<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoadController extends Controller
{
    public function modal($data){
        if(!(Auth::user())){
            return abort(404);
        }
            return view("layouts.modal",["ruangan"=>$data]);
        
    }
}
