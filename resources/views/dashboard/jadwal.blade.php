@extends("layouts.admin")
@section("title","Book List")
@section("konten")
<script src="{{asset('/adminlte/plugins/toastr/toastr.min.js')}}"></script>
<style>


#home a{
   
}
#utama .top{
    padding:10px;
}
.tanggal{
    margin-top:10px;
}
.errorForm{
	border-color: #d58f8f !important;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25)!important;
}
</style> 

<div class="tanggal">
        <label>Masukkan tanggal :</label>
        <input type="date" name="tanggal" id="tanggal">        
        <script>
        let today = new Date().toISOString().substr(0, 10);
        document.querySelector("#tanggal").value = today;
        </script>    
</div>

<script>
        window.setTimeout(function() {
            $("#alr").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
        }, 4000);
    </script>
    <div class='row' id="kontener">
        @include("ajax.jadwal")       

    </div>

<style>
    #tablemodal{
    padding-left:15px;
    padding-right:15px;
    }
    #tablemodal input{
    width:100%;

    }
    #tablemodal tr td{
    padding:20px;
    font-size:25px;
    }
    .modal-title{
    font-size:30px;
    }
    .modal-header .close span{
    font-size:50px;
    }
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Booking Ruangan <span id="ruanganBooking"></span></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('bookingRuangan')}}" id="formPesan">
      <div class="modal-body">
      
      <h5 class="text-success">Tanggal : <span id="tanggalBooking"></span></h5>     
        <p class="text-danger" style="font-size:15px;display:none;" id="errorModal"></p>
        <table style="width:100%;" id="tablemodal">            
            <tr>
              <td>Jam Mulai</td>
              <td><input type="time" id="mulai" required class="form-control"></td>
            </tr>
            <tr>
              <td>Jam Selesai :</td>
              <td><input type="time" id="selesai" required class="form-control"></td>
            </tr>
            <tr>
              <td>Keperluan :</td>
              <td><textarea id="keperluan" rows="10"style="width:100%;" required class="form-control"></textarea></td>
            </tr>
         </table>      
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Booking</button>
      </div>
      </form>
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
<!-- SweetAlert2 -->

<script>
($(".has-treeview").addClass("menu-open"));
($(".nav-item .nav-link").eq(2).addClass("active"));
($(".nav-item .nav-link").eq("{{$active}}").addClass("active"));


var tanggalPilihan="{{date('Y-m-d')}}";
var pilihanRuangan="";

$("#tanggal").on("change",function(){
    var url="{{route('searchKelas',$jenis)}}";
    var tanggal=$(this).val();
    tanggalPilihan=tanggal;
    
    $.ajax({
        method:"GET",
        data:{tanggal:tanggal},
        url:url,
        success:function(data){
            $("#kontener").html(data.view);
            if(tanggalPilihan < "{{date('Y-m-d')}}"){
                $("#kontener .button-pesan").hide();
            }else{
                $("#kontener .button-pesan").show();
            }
           
        },
        error:function(data){
            console.log(data);
        }
    })
})
$(".row").on("click",".button-pesan",function(){
    
    if(cekAkun()== true){
        if(pilihanRuangan!=$(this).val()){
            $("#mulai").val("");
            $("#selesai").val("");
            $("#keperluan").val("");
            $("#mulai").removeClass("errorForm");
            $("#selesai").removeClass("errorForm");
            $("#errorModal").hide()
        }
        pilihanRuangan=$(this).val();
        $("#ruanganBooking").html($(this).val());
        $("#tanggalBooking").html(tanggalPilihan);
        $('#myModal').modal('show')
    }
});
$("#formPesan").on("submit",function(e){
    e.preventDefault();
    bookingRuangan($(this).attr('action'));
})
function keterangan(id){
    
    var url="{{route('searchKelas',$jenis)}}";
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
function hapus(id,kelas){
    
Swal.fire({
  title: 'Apakah anda yakin ingin menghapus booking kelas ini?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yaa!',
  cancelButtonText: 'Buung'
}).then((result) => {
  if (result.value) {
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{url('/hapus/booking')}}",
        data:{id:id},
        method:"DELETE",
        success:function(data){
            $("#"+kelas).html(data.view);
            $("#kontener #textKosong"+data.id).remove();
            Toast.fire({
                type:"success",
                title:"Booking telah berhasil dihapus"
            }          
            );
        },
        error:function(data){
            $("#"+kelas).html(data.responseJSON.view);
            $("#textKosong"+data.id).remove();
            Swal.fire({
                type:"error",
                title:"Maaf",
                text:data.responseJSON.pesan
            });
            console.log(data);
        }
      })
    
  }else{
    Swal.fire({
        type:"warning",
        title:"Lengeh celenge"
    })
  }
})
    

}
function cekAkun(){
    var status="";
    $.ajax({
        method:"get", 
        dataType:"json",  
        async:false,     
        url:"{{url('/cekakun')}}",
        success:function(data){            
            $("#userStatus").addClass("text-success").removeClass("text-danger").html(data);
            status=data;
        },
        error:function(data){            
            $("#userStatus").addClass("text-danger").removeClass("text-success").html(data.responseJSON);
            status=data.responseJSON;
            Swal.fire({
            type: 'error',
            title: 'Maaf...',
            text: 'Akun anda belum terverifikasi, silahkan hubungi ADMIN!',  
            });
        }

    });
    if(status == "approve"){
        return true;
    }else{
        return false;
    }
    
}
function bookingRuangan(url){
    var mulai=$("#mulai").val();
    var selesai=$("#selesai").val();
    var keperluan=$("#keperluan").val();
    if(cekModal(mulai,selesai) != false){
        $.ajax({
        url:url,
        method:"POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{tanggal:tanggalPilihan,ruangan:pilihanRuangan,mulai:mulai,selesai:selesai,keperluan:keperluan},
        success:function(data){
            $("#mulai").val("");
            $("#selesai").val("");
            $("#keperluan").val("");
            $("#mulai").removeClass("errorForm");
            $("#selesai").removeClass("errorForm");
            $("#errorModal").hide();
            $('#myModal').modal('hide');
            console.log(data);
            Swal.fire({
                type: 'success',
                text:data.pesan,
                title:"Berhasil",
            })
            var idd="#box"+data.id;
            $("#textKosong"+data.id).remove();
            $(idd).append(data.view);
        },error:function(data){
            Swal.fire({
                type:"error",
                title:"Maaf!",
                text:data.responseJSON
            });
            console.log(data);
        }
        })
    }
      
    
}
function cekModal(mulai,selesai){
    
    if(mulai >= selesai){
        $("#errorModal").show().html("Waktu tidak valid, selesai harus lebih dari mulai");
        $("#mulai").addClass("errorForm");
        $("#selesai").addClass("errorForm");
        return false; 
    }
    if(mulai > "22:00" || mulai < "07:30" || selesai > "22:00" || selesai < "07.30"){
        $("#errorModal").show().html("Booking kelas dapat dilakukan dari jam 07:30 AM sampai 10:00 PM");
        $("#mulai").addClass("errorForm");
        $("#selesai").addClass("errorForm");
        return false; 
    }
    return true;
}


</script>


@endsection
