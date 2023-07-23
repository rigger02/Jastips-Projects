<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'tbl_m_driver';
    protected $fillable = ['id_tmu','status_tmd', 'status_active_account'];

    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }
}
