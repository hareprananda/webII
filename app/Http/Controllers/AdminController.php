<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Peran;
use Auth;
use App\User;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        if(Auth::guest()){
            return route("login");
        }
    }
    public function house(){
        
        return view("dashboard.house");
    }
    public function ruangan($data){
        if($data=="aulalab"){
            $dat=Kelas::where("jenis","Aula & Lab")->get();
        }
        else{
            $dat=Kelas::where("jenis",$data)->get();
        }
        return view("dashboard.jadwal",["data"=>$dat,"id"=>$data]);
    }
    public function profile(){
        $id=Auth::user()->id;
        $data=User::find($id);

        $peran=Peran::select("nama")->where("id",$data->peran_id)->get();
        return view('dashboard.profil',['peran'=>$peran,'data'=>$data]);

    }
}
