<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'tbl_t_customer_address';
    protected $fillable = [
        'name_ttca',
        'phone_ttca',
        'static_ttca',
        'isActive_ttca',
        'dynamic_ttca',
        'id_tmu',
    ];
}
