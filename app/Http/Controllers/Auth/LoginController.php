<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;




class LoginController extends Controller
{
 

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

   
    public function __construct()
    {
     
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password',);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('welcome');
           //return view('/auth/verify');
        }
        else
        {
           $data=false;
           return response()->json($data);
        }

    }
    public function redirectPath()
    {
        dd('redirectPath');
        return '/autenticar';
    }
  
}
