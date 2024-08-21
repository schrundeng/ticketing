<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TicketModel extends Model
{
    use HasFactory;
    protected $table = 'ticket', $primaryKey = 'id_ticket', $fillable = [
        'id_user',
        'id_pengelola',
        'description',
        'id_category',
        'date_created',
        'status',
        'status_note'
    ];
    public $timestamp = false, $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_ticket)) {
                $model->id_ticket = Str::uuid();
            }
        });
    }
}
