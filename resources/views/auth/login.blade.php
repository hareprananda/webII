<!DOCTYPE html>
<html>
<head>
<title>Login</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('exa/style.css')}}">
<link rel="shortcut icon" type="image/png" href="{{asset('/img/logostiki.png')}}"/>
 
</head>
<body>
<style>
.stikiStyle{
	background: rgba(255, 208, 0, .8);
    box-shadow: 10px 0 0 rgba(255, 208, 0, .8), -10px 0 0 rgba(255, 208, 0, .8);
    text-shadow: 0px 1px 2px rgba(0,0,0,.5);
	color: #fff;		
	display:inline;
	
}
#tulisan{
	float:left;
	margin-top:50px;
	margin-left:20px;
}
#logow{
	width:150px;
	float:left;
}
.errorForm{
	border-color: #d58f8f !important;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25)!important;
}
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  
}
#tulisanz{
  position: fixed;
  display: none;
  font-size:35px;
  color:white;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);

}
@media screen and (max-width:700px){
	
	.stikiStyle{
		font-size:28px;
		margin-left:-10px;
	}
}
</style>
<div id="overlay" >
	<div id="tulisanz">	
		
    	<p>Jantos Dumun...</p>
    </div>	
</div>
<div class="container-fluid">
  <div class="row no-gutter">
  <div class="" style="position:absolute;z-index:1">
	<img src="{{asset('/img/logostiki.png')}}" style="" id="logow">
	<div id="tulisan">
  	<h1 class="stikiStyle">STIKI INDONESIA</h1><br>
	<h1 class="stikiStyle" style="margin-top:5px!important;">Sistem Peminjaman Kelas</h1>
	</div>
  </div>

  
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image" style=" background-image: url({{asset('/img/logincover2.jpg')}});"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
			
              <h3 class="login-heading mb-4">Login Doeloe</h3>
			  <p id="errorPesan" style="display:none" class="text-danger"></p>
               <form id="logForm">
 
                 {{ csrf_field() }}
 
                <div class="form-label-group">
                  <input type="text" name="id" id="inputEmail" class="form-control " placeholder="NIM" >
                  <label for="inputEmail">NIM</label>
 
                  @if ($errors->has('nim'))
                  <span class="error">{{ $errors->first('nim') }}</span>
                  @endif    
                </div> 
 
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  <label for="inputPassword">Password</label>
                   
                  @if ($errors->has('password'))
                  <span class="error">{{ $errors->first('password') }}</span>
                  @endif  
                </div>
				
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Login</button>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('/js/app.js')}}"></script>
<script>
	
	//method="POST" action="{{ url('/custom/login') }}" 
	function cek(){
		var nim=$("#inputEmail").val();
		var pass=$("#inputPassword").val();
		$( "#inputEmail" ).removeClass( "errorForm" );
		$("#inputPassword").removeClass( "errorForm" );
		if(nim == ""){
			$("#inputEmail").addClass("errorForm");
			$("#errorPesan").show().html("Anda belum mengisi NIM");
			return false;
		}
		if(pass == ""){
			$("#inputPassword").addClass("errorForm");
			$("#errorPesan").show().html("Anda belum mengisi password");
			return false;
		}
		// alert(nim+pass);
		return true;
		
	}
	$("#logForm").on("submit",function(e){
		e.preventDefault();	
		
		if(cek()==true){
			$("#overlay").show();
			$("#tulisanz").show();
			var nim=$("#inputEmail").val();
			var pass=$("#inputPassword").val();
			$.ajax({
			headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method:"POST",
			url:"{{ url('/custom/login') }}",
			data:{id:nim,password:pass},
			success:function(d){
				console.log(d);
				window.location.href="{{url('/house')}}";
			},
			error:function(data){
				$("#inputEmail").addClass("errorForm");
				$("#inputPassword").addClass("errorForm");
				$("#errorPesan").show().html("Username / password salah");
				$("#overlay").hide();
				$("#tulisanz").hide();
				console.log(data);
			}
			});
		}
		
	})
</script>
</body>
</html>