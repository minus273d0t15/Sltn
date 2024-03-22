<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class NewsService
{
    protected $baseUrl = 'https://newsapi.org/v2';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NEWS_API_KEY');
    }

    public function fetchNewsByCategory($category)
    {
        $cacheKey = "news_{$category}";
    
        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($category) {
            $response = Http::get("{$this->baseUrl}/top-headlines", [
                'category' => $category,
                'apiKey' => $this->apiKey,
                'country' => 'us' // specify the country if required
            ]);
    
            if ($response->successful()) {
                $articles = $response->json()['articles'];
    
                // Filter out articles with '[Removed]' in title or content
                $filteredArticles = array_filter($articles, function ($article) {
                    return $article['title'] !== '[Removed]' && $article['content'] !== '[Removed]';
                });
    
                return array_values($filteredArticles); // Reset keys after filtering
            } else {
                logger()->error("Failed to fetch news: " . $response->body());
                return [];
            }
        });
    }
    

    public function index(NewsService $newsService)
        {
            $user = auth()->user();
            $preferences = optional($user->preference)->categories ?: [];

            $newsItems = [];
            foreach ($preferences as $category) {
                // Fetch and format the news items for each preferred category
                $newsItems[$category] = $newsService->fetchNewsByCategory($category);
            }

            // Make sure the variable name here matches what you use in the view
            return view('dashboard', compact('newsItems'));
        }

}
