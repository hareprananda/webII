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
        <h5 class="modal-title">Booking Ruangan {{$kelas->nama_kelas}}</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('bookingRuangan')}}" method="post">
      <div class="modal-body">
      
      <h5 class="text-success">Tanggal : {{$tanggal}}</h5>
      
      @csrf
      <input type="hidden" name='tanggal' value="{{$tanggal}}">
      <input type="hidden" name='kelas' value="{{$kelas->id}}">
        <table style="width:100%;" id="tablemodal">
            
            <tr>
              <td>Jam Mulai</td>
              <td><input type="time" name="mulai" required></td>
            </tr>
            <tr>
              <td>Jam Selesai :</td>
              <td><input type="time" name="selesai" required></td>
            </tr>
            <tr>
              <td>Keperluan :</td>
              <td><textarea name="keperluan" rows="10"style="width:100%;" required></textarea></td>
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
<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    
  // Hide the Modal
 
});
</script>
 