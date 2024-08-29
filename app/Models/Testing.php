<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;
    protected $table = 'playing_with_neon';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'value',
    ];

}

