<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryModel extends Model
{
    use HasFactory;

    protected $keytype = 'string', $table = 'category', $primaryKey = 'id_category', $fillable = ['name'];
    public $timestamps = false, $incrementing = false;
}
