<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Peran;
use App\Jadwal;
use Auth;
use App\User;
use Hash;
class UserController extends Controller
{
    public $tempatgambar;
    public $dimensi;

    public function __construct(){
        $this->middleware('auth');
        $this->tempatgambar=storage_path('app/public/images');
        $this->dimensions = ['245', '300', '500'];
        if(Auth::guest()){
            return route("login");
        }
    }
    public function house(){
        
        return view("dashboard.house"); 
    }
    public function ruangan($data){
        $today=date("Y-m-d");

        if($data=="aulalab"){
            $dat=Jadwal::whereHas('kelas', function($q) use($data){
                $q->where('jenis', "Aula & Lab");
            })->where('tanggal',$today)->get();
        }
        else{
            $dat=Jadwal::whereHas('kelas', function($q) use($data){
                $q->where('jenis', $data);
            })->where('tanggal',$today)->get();
        }
        if($data=='aulalab'){
            $data='Aula & Lab';
        }
        $kelas=Kelas::where('jenis',$data)->get()->pluck('nama_kelas');
        return view("dashboard.jadwal",["data"=>$dat,'jenis'=>$data,"kelas"=>$kelas,"tanggal"=>$today]);

               
    }
    public function search($data){
        $date=$_GET['tanggal'];

        if($data=="aulalab"){
            $dat=Jadwal::whereHas('kelas', function($q) use($data){
                $q->where('jenis', "Aula & Lab");
            })->where('tanggal',$date)->get();
        }
        else{
            $dat=Jadwal::whereHas('kelas', function($q) use($data){
                $q->where('jenis', $data);
            })->where('tanggal',$date)->get();
        }
        if($data=='aulalab'){
            $data='Aula & Lab';
        }
        $kelas=Kelas::where('jenis',$data)->get()->pluck('nama_kelas');
        return view("dashboard.jadwal",["data"=>$dat,'jenis'=>$data,"kelas"=>$kelas,"tanggal"=>$date]);

    }
    public function profile(){
        
        $data=Auth::user();
        
        $peran=Peran::select("nama")->where("id",$data->peran_id)->get();
        
        $history=Jadwal::where('pemesan',$data->id)->orderBy('created_at', 'desc')->get();
        
        return view('dashboard.profil',['peran'=>$peran,'data'=>$data,"history"=>$history]);

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
    public function booking(Request $request){
    
        if($request->mulai > $request->selesai){
            return redirect()->back()->with("gagal","Waktu mulai dan selesai tidak relevan");
        }
        if($request->mulai > "22:00" || $request->mulai < "07:30"){
            return redirect()->back()->with("gagal","Booking kelas dapat dilakukan dari jam 07:30 AM sampai 22:00PM");
        }
        Jadwal::create([
            "pemesan"=>Auth::user()->id,
            "mulai"=>$request->mulai,
            "selesai"=>$request->selesai,
            "tanggal"=>$request->tanggal,
            "id_kelas"=>$request->kelas,
            "keperluan"=>$request->keperluan
        ]);
        return redirect()->back()->with("sukses","Booking kelas sedang dalam proses verifikasi");
    }
    
}
