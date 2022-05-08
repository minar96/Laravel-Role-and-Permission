<?php

namespace App\Http\Controllers\BackEnd\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }
    public function login(Request $request)
    {
        //validate Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        //Attempt to login

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirect to Dashboard
            session()->flash('success', 'Successfully Login');
            return redirect()->intended(route('admin.index'));
        }else{
            //search by username
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
                // Redirect to Dashboard
                session()->flash('success', 'Successfully Login');
                return redirect()->intended(route('admin.index'));
            }
            //show error in login
            session()->flash('error', 'Invalid Login');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
         return redirect()->route('admin.login');
    }
}
