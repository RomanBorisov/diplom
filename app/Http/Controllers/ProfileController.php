<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Auth;

class ProfileController extends Controller
{
    /**
     * Get the User Profile View
     */
    public function profile()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|string|max:255'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return redirect('/profile')->with('success', 'Изменения сохранены!');
    }
}
