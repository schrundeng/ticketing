<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table  = 'User', $primaryKey = 'id_user';
    public $fillable = ['name', 'username', 'email', 'password'];
}
