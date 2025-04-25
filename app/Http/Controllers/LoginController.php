<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view("login");
    }
    public function actionLogin(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required|min:7'
        ]);

        // $email = $request->email;
        // $password = $request->password;
        $credentials = $request->only('email','password');
        // Auth
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $contents = File::get(base_path('resources/views/layouts/inc/routing.json'));
            $routings = json_decode(json: $contents, associative: true);
            $privilage = [];

            foreach ($routings as $route) {
                $privilage[$route['route']][] = $route['privilage'];
            }

            $request->session()->put('routings' , $routings);
            $request->session()->put('privilage' , $privilage);
            
            
            return redirect('dashboard')->with('success', 'Success Login');
        } else {
            return back()->withErrors(['email'=> 'Please check your creddentials'])->withInput();
        }
    }
    public function logout(request $request): RedirectResponse {
        auth::logout();
        Session::flush();
        return redirect('login')->with('Success', '');
    }
}
