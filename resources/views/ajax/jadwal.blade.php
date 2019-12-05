@if(isset($boxing))

    @foreach($data as $dat)

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
        <div class="small-box-footer">
        @if($dat->status=='pending' && $dat->pemesan == Auth::user()->id)
        <button class="btn btn-danger" style="padding:0px;padding-left:20px;padding-right:20px;float:left" onclick="hapus('{{$dat->id}}','box{{$k->id}}')"><i class="fas fa-trash" ></i> Batal</button>
        @endif

        <a onclick="keterangan('{{$dat->id}}')"  style="cursor:pointer">Keterangan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    @endforeach
@elseif(isset($box))
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
        <div class="small-box-footer">
        @if($dat->status=='pending' && $dat->pemesan == Auth::user()->id)
        <button class="btn btn-danger" style="padding:0px;padding-left:20px;padding-right:20px;float:left" onclick="hapus('{{$dat->id}}','box{{$dat->id_kelas}}')"><i class="fas fa-trash" ></i> Batal</button>
        @endif

        <a onclick="keterangan('{{$dat->id}}')"  style="cursor:pointer">Keterangan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>

@else
    @foreach ($kelas as $k)
    <div class='col-6'>
        <div class="kolom" >
            <div class="card" style="width:100%;">
                <div class="card-header d-flex p-0 ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title p-3">
                    <i class="fas fa-university"></i>
                    {{$k->nama_kelas}}
                    </h3>
                    <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        
                        <button type="button" class="btn btn-primary button-pesan"                        
                        value="{{$k->nama_kelas}}">
                        
                        <i class="fas fa-plus"></i> Booking
                        </button>
                        
                    </li>
                    
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                <div class='row' id="box{{$k->id}}">
                @php $ada=0; @endphp
                @foreach($data as $dat)

                @if(($dat->kelas->nama_kelas != $k->nama_kelas) || $dat->status=='ignored')
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
                    <div class="small-box-footer">
                    @if($dat->status=='pending' && $dat->pemesan == Auth::user()->id)
                    <button class="btn btn-danger" style="padding:0px;padding-left:20px;padding-right:20px;float:left" onclick="hapus('{{$dat->id}}','box{{$k->id}}')"><i class="fas fa-trash" ></i> Batal</button>
                    @endif

                    <a onclick="keterangan('{{$dat->id}}')"  style="cursor:pointer">Keterangan <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                </div>
                @endforeach
                @if($ada==0)
                <p class="text-info" id="textKosong{{$k->id}}">Belum ada booking untuk ruangan ini</p>
                @endif
                </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                
                </div>
            </div>
        </div>
    </div>       
    
    @endforeach
@endif
    
    
