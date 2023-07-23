<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'tbl_t_order_purchase';
    protected $fillable = ['qty_ttop','total_price_ttop','description_ttop','status_ttop','id_ttps','id_tmd','id_ttca', 'transaction_ttop'];

}
