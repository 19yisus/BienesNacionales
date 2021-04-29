$(document).ready( ()=>{
  $('#Catalogo_comprobantes_Reasignacion').DataTable({
    responsive: true,
      lengthChange: true,
      autoWidth: true,
      ajax: {
        url: `${host_url}/TransaccionController/CatalogoComprobantes/R`,
        dataSrc: "data",
      },
      columns:[
        {data: "com_cod"},
        {data: "com_origen"},
        {data: "dep_des"},
        {data: "com_fecha_comprobante"},
        {data: "total_bienes"},
        {defaultContent: "", 
        render: function(data, type, row, meta){
          return `<button class="btn btn-sm btn-default" title="Consultar" onclick="bConsul(this);" data-control="${controller}" 
          data-codigo="${row.com_cod}" data-toggle="modal" data-target="#ModalConsultar" 
          data-dismiss="modal"><i class="fas fa-list"></i></button>`;
        }},
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
      Dep_origen:{
      	required: true
      },
      Dep_destino:{
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
      Dep_origen:{
      	required: "Debe de seleccionar la dependencia donde se encuentran los bienes"
      },
      Dep_destino:{
      	required: "Debe de seleccionar la dependencia destino para los bienes"
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
  	$("#Reasignar").click(() => {
    if ($("#formulario").valid()) {
      confirmacion(
        `${host_url}/${controller}/Reasignacion`,
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

  $('#Dep_destino').on('change', ()=>{
		if($('#Dep_destino').valid()){
			ConsultaEncargado($('#Dep_destino').val());
		}
	});  
});