function modal(data){
    data=data.replace(/ /g,"%20");
    $("#modal").load("/modal/"+data);
}