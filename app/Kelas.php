<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table="kelas";

    public function jadwal(){
        return $this->hasMany('App\Jadwal','id_kelas','id');
    }
}
