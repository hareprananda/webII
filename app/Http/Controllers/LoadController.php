<?php

namespace App\Http\Controllers;
use App\Kelas;
use Illuminate\Http\Request;
use Auth;
class LoadController extends Controller
{
    public function modal($data,$date){
        if(!(Auth::user())){
            return abort(404);
        }
            return view("layouts.modal",["kelas"=>Kelas::where('nama_kelas',$data)->first(),"tanggal"=>$date]);
        
    }
}
