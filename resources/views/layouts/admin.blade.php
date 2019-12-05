<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield("title")</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/adminlte/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/adminlte.min.css')}}">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{asset('/img/logostiki.png')}}"/>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>


    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <p style="margin-top:13px;"> Akun status : <span class="
      @if((Auth::user()->status)=="unverified")
      text-danger
      @else
      text-success
      @endif"
       id="userStatus">{{Auth::user()->status}}</span></p> 
    </ul>
  </nav>
  <!-- /.navbar -->
    <style>
    .mt-2.nav-item i{
        font-size:80px;
    }
    </style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/house')}}" class="brand-link">
      <img src="{{asset('/img/logostiki.png')}}" class="brand-image img-circle elevation-3"
           style="opacity: .8;">
      <span class="brand-text font-weight-light">STIKI Indonesia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" >
          <img src={{asset("/img/user/".Auth::user()->photo)}} class="img-circle elevation-2 potoPropil" style="width:35px;height:35px;" >
        </div>
        <div class="info">
            <a href="{{url('/setting')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{url('/house')}}" class="nav-link " id="setting">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview " >
            <a href="#" class="nav-link " id="home">
              <i class="nav-icon fas fa-university"></i>
              <p>
                  Ruangan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item" >
                <a href="{{url('/ruangan/100')}}" class="nav-link" id="name100">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang 100</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/ruangan/200')}}" class="nav-link" id="name200">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang 200</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/ruangan/300')}}" class="nav-link" id="name300">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang 300</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/ruangan/400')}}" class="nav-link" id="name400">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang 400</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/ruangan/500')}}" class="nav-link" id="name500">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/ruangan/aulalab')}}" class="nav-link" id=nameaulalab>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aula & Lab</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('/setting')}}" class="nav-link" id="setting">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Pengaturan 
                
              </p>
            </a>
          </li>
          @if((Auth::user()->peran_id)==1)
          <li class="nav-item">
            <a href="{{url('/user')}}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Daftar Akun
                
              </p>
            </a>
          </li>
          
         
          <li class="nav-item">
            <a href="{{route('booking')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Daftar Pengajuan
                
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Log Out
                
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
            </form>
          </li>
         
          
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->
    <script src="{{asset('/js/app.js')}}"> </script>
    <script src="{{asset('/adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 99999999999,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })    
    </script>
    <!-- Main content -->
    <section class="content">
        @yield("konten")
       
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{asset('/adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- jQuery -->
<script src="{{asset('/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/adminlte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/adminlte/dist/js/pages/dashboard.js')}}"></script>


</body>
</html>
