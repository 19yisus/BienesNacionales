const controller = 'TransaccionController';

$("#tipos").on("change", (e)=>{
  
  if(e.target.value != ""){
    cleanBienes();
    resetSelect();
  }
});

$('#Dep_destino').on('change', ()=>{
  if($('#Dep_destino').valid()){
    ConsultaEncargado($('#Dep_destino').val());
  }
});

const validarSelects = ()=>{
  if($('#Dep_origen').val() == $('#Dep_destino').val()){
    $('#Dep_destino').val('');
    $('#Dep_destino').trigger('change');
    
    alerta("La dependencia destino no puede ser la misma dependencia de origen");
    return false;
  }
  return true;
}

$('#Dep_destino').on('change', (e) =>{
  if(validarSelects()){
    $('#orden').attr('disabled',false);
    $('#Obser').attr('readonly',false);
    $('#Reasignar').attr('disabled', false);
  }else{
    $('#orden').attr('disabled',true);
    $('#Obser').attr('readonly',true);
    $('#Reasignar').attr('disabled', true);
  }
});


$('#Dep_origen').on('change', (e)=>{
  if(e.target.value != ''){
    $('#Dep_destino').attr('disabled', false);

    if($('#Dep_destino').val() != e.target.value){
      $('#listar').attr('disabled',false);
      cleanBienes();
      let tipo_bienes = $('#tipos').val();
      let catalogo = $('#CatalogoBienes').DataTable();
      catalogo.ajax.url(`${host_url}/TransaccionController/BienesDesincorporados/${e.target.value}/${tipo_bienes}`).load();
    }

    validarSelects();
  }else{
    // $('#tabla').hide('slow');
    $('#orden').attr('disabled',true);
    $('#Obser').attr('readonly',true);
    $('#Dep_destino').attr('disabled', true);
    $('#Reasignar').attr('disabled', true);
  }
});

