@extends('layouts.custom-app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Dashboard</h1>
    @foreach ($newsItems as $category => $articles)
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">{{ ucfirst($category) }}</h2>
            <div class="space-y-4">
                @foreach ($articles as $article)
                    <div class="p-4 bg-white shadow rounded-lg">
                        <h3 class="font-bold text-md">{{ $article['title'] }}</h3>
                        <p class="text-sm">{{ $article['description'] }}</p>
                        <a href="{{ $article['url'] }}" target="_blank" class="text-indigo-500 hover:text-indigo-600 text-sm">Read more</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

