<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class pengelolaModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'pengelola';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'id_pengelola';

    protected $keyType = 'string'; // id_pengelola is a string (varchar)
    protected $fillable = [
        'id_pengelola',
        'name',
        'username',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
