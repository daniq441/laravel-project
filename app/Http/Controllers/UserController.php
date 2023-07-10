<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\ForgetValidation;
use App\Models\User;
// use Illuminate\Support\Facades\Request as Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Validation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;

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
    public function loggedin(LoginValidation $request)
    {
        $user = new User();
        $userData = $user->getUserByEmail($request->userEmail);

        if ($userData && Hash::check($request->userPassword, $userData->userPassword)) {
            session()->put('user_id', $userData->user_id);
            session()->put('usernames', $userData->usernames);
            return redirect()->route('welcome')->with('success', 'Login successful!');
        } else {
            return redirect()->route('login')->with('error', 'Email/Password incorrect');
        }
    }

    public function password()
    {
        return view('user.changepw');
    }

    public function resetpassword(Request $request)
    {
        $user = session()->get('user_id'); 
        $user = User::find($user);
        
        if (Hash::check($request->oldPassword, $user->userPassword)) {
            if ($request->newPassword === $request->confirmPassword) {
                $user->userPassword = Hash::make($request->newPassword);
                $user->save();
                return back()->with('success', 'Password Changed');
            } else {
                return back()->with('error', 'New password and confirm password do not match.');
            }
        } else {
            return back()->with('error', 'Old password is incorrect.');
        }
    }

    public function forgetpassword()
    {
        return view('user.forgetpw');
    }

    public function forget(ForgetValidation $request)
    {
        $user = new User();
        $user = $user->getEmailCheck($request->userEmail);
        // dd($getEmailCheck);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->userEmail) // Update to use the correct email field
                ->send(new ForgotPasswordMail($user));
            return back()->with('success', 'Link sent successfully. Check your emails.');
        } else {
            return back()->with('error', 'Email does not exist.');
        }
    }
    
    public function reset($remember_token){
        // dd($remember_token);
        $user = new User();
        $user = $user->getTokenCheck($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('user.reset', $data);
        }
        else{
            abort(404);
        }
    }

    public function rreset($token, Request $request){
        // dd($token);
        if($request->userPassword == $request->cuserPassword)
        {
            $user = new User();
            $user = $user->getTokenCheck($token);
            $user->userPassword = Hash::make($request->userPassword);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect()->route('login')->with('success', 'Password changed successfully');
        }
        else{
            return back()->with('error', 'Password does not match');
        }
    }

    public function logout(){
        session()->forget('user_id');
        return redirect()->route('login')->with('success', 'Logout successfully!');
    }


}
