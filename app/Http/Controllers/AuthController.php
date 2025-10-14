<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user=User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->remember );
            return redirect()->route('home')->with('success', 'You are logged in');
        }else{
            return redirect()->back()->with('error', 'Invalid Credentials');
        }

    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
//        return $request;
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

       $user= User::create($data);

       if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           Auth::login($user);
//           $role=Role::where('name','user')->first();
//           $role = Role::create([
//               'name' => 'user',
//               'display_name' => 'Project user', // optional
//               'description' => 'User is the user of a given project', // optional
//           ]);
//           $user->addRole($role);
           return redirect()->route('login');
       }else{
           return redirect()->back()->with('error', 'Invalid Credentials');
       }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
