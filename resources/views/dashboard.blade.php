@extends('layouts.custom-app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-5xl font-bold text-center text-white mb-10">Dashboard</h1>
    @foreach ($newsItems as $category => $articles)
        <div class="mb-12 my-8"><br />
            <div class="my-8 py-4 border-t border-b border-gray-200">
                <h2 class="text-3xl font-semibold text-white text-center">{{ ucfirst($category) }}</h2>
            </div><br />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-3">{{ $article['title'] }}</h3>
                            <p class="text-gray-600 text-sm">{{ $article['description'] }}</p>
                        </div>
                        <div class="bg-gray-100 p-4">
                            <a href="{{ $article['url'] }}" target="_blank" class="text-indigo-500 hover:text-indigo-600 text-sm font-semibold">Read more</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

