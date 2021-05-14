const controller = 'BienesController';
$("#formulario").on("reset", ()=> FormDinamic("") );

const CodificacionBien = (valor) =>{

  fetch(`${host_url}/${controller}/Codificador/${valor}`)
    .then( response =>{ return response.text(); })
    .then( res =>{
      $('#Cod').attr('disabled',false);
      $('#Cod').val(res);
			$('#Cantbien').attr('disabled',false);			
    })
    .catch( Error =>{ console.log(Error); })
}

const FullSelect1 = async (valor) =>{
	
	var result = await fetch(`${host_url}/${controller}/Select_Marcas/${valor}`)
	.then( response =>{ return response.text();})
	.then( text =>{ return text; })
	.catch( Error =>{ console.log(Error); });
		
	return result;
}

const FullSelect2 = async (valor2) =>{

	let res = await fetch(`${host_url}/${controller}/Select_Modelo/${valor2}`)
		.then( response =>{ return response.text(); })
		.then( res => { return res; })
		.catch( Error => { console.log(Error); return false; });

	return res;
}

const FormDinamic = (cod) => {
	let list = ['BS','EL','IN','MA','OF','TP'];
	list.forEach( bien => {
		if(cod != bien ){
			$(`.${bien}`).hide('slow');
		}
	});
	if(cod != '') $(`.${cod}`).show('slow'); else rebootForm();
}

const SetValue = (id, val) => {
	$(`#${id}`).attr('disabled',false);
	$(`#${id}`).val(val);
}

const Consulta = async (e)=>{

	let resultado = await fetch(`${host_url}/${controller}/Consulta/${e.dataset.codigo}`)
		.then( response=>{
			return response.json()
		})
		.then( res =>{
			$('#ModalCatalogo').modal('hide');
			
			rebootForm();
			if(res.status == 200){
				const data = res.datos;
				
				SetValue('Cod_edit',data.Cod);
				SetValue('Desbien_edit',data.Des);
				SetValue('Valbien_edit',data.Pre);
				Selected('divisa',data.divisa);
				
				switch(data.Cate){
					case 'IN':
						SetValue('Terreno_edit', data.Terr);
					break;

					default:
						$('#Terreno_edit').attr('disabled', true); 
						FullSelect1(data.Cate).then( (res) =>{
							if(data.Cate == 'BS'){
								$('#Esp_edit').attr('disabled', false); 
								$('#Esp_edit').html(res);
								
								return 'Esp';
							}else $('#Marca_edit').attr('disabled',false); $('#Marca_edit').html(res); return 'Marca';
						}).then( (res) => {
							Selected(res,data.Mar);
						});

						FullSelect2(data.Mar).then( (res) =>{
							if(data.Cate == 'BS'){
								$('#Raza_edit').attr('disabled', false); 
								$('#Raza_edit').html(res);
								
								return 'Raza';
							}else $('#Modelo_edit').attr('disabled',false); $('#Modelo_edit').html(res); return 'Modelo';
						}).then( (res)=>{
							Selected(res,data.Mod);

							return res;
						}).then( (tipo) =>{
							
							if(tipo == 'Raza'){
								SetValue('Peso_edit',data.Peso);
								$('#S1_edit').attr('disabled', false);
								$('#S2_edit').attr('disabled', false);

								$(`#S1_edit[value='${data.Sexo}'], #S2_edit[value='${data.Sexo}']`).prop('checked', true);
							}else{
								$('#Color_edit').attr('disabled', false);
								
								Selected('Color',data.Color);
																
								if(data.Cate != 'TP'){
									SetValue('Catalogo_edit',data.Cata);
									SetValue('Serial_edit',data.Serial);
									SetValue('Depre_edit', data.Depre);
								}else{
									SetValue('Placa_edit',data.Placa);
									SetValue('Anio_edit',data.Anio);
																		
								}
							}
						});

					break;
				}
				return res.datos.Cate;
			}
		})
		.catch( Error =>{
			console.log(Error);
		})

		FormDinamic(resultado);
}

const Selected = (id,valor)=>{
	
	for(var i = 0; i < $(`#${id}_edit`)[0].options.length; i++){
		if($(`#${id}_edit`)[0].options[i].value == valor){
			$(`#${id}_edit`)[0].selectedIndex = i;
			break;
		}
	}
}

const rebootForm = () => {
	
	$('#formulario input, #formulario select, #FormEdit input, #FormEdit select').each( (index,element) => {	
		if(element.type == 'select-one' && element.name != 'Clbien' && element.name != 'Color' && element.name != 'divisa') $(element).html('');
		if(element.type == 'radio') $(element).attr('checked', false);
		if(element.type == 'text' || element.type == 'date' || element.type == 'number') $(element).val('');
		if(element.name != 'Clbien') $(element).attr('disabled',true);
	});
}
