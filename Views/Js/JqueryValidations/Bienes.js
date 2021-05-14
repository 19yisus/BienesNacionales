$(document).ready(() => {
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
    "decimal",
    function (value, element) {
      return (
        this.optional(element) ||
        /^((\d+(\\.\d{0,2})?)|((\d*(\.\d{1,2}))))$/.test(value)
      );
    },
    "Please enter a correct number, format 0.00"
  );

  $("#FormEdit").validate({
    rules: {
      Codbien: {
        required: true,
        minlength: 7,
        maxlength: 7,
        number: true,
      },
      Desbien: {
        required: true,
        minlength: 2,
        maxlength: 90,
      },
      Valbien: {
        required: true,
        min: 1,
        minlength: 1,
        maxlength: 9,
        decimal: true,
      },
      Marca: {
        required: true,
      },
      Modelo: {
        required: true,
      },
      Color: {
        required: true,
      },
      Catalogo: {
        required: true,
        minlength: 10,
        maxlength: 20,
      },
      Serial: {
        required: true,
        minlength: 4,
        maxlength: 20,
      },
      Depre: {
        required: true,
        min: 0,
        minlength: 1,
        maxlength: 9,
        decimal: true,
      },
      Placa: {
        required: true,
        minlength: 6,
        maxlength: 6,
      },
      Anio: {
        required: true,
        minlength: 4,
        maxlength: 4,
        number: true,
        valida_fecha: true,
      },
      Terreno: {
        required: true,
        minlength: 10,
        maxlength: 120,
      },
      Esp: {
        required: true,
      },
      Raza: {
        required: true,
      },
      Peso: {
        required: true,
        minlength: 2,
        maxlength: 4,
        min: 1,
        decimal: true,
      },
      Sexo: {
        required: true,
      },
    },
    messages: {
      Codbien: {
        required: "No hay codigo del bien",
        minlength: "El codigo tiene 7 caracteres de longitud",
        maxlength: "El codigo tiene 7 caracteres de longitud",
        number: "Solo se permiten numeros",
      },
      Desbien: {
        required: "Ingrese la descripcion del bien",
        minlength: "Ingrese al menos 2 caracteres",
        maxlength: "Ingrese menos de 90 caracteres",
        pattern: "Solo se permiten letras",
      },
      Valbien: {
        required: "Ingrese el valor del bien",
        minlength: "Minimo 1 caracter numerico",
        maxlength: "NO puedes ingresar mas de 9 caracteres",
        min: "Ingrese una precio mayor a 0",
        number: "Solo se permiten caracteres decimales",
      },
      Marca: {
        required: "Seleccione la marca del bien",
      },
      Modelo: {
        required: "Seleccione el modelo del bien",
      },
      Color: {
        required: "Seleccione un color para el bien",
      },
      Catalogo: {
        required: "Debe de ingresar el catalogo del bien",
        minlength: "Debe de ingresar 10 caracteres minimo",
        maxlength: "NO puedes ingresar mas de 20 caracteres",
        pattern: "No se permiten letras",
      },
      Serial: {
        required: "Debe de ingresar el serial del bien",
        minlength: "Debe de ingresar al menos 4 caracteres",
        maxlength: "NO puedes ingresar mas de 20 caracteres",
      },
      Depre: {
        required: "Debe de ingresar la deprecion del bien",
        minlength: "Debe de ingresar al menos 1 caracter numerico",
        maxlength: "No ingreses mas de 9 caracteres",
        decimal: "Solo se permiten caracteres decimales",
        min: "Ingrese una depreciación de almenos de 0",
      },
      Placa: {
        required: "Debe de ingresar la placa del transporte",
        minlength: "Debe de ingresar los 6 caracteres del transporte",
        maxlength: "Debe de ingresar los 6 caracteres del transporte",
      },
      Anio: {
        required: "Ingrese el año de este transporte",
        minlength: "Debe de ingresar 4 caracteres numericos",
        maxlength: "Debe de ingresar 4 caracteres numericos",
        number: "Solo se permiten numeros",
        max: "El año ingresado es invalido",
        min: "Minimo hasta el año 1990",
      },
      Terreno: {
        required: "Debe de ingresar obsevacion del semoviente",
        minlength: "Ingrese minimo 10 caracteres",
        maxlength: "Ingrese menos de 120 caracteres",
      },
      Esp: {
        required: "Seleccione la Especie del semoviente",
      },
      Raza: {
        required: "Seleccione la Raza del semoviente",
      },
      Peso: {
        required: "Debe de ingresar el peso",
        minlength: "Debe de ingresar al menos 2 caracter numerico",
        maxlength: "El peso ingresado es invalido",
        decimal: "Solo se permiten decimales",
        min: "Debe de ingresar una cantidad mayor a 0",
      },
      Sexo: {
        required: "Debe se seleccionar el sexo del semoviente",
      },
    },
  });

  $("#formulario").validate({
    rules: {
      Tbien: {
        required: true,
      },
      Clbien: {
        required: true,
      },
      Codbien: {
        required: true,
        minlength: 7,
        maxlength: 7,
        number: true,
      },
      Desbien: {
        required: true,
        minlength: 2,
        maxlength: 90,
      },
      Valbien: {
        required: true,
        minlength: 1,
        maxlength: 9,
        min: 1,
        number: true,
      },
      Cantbien: {
        required: true,
        minlength: 1,
        maxlength: 3,
        min: 1,
        max: 100,
        number: true,
      },
      Marca: {
        required: true,
      },
      Modelo: {
        required: true,
      },
      Color: {
        required: true,
      },
      Catalogo: {
        required: true,
        minlength: 10,
        maxlength: 20,
      },
      Serial: {
        required: true,
        minlength: 4,
        maxlength: 20,
      },
      Depre: {
        required: true,
        min: 0,
        minlength: 1,
        maxlength: 9,
        decimal: true,
      },
      Placa: {
        required: true,
        minlength: 6,
        maxlength: 6,
      },
      Anio: {
        required: true,
        minlength: 4,
        maxlength: 4,
        number: true,
        valida_fecha: true,
      },
      Terreno: {
        required: true,
        minlength: 10,
        maxlength: 120,
      },
      Esp: {
        required: true,
      },
      Raza: {
        required: true,
      },
      Peso: {
        required: true,
        minlength: 2,
        maxlength: 4,
        min: 1,
        decimal: true,
      },
      Sexo: {
        required: true,
      },
    },
    messages: {
      Tbien: {
        required: "Seleccione el tipo de bien",
      },
      Clbien: {
        required: "Seleccione la clasificacion del bien",
      },
      Codbien: {
        required: "No hay codigo del bien",
        minlength: "El codigo tiene 7 caracteres de longitud",
        maxlength: "El codigo tiene 7 caracteres de longitud",
        number: "Solo se permiten numeros",
      },
      Desbien: {
        required: "Ingrese la descripcion del bien",
        minlength: "Ingrese al menos 2 caracteres",
        maxlength: "Ingrese menos de 90 caracteres",
        pattern: "Solo se permiten letras",
      },
      Valbien: {
        required: "Ingrese el valor del bien",
        minlength: "Minimo 1 caracter numerico",
        maxlength: "NO puedes ingresar mas de 9 caracteres",
        min: "Ingrese una precio mayor a 0",
        number: "Solo se permiten valores decimales",
      },
      Cantbien: {
        required: "Debe de ingresar la cantidad de bienes",
        minlength: "Minimo 1 caracter numerico",
        maxlength: "Maximo de 3 caracteres numericos",
        min: "Ingrese un numero mayor a cero",
        max: "Solo se pueden registrar maximo 100",
        number: "Solo se permiten numeros",
      },
      Marca: {
        required: "Seleccione la marca del bien",
      },
      Modelo: {
        required: "Seleccione el modelo del bien",
      },
      Color: {
        required: "Seleccione un color para el bien",
      },
      Catalogo: {
        required: "Debe de ingresar el catalogo del bien",
        minlength: "Debe de ingresar 10 caracteres minimo",
        maxlength: "NO puedes ingresar mas de 20 caracteres",
        pattern: "Solo se permiten 12 caracteres numericos",
      },
      Serial: {
        required: "Debe de ingresar el serial del bien",
        minlength: "Debe de ingresar al menos 4 caracteres",
        maxlength: "NO puedes ingresar mas de 20 caracteres",
      },
      Depre: {
        required: "Debe de ingresar la deprecion del bien",
        minlength: "Debe de ingresar al menos 1 caracter numerico",
        maxlength: "No ingreses mas de 9 caracteres",
        decimal: "Solo se permiten valores decimales",
        min: "Ingrese una depreciación de almenos 0",
      },
      Placa: {
        required: "Debe de ingresar la placa del transporte",
        minlength: "Debe de ingresar los 6 caracteres del transporte",
        maxlength: "Debe de ingresar los 6 caracteres del transporte",
      },
      Anio: {
        required: "Ingrese el año de este transporte",
        minlength: "Debe de ingresar 4 caracteres numericos",
        maxlength: "Debe de ingresar 4 caracteres numericos",
        number: "Solo se permiten numeros",
        max: "El año ingresado es invalido",
        min: "Minimo hasta el año 1990",
      },
      Terreno: {
        required: "Debe de ingresar obsevacion del semoviente",
        minlength: "Ingrese minimo 10 caracteres",
        maxlength: "Ingrese menos de 120 caracteres",
      },
      Esp: {
        required: "Seleccione la Especie del semoviente",
      },
      Raza: {
        required: "Seleccione la Raza del semoviente",
      },
      Peso: {
        required: "Debe de ingresar el peso",
        minlength: "Debe de ingresar al menos 2 caracter numerico",
        maxlength: "El peso ingresado es invalido",
        decimal: "Solo se permiten valores decimales",
        min: "Debe de ingresar una cantidad mayor a 0",
      },
      Sexo: {
        required: "Debe se seleccionar el sexo del semoviente",
      },
    },
  });

  $("#btnAdd").click(() => {
    if ($("#formulario").valid()) {
      confirmacion(
        `${host_url}/${controller}/Insert`,
        $("#formulario")[0]
      ).then((response1) => {
        if (response1) {
          POST(response1[0], response1[1]).then((res) => {
            if (res.status == 200) {
              FormDinamic("");
              reloadCatalogo();
              ShowCodigo_incrementado(
                `${host_url}/${controller}`,
                document.formulario.Cod
              );
            }
          });
        }
      });
    }
  });

  $("#btnUp").click(() => {
    if ($("#FormEdit").valid()) {
      confirmacion(`${host_url}/${controller}/Update`, $("#FormEdit")[0]).then(
        (response1) => {
          if (response1) {
            POST(response1[0], response1[1]).then((res) => {
              FormDinamic("");
              reloadCatalogo();
              $('#ModalEdit').modal('hide');
              return true;
            });
          }
        }
      );
    }
  });
  let categoria = null;
  $(`#catalogo_table_incorporados`).DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: true,
    ajax: {
      url: `${host_url}/${controller}/Incorporados/1`,
      dataSrc: "data",
    },
    dom: 'Bftp',
    buttons:{
      buttons:[
        {
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success',
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i>',
          titleAttr: 'Exportar a PDF',
          className: 'btn btn-danger',
        },
      ],
    },
    columns: [
      { data: "bien_cod" },
      { data: "bien_des" },
      { data: "cat_des" },
      { data: "ubicacion" },
      {
        data: "bien_estado",
        render: function (data) {
          return data == 1 ? "Activo" : "Innactivo";
        },
      },
      {
        defaultContent: "",
        render: function (data, type, row, meta) {
          let estado = row.bien_estado == 0 ? "disabled" : "";
          let title_edit =
            row.bien_estado == 0
              ? "Este Bien no puede ser modificado"
              : "Modificar";
          let title_desac = row.bien_estado == 0 ? "Activar" : "Desactivar";
          let clase = row.bien_estado == 0 ? "danger" : "success";
          let btnDestroy = "";

          // if (row.bien_estado == 0) {
          //   btnDestroy = `
					// <button class="btn btn-sm btn-warning b-destroy" onclick="bDelet(this);" data-function="Destroy" id="bDestroy"
					// data-form="form-del-${row.bien_cod}"
					// 	data-dismiss="modal" title="Eliminar regitro">
					// 		<i class="fas fa-trash"></i>
          // <button class="btn btn-sm btn-${clase}" onclick="bDelet(this);" data-function="Delete" id="bDelete" data-form="form-del-${row.bien_cod}"
          //   data-dismiss="modal" title="${title_desac}">
          //     <i class="fas fa-power-off"></i>
          //   </button>
					// 	</button>`;
          // }

          let btn = `
          <form name="form-del-${row.bien_cod}" id="form-del-${row.bien_cod}">
            <input type="hidden" name="Cod" value="${row.bien_cod}">
          </form>
          <div class='btn-group'>
            <button class="btn btn-sm btn-info" id="btn-edit" onclick="Consulta(this)" data-codigo="${row.bien_cod}"
              data-toggle="modal" data-target="#ModalEdit" ${estado} title="${title_edit}">
              <i class="fas fa-edit"></i>
            </button>
            
            <button class="btn btn-sm btn-default" data-control="${controller}" onclick="bConsul(this);" data-codigo="${row.bien_cod}"
              data-toggle="modal" data-target="#ModalConsultar" data-dismiss="modal"  title="Consultar">
              <i class="fas fa-list"></i>
            </button>
           </div>`;
          return btn;
        },
      },
    ],
    language: {
      url: `${host_url}/Views/Js/DataTables.config.json`,
    },
  });

  $(`#catalogo_table_desincorporados`).DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: true,
    ajax: {
      url: `${host_url}/${controller}/Desincorporados/0`,
      dataSrc: "data",
    },
    dom: 'Bftp',
    buttons:{
      buttons:[
        {
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success',
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i>',
          titleAttr: 'Exportar a PDF',
          className: 'btn btn-danger',
        },
      ],
    },
    columns: [
      { data: "bien_cod" },
      { data: "bien_des" },
      { data: "cat_des" },
      { data: "ubicacion" },
      { data: "com_destino" },
      {
        data: "bien_estado",
        render: function (data) {
          return data == 1 ? "Activo" : "Innactivo";
        },
      },
      {
        defaultContent: "",
        render: function (data, type, row, meta) {
                              
          let btn = `
          <div class='btn-group'>            
            <button class="btn btn-sm btn-default" data-control="${controller}" onclick="bConsul(this);" data-codigo="${row.bien_cod}"
              data-toggle="modal" data-target="#ModalConsultar" data-dismiss="modal"  title="Consultar">
              <i class="fas fa-list"></i>
            </button>
           </div>`;
          return btn;
        },
      },
    ],
    language: {
      url: `${host_url}/Views/Js/DataTables.config.json`,
    },
  });
   
  $(`.catalogo-table`).DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: true,
    ajax: {
      url: `${host_url}/${controller}/PaginadorController`,
      dataSrc: "data",
    },
    dom: 'Bftp',
    buttons:{
      buttons:[
        {
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success',
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i>',
          titleAttr: 'Exportar a PDF',
          className: 'btn btn-danger',
        },
      ],
    },
    columns: [
      { data: "bien_cod" },
      { data: "bien_des" },
      { data: "cat_des" },
      { data: "bien_fecha_ingreso" },
      { data: "bien_precio",
        render: function(data, type, row){
          return `${data} ${row.bien_divisa}`
        }
      },
      {
        data: "bien_estado",
        render: function (data) {
          return data == 1 ? "Activo" : "Innactivo";
        },
      },
      {
        defaultContent: "",
        render: function (data, type, row, meta) {
          let estado = row.bien_estado == 0 ? "disabled" : "";
          let title_edit =
            row.bien_estado == 0
              ? "Este Bien no puede ser modificado"
              : "Modificar";
          let title_desac = row.bien_estado == 0 ? "Activar" : "Desactivar";
          let clase = row.bien_estado == 0 ? "danger" : "success";

          if (row.bien_estado == 0) {
            btnDestroy = `
					<button class="btn btn-sm btn-warning b-destroy" onclick="bDelet(this);" data-function="Destroy" id="bDestroy"
					data-form="form-del-${row.bien_cod}"
						data-dismiss="modal" title="Eliminar regitro">
							<i class="fas fa-trash"></i>
						</button>`;
          // <button class="btn btn-sm btn-${clase}" onclick="bDelet(this);" data-function="Delete" id="bDelete" data-form="form-del-${row.bien_cod}"
          //      data-dismiss="modal" title="${title_desac}">
          //     <i class="fas fa-power-off"></i>
          // </button>
          }

          let btn = `
          <form name="form-del-${row.bien_cod}" id="form-del-${row.bien_cod}">
            <input type="hidden" name="Cod" value="${row.bien_cod}">
          </form>
          <div class='btn-group'>
            <button class="btn btn-sm btn-info" id="btn-edit" onclick="Consulta(this)" data-codigo="${row.bien_cod}"
              data-toggle="modal" data-target="#ModalEdit" ${estado} title="${title_edit}">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-default" data-control="${controller}" onclick="bConsul(this);" data-codigo="${row.bien_cod}"
              data-toggle="modal" data-target="#ModalConsultar" data-dismiss="modal"  title="Consultar">
              <i class="fas fa-list"></i>
            </button>
           </div>`;
          return btn;
        },
      },
    ],
    language: {
      url: `${host_url}/Views/Js/DataTables.config.json`,
    },
  });

  let table = $(`.catalogo-table #catalogo_table_incorporados`).DataTable();
  table.page.len(5).draw();
  table.on("processing", async () => {
    let res = await permisosUser();
    if (res.eliminar == 0) $(".b-destroy").remove();
    if (res.modificar == 0) {
      $(".b-editar").remove();
      $(".b-desactivar").remove();
    }
    if (res.consultar == 0) $(".b-consultar").remove();
  });
});
