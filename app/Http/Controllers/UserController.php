<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserController extends Controller
{
    protected $casts = [
        'categories' => 'array',
    ];

    // Display the form for editing user preferences
    public function editPreferences()
    {
        $user = auth()->user();
        $preferences = $user->preference()->firstOrCreate(
            ['user_id' => $user->id],
            ['categories' => json_encode([])] // Default to empty categories
        );
        // No need to json_decode because 'categories' is already cast to an array
        $selectedCategories = $preferences->categories ?: [];
    
        return view('profile.preferences', compact('selectedCategories'));
    }
    
    

    // Save the updated preferences
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
        ]);

        $user = auth()->user();
        $user->preference()->update([
            'categories' => json_encode($request->categories),
        ]);

        return redirect()->route('dashboard')->with('success', 'Preferences updated successfully!');
    }
}
