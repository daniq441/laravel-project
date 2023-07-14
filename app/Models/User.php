<?php
namespace App\Models;
namespace App\Services;

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
    public function getUserById($id)
    {
        return $this->where('user_id', $id)->first();
    }

    public function getEmailCheck($email){
        return User::where('userEmail', '=', $email)->first();
    }

    public function getTokenCheck($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }

    public function getUserByToken($token)
    {
        return $this->where('remember_token', $token)->first();
    }
}
