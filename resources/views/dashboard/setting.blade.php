@extends("layouts.admin")
@section("konten")
    @section("title","Profile")
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white" style="background: url({{asset('/adminlte/dist/img/photo1.png')}}) center center;height:300px;">
        <h3 class="widget-user-username">{{$data->name}}</h3>
        </div>
        <div class="widget-user-image">
        <center>
            <img class="img-circle potoPropil" src="{{url('/img/user/'.$data->photo)}}"  style="margin-left:-30px;margin-top:70px;width:150px;height:150px;border:2px solid black">
            </center>
        </div>
        <div class="card-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">{{count($history)}}</h5>
                <span class="description-text">Jumlah Pengajuan</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Ganti Profile</h5>
                <button class="btn btn-primary" id="pilihPoto" >Pilih</button>
                <form action="{{url('/ajaxpoto')}}" method="POST" enctype="multipart/form-data" id="formPot">
                    @csrf
                    <input type="file" id="photo"  name="photo" style="display:none">
                    <button type="submit" style="display:none" id="btnSubmit"></button>
                </form>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
            <div class="description-block">
                <h5 class="description-header @if($data->status == 'approve') text-success @else text-danger @endif">{{ucfirst($data->status)}}</h5>
                <span class="description-text">Akun status</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </div>
    <div class="card" >
        <div class="card-header">
            <h5>History</h5>
        
        </div>
        <div class="card-body" id="plezz">
            <div class="row">
            @php  $tanggal="" @endphp
            @foreach($history as $dat)
                @if($tanggal != $dat->tanggal)
                @php $tanggal = $dat->tanggal @endphp
                </div>
                    <h2 style="border-bottom:1px solid black">{{$dat->tanggal}}</h2>
                <div class="row">
                @endif
                <div class="col-4">
                    <div class="small-box
                    @if($dat->status=='approve')
                        bg-success
                    @elseif($dat->status=='pending')
                    bg-secondary
                    @elseif($dat->status=='ignored')
                    bg-danger
                    @endif
                        ">
                    <div class="inner">
                        <h4 style='overflow:hidden;'>{{$dat->pemesann->name}}</h4>

                        <p>{{$dat->mulai.'-'.$dat->selesai}}</p>
                    </div>
                    <div class="icon">
                        <i class=" @if($dat->status=='approve')fas fa-check  @elseif($dat->status=='pending') fas fa-sync @elseif($dat->status=='ignored') fas fa-times @endif"></i>
                    </div>
                    <a onclick="keterangan('{{$dat->id}}')" class="small-box-footer" style="cursor:pointer">Keterangan <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
            
            
            </div>
        
        
        </div>
    
    
    </div>
    <div class="modal fade" id="modalKeterangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keterangan</h5>        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            
                <h5 id="textKeterangan"></h5>
                    
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
            </div>
        </div>
    </div>
<script>
($(".nav-item .nav-link").eq(9).addClass("active"));
$("#pilihPoto").on("click",function(){
    
    $("#photo").click();
});
function keterangan(id){
    
    var url="{{route('searchKelas',100)}}";
    $.ajax({
        method:"GET",
        url:url,
        data:{idJadwal:id,keterangan:true},
        success:function(data){
            $("#textKeterangan").html(data.pesan);
            $("#modalKeterangan").modal("show");
        },
        error:function(data){
            console.log(data);
        }

    })
    
}
$("#photo").on("change",function(){
    //return alert("yey");
    $("#btnSubmit").click()
    // if ($(this).val() != '') {
    //     upload(this);

    // }
})
$("#formPot").on("submit",function(e){
    e.preventDefault();
    $.ajax({
        
        url: "{{url('/ajaxpoto')}}",
        method:"post",
        data:new FormData(this),
        dataType:'json',
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            $(".potoPropil").attr("src",data.url);  
            Toast.fire({
                type:"success",
                title:"Poto berhasil diupload"
            });
            console.log(data);
        },
        error:function(data){
            console.log(data);
        }
    });
});
function upload(img){
    var fd = new FormData();
    var files = $('#photo')[0].files[0];
    fd.append('file',files);
    
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('/ajaxpoto')}}",
        method: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
            // if(response != 0){
            //     $("#img").attr("src",response); 
            //     $(".preview img").show(); // Display image element
            // }else{
            //     alert('file not uploaded');
            // }
        },
    });
}
</script>        

      
@endsection