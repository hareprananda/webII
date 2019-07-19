@extends("layouts.admin")
@section("konten")
<script src="{{asset('/adminlte/plugins/toastr/toastr.min.js')}}"></script>
<style>
.mt-2 .nav-pills .nav .nav-item #name{{$id}}{
    background: rgba(255, 208, 0, .8);
    box-shadow: 10px 0 0 rgba(255, 208, 0, .8), -10px 0 0 rgba(255, 208, 0, .8);
    color:black;
}
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

    <label>Tanggal :</label>
    <input type="date" name="tanggal" id="tanggal">
    <button type="button" name="tombol" class="btn btn-info">Cari</button>
    <script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#tanggal").value = today;
    </script>
</div>
@section("title","Home")
    <table style="width:100%;" id="utama">
        @php $z=0; @endphp
        @foreach ($data as $jadwal)
        @php if($z==2){
            $z=0;
        }@endphp
        @if($z==0)
            <tr >
        @endif
        <td class="top">
        <div class="kolom" >
            <div class="card" style="width:100%;">
                <div class="card-header d-flex p-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title p-3">
                  <i class="fas fa-university"></i>
                  {{$jadwal->nama_kelas}}
                </h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                    @if(Auth::user()->status=="approve")
                    @php $i=$jadwal->nama_kelas; @endphp
                    onclick="modal('{{$i}}')" 
                    @else
                    onclick="error()"
                    @endif
                    >
                      <i class="fas fa-plus"></i> Booking
                    </button>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <table style="width:100%;">
                @php $a=0; @endphp
                @for ($i = 0; $i < 10; $i++)

                @php if($a==3){
                     $a=0; }
                @endphp
                @if($a==0)
                    <tr>
                @endif
                <td>
                    <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$a}}</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </td>
               
                
                @if($a==2)
                    </tr>
                @endif

                @php $a++ @endphp
                @endfor
                </table>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
            </div>
        </div>
        </td>
        @if($z==1)
            </tr>
        @endif
        
        <div id="modal"></div>
        @php $z++; @endphp
        @endforeach

        
        
    </table>
@if(Auth::user()->status=="approve")
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
