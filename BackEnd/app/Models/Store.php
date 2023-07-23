<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'tbl_m_store';
    protected $fillable = ['name_tms','phone_tms','image_tms','address_tms','id_tmu','status_tms'];
}
