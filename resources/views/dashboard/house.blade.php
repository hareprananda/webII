@extends("layouts.admin")
@section('title','House')
@section("konten")
<style>


#tableutama .small-box{
    height:100%;
}
.small-box .small-box-footer{
    margin-top:50px;
    
}
table tr td{
    font-size:18px;
}
</style>
<div class="card">
    <div class="card-header p-2">
    <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Pinjam Ruangan</a></li>
        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Cari</a></li>
        
    </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
    <div class="tab-content">
        <div class="tab-pane active" id="activity">     
        <h2>Pilih Blok Ruangan yang ingin dipinjam</h2>   
        <div class="row" >
            @for($i=0;$i<count($jenis);$i++)
            <div class="col-4">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4 style="font-size:25px;">Ruang {{$jenis[$i]}}</h4>          
                    </div>
                    <div class="icon">
                        <i class="fas fa-university"></i>
                    </div>
                    @php
                    if($i == 5){
                        $jenis[$i]="aulalab";
                    }
                    @endphp
                    <a href="{{url('/ruangan/'.$jenis[$i])}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endfor
        
        </div>

        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">        
            <h2>Cari jadwal</h2>
            <div class="form-group">
            <label for="tanggal" >Tanggal :</label>
            <div class="" >
                <input type="date" class="form-control" id="tanggal" style="width:200px;"> 
                <script>
                let today = new Date().toISOString().substr(0, 10);
                document.querySelector("#tanggal").value = today;
                </script>  
            </div>
                
            
            </div>
            <input type="text" class="form-control" placeholder="Masukkan keterangan dari kegiatan tersebut..." id="keterangan"> 
            <div id="hasil" style="margin-top:20px;">
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Ruangan</td>
                            <td>Waktu</td>                    
                            <td>Keterangan</td>
                        </tr>
                    </thead>
                    <tbody >
                    @foreach($jadwal as $je=>$jen)
                    
                        <tr>
                            <td>{{$jen->kelas->nama_kelas}}</td>
                            <td>{{$jen->mulai."-".$jen->selesai}}</td>
                            <td>{{$jen->keperluan}}</td>                
                        </tr>
                    
                    @endforeach
                    </tbody>
                
                </table>
                <div id="paginat">
                {{$jadwal->onEachSide(1)->links()}}
                </div>
            </div>
        
        
        </div>
        <!-- /.tab-pane -->

       
    </div>
    <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>
<script>
($(".nav-item .nav-link").eq(1).addClass("active"));
var ket="";
var tgl="{{date('Y-m-d')}}";
$("#keterangan").on("keyup",function(){
    ket=$(this).val();
    pagination("{{url('/house')}}");
})
$("#tanggal").on("change",function(){
    tgl=$(this).val();
    pagination("{{url('/house')}}");
})
$("#paginat").on("click",".page-item .page-link",function(e){
    e.preventDefault();
    if($(this).attr('href') != undefined){
        pagination($(this).attr('href'));
    }

})
function pagination(url,tanggal=tgl,keterangan=ket){
    $.ajax({
        url:url,
        method:"GET",
        data:{tanggal:tanggal,keterangan:keterangan},
        success:function(data){
            
            $("tbody").html(data.view);
            $("#paginat").html(data.pagination);
        },
        error:function(data){
            console.log(data);
        }
    })
}   

</script>


@endsection