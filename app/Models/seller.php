<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    use HasFactory;
    protected $table = 'seller';
    protected $fillable = ['namaToko','alamatToko','validateEmail','status','phoneSeller','gambarSeller'];
}
