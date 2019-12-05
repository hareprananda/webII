<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table='jadwal';
    protected $fillable=['pemesan','mulai','selesai','tanggal','id_kelas','keperluan',"status"];
    public function pemesann(){
        return $this->belongsTo('App\User','pemesan','id');
    }

    public function kelas(){
        return $this->belongsTo('App\Kelas','id_kelas','id');
    }
}
