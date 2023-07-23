<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_t_product_store';
    protected $fillable = ['name_ttps','image_ttps','price_ttps','status_ttps','id_tms'];
}
