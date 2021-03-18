let BienesEnTransaccion = [];
$(document).ready( ()=>{
  $.fn.dataTable.ext.errMode = 'none';
  $('#aceptar').on('click', ()=>{
		$('#formulario').valid();
		$('.selected').each( async (index,element)=>{
      let codigo = $(element.cells[0]).children('p')[0].innerHTML;

      if(BienesEnTransaccion.find( x => x === codigo) == undefined){
        BienesEnTransaccion.push(codigo);
  			$('#Transaccion_bienes').DataTable().row.add([
  				codigo,
  				element.cells[1].innerHTML,
  				element.cells[2].innerHTML,
  				element.cells[3].innerHTML,
  				`<div class="btn-group text-center">
            <input type="hidden" value="${codigo}" name=bien_cod[] id="input-bien-${codigo}">
  					<button type="button" class="btn btn-md btn-danger btn-delete-row-transaction"
  					data-codigo="${codigo}"
  					onclick="delete_row(this)">
  						<i class="fas fa-trash"></i>
  					</button>
  				</div>`
  			]).draw(false);
        $('#CatalogoBienes').DataTable().ajax.reload(null, false);
      }
  	});
	});

  $('#CatalogoBienes').on( 'draw.dt', function () {
    BienesEnTransaccion.forEach( x => {
        $(`#Cod-${x}`).parent().parent().hide();
    });
  });

  $('#formulario').on('reset', ()=>{
    $('#Transaccion_bienes tbody').children().each( (indice, element) =>{
        $('#Transaccion_bienes').DataTable().row($(element)).remove().draw();
    });

    $('#CatalogoBienes tbody').children().each( (indice, element) => {
      if(!$(element).is('visible')) $(element).show();
    });
  });
});

const delete_row = (e) => {
  let input = e.dataset.codigo;
  let element = $(e).parent().parent().parent()[0];
  $('#Transaccion_bienes').DataTable().row($(element)).remove().draw();
  $(`#Cod-${input}`).parent().parent().show();

  let i = BienesEnTransaccion.indexOf(input);
  if(i !== -1) BienesEnTransaccion.splice(i,1);
}