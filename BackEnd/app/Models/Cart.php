<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'tbl_t_order_cart';
    protected $fillable = ['qty_ttoc','total_price_ttoc','description_ttoc', 'id_ttps', 'id_tmu'];
}
