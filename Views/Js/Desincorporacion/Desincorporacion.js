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