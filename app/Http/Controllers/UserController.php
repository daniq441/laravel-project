<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\Validation;
use App\Http\Requests\ForgetValidation;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function create()
    {
        return $this->getUserService()->create();
    }

    public function login()
    {
        return $this->getUserService()->login();
    }

    public function store(Validation $request)
    {
        return $this->getUserService()->createUser($request);
    }

    public function loggedin(LoginValidation $request)
    {
        return $this->getUserService()->getUserByEmail($request);
    }

    public function password()
    {
        return $this->getUserService()->password();
    }

    public function resetpassword(Request $request)
    {
        return $this->getUserService()->changePassword($request);
    }

    public function forgetpassword()
    {
        return $this->getUserService()->forgetpassword();
    }

    public function sendlink(ForgetValidation $request)
    {
        return $this->getUserService()->sendPasswordResetLink($request);
    }

    public function resetscreen($remember_token)
    {
        return $this->getUserService()->resetscreen($remember_token);
    }

    public function pwreset($token, Request $request)
    {
        return $this->getUserService()->resetPassword($token, $request);
    }

    public function logout()
    {
        return $this->getUserService()->logout();
    }
}
