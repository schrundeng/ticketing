<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ticket';
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id_ticket'; //uuid
    protected $keyType = 'uuid';

    protected $fillable = [         
        'id_user', // uuid
        'id_pengelola', // varchar
        'description', // texts
        'id_category', // uuid
        'date_created', // timestamp
        'status', // int4
        'status_note', // varchar
        'created_at', // date
        'updated_at' // date
    ];

    public function userRelation()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }
    public function pengelolaRelation()
    {
        return $this->belongsTo(pengelolaModel::class, 'id_pengelola', 'id_pengelola');
    }
    public function categoryRelation()
    {
        return $this->belongsTo(CategoryModel::class, 'id_category', 'id_category');
    }
}