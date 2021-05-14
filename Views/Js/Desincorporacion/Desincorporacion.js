const controller = 'TransaccionController';

$("#tipos").on("change", (e)=>{
  
  if(e.target.value != ""){
    cleanBienes();
    resetSelect();
    // restartForm(false);
    // let catalogo = $('#CatalogoBienes').DataTable();
    // catalogo.ajax.url(`${host_url}/TransaccionController/BienesNoIncorporados/${e.target.value}`).load();
  }
});

$('#Dep').on('change', (e)=>{

  if(e.target.value != ''){
    // $('#tabla').show('slow');
    $('#listar').attr('disabled',false);
    let catalogo = $('#CatalogoBienes').DataTable();
    // $('#Transaccion_bienes').DataTable().ajax.reload(null,false);
    cleanBienes();
    let tipo_bienes = $('#tipos').val();
    catalogo.ajax.url(`${host_url}/TransaccionController/BienesIncorporados/${e.target.value}/${tipo_bienes}`).load();
    
    $('#origen').attr('disabled',false);
    $('#orden').attr('disabled',false);
    $('#Obser').attr('readonly',false);
    $('#Destino').attr('readonly',false);

  }else{
    // $('#tabla').hide('slow');
    $('#origen').attr('disabled',true);
    $('#orden').attr('disabled',true);
    $('#Obser').attr('readonly',true);
    $('#Destino').attr('readonly',true);
  }
});

$('#Dep').on('change', () => {
  if ($('#Dep').valid()) {
    ConsultaEncargado($('#Dep').val());
  } else {
    $('#Encargado').val("");
  }
});