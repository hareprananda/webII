<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){

    }
    public function table(){
        $data=User::query()->where("peran_id","2")->paginate(10);

        return view("dashboard.user",["data"=>$data]);
    }
    public function cari(Request $request){
        $request->validate([
            'search' => 'required|max:100'
        ]);
        $search=$request->search;

        $data=User::where("name","LIKE","%".$search."%")
        ->orWhere("email","LIKE","%".$search."%")->paginate(10)->setpath('');

        $data->appends($request->only('search'));
        return view("dashboard.user",["data"=>$data]);
    }
}
