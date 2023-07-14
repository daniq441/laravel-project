<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class UserService extends Config
{
    public function create()
    {
        return view('user.create');
    }

    public function login()
    {
        return view('user.login');
    }

    public function forgetpassword()
    {
        return view('user.forgetpw');
    }

    public function password()
    {
        return view('user.changepw');
    }
    
    public function createUser($requestData)
    {
        $this->getUserModel()->create([
            'usernames' => $requestData->input('usernames'),
            'userFirstName' => $requestData->input('userFirstName'),
            'userLastName' => $requestData->input('userLastName'),
            'userPhone' => $requestData->input('userPhone'),
            'userEmail' => $requestData->input('userEmail'),
            'userPassword' => Hash::make($requestData->input('userPassword')),
            'gender' => $requestData->input('gender'),
        ]);
        return redirect()->route('login')->with('success', 'Registration successful!');

    }

    public function getUserByEmail($request)
    {
        // $user = new User();
        $userData =  $this->getUserModel()->getUserByEmail($request->userEmail);
        if ($userData && Hash::check($request->userPassword, $userData->userPassword)) {
            Session::put('user_id', $userData->user_id);
            Session::put('usernames', $userData->usernames);
            return redirect()->route('welcome')->with('success', 'Login successful!');
        } else {
            return redirect()->route('login')->with('error', 'Email/Password incorrect');
        }
    }

    public function changePassword($request)
    {
        // $user = new User();
        
        $user_data =  $this->getUserModel()->getUserById(session('user_id'));
        if (Hash::check($request->oldPassword, $user_data->userPassword)) {
            if ($request->newPassword === $request->confirmPassword) {
                $user_data->userPassword = Hash::make($request->newPassword);
                $user_data->save();
                return back()->with('success', 'Password Changed');
                
            } 
            else 
            {
                return back()->with('error', 'Old password is incorrect or new password and confirm password do not match.');
            }
        } 
        else 
        {
            return back()->with('error', 'Old password is incorrect or new password and confirm password do not match.');
        }
    }

    public function sendPasswordResetLink($request)
    {
        // $user_model = new User();
        $user =  $this->getUserModel()->getUserByEmail($request->userEmail);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->userEmail)->send(new ForgotPasswordMail($user));
            return back()->with('success', 'Link sent successfully. Check your emails.');
        }
        else
        {
            return back()->with('error', 'Email does not exist.');
        }
    }


    public function resetscreen($remember_token)
    {
        // $user_model = new User();
        $user =  $this->getUserModel()->getUserByToken($remember_token);

        if (!empty($user)) {
            $data['user'] = $user;
            return view('user.reset', $data);
        } else {
            abort(404);
        }
    }

    public function resetPassword($token, $request)
    {
        // $user = new User();
        $user_data =  $this->getUserModel()->getUserByToken($token);
        if ($request->userPassword === $request->cuserPassword) {
            $user_data->userPassword = Hash::make($request->userPassword);
            $user_data->remember_token = Str::random(30);
            $user_data->save();
            return redirect()->route('login')->with('success', 'Password changed successfully');
        } else {
            return back()->with('error', 'Password does not match');
        }
    }

    public function logout()
    {
        Session::forget('user_id');
        return redirect()->route('login')->with('success', 'Logout successfully!');
    }
}
