@extends("layouts.admin")
@section("konten")
@section("title","Book Table")
<div class="card" style="margin-top:10px;">
    <div class="card-header ">
    <h3>Book List</h3> 
    <div class="custom-control custom-switch" style="margin-left:30px;">
        <input type="checkbox" class="custom-control-input" id="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">Otomatis tolak untuk waktu yang bertabrakan</label>
    </div>
    </div>
    <form action="{{route('searchBook')}}" method="get"> 
        <label>Tanggal :</label>
        <input type="date" name="tanggal" id="tanggal" >
        <button class="btn btn-primary" id="semuaTanggal">Semua tanggal</button>
        
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
            <script>
           
                function ubah(index,val){
                    ubahh(index,val);
                
                
                
            }
            
            
            </script>
            <tbody id="dataBooking">
            
               @include("ajax.booking")
            </tbody>
            
        </table>
        
    </div>
    <div class="card-footer">
        {{$data->links()}}
    </div>
</div>
<script>
($(".nav-item .nav-link").eq(11).addClass("active"));
var tanggal="semua";
var auto=false;
var yurl="";
const today="{{date('Y-m-d')}}";
$("#tanggal").on("change",function(){
    if($(this).val() < today){
        return Swal.fire({
            type:"error",
            title:"Sorry!",
            text:"Yang berlalu biarlah berlalu"
        })
    }
    tanggal=$(this).val();
    pagination("{{url('/booklist')}}");
});
$("#semuaTanggal").on("click",function(e){
    e.preventDefault();
    tanggal="semua";
    pagination("{{url('/booklist')}}");

})
$(".persetujuan").on("submit",function(e){
    e.preventDefault();
    console.log($(this).serialize());
    });
$(".card-footer").on("click",".page-item .page-link",function(e){
    e.preventDefault();
    if($(this).attr("href")!= undefined){
        yurl=$(this).attr("href");
        pagination();
    }    
});
$("#customSwitch1").change(function(){
var cekbok = $(this).is(':checked');
auto=cekbok;


});
function pagination(url=yurl,tanggall=tanggal){
    $.ajax({
        url:url,
        method:"GET",
        data:{pagination:true,tanggal:tanggall},
        success:function(data){
            $("#dataBooking").html(data.view);
            $(".card-footer").html(data.pagination);
        },
        error:function(data){
            console.log(data);
        }
    });
}
function ubahh(id, val){
    
    var url="{{url('/prosesbook/')}}"+"/"+id;
    var kelas=".action"+id;
    var status="#status"+id;
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        method:"PUT",
        dataType:'json',
        data:{value:val,oto:auto,tanggal:tanggal},
        success:function(data){
            if(auto == false){
                $(kelas).html(data.view);
                $(status).html(data.status);                
            }else{
                pagination();
            }
            Toast.fire({
                type:"success",
                title:data.pesan
            });
            console.log(data);
        },
        error:function(data){
            console.log(data);
        }
    })
    
}



</script>




@endsection