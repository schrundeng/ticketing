<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absenModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'absen';
    public $timestamps = false;
    protected $primaryKey = 'id_absen';

    protected $fillable = [
        'id_absen',
        'id_pengelola',
        'login_date',
        'logout_date',
        'status',
    ];
}

