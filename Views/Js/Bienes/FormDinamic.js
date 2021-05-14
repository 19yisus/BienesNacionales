$("#Clbien").change((e) => {

  rebootForm();
  
  if(e.target.value != ""){
    $('#Clbien option').each( (index,element)=>{
      if(element.dataset.categoria != undefined && element.value == e.target.value && e.target.value != ""){
        categoria = element.dataset.categoria;
        FormDinamic(categoria);
      }
    });

    if ($("#Clbien").valid()) CodificacionBien(e.target.value);
    else $("#Cod").attr("disabled", true);
    $("#Cod").val("");

    $("#Cantbien").attr("disabled", true);
    $("#Cantbien").val("");
  }else{
    FormDinamic("");
  }
});

$("#Cantbien").on("keyup", () => {
  if ($("#Cantbien").valid()) {
    $("#Desbien").attr("disabled", false);
  } else {
    $("#Desbien").attr("disabled", true);
  }
});

$("#Desbien").on("keyup", () => {
  if ($("#Desbien").valid()) {
    $("#Valbien").attr("disabled", false);
  } else {
    $("#Valbien").attr("disabled", true);
  }
});

$("#Valbien").on("keyup", () => {
  if ($("#Valbien").valid()) {
    $('#divisa').attr('disabled', false);
    
    switch (categoria) {
      case "IN":
        $("#Terreno").attr("disabled", false);
        break;

      default:
        $("#Terreno").attr("disabled", true);
        FullSelect1(categoria).then((res) => {
          if (categoria == "BS") {
            $("#Esp").attr("disabled", false);
            $("#Esp").html(res);
          } else $("#Marca").attr("disabled", false);
          $("#Marca").html(res);
        });
        break;
    }
  }
});

$("#Marca").change((e) => {
  if ($("#Marca").valid()) {
    FullSelect2(e.target.value).then((res) => {
      $("#Raza").attr("disabled", true);
      $("#Modelo").attr("disabled", false);
      $("#Modelo").html(res);
    });
  } else $("#Modelo").attr("disabled", true);
});

$("#Marca_edit").change((e) => {
  if ($("#Marca_edit").valid()) {
    FullSelect2(e.target.value).then((res) => {
      $("#Raza_edit").attr("disabled", true);
      $("#Modelo_edit").attr("disabled", false);
      $("#Modelo_edit").html(res);
    });
  } else $("#Modelo_edit").attr("disabled", true);
});

$("#Esp").change((e) => {
  if ($("#Esp").valid()) {
    FullSelect2(e.target.value).then((res) => {
      $("#Modelo").attr("disabled", true);
      $("#Raza").attr("disabled", false);
      $("#Raza").html(res);
    });
  } else $("#Raza").attr("disabled", true);
});

$("#Esp_edit").change((e) => {
  if ($("#Esp_edit").valid()) {
    FullSelect2(e.target.value).then((res) => {
      $("#Modelo_edit").attr("disabled", true);
      $("#Raza_edit").attr("disabled", false);
      $("#Raza_edit").html(res);
    });
  } else $("#Raza_edit").attr("disabled", true);
});

$("#Raza").change((e) => {
  if ($("#Raza").valid()) $("#Peso").attr("disabled", false);
  else $("#Peso").attr("disabled", true);
});

$("#Modelo").change((e) => {
  if ($("#Modelo").valid()) $("#Color").attr("disabled", false);
  else $("#Color").attr("disabled", true);
});

$("#Color").change((e) => {
  if ($("#Color").valid())
    if ($("#Tbien").val() != "TP") $("#Catalogo").attr("disabled", false);
    else $("#Placa").attr("disabled", false);
  else $("#Catalogo").attr("disabled", true);
});

$("#Catalogo").on("keyup", () => {
  if ($("#Catalogo").valid()) $("#Serial").attr("disabled", false);
  else $("#Serial").attr("disabled", true);
});

$("#Serial").on("keyup", () => {
  if ($("#Serial").valid()) $("#Depre").attr("disabled", false);
  else $("#Depre").attr("disabled", true);
});

$("#Depre").on("keyup", () => {
  if ($("#Depre").valid()) $("#if_componente").attr("disabled", false);
});

$("#Peso").on("keyup", () => {
  if ($("#Peso").valid()) $("#S1, #S2").attr("disabled", false);
  else $("#S1, #S2").attr("disabled", true);
});

$("#Depre").on("keyup", () => {
  if ($("#Tbien").val() == "TP" && $("#Depre").valid())
    $("#Placa").attr("disabled", false);
  else $("#Placa").attr("disabled", true);
});

$("#Placa").on("keyup", () => {
  if ($("#Placa").valid()) $("#Anio").attr("disabled", false);
  else $("#Anio").attr("disabled", true);
});