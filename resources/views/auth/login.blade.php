
@extends("layouts.costumap")

@section("content")
@section("title","Login & Sign Up") 
<link rel="stylesheet" href="/css/custom/login.css">
<section class="forms-section">
  <h1 class="section-title"><img src="/img/logostiki.png" style="width:100px;"> Peminjaman Kelas</h1>
  <div class="forms"> 
    <div class="form-wrapper is-active">
      <button type="button" class="switcher switcher-login">
        Login
        <span class="underline"></span>
      </button>
      <form class="form form-login" method="POST" action="{{ route('login') }}">
	  
        <fieldset>
          <legend>Please, enter your email and password for login.</legend>
          @error('email')
            
            <p style="color:red;font-style:italic;font-size:20px;">Username/password salah</p>
         
          @enderror
         
		    @csrf
          <div class="input-block">
            <label for="login-email">E-mail</label>
            <input id="login-email" type="email" name="email" required value="{{ old('email') }}" 
            @error("email")  style="background-color:#ffe6e6;border:1px solid #cc0000"@enderror>
          </div>
         
          
          <div class="input-block">
            <label for="login-password">Password</label>
            <input id="login-password" type="password" name="password"required>
          </div>
        </fieldset>
        <button type="submit" class="btn-login btn btn-primary">Login</button>
      </form>
    </div>
    <div class="form-wrapper">
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
    </div>
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