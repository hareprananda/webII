<?php

namespace App\Http\Controllers;
use App\User;
use App\Jadwal;
use Illuminate\Http\Request;
use View;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(["auth","admin"]);
    }
    public function table(){
        $data=User::where("peran_id","2")->paginate(10);
        
        if(request()->pagination == true){
            $data=User::where("peran_id","2")->where("name","LIKE","%".request()->search."%")->orWhere("email","LIKE","%".request()->search."%")->orWhere("id","LIKE","%".request()->search."%")->paginate(10);
            $view=View::make("ajax.user")->with("data",$data)->render();
            
            $hasil=[
                "view"=>$view,
                "pagination"=>View::make("ajax.pagination")->with("data",$data)->render()
            ];
            return response()->json($hasil);
        }
        return view("dashboard.user",["data"=>$data]);
    }    
    public function unverify($id){
        $data=User::find($id);
        $data->status="unverified";
        $data->save();
        $url=url("/approve/".$id);
        $view='<form action='.$url.' method="post" class="formBtn">
            <button class="btn btn-primary">Approve</button>
            <p style="font-size:15px;">Status : <span class="text-danger">Unverified</span> </p>
        </form>';
        $hasil=[
            "view"=>$view,
            "pesan"=>"Status ".$data->name." berhasil diubah menjadi unverified"
        ];
        //return back()->with(["sukses"=>"Status user berhasil diubah"]);
        return response()->json($hasil);
    }
    public function approve($id){
        $data=User::find($id);
        $data->status="approve";
        $data->save();
        $url=url('/unverify/'.$id);
        $view='<form action='.$url.' method="post" class="formBtn"> 
        <button class="btn btn-danger">Unverified</button>
        <p style="font-size:15px;">Status : <span class="text-success">Approve</span> </p>
        </form>';
        $hasil=[
            "view"=>$view,
            "pesan"=>"Status ".$data->name." berhasil diubah menjadi approve"
        ];
        return response()->json($hasil);
        //return back()->with(["sukses"=>"Status user berhasil diubah"]);
    }
    public function bookToday(){
        $page=5;
        if(request()->pagination){
            if(request()->tanggal != "semua"){
                $data=Jadwal::where("tanggal",request()->tanggal)->paginate($page);
            }else{
                $data=Jadwal::where("tanggal",">=",date("Y-m-d"))->paginate($page);
            }
            
            $hasil=[
                "view"=>View::make("ajax.booking")->with("data",$data)->with("auto",true)->render(),
                "pagination"=>View::make("ajax.pagination")->with("data",$data)->render()
            ];
            return response()->json($hasil);

        }
        $data=Jadwal::where('tanggal','>=',date("Y-m-d"))->paginate($page);
        return view('dashboard.daftarbooking',["data"=>$data,"auto"=>true]);
       
    }
    public function search(){
        $data=Jadwal::where('tanggal',$_GET['tanggal'])->paginate(20);
        return view('dashboard.daftarbooking',["data"=>$data]);
       
    }
    public function ubahStatus(Request $request, $id){
        $jadwal=Jadwal::find($id);
        //return response()->json(request()->oto);
        if(request()->oto == "true"){//must approve
            $jadwal->status=$request->value;
            $jadwal->save();
            if($request->value == "approve"){
                $cekk=Jadwal::where("tanggal",$jadwal->tanggal)->where("status","pending")->get();
                foreach($cekk as $c){
                    
                    if($c->mulai > $jadwal->mulai && $c->mulai < $jadwal->selesai){                        
                        $c->status="ignored";
                        $c->save();                    
                    }elseif($c->selesai > $jadwal->mulai && $c->selesai < $jadwal->selesai){                        
                        $c->status="ignored";
                        $c->save();
                    }elseif($c->selesai == $jadwal->selesai && $c->mulai == $jadwal->mulai){
                        $c->status="ignored";
                        $c->save();
                    }
                }
            }
            
            $hasil=[                
                "pesan" => "Telah berhasil diubah"
            ];
            return response()->json($hasil);
        }else{
            

            $jadwal->status=$request->value;
            $jadwal->save();
            
            $hasil=[
                "view" => View::make("ajax.booking")->with("da",$jadwal)->with("auto",false)->render(),
                "pesan" => "Telah berhasil diubah",
                "status" => $jadwal->status
            ];
            return response()->json($hasil);
        }
    
    }
}

