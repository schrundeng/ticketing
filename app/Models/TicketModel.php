<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    use HasFactory;
    protected $table = 'ticket';
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id_ticket'; //uuid
    protected $keyType = 'uuid';

    protected $fillable = [         
        'id_user', // uuid
        'id_pengelola', // varchar
        'description', // text
        'id_category', // uuid
        'date_created', // timestamp
        'status', // int4
        'status_note', // varchar
        'created_at', // date
        'updated_at' // date
    ];
}
