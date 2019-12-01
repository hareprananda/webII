
@extends("layouts.costumap")

@section("content")
@section("title","Login & Sign Up") 
<style>
*,
*::before,
*::after {
	box-sizing: border-box;
}

body {
	margin: 0;
	font-family: Roboto, -apple-system, 'Helvetica Neue', 'Segoe UI', Arial, sans-serif;
	background: url({{asset('/img/logincover.jpg')}});
    background-size:cover;
}

.forms-section {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}

.section-title {
	font-size: 32px;
	letter-spacing: 1px;
	color: #fff;
    background-color:rgba(255, 208, 0, .8);;
    padding:10px;
    box-shadow: 10px 0 0 rgba(255, 208, 0, .8), -10px 0 0 rgba(255, 208, 0, .8);
    text-shadow: 0px 1px 2px rgba(0,0,0,.5);
}

.forms {
	display: flex;
	align-items: flex-start;
	margin-top: 30px;
}

.form-wrapper {
	animation: hideLayer .3s ease-out forwards;
}

.form-wrapper.is-active {
	animation: showLayer .3s ease-in forwards;
}

@keyframes showLayer {
	50% {
		z-index: 1;
	}
	100% {
		z-index: 1;
	}
}

@keyframes hideLayer {
	0% {
		z-index: 1;
	}
	49.999% {
		z-index: 1;
	}
}

.switcher {
	position: relative;
	cursor: pointer;
	display: block;
	margin-right: auto;
	margin-left: auto;
	padding: 0;
	text-transform: uppercase;
	font-family: inherit;
	font-size: 16px;
	letter-spacing: .5px;
	color: yellow;
	background-color: transparent;
	border: none;
	outline: none;
	transform: translateX(0);
	transition: all .3s ease-out;
	width:300px;
}

.form-wrapper.is-active .switcher-login {
	color: #fff;
	font-size:25px;
	transform: translateX(90px);
}

.form-wrapper.is-active .switcher-signup {
	color: #fff;
	font-size:25px;
	transform: translateX(-90px);
}

.underline {
	position: absolute;
	bottom: -5px;
	left: 0;
	overflow: hidden;
	pointer-events: none;
	width: 100%;
	height: 3px;
} 

.underline::before {
	content: '';
	position: absolute;
	top: 0;
	left: inherit;
	display: block;
	width: inherit;
	height: inherit;
	background-color: currentColor;
	transition: transform .2s ease-out;
}

.switcher-login .underline::before {
	transform: translateX(101%);
}

.switcher-signup .underline::before {
	transform: translateX(-101%);
}

.form-wrapper.is-active .underline::before {
	transform: translateX(0);
}

.form {
	overflow: hidden;
	min-width: 400px;
	margin-top: 50px;
	padding: 30px 25px;
  border-radius: 5px;
  border:2px solid #97191d;
	transform-origin: top;
}

.form-login {
	animation: hideLogin .3s ease-out forwards;
}

.form-wrapper.is-active .form-login {
	animation: showLogin .3s ease-in forwards;
}

@keyframes showLogin {
	0% {
		background: #FFD000;;
		transform: translate(40%, 10px);
	}
	50% {
		transform: translate(0, 0);
	}
	100% {
		background-color: #fff;
		transform: translate(35%, -20px);
	}
}

@keyframes hideLogin {
	0% {
		background-color: #fff;
		transform: translate(35%, -20px);
	}
	50% {
		transform: translate(0, 0);
	}
	100% {
		background: #FFD000;;
		transform: translate(40%, 10px);
	}
}

.form-signup {
	animation: hideSignup .3s ease-out forwards;
}

.form-wrapper.is-active .form-signup {
	animation: showSignup .3s ease-in forwards;
}

@keyframes showSignup {
	0% {
		background: #FFD000;
		transform: translate(-40%, 10px) scaleY(.8);
	}
	50% {
		transform: translate(0, 0) scaleY(.8);
	}
	100% {
		background-color: #fff;
		transform: translate(-35%, -20px) scaleY(1);
	}
}

@keyframes hideSignup {
	0% {
		background-color: #fff;
		transform: translate(-35%, -20px) scaleY(1);
	}
	50% {
		transform: translate(0, 0) scaleY(.8);
	}
	100% {
		background: #FFD000;
		transform: translate(-40%, 10px) scaleY(.8);
	}
}

.form fieldset {
	position: relative;
	opacity: 0;
	margin: 0;
	padding: 0;
	border: 0;
	transition: all .3s ease-out;
}

.form-login fieldset {
	transform: translateX(-50%);
}

.form-signup fieldset {
	transform: translateX(50%);
}

.form-wrapper.is-active fieldset {
	opacity: 1;
	transform: translateX(0);
	transition: opacity .4s ease-in, transform .35s ease-in;
}

.form legend {
	position: absolute;
	overflow: hidden;
	width: 1px;
	height: 1px;
	clip: rect(0 0 0 0);
}

.input-block {
	margin-bottom: 5px;
}

.input-block label {
	font-size: 22px;
    color: black;
}

.input-block input {
	display: block;
	width: 100%;
	
	padding-right: 10px;
	padding-left: 10px;
	font-size: 16px;
	line-height: 40px;
	color: #3b4465;
  background: #eef9fe;
  border: 1px solid #cddbef;
  border-radius: 2px;
}

.form [type='submit'] {
	opacity: 0;
	display: block;
	min-width: 120px;
	margin: 30px auto 10px;
	font-size: 18px;
	line-height: 40px;
	border-radius: 5px;
	border: none;
	transition: all .3s ease-out;
}

.form-wrapper.is-active .form [type='submit'] {
	opacity: 1;
	transform: translateX(0);
	transition: all .4s ease-in;
}

.btn-login {

	transform: translateX(-30%);
}

.btn-signup {

	transform: translateX(30%);
}

</style>

<section class="forms-section">
  <h1 class="section-title"><img src="{{asset('/img/logostiki.png')}}" style="width:100px;"> Peminjaman Kelas</h1>
  <div class="forms"> 
    <div class="form-wrapper is-active">
      <button type="button" class="switcher switcher-login">
        Login
        <span class="underline"></span>
      </button>
      <form class="form form-login" method="POST" action="{{ url('/custom/login') }}">
	  
        <fieldset>
          <legend>Please, enter your email and password for login.</legend>
          @error('email')
            
            <p style="color:red;font-style:italic;font-size:20px;">Username/password salah</p>
         
          @enderror
         
		    @csrf
          <div class="input-block">
            <label for="login-email">NIM</label>
            <input id="login-email" type="number" name="id" required  style="background-color:#ffe6e6;border:1px solid #cc0000">
          </div>
         
          
          <div class="input-block">
            <label for="login-password">Password</label>
            <input id="login-password" type="password" name="password"required>
          </div>
        </fieldset>
        <button type="submit" class="btn-login btn btn-primary">Login</button>
      </form>
    </div>
    <!-- <div class="form-wrapper">
      <button type="button" class="switcher switcher-signup">
        Sign Up
        <span class="underline"></span>
      </button>
      <form class="form form-signup" method="POST" action="{{ route('register') }}"> 
        <fieldset>
          @csrf
		      <div class="input-block">
            <label for="nama">Nama</label>
            <input id="nama" type="text" required class="@error('name') is-invalid @enderror" name="name">
          </div>
          
          <div class="input-block">
            <label for="signup-email">E-mail</label>
            <input id="signup-email" type="email" required class="@error('email') is-invalid @enderror" name="email">
          </div>
          <div class="input-block">
            <label for="signup-password">Password</label>
            <input id="signup-password" type="password" required class="@error('password') is-invalid @enderror"
            name="password">
          </div>
          <div class="input-block">
            <label for="signup-password-confirm">Confirm password</label>
            <input id="signup-password-confirm" type="password" required name="password_confirmation">
          </div>
        </fieldset>
        <button type="submit" class="btn-signup btn btn-success">Continue</button>
      </form>
    </div> -->
  </div>
</section>
<script>
const switchers = [...document.querySelectorAll('.switcher')]

switchers.forEach(item => {
	item.addEventListener('click', function() {
		switchers.forEach(item => item.parentElement.classList.remove('is-active'))
		this.parentElement.classList.add('is-active')
	})
})

</script>
@endsection
