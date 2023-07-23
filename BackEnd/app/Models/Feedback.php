<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'tbl_l_feedback';
    protected $fillable = ['feedback_tlf','id_tmu',];
}
