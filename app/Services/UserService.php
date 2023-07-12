<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;

class UserService
{
    public function createUser($requestData)
    {
        return User::create([
            'usernames' => $requestData->input('usernames'),
            'userFirstName' => $requestData->input('userFirstName'),
            'userLastName' => $requestData->input('userLastName'),
            'userPhone' => $requestData->input('userPhone'),
            'userEmail' => $requestData->input('userEmail'),
            'userPassword' => Hash::make($requestData->input('userPassword')),
            'gender' => $requestData->input('gender'),
        ]);
    }

    public function getUserByEmail($email)
    {
        return User::where('userEmail', $email)->first();
    }

    public function changePassword($oldPassword, $newPassword, $confirmPassword, $user)
    {
        if (Hash::check($oldPassword, $user->userPassword)) {
            if ($newPassword === $confirmPassword) {
                $user->userPassword = Hash::make($newPassword);
                $user->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUserByToken($token)
    {
        return User::where('remember_token', $token)->first();
    }

    public function sendPasswordResetLink($user)
    {
        $user->remember_token = Str::random(30);
        $user->save();
        Mail::to($user->userEmail)->send(new ForgotPasswordMail($user));
    }

    public function resetPassword($newPassword, $confirmPassword, $user)
    {
        if ($newPassword === $confirmPassword) {
            $user->userPassword = Hash::make($newPassword);
            $user->remember_token = Str::random(30);
            $user->save();
            return true;
        } else {
            return false;
        }
    }
}
