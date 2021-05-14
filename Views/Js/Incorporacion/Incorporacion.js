const controller = 'TransaccionController';

const restartForm = (boolean) =>{
  $("#origen").attr('disabled', boolean);
  $("#Factura").attr('disabled', boolean);
  $("#orden").attr('disabled', boolean);
  $("#Dep").attr('disabled', boolean);
  $("#Obser").attr('disabled', boolean);
  $("#Registro").attr('disabled', boolean);
  $("#listar").attr('disabled', boolean);
}

$("#tipos").on("change", (e)=>{
  
  if(e.target.value != ""){
    cleanBienes();
    restartForm(false);
    let catalogo = $('#CatalogoBienes').DataTable();
    catalogo.ajax.url(`${host_url}/TransaccionController/BienesNoIncorporados/${e.target.value}`).load();
  }else{
    restartForm(true);
  }
});

$('#Dep').on('change', ()=>{
  if($('#Dep').valid()){
    ConsultaEncargado($('#Dep').val());
  }else{
    $('#Encargado').val("");
  }
});



