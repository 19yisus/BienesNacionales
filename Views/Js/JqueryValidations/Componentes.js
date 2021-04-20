$(document).ready( () =>{
	
 //  if ($("#catalogo_table").is(":visible")) {
 //    catalogo = "catalogo_table";
 //  } else {
 //    catalogo = "catalogo_table2";
 //  }

  // $(`#catalogo_bien`).DataTable({
  //   responsive: true,
  //   lengthChange: true,
  //   autoWidth: true,
  //   ajax: {
  //     url: `${host_url}/${controller}/ModalAsignacion/Bienes`,
  //     dataSrc: "data",
  //   },
  //   columns: [
  //     { data: "bien_cod" },
  //     { data: "bien_des" },
  //     { data: "cat_des" },
  //     {
  //       data: "bien_estado",
  //       render: function (data) {
  //         return data == 1 ? "Activo" : "Innactivo";
  //       },
  //     },
  //     {
  //       defaultContent: "",
  //       render: function (data, type, row, meta) {
          
  //         let btn = `
  //         <div class='btn-group'>
  //           <button class="btn btn-sm btn-info" onclick="AddForm(this);" data-form="Bienes" data-codigo = "${row.bien_cod}"
  //               data-dismiss="modal" >
  //               <i class="fas fa-check-circle"></i>
  //           </button>
  //          </div>`;
  //         return btn;
  //       },
  //     },
  //   ],
  //   language: {
  //     url: `${host_url}/Views/Js/DataTables.config.json`,
  //   },
  // });

  // $(`#catalogo_componente`).DataTable({
  //   responsive: true,
  //   lengthChange: true,
  //   autoWidth: true,
  //   ajax: {
  //     url: `${host_url}/${controller}/ModalAsignacion/Componente`,
  //     dataSrc: "data",
  //   },
  //   columns: [
  //     { data: "bien_cod" },
  //     { data: "bien_des" },
  //     { data: "cat_des" },
  //     {
  //       data: "bien_estado",
  //       render: function (data) {
  //         return data == 1 ? "Activo" : "Innactivo";
  //       },
  //     },
  //     {
  //       defaultContent: "",
  //       render: function (data, type, row, meta) {
          
  //         let btn = `
  //         <div class='btn-group'>
  //           <button class="btn btn-sm btn-info" onclick="AddForm(this);" data-form="Componente" data-codigo="${row.bien_cod}"
  //               data-dismiss="modal" >
  //               <i class="fas fa-check-circle"></i>
  //           </button>
  //          </div>`;
  //         return btn;
  //       },
  //     },
  //   ],
  //   language: {
  //     url: `${host_url}/Views/Js/DataTables.config.json`,
  //   },
  // });

	// $.validator.addMethod('ValidFormEdit', () =>{
	
	// 	if($('#CodB_old_edit').is(':disabled') || $('#CodM_old_edit').is(':disabled')){
	// 		return false;
	// 	}
	// 	return true;
	
	// }, "No has cambiado ningun valor");
	$.validator.setDefaults({
		onsubmit: true,
		debug: true,
	    errorClass: 'invalid-feedback',
	    highlight: function(element) {
	      $(element)
	        .closest('.form-group')
	        .removeClass('has-success')
	        .addClass('has-error');
	    },
	    unhighlight: function(element) {
	      $(element)
	        .closest('.form-group')
	        .removeClass('has-error')
	        .addClass('has-success');
	    },			   
	    errorPlacement: function (error, element) {
	      if (element.prop('type') === 'checkbox') {
	        error.insertAfter(element.parent());
	      }else {
	      	// var id = element[0].attributes.id.value;
	      	// console.log( $(`#${id}`)[0].attr('aria-invalid'))
	      	// $(element).attr('aria-invalid', true);
	        error.insertAfter(element);
	      }

				if(element.parent().parent().parent().parent()[0].id == 'formulario'){
					$('#formulario').addClass('was-validated');
				}else{
					$('#FormEdit').addClass('was-validated');
				}
	    }
	});
	
	$('.formulario').validate({
		rules:{
			bien_cod:{
				required: true,
			}
		},
		messages:{
			bien_cod:{
				required: "Debe de seleccionar un bien",
			}
		}
	});

	$('.Asignar').click( (e)=>{
		let formulario = e.target.value;

		if($(formulario).valid()){
			confirmacion(`${host_url}/${controller}/Asignar`, $(formulario)[0]).then( (response1) =>{
				if(response1){
					POST(response1[0],response1[1]).then( (res) =>{
						if(res.status == 200){
							$(formulario).remove();
							return true;
						}
					});
				}
			});
		}
	});

  // $('#btnAddMaterial').click( ()=>{
  //   ModalBienes('Componente');
  // });
  
  // $('#btnAddBien').click( ()=>{
  //   ModalBienes('Bienes');
  // });
});
