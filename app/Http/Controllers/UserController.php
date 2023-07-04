<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Validation;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }
    public function login()
    {
        return view('user.login');
    }

    public function store(Validation $request)
    {
        // $request_params = Input::all();
        // echo "<pre>";
        // print_r($request_params);
        // die();

        // $alreadyexistemail = user::where('userEmail', $request->input('userEmail'))->get();
        // if($alreadyexistemail->isEmpty()){
        //     return back()->withInput()->withErrors(['userEmail'=>'Email already exist']);
        // }
        
        try {
            User::create([
                'usernames' => $request->input('usernames'),
                'userFirstName' => $request->input('userFirstName'),
                'userLastName' => $request->input('userLastName'),
                'userPhone' => $request->input('userPhone'),
                'userEmail' => $request->input('userEmail'),
                'userPassword' => Hash::make($request->input('userPassword')),
                'gender' => $request->input('gender'),
            ]);
        return redirect()->route('login')->with('success', 'Registration successful!');

        } catch (\Exception $e) {

            return redirect()->route('signup')->with('error', 'Registration unsuccessful!');

        }
        
    }
public function loggedin(Request $request)
{
    $user = User::where('userEmail', $request->userEmail)->first();
    
    if ($user && Hash::check($request->userPassword, $user->userPassword)) {
        session()->put('userId', $user->userId);
        $username = $user->usernames;
        session()->put('usernames', $username);
        return redirect()->route('welcome')->with('success', 'Login successful!');
    } else {
        // Email and password do not match
        // Perform necessary actions (e.g., show an error message, redirect back, etc.)
        return redirect()->route('login')->with('error', 'Email/Password incorrect');
    }
}
    public function logout(){
        session()->forget('userId');
        return redirect()->route('login')->with('success', 'Logout successfully!');
    }
}
