
@php 
    $a=$data->firstItem();
    
@endphp 
@foreach($data as $dat)

<tr>
<td>{{$a}}</td>
<td>{{$dat->name}}</td>
<td>{{$dat->id}}</td>
<td>{{$dat->created_at}}</td>

<td>
@if(($dat->status)=="approve")
<form action="{{url('/unverify/'.$dat->id)}}" method="post"  class="formBtn"> 
    <button class="btn btn-danger">Unverified</button>
    <p style="font-size:15px;">Status : <span class="text-success">Approve</span> </p>
    
</form>
@elseif(($dat->status)=="unverified")
<form action="{{url('/approve/'.$dat->id)}}" method="post" class="formBtn">                
    <button class="btn btn-primary">Approve</button>
    <p style="font-size:15px;">Status : <span class="text-danger">Unverified</span> </p>
</form>
@endif
</td>
</tr>
@php $a++; @endphp
@endforeach

