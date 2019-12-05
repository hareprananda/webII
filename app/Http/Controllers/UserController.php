<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Peran;
use App\Jadwal;
use Auth;
use App\User;
use Hash;
use Validator;
use View;
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
    public function house(Request $request){
        $page=5;
        if($request->ajax()){
               
                $jadwal=Jadwal::where("tanggal",request()->tanggal)->where("status","approve")->where("keperluan","LIKE","%".request()->keterangan."%")->orderBy("mulai","asc")->paginate($page);
            $view="";
            if(count($jadwal) >= 1){

            
                foreach($jadwal as $je=>$jen){
                    $view.="
                    <tr>
                        <td>".$jen->kelas->nama_kelas."</td>
                        <td>".$jen->mulai."-".$jen->selesai."</td>
                        <td>".$jen->keperluan."</td>                
                    </tr>";
                    
                }   
            }else{
                $view="<p class='text-danger' style='font-size:18px;'>Kelas yang anda cari tidak ditemukan</p>";
            }
            $hasil=[
                "view"=>$view,
                "pagination"=> View::make('ajax.pagination')->with("data",$jadwal)->render()
            ];
            return response()->json($hasil);
        }
            
        
        $jenis=[
            "100","200","300","400","500","Aula & Lab"
        ];
        $jadwal=Jadwal::where("tanggal",date("Y-m-d"))->where("status","approve")->orderBy("mulai","asc")->paginate($page);
        return view("dashboard.house",["jenis"=>$jenis,"jadwal"=>$jadwal]); 
    }
    public function ruangan($data){
        $active=8;
        if($data != "aulalab"){
            $active=$data/100+2;
        }
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
        $kelas=Kelas::select("id","nama_kelas")->where('jenis',$data)->get();
        
        return view("dashboard.jadwal",["data"=>$dat,'jenis'=>$data,"kelas"=>$kelas,"active"=>$active]);
    }
    public function search($data){
        
        if(request()->keterangan){
            $jadwal=Jadwal::find(request()->idJadwal);
            return response()->json(["pesan"=>$jadwal->keperluan]);
        }
        if($data == "Aula &amp; Lab"){
            $data="Aula & Lab";
        }

        $dat=Jadwal::whereHas('kelas', function($q) use($data){
            $q->where('jenis', $data);
        })->where('tanggal',request()->tanggal)->get();
        $kelas=Kelas::where('jenis',$data)->get();
        
        $view= View::make("ajax.jadwal")->with("data",$dat)->with("jenis",$data)->with("kelas",$kelas)->render();        
        $hasil=[
            "view"=>$view,
        ];
        return response()->json($hasil);

    }
    public function profile(){        
        $data=Auth::user();        
        $peran=Peran::select("nama")->where("id",$data->peran_id)->get();        
        $history=Jadwal::where('pemesan',$data->id)->orderBy('tanggal', 'desc')->get();
        
        return view('dashboard.setting',['peran'=>$peran,'data'=>$data,"history"=>$history]);

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
    public function ajaxpoto(Request $request){
        //return $request->photo;
        $user=Auth::user();
        $validator = Validator::make($request->all(),
            [
                'photo' => 'image',
            ],
            [
                'photo.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
            ]);
        if ($validator->fails())
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $request->file('photo')->move("img/user", $filename);
        if($user->photo != "nophoto.png"){
            unlink("img/user/".$user->photo);
        }        
        $user->photo=$filename;
        $user->save();
        $hasil=[
            "url"=>url('/img/user/'.$filename)
        ];
        return response()->json($hasil);
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
        $kelas=Kelas::where("nama_kelas",request()->ruangan)->first();
        $cekhari= Jadwal::where("tanggal",request()->tanggal)->where("id_kelas",$kelas->id)->where("status","approve")->get();
        //return response()->json($cekhari,400);
        foreach($cekhari as $jad){
            if(request()->mulai < $jad->selesai && request()->mulai > $jad->mulai ){
                return response()->json("Kelas pada waktu ini sudah dipesan",400);
            }
            if(request()->selesai < $jad->selesai && request()->selesai > $jad->mulai ){
                return response()->json("Kelas pada waktu ini sudah dipesan",400);
            }
            if(request()->selesai == $jad->selesai && request()->mulai == $jad->mulai ){
                return response()->json("Kelas pada waktu ini sudah dipesan",400);
            }
            if(request()->mulai < $jad->selesai && request()->selesai > $jad->selesai ){
                return response()->json("Kelas pada waktu ini sudah dipesan",400);
            }
        }
        
        
        $jenis=$kelas->jenis;
        $buat=[
            "pemesan"=>Auth::user()->id,
            "mulai"=>request()->mulai,
            "selesai"=>request()->selesai,
            "tanggal"=>request()->tanggal,
            "id_kelas"=>$kelas->id,
            "keperluan"=>request()->keperluan,
            "status"=>"pending"
        ];
        $pesan="Kelas telah di booking, selanjutnya akan di verifikasi oleh admin";
        if(Auth::user()->peran_id == 1){
            $replace=[
                "status"=>"approve"
            ];
            $buat=array_replace($buat,$replace);
            $pesan="Kelas telah di booking";
        }
        $buat= new Jadwal($buat);
        $buat->save();
        $view= View::make("ajax.jadwal")->with("dat",$buat)->with("box",true)->with("pemesan",Auth::user())->render();        
        
        
        $hasil=[
            "view"=>$view,
            "pesan"=>$pesan,
            "id"=>$buat->id_kelas         
        ];
        
        //return view("dashboard.jadwal",["data"=>$dat,'jenis'=>$jenis,"kelas"=>$kelasi]);
        return response()->json($hasil);
    }
    public function cekakun(){
        if(request()->ajax()){
            $status=Auth::user()->status;
            if($status == "approve"){   
                return response()->json($status);
            }else{
                return response()->json($status,400);
            }
            
        }
        
    }
    public function hapusBooking(){
        $jadwal=Jadwal::find(request()->id);
        $view="<p class='text-info' id='textKosong'.$jadwal->id_kelas.'>Belum ada booking untuk ruangan ini</p>";
        if($jadwal->status == 'approve' && Auth::user()->peran_id != 1){
            $data=Jadwal::where("tanggal",$jadwal->tanggal)->where("id_kelas",$jadwal->id_kelas)->where("status","!=","ignored")->get();
            
            if(count($data) > 0){
                $view=View::make("ajax.jadwal")->with("boxing",true)->with("data",$data)->with("k",$jadwal->kelas)->render();
            }
            $hasil=[
                "pesan"=>"Order ini telah di approve oleh Admin, anda tidak bisa membatalkannya",
                "view"=>$view
            ];
            return response()->json($hasil,400);
        }
        $kelas=$jadwal->kelas;
        Jadwal::destroy(request()->id);
        $data=Jadwal::where("tanggal",$jadwal->tanggal)->where("id_kelas",$jadwal->id_kelas)->where("status","!=","ignored")->get();
        if(count($data) > 0){
            $view=View::make("ajax.jadwal")->with("boxing",true)->with("data",$data)->with("k",$kelas)->render();
        }
        $hasil=[
            "view"=>$view,
            "id"=>$kelas->id
        ];
        return response()->json($hasil);

    }
}
