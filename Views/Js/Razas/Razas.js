const controller = "RazasController";

const Consulta = (e) =>{
	fetch(`${host_url}/${controller}/Consulta/${e.dataset.codigo}`)
		.then( response =>{
			return response.json();
		})
		.then( res =>{
			$('#ModalCatalogo').modal('hide');

			if(res.status == 200){

				$('#Cod_edit').val(res.datos.Cod);
				$('#Des_edit').val(res.datos.Des);

				$('#Esp_edit').val(`${res.datos.Raza}`);
        		$('#Esp_edit').trigger('change');
			}
		})
		.catch( Error =>{
			console.log(Error);
		});
}
