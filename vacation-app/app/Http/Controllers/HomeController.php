<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller {
    
    //constructor Controller -> reglas de control de acceso
    function __construct() {
        $this->middleware('auth')->only(['index']);
        $this->middleware('verified')->only(['edit', 'update']);
    }

    function edit(): View {
        return view('auth.edit');
    }

    function index(): View {
        return view('auth.home');
    }

    function update(Request $request): RedirectResponse {
        $user = Auth::user();
        $rules = [
            'name'            => 'required|max:255',
            'email'           => 'required|max:255|email',
            'currentpassword' => 'nullable|current_password',
            'password'        => 'nullable|min:8|confirmed'
        ];
        $messages = [
            'name.required'                     => 'Name is required',
            'name.max'                          => 'Name is too long',
            'email.required'                    => 'Email is required',
            'email.max'                         => 'Email is too long',
            'email.email'                       => 'Invalid email format',
            'currentpassword.current_password'  => 'Incorrect current password',
            'password.min'                      => 'Password must be at least 8 characters',
            'password.confirmed'                => 'Passwords do not match',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        if($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }
        if($request->password != null && $request->currentpassword != null) {
            $user->password = Hash::make($request->password);
            //Auth::logout();
        }
        try {
            $result = $user->save();
            $message = 'User profile updated successfully.';
        } catch(\Exception $e) {
            $message = 'Error updating profile.';
            $result = false;
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('home')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
}