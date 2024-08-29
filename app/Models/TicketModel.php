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
    protected $guarded = ['id_ticket']; // Guard the id_ticket so Laravel doesn’t touch it
    protected $primaryKey = 'id_ticket'; //uuid
    protected $keyType = 'string';

    protected $fillable = [
        'id_user', // uuid
        'id_pengelola', // varchar
        'description', // text
        'id_category', // uuid
        'status', // int4
        'status_note', // varchar
        'created_at', // date
        'updated_at' // date
    ];
}
