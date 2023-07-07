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
        'gender',
    ];

    protected $hidden = [
        'userPassword',
        '_token',
    ];

    public function getUserByEmail($email)
    {
        return $this->where('userEmail', $email)->first();
    }
}
