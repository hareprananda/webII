@extends("layouts.admin")
@section("konten")
    @section("title","Profile")

<style>
    #setting{
    background: rgba(255, 208, 0, .8);
    box-shadow: 10px 0 0 rgba(255, 208, 0, .8), -10px 0 0 rgba(255, 208, 0, .8);
    color:black;
    
}
</style>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/img/user/{{$data->photo}}"
                       style="width:200px;height:200px;">
                </div>

                <h3 class="profile-username text-center">{{$data->name}}</h3>

                <p class="text-muted text-center">{{$peran[0]->nama}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Account Status</b> <a class="float-right">{{$data->status}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$data->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Joined at</b> <a class="float-right">{{date($data->created_at)}}</a>
                  </li>
                </ul>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link @if(!($message =  Session::get('buka'))) active @endif" href="#history" data-toggle="tab">History</a></li>
                  
                  <li class="nav-item"><a class="nav-link @if(($message =  Session::get('buka'))) active @endif" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="@if(!($message =  Session::get('buka'))) active @endif tab-pane" id="history">
                  @for($i=0; $i < 2;$i++)
                    <div class='card card-primary'>
                      <div class="card-header" style="font-weight:bold">
                        {{date("Y-m-d")}}
                      </div>
                      
                      <div class="card-body">
                        Memesan kelas A
                        Status :Approve
                      </div>
                    </div>
                    <div class='card card-danger'>
                      <div class="card-header" style="font-weight:bold">
                      {{date("Y-m-d")}}
                      </div>
                      
                      <div class="card-body">
                        Memesan kelas A
                        Status :Gagal
                      </div>
                    </div>
                    @endfor
                  </div>
                
                  <!-- /.tab-pane -->

                  <div class="tab-pane nav-link @if(($message = Session::get('buka'))) active @endif" id="settings">
                    <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="/ubah">
                    @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block" id="alert" style="width:50%;"> 
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                      </div>
                    @endif

                    @if ($message = Session::get('error'))
                      <div class="alert alert-danger alert-block" id="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                      </div>
                    @endif
                    @error("photo")
                      <p style="color:red;font-style:italic;font-size:24px;">Yang anda inputkan bukan photo</p>
                    @enderror
                    @error("name")
                      <p style="color:red;font-style:italic;font-size:24px;">Nama yang anda inputkan salah</p>
                    @enderror
                    @csrf
                    {{method_field("PUT")}}
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{$data->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">
                          <input type="file" name="photo" accept="image/*">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Ubah</button>
                        </div>
                      </div>
                    </form>
                    <div class="card">
              <div class="card-header p-2 bg-info">
                <h5>Ganti Password</h5>
              </div>
              <div class="card-body">
                <form action="{{url('/ubahPas')}}" method="post">
                @csrf
                {{method_field("PUT")}}

                    @if($message=Session::get('perror'))
                    <p style="color:red;font-style:italic;font-size:24px;">{{$message}}</p>
                    @endif
                    @if($message=Session::get('psuccess'))
                    <div class="alert alert-success alert-block" id="alert" style="width:50%;"> 
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                      </div>
                    @endif
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Lama</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control"  placeholder="Ketikkan password lama" name="old">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Baru</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control"  placeholder="Ketikkan password baru" name="new">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Confirm</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control"  placeholder="Konfirmasi password baru" name="confirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Ganti</button>
                        </div>
                    </div>
                </form>
                </div>
                </div>
            </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
            
          </div>
          <!-- /.col -->
          </div>
          <script>
          
          </script>
          
@endsection