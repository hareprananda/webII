<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Peran;
use Auth;
use App\User;
use Hash;
class UserController extends Controller
{
    public $tempatgambar;
    public $dimensi;

    public function __construct(){
        $this->tempatgambar=storage_path('app/public/images');
        $this->dimensions = ['245', '300', '500'];
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
        
        $data=Auth::user();

        $peran=Peran::select("nama")->where("id",$data->peran_id)->get();
        
       
        
        return view('dashboard.profil',['peran'=>$peran,'data'=>$data]);

    }
    public function ubah(Request $post){
        $post->validate([
            'name' => 'required|max:255',
            'photo' => 'image',
            
        ]);
        $user=Auth::user();

        $user->name=$post->input("name");
        if($post->hasFile("photo")){
            $file=$post->file("photo");
            $extensi=$file->getClientOriginalExtension();
            $filename=$user->id.time().".".$extensi;
            $file->move("img/user",$filename);
            $user->photo=$filename;
        }
        $kembali=$user->save();
        if($kembali){
            return redirect()->back()->with(['success' => 'Berhasil diedit',"buka"=>"1"]);}
        else{
            return redirect()->back()->with(['error' => 'Gagal Diedit',"buka"=>"1"]);
        }
    }
    public function ubahPas(Request $request){
        $user=Auth::user();
        $new=$request->new;
        $old=$request->old;
        $confirm=$request->confirm;
        if($new!=$confirm){
            return back()->with(['perror' => 'Password Salah',"buka"=>"1"]);
        }
        if(Hash::check($old,$user->password)){
            $user->password=Hash::make($new);
            $kembali=$user->save();
            if($kembali){
                return back()->with(['psuccess' => 'Berhasil diubah',"buka"=>"1"]);
            }
                
            
        }
        return back()->with(['perror' => 'Password Salah',"buka"=>"1"]);
    }
    
}
