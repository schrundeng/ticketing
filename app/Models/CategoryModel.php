<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryModel extends Model
{
    use HasFactory;

    protected $keytype = 'string', $table = 'category', $primaryKey = 'id_category', $fillable = ['name', 'color'];
    public $timestamps = false, $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_category)) {
                $model->id_category = Str::uuid();
            }
        });
    }
}
