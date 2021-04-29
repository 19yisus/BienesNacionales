const controller = 'TransaccionController';

$("#tipos").on("change", (e)=>{
  
  if(e.target.value != ""){
    cleanBienes();
    resetSelect();
  }
});