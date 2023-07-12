<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\Validation;
use App\Http\Requests\ForgetValidation;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
        try {
            $this->userService->createUser($request);
            return redirect()->route('login')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->route('signup')->with('error', 'Registration unsuccessful!');
        }
    }

    public function loggedin(LoginValidation $request)
    {
        $userData = $this->userService->getUserByEmail($request->userEmail);

        if ($userData && Hash::check($request->userPassword, $userData->userPassword)) {
            Session::put('user_id', $userData->user_id);
            Session::put('usernames', $userData->usernames);
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
        $user = Session::get('user_id');
        $user = User::find($user);

        if ($this->userService->changePassword($request->oldPassword, $request->newPassword, $request->confirmPassword, $user)) {
            return back()->with('success', 'Password Changed');
        } else {
            return back()->with('error', 'Old password is incorrect or new password and confirm password do not match.');
        }
    }

    public function forgetpassword()
    {
        return view('user.forgetpw');
    }

    public function forget(ForgetValidation $request)
    {
        $user = $this->userService->getUserByEmail($request->userEmail);

        if (!empty($user)) {
            $this->userService->sendPasswordResetLink($user);
            return back()->with('success', 'Link sent successfully. Check your emails.');
        } else {
            return back()->with('error', 'Email does not exist.');
        }
    }

    public function reset($remember_token)
    {
        $user = $this->userService->getUserByToken($remember_token);

        if (!empty($user)) {
            $data['user'] = $user;
            return view('user.reset', $data);
        } else {
            abort(404);
        }
    }

    public function rreset($token, Request $request)
    {
        $user = $this->userService->getUserByToken($token);

        if ($this->userService->resetPassword($request->userPassword, $request->cuserPassword, $user)) {
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
