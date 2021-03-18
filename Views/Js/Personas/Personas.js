const controller = 'PersonasController';

const Consulta = (e)=>{
	fetch(`${host_url}/${controller}/Consulta/${e.dataset.codigo}`)
		.then( response =>{
			return response.json();
		})
		.then( res =>{
			$('#ModalCatalogo').modal('hide');
			
			if(res.status == 200){				
				$('#Cod_edit').val(res.datos.Cod);
				$('#Nom_edit').val(res.datos.Name);
				$('#Ape_edit').val(res.datos.LastName);
				$('#Tel_edit').val(res.datos.Tel);
				$('#Email_edit').val(res.datos.Email);
				$('#Fecha_edit').val(res.datos.Fecha);
				$('#Dir_edit').val(res.datos.Dir);

				$('#Cargo_edit').val(`${res.datos.CodCargo}`);
        		$('#Cargo_edit').trigger('change');

        		$('#Dep_edit').val(`${res.datos.CodDep}`);
        		$('#Dep_edit').trigger('change');

			}else{

				alerta(res.respuesta);
			}
		})
		.catch( Error =>{
			console.log(Error);
		});
}
