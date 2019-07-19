<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(["auth","admin"]);
    }
    public function table(){
        $data=User::query()->where("peran_id","2")->paginate(10);

        return view("dashboard.user",["data"=>$data]);
    }
    public function cari(Request $request){
        if(strlen($request->search)==0){
            return redirect("/user");
        }
        $request->validate([
            'search' => 'required|max:100'
        ]);
        $search=$request->search;

        $data=User::where("name","LIKE","%".$search."%")
        ->orWhere("email","LIKE","%".$search."%")->paginate(10)->setpath('');

        $data->appends($request->only('search'));
        return view("dashboard.user",["data"=>$data]);
    }
    public function unverify($id){
        $data=User::find($id);
        $data->status="unverified";
        $data->save();
        return back()->with(["sukses"=>"Status user berhasil diubah"]);
    }
    public function approve($id){
        $data=User::find($id);
        $data->status="approve";
        $data->save();
        return back()->with(["sukses"=>"Status user berhasil diubah"]);
    }
}

