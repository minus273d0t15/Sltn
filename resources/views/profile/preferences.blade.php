@extends('layouts.custom-app')

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center">
    <div class="container">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Edit Preferences</h1>
            <form action="{{ route('profile.updatePreferences') }}" method="POST" class="space-y-4">
                @csrf
                <fieldset>
                    <legend class="text-lg font-semibold text-gray-800">Select your news categories:</legend>
                    <div class="mt-2">
                        @foreach(['technology', 'sports', 'business'] as $category)
                            <label class="inline-flex items-center">
                                <input class="form-checkbox text-indigo-600" type="checkbox" name="categories[]" value="{{ $category }}"
                                    @if(is_array($selectedCategories) && in_array($category, $selectedCategories)) checked @endif>
                                <span class="ml-2 text-gray-700">{{ ucfirst($category) }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
        <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-black font-bold rounded-lg shadow">Save Preferences</button>
    </form>
</div>
@endsection
