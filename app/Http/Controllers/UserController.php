<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserController extends Controller
{
    // Display the form for editing user preferences
    public function editPreferences()
    {
        $user = auth()->user();
        $preferences = $user->preference()->firstOrCreate(
            ['user_id' => $user->id],
            ['categories' => json_encode([])] // Default to empty categories
        );
        // Ensure we have an array, even if it's empty
        $selectedCategories = json_decode($preferences->categories, true) ?: [];
    
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
