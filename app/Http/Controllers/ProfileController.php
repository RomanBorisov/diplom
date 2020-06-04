<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Auth;
use Hash;
use Nexmo;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Get the User Profile View
     */
    public function profile()
    {
        return view('profile');
    }
    /**
     * Update the Authenticated user profile
     */
    public function update(Request $request)
    {
        //Validation rules
        $this->validate($request, [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|string|max:255',
            'phone_number' => 'required|min:11|max:12'
        ]);
        $user = Auth::user();

        //Сlear phone/email verification date if they has been changed
        if ($user->email !== $request['email'])    {
            $user->email_verified_at = NULL;
            $this->middleware('throttle:6,1')->only('verify', 'resend');
        }
        

        if ($user->phone_number !== $request['phone_number'])    {
            $user->phone_verified_at = NULL;
            $this->sendCodeToPhoneNum($request);
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->phone_number = $request['phone_number'];
            $user->save();
        
            return redirect('/nexmo');
        }

        //Save the Profile updates
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->save();
        
        return redirect('/profile');
    }
    /**
     * Get the profile view for changing the password
     */
    public function changePasswordView()
    {
        return view('changePassword');
    }

    /**
     * Change password for the authenticated user
     */
    public function changePassword(Request $request)
    {
        if ( !( Hash::check( $request->get('current-password'), Auth::user()->password) ) ) {
            return back()->with('error', 'Введённый пароль не совпадает с текущим');
        }
        if ( strcmp( $request->get('current-password'), $request->get('new-password') ) == 0 ) {
            return back()->with('error', 'Новый пароль не должен совпадать с текущим');
        }
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed'
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect('/profile')->with('success', 'Пароль успешно изменён');
    }


    /**
     * Send code to specified phone number
     */
    public function sendCodeToPhoneNum($data)
    {

        $verification = Nexmo::verify()->start([
            'number' => $data['phone_number'],
            'brand' => 'Кредитная орг.',
        ]);
        
        session(['nexmo_request_id' => $verification->getRequestId()]);

    }
}
