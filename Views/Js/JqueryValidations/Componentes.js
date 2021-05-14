$(document).ready( () =>{
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
