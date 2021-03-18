const controller = 'TransaccionController';

const ConsultaEncargado = (idDep) =>{
	fetch(`${host_url}/${controller}/ConsultarEncargado/${idDep}`)
		.then( response =>{ return response.json(); })
		.then( res =>{
			$('#Encargado').val(res);
		}).catch( Error =>{
			console.log(Error)
		});
}
