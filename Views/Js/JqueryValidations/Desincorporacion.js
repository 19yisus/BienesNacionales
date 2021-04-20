$(document).ready( ()=>{
  // `comprobantes.com_cod,comprobantes.com_origen,comprobantes.com_fecha_comprobante,dependencia.dep_des`
  $('#Catalogo_comprobantes_Desincorporacion').DataTable({
    responsive: true,
      lengthChange: true,
      autoWidth: true,
      ajax: {
        url: `${host_url}/TransaccionController/CatalogoComprobantes/D`,
        dataSrc: "data",
      },
      columns:[
        {data: "com_cod"},
        {data: "com_origen"},
        {data: "dep_des"},
        {data: "com_fecha_comprobante"},
      ],
      language: {
        url: `${host_url}/Views/Js/DataTables.config.json`,
      },
  });

	$('#Transaccion_bienes').DataTable({
		responsive: true,
	    lengthChange: true,
	    autoWidth: true,
      ajax:`${host_url}/Views/Js/Empty.json`,
	    language: {
	      url: `${host_url}/Views/Js/DataTables.config.json`,
	    },
	});

  $('#CatalogoBienes').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: true,
    select: true,
    select:{
      style:'multi'
    },
    columns:[
      {data: "bien_cod", render: function(data){
        return `<span id="Cod-${data}"></span><p>${data}</p>`
      }},
      {data: "bien_des"},
      {data: "bien_catalogo"},
      {data: "dep_des"},
    ],
    language: {
      url: `${host_url}/Views/Js/DataTables.config.json`,
    },
  });


  $('#Dep').on('change', (e)=>{

    if(e.target.value != ''){
      // $('#tabla').show('slow');
      $('#listar').attr('disabled',false);
      let catalogo = $('#CatalogoBienes').DataTable();
      $('#Transaccion_bienes').DataTable().ajax.reload(null,false);
      catalogo.ajax.url(`${host_url}/TransaccionController/BienesIncorporados/${e.target.value}`).load();
      
      $('#origen').attr('disabled',false);
      $('#orden').attr('disabled',false);
      $('#Obser').attr('readonly',false);

    }else{
      // $('#tabla').hide('slow');
      $('#origen').attr('disabled',true);
      $('#orden').attr('disabled',true);
      $('#Obser').attr('readonly',true);
    }
  });

	$.validator.setDefaults({
    onsubmit: true,
    debug: true,
    errorClass: "invalid-feedback",
    highlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error")
        .addClass("has-success");
    },
    errorPlacement: function (error, element) {
      if (element.prop("type") === "checkbox") {
        error.insertAfter(element.parent());
      } else {
        // var id = element[0].attributes.id.value;
        // console.log( $(`#${id}`)[0].attr('aria-invalid'))
        // $(element).attr('aria-invalid', true);
        error.insertAfter(element);
      }
      if (element.parent().parent().parent().parent()[0].id == "formulario") {
        $("#formulario").addClass("was-validated");
      } else {
        $("#FormEdit").addClass("was-validated");
      }
    },
  });

	$.validator.addMethod(
    "validarBienes",
    (value) => {
      if($("#formulario input[type='hidden']").length == 0) return false; else return true;
    },
    "NO hay ningun bien en esta transaccion"
  );

  $("#formulario").validate({
    rules: {
      origen:{
      	required: true
      },
      Factura:{
      	number: true,
      	required: true,
      	minlength: 4,
      	maxlength: 10,
      },
      Dep:{
      	required: true
      },
      orden:{
        number: true,
        required: true,
        minlength: 8,
        maxlength: 10,
      },
      Obser:{
        required: true,
        minlength: 10,
        maxlength: 150,
        validarBienes: true,
      },
    },
    messages: {
      origen:{
      	required: "Debe de seleccionar el origen"
      },
      Factura:{
      	number: "Solo se aceptan numeros",
      	required: "Debe de ingresar el numero de factura",
      	minlength: "Minimo 4 caracteres numericos",
      	maxlength: "Maximo 10 caracteres numericos",
      },
      Dep:{
      	required: "Debe de seleccionar la dependencia donde se encuentran los bienes"
      },
      orden:{
        number: "Solo se aceptan numeros",
        minlength: "Minimo 8 caracteres numericos",
        maxlength: "Maximo 10 caracteres numericos",
        required: "Este campo es requerido",
      },
      Obser:{
        required: "Debe de ingresar una obervacion",
        minlength: "Debe de ingresar minimo 10 caracteres",
        maxlength: "Maximo de 150 caracteres",
      },
    },
  });

  $('#Dep').on('change', () => {
    if ($('#Dep').valid()) {
      ConsultaEncargado($('#Dep').val());
    } else {
      $('#Encargado').val("");
    }
  });
  	$("#Desincorporar").click(() => {
    if ($("#formulario").valid()) {
      confirmacion(
        `${host_url}/${controller}/Desincorporar`,
        $("#formulario")[0]
      ).then((response1) => {
        if (response1) {
          POST(response1[0], response1[1]).then((res) => {
            if (res.status == 200) {
              reloadCatalogo();
              print_info();
            }
          });
        }
      });
    }
  });
});
