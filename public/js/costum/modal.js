function modal(data,tanggal){
    
    data=data.replace(/ /g,"%20");
    $("#modal").load("/modal/"+data+"/"+tanggal);
}