@extends("layouts.admin")
@section("konten")
@section("title","User Table")
<div class="card" style="margin-top:10px;">
    <div class="card-header bg-primary">
    <h3>User Table</h3>
    </div>
    <div class="form-inline ml-3" style="margin-top:10px;" >
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari orang" aria-label="Recipient's username" aria-describedby="button-addon2" id="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
    @if ($message = Session::get('sukses'))
                      <div class="alert alert-primary alert-block" id="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                      </div>
                    @endif
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Joined At</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @include("ajax.user")
            </tbody>
            
        </table>
        
    </div>
    <div class="card-footer">
        
        {{$data->onEachSide(1)->links()}}
    </div>
</div>
<script>
($(".nav-item .nav-link").eq(10).addClass("active"));
var searchss="";
$("#example2").on("submit",".formBtn",function(e){
    e.preventDefault(); 
    var index=$(".formBtn").index(this);
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:$(this).attr('action'),
        method:"PUT",
        dataType:'json',
        success:function(data){
            $(".formBtn").eq(index).replaceWith(data.view);
            Toast.fire({
                type: 'success',
                title: data.pesan
            })
        },
        error:function(data){
            console.log(data);
        }
    });
    
})
function paginate(url,search=searchss){
    $.ajax({
        url:url,
        data:{pagination:true,search:search},
        method:"GET",
        dataType:'json',
        success:function(data){
            $(".card-footer").html(data.pagination);
            $("#example2 tbody").html(data.view);
        },
        error:function(data){
            console.log(data);
        }
    })
}
$(".card-footer").on('click',".page-item .page-link",function(e){
    e.preventDefault();
    var url=$(this).attr('href');
    if(url != undefined){
        paginate(url);
    }    
})
$("#search").on("keyup",function(){
    var url="{{url('/user')}}";
    searchss=$(this).val();
    paginate(url);
})

</script>

@endsection