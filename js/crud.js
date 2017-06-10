
function inputdata(data,lebar,tinggi){
    window.open(data,"Tambah PO","menubar=no,width="+lebar+",height="+tinggi);
}
function sate(kambing){
    window.open(kambing,"Delete PO","menubar=no,width=175,height=20");
}
function tutup(){
    self.close();
    window.opener.location.reload();
}
function directlink(url){
    tutup();
}
function refreshparent(){
  window.opener.location.reload(false);
}
