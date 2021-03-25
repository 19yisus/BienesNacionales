const controller = 'ModelosController';

const Consulta = (e)=>{
	fetch(`${host_url}/${controller}/Consulta/${e.dataset.codigo}`)
		.then( response =>{
			return response.json();
		})
		.then( res =>{
			$('#ModalCatalogo').modal('hide');
			
			if(res.status == 200){

				$('#Cod_edit').val(res.datos.Cod);
				$('#Des_edit').val(res.datos.Des);
				$('#Marca_edit').val(`${res.datos.Marca}`);
        		$('#Marca_edit').trigger('change');

			}else{

				alerta(res.respuesta);
			}
		})
		.catch( Error =>{
			console.log(Error);
		});
}