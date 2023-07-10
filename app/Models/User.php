<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'usernames',
        'userFirstName',
        'userLastName',
        'userPhone',
        'userEmail',
        'userPassword',
        'remember_token',
        'gender',
    ];

    protected $hidden = [
        'userPassword',
        'remember_token',
    ];

    public function getUserByEmail($email)
    {
        return $this->where('userEmail', $email)->first();
    }

    public function getEmailCheck($email){
        return User::where('userEmail', '=', $email)->first();
    }

    public function getTokenCheck($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }
}
