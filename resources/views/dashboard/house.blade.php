@extends("layouts.admin")
@section('title','House')
@section("konten")
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
#tableutama tr td{
    width:33.333%;
    height:250px;
    padding:10px;
}
#tableutama .small-box{
    height:100%;
}
.small-box .small-box-footer{
    margin-top:100px;
    
}
.small-box .icon .fa-university{
    font-size:80px;
}
</style>
<h2>Pilih Blok Kelas</h2>
<table style="width:100%;" id="tableutama">
    <tr>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang 100</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/100')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </td>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang 200</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/200')}}" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </td>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang 300</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/300')}}" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>
        </div>
        
    </tr>
    <tr>
    </td>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang 400</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/400')}}" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </td>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang 500</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/500')}}" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </td>
        <td>
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Ruang Aula & Lab</h3>          
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <a href="{{url('/ruangan/aulalab')}}" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </td>
    </tr>
</table>



@endsection