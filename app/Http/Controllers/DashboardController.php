<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;

class DashboardController extends Controller
{
    public function index(NewsService $newsService)
    {
        $user = auth()->user();
        $preferences = optional($user->preference)->categories ?: [];
        $newsItems = [];

        foreach ($preferences as $category) {
            $newsItems[$category] = $newsService->fetchNewsByCategory($category);
        }

        return view('dashboard', compact('newsItems'));
    }
}
