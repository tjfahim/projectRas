<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function editProfile()
    {
        $user = auth()->user();
        return view('user.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
    
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $user->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
    
    public function editPassword()
    {
        return view('user.editPassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Get the authenticated user
        $user = auth()->user();

       
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The old password is incorrect']);
        }

        // Update the user's password
        $user->password = bcrypt($request->password);
        $user->save();
      

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }
}
