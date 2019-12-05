@if($auto== false)
    @if($da->status=='ignored'||$da->status=='approve')
        <button  class="btn btn-secondary"  onclick="ubah('{{$da->id}}',this.value)" value="pending">Pending</button>
    @else

        <button class="btn btn-danger"  onclick="ubah('{{$da->id}}',this.value)" value="ignored">Ignore</button>
        <button class="btn btn-primary"   onclick="ubah('{{$da->id}}',this.value)" value="approve">Approve</button>
    @endif
@else
    @php
    $a=$data->firstItem();
    @endphp
    @foreach($data as $dat=>$da)
                    
        <tr>
            <td>{{$a}}</td>
            <td>{{$da->pemesann->name}}</td>
            <td>{{$da->mulai}}</ td>
            <td>{{$da->selesai}}</td>
            <td>{{$da->tanggal}}</td>
            <td>{{$da->kelas->nama_kelas}}</td>
            <td>{{$da->keperluan}}</td>
            <td id="status{{$da->id}}" class="
            @if($da->status=='approve') text-success @elseif($da->status=='ignored') text-danger @endif
            ">{{$da->status}}</td>
            <td class="action{{$da->id}}">
                
                @if($da->status=='ignored'||$da->status=='approve')
                    <button  class="btn btn-secondary"  onclick="ubah('{{$da->id}}',this.value)" value="pending" >Pending</button>
                @else
                
                    <button class="btn btn-danger"  onclick="ubah('{{$da->id}}',this.value)" value="ignored">Ignore</button>
                    <button class="btn btn-primary"   onclick="ubah('{{$da->id}}',this.value)" value="approve">Approve</button>
                @endif
                
            </td>
        </tr>
    @php $a++ @endphp
    @endforeach

@endif