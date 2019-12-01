<?php

namespace App\Http\Controllers\CustomController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('dashboard');
    }
    function callAPI($method, $url, $data, $headers = false){
        $curl = curl_init();
     
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
     
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        if(!$headers){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'APIKEY: 111111111111111111111',
               'Content-Type: application/json',
            ));
        }else{
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'APIKEY: 111111111111111111111',
               'Content-Type: application/x-www-form-urlencoded',
               'Accept: application/json',
               $headers
            ));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  
           // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
     
    }
    public function index()
    {
        
        return view('login');
    }  
 
    public function registration()
    {
        
        return view('registration');
    }
     
    public function postLogin(Request $request, $register=false)
    {
        
            
            if($register == false && $request->id != 3){
                $dolar=array(
                    "id"=>$request->id,
                    "password"=>$request->password,
                );
                $panggil=$this->callAPI('POST', 'http://localhost:8000/api/login', json_encode($dolar));
                $response = json_decode($panggil, true);
                if(!isset($response["success"])){
                    return redirect()->back();
                }
                $token= $response["success"]["token"];
                $tokenHeader='Authorization: Bearer '.$token;
                $apidetail=$this->callAPI('POST', 'http://localhost:8000/api/details', json_encode($dolar),$tokenHeader);
                $response = json_decode($apidetail, true);
                
                $jumlah=User::where("id",$response["success"]["id"])->get()->count();
            
                if($jumlah == 0){
                    return $this->postRegistration($response["success"],$request);
                }
                $this->updateData($response["success"]);
            }
            
            request()->validate([
                'id' => 'required',
                'password' => 'required',
            ]);
            
            if (Auth::attempt(['id' => request('id'), 'password' => request('password')])) {
                // Authentication passed...
                return redirect('/house');
            }
        
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
 
    public function postRegistration($data,$login)
    {  
        // request()->validate([
        // // 'name' => 'required',
        // 'email' => 'required|email|unique:users',
        // 'password' => 'required|min:6',
        // ]);
         
        //$data = $request->all();
 
        $check = $this->create($data);
        return $this->postLogin($login,true);
        
        //return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
     
    public function dashboard()
    {
 
      if(Auth::check()){
        return view('dashboard');
      }
       
    }
 
    public function create(array $data)
    {
      return User::create([
        //'name' => $data['name'],
        'id'=>$data['id'],
        'name'=>$data["name"],
        'email' => $data['email'],
        'password' => $data["password"]
        
      ]);
    }
    public function updateData(array $data){

        return User::where("id",$data["id"])->update([
            "email"=>$data["email"],
            "name"=>$data["name"],
            'password' => $data["password"]
        ]);
    } 
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
