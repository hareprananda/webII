@extends("layouts.admin")
@section("title","Book List")
@section("konten")
<script src="{{asset('/adminlte/plugins/toastr/toastr.min.js')}}"></script>
<style>

#home{
    background: rgba(255, 208, 0, .8);
    box-shadow: 10px 0 0 rgba(255, 208, 0, .8), -10px 0 0 rgba(255, 208, 0, .8);
    color:black;
    
}
#home a{
   
}
#utama .top{
    padding:10px;
}
.tanggal{
    margin-top:10px;
}
</style> 
<div class="tanggal">

    <form action="{{route('searchKelas',$jenis)}}" method="get"> 
        <label>{{$tanggal}} :</label>
        <input type="date" name="tanggal" id="tanggal">
        <button type="submit" class="btn btn-info">Cari</button>
        <script>
        let today = new Date().toISOString().substr(0, 10);
        document.querySelector("#tanggal").value = today;
        </script>
    </form>
</div>
@if(session('sukses'))
    <div class="alert alert-success" role="alert" id="alr">
        {{session('sukses')}}
    </div>
    
@elseif(session('gagal'))
<div class="alert alert-danger" role="alert" id="alr">
        {{session('gagal')}}
    </div>
    
@endif
<script>
        window.setTimeout(function() {
            $("#alr").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
        }, 4000);
    </script>
    <div class='row'>
        
        @for ($k=0; $k< count($kelas); $k++)
        
               
        <div class='col-6'>
        <div class="kolom" >
            <div class="card" style="width:100%;">
                <div class="card-header d-flex p-0 ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title p-3">
                    <i class="fas fa-university"></i>
                    {{$kelas[$k]}}
                    </h3>
                    <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        @if(Auth::user()->peran_id != 1)
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                        @if(Auth::user()->status=="approve")
                        @php $i=$kelas[$k]; @endphp
                        onclick="modal('{{$i}}','{{$tanggal}}')" 
                        @else
                        onclick="error()"
                        @endif
                        >
                        <i class="fas fa-plus"></i> Booking
                        </button>
                        @endif
                    </li>
                    
                    </ul>
                </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <div class='row'>
                @php $ada=0; @endphp
                @foreach($data as $dat)

                @if(($dat->kelas->nama_kelas != $kelas[$k])|| $dat->status=='ignored')
                    @php continue; @endphp
                @endif
                @php $ada=1; @endphp
                <div class="col-6">
                    <div class="small-box
                    @if($dat->status=='approve')
                     bg-success
                    @elseif($dat->status=='pending')
                    bg-secondary
                    @endif
                     ">
                    <div class="inner">
                        <h4 style='overflow:hidden;'>{{$dat->pemesann->name}}</h4>

                        <p>{{$dat->mulai.'-'.$dat->selesai}}</p>
                    </div>
                    <div class="icon">
                        <i class=" @if($dat->status=='approve')fas fa-check  @elseif($dat->status=='pending') fas fa-sync @endif"></i>
                    </div>
                        
                    </div>
                </div>
               
                
                

                
                @endforeach
                @if($ada==0)
                <p class="text-info">Belum ada booking untuk ruangan ini</p>
                @endif
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
            </div>
        </div>
        </div>
        
            
       
        
        <div id="modal"></div>
       
        @endfor

        
        
    </div>
@if(Auth::user()->status=="approve" )
    <script src="{{asset('/js/costum/modal.js')}}"></script>
@else
<!-- SweetAlert2 -->

<script type="text/javascript">

function error(){
    Swal.fire({
  type: 'error',
  title: 'Maaf...',
  text: 'Akun anda belum terverifikasi, silahkan hubungi ADMIN!',
  
});

};
   


</script>
@endif

@endsection
