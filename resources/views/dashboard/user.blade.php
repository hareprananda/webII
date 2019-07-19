@extends("layouts.admin")
@section("konten")
@section("title","User Table")
<div class="card" style="margin-top:10px;">
    <div class="card-header bg-primary">
    <h3>User Table</h3>
    </div>
    <form class="form-inline ml-3" style="margin-top:10px;" action="{{url('/user/cari')}}">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari orang" aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Joined At</th>
                    <th>Approval</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    if(!isset($_GET['page'])){
                        $_GET['page']=1;
                    }
                
                   
                    $a=(1+($_GET['page']*10))-10; 
                   
                @endphp
                @foreach($data as $dat)
                <tr>
                <td>{{$a}}</td>
                <td>{{$dat->name}}</td>
                <td>{{$dat->email}}</td>
                <td>{{$dat->created_at}}</td>
                <td
                @if(($dat->status)=="approve")
                style="color:green;"
                @elseif(($dat->status)=="unverified")
                style="color:red;"
                @endif
                >{{$dat->status}}</td>
                <td>
                @if(($dat->status)=="approve")
                    <button class="btn btn-danger">Unverifie</button>
                @elseif(($dat->status)=="unverified")
                    <button class="btn btn-primary">Approve</button>
                @endif
                </td>
                </tr>
                @php $a++; @endphp
                @endforeach
            </tbody>
            
        </table>
        
    </div>
    <div class="card-footer">
        {{$data->links()}}
    </div>
</div>


@endsection