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

  $(`.catalogo-table`).DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: true,
    ajax: {
      url: `${host_url}/${controller}/PaginadorController`,
      dataSrc: "data",
    },
    dom: 'Bftlp',
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
      { data: "dep_cod" },
      { data: "dep_des" },
      { data: "nuc_des" },
      {
        data: "dep_estado",
        render: function (data) {
          return data == 1 ? "Activo" : "Innactivo";
        },
      },
      {
        defaultContent: "",
        render: function (data, type, row, meta) {
          let estado = row.dep_estado == 0 ? "disabled" : "";
          let title_edit =
            row.dep_estado == 0
              ? "Esta Dependencia no puede ser modificada"
              : "Modificar";
          let title_desac = row.dep_estado == 0 ? "Activar" : "Desactivar";
          let clase = row.dep_estado == 0 ? "danger" : "success";
          let btnDestroy = "";

          if (row.dep_estado == 0) {
            btnDestroy = `
					<button class="btn btn-sm btn-warning b-destroy" onclick="bDelet(this);" data-function="Destroy" id="bDestroy"
					data-form="form-del-${row.dep_cod}"
						data-dismiss="modal" title="Eliminar regitro">
							<i class="fas fa-trash"></i>
						</button>`;
          }

          let btn = `
          <form name="form-del-${row.dep_cod}" id="form-del-${row.dep_cod}">
            <input type="hidden" name="Cod" value="${row.dep_cod}">
          </form>
          <div class='btn-group'>
            <button class="btn btn-sm btn-info" id="btn-edit" onclick="Consulta(this)" data-codigo="${row.dep_cod}"
              data-toggle="modal" data-target="#ModalEdit" ${estado} title="${title_edit}">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-${clase}" onclick="bDelet(this);" data-function="Delete" id="bDelete" data-form="form-del-${row.dep_cod}"
            data-dismiss="modal" title="${title_desac}">
              <i class="fas fa-power-off"></i>
            </button>
            <button class="btn btn-sm btn-default" data-control="${controller}" onclick="bConsul(this);" data-codigo="${row.dep_cod}"
              data-toggle="modal" data-target="#ModalConsultar" data-dismiss="modal"  title="Consultar">
              <i class="fas fa-list"></i>
            </button>
						${btnDestroy}
           </div>`;
          return btn;
        },
      },
    ],
    language: {
      url: `${host_url}/Views/Js/DataTables.config.json`,
    },
  });

  let table = $(`.catalogo-table`).DataTable();
  table.on("processing", async () => {
    let res = await permisosUser();
    if (res.eliminar == 0) $(".b-destroy").remove();
    if (res.modificar == 0) {
      $(".b-editar").remove();
      $(".b-desactivar").remove();
    }
    if (res.consultar == 0) $(".b-consultar").remove();
  });

  $("#FormEdit").validate({
    rules: {
      Des: {
        required: true,
        minlength: 4,
        maxlength: 60,
      },
      Nu: {
        required: true,
      },
    },
    messages: {
      Des: {
        required: "Debe ingresar el nombre de la dependencia",
        minlength: "Debe de ingresar al menos 4 caracteres",
        maxlength: "No puede ingresar mas de 60 caracteres",
        pattern: "Este campo solo acepta letras",
      },
      Nu: {
        required: "Debe de seleccionar a que nucleo pertenece",
      },
    },
  });

  $("#formulario").validate({
    rules: {
      Des: {
        required: true,
        minlength: 4,
        maxlength: 60,
      },
      Nu: {
        required: true,
      },
    },
    messages: {
      Des: {
        required: "Debe ingresar el nombre de la dependencia",
        minlength: "Debe de ingresar al menos 4 caracteres",
        maxlength: "No puede ingresar mas de 60 caracteres",
        pattern: "Este campo solo acepta letras",
      },
      Nu: {
        required: "Debe de seleccionar a que nucleo pertenece",
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
              reloadCatalogo();
              Isthereprincipal();
              SelectNucleos();
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
              reloadCatalogo();
              return true;
            });
          }
        }
      );
    }
  });
});
