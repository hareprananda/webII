@extends("layouts.admin")
@section("konten")
@section("title","Book Table")
<div class="card" style="margin-top:10px;">
    <div class="card-header bg-primary">
    <h3>Book List</h3> 
    </div>
    <form action="{{route('searchBook')}}" method="get"> 
        <label>Tanggal :</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <button type="submit" class="btn btn-info">Cari</button>
        
    </form>
    <div class="card-body">
        @if (session('sukses'))
            <div class="alert alert-primary alert-block" id="alert">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('sukses') }}</strong>
            </div>
        @endif
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pemesan</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
               @foreach($data as $dat=>$da)
                    
                    <tr>
                        <td>{{$dat+1}}</td>
                        <td>{{$da->pemesann->name}}</td>
                        <td>{{$da->mulai}}</ td>
                        <td>{{$da->selesai}}</td>
                        <td>{{$da->tanggal}}</td>
                        <td>{{$da->kelas->nama_kelas}}</td>
                        <td>{{$da->keperluan}}</td>
                        <td
                        @if($da->status=='approve') class="text-success" @elseif($da->status=='ignored') class='text-danger' @endif
                        >{{$da->status}}</td>
                        <td>
                            <form action="{{route('prosesBook',$da->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if($da->status=='ignored'||$da->status=='approve')
                                <button button class="btn btn-info" name="action" value="cancel">Cancel</button>
                            @else
                            
                                <button class="btn btn-danger" name="action" value="ignore">Ignore</button>
                                <button class="btn btn-primary"  name='action' value="approve">Approve</button>
                            @endif
                            </form>
                        </td>
                    </tr>

               @endforeach
            </tbody>
            
        </table>
        
    </div>
    <div class="card-footer">
        {{$data->links()}}
    </div>
</div>


@endsection