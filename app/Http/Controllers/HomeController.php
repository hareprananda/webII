<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function api($id){
        $apiurl='http://localhost/kampus/public/api/user/'.$id;
        $konten=file_get_contents($apiurl);
        $json=json_decode($konten,true);
        return $json;
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
    public function postApi(){
        $data_array =  array(
            "customer"        => "Ini adalah id",
            "customer2"        => "Ini adalah id2",
            "payment"         => array(
                  "number"         => "ini adalah number",
                  "routing"        => "ini adalah routing",
                  "method"         => "ini adalah method"
            ),
        );
        
        $make_call = $this->callAPI('POST', 'http://localhost/kampus/public/api/user', json_encode($data_array));
        $response = json_decode($make_call, true);
        return $response;
        // $errors   = $response['response']['errors'];
        // $data     = $response['response']['data'][0];
      }
      public function register(){
         $array=[
            "name"=>"Komang Hare",
            "email"=>"hareprananda@yahoo.com",
            "password"=>"password",
            "c_password"=>"password"
         ];
         $panggil=$this->callAPI('POST', 'http://localhost/kampus/public/api/register', json_encode($array));
         $response = json_decode($panggil, true);
         return $response;
      }
      public function login(Request $request){
         $dolar=array(
            "email"=>$request->email,
            "password"=>$request->password,
         );
         $panggil=$this->callAPI('POST', 'http://localhost:8000/api/login', json_encode($dolar));
         $response = json_decode($panggil, true);
         $token= $response["success"]["token"];
         $tokenHeader='Authorization: Bearer '.$token;
         $apidetail=$this->callAPI('POST', 'http://localhost:8000/api/details', json_encode($dolar),$tokenHeader);
         $response = json_decode($apidetail, true);
         return $response;


      }
}
