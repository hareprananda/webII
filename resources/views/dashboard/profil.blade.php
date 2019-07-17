@extends("layouts.admin")
@section("konten")
    @section("title","Profile")
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/img/user/{{$data->photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$data->name}}</h3>

                <p class="text-muted text-center">{{$peran[0]->nama}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Account Status</b> <a class="float-right">{{$data->status}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
                  <li class="nav-item"><a class="nav-link active" href="#history" data-toggle="tab">History</a></li>
                  
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="history">
                    ini history
                  </div>
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                    @csrf
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name" name="nama" value="{{$data->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">
                          <input type="file" name="poto">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Ubah</button>
                        </div>
                      </div>
                    </form>
                    <div class="card">
              <div class="card-header p-2 bg-warning">
                <h5>Ganti Password</h5>
              </div>
              <div class="card-body">
                <form action="">
                @csrf
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
@endsection