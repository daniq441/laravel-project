<?php

namespace App\Services;
use App\Models\User;
class Config
    {
    public function getUserModel()
    {
        return new User();
    }
}