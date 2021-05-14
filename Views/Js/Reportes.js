$(document).ready( ()=>{
    const controller = 'TransaccionController';
    $.validator.addMethod(
        "valida_fecha",
        (value, element) => {
            if (value >= element.min && value <= element.max) {
                return true;
            }
            return false;
        },
        "La fecha ingresada es invalida"
    );

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

    $('#inventario').validate({
        rules: {
            mov: {
                required: true,
            },
            first_date: {
                required: true,
                valida_fecha: true,
            }, 
            second_date: {
                required: true,
                valida_fecha: true,
            }
        },
        messages: {
            mov: {
                required: "Seleccione una opcion",
            },
            first_date: {
                required: "Ingrese la fecha inicial",
            },
            second_date: {
                required: "Ingrese la fecha final",
            }
        }
    });

    $("#enviar").click( ()=>{
        if($("#inventario").valid()){
            document.formulario.submit();
        }
    })

    $('#Catalogo_comprobantes').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        ajax: {
            url: `${host_url}/TransaccionController/CatalogoComprobantes/A`,
            dataSrc: "data",
        },
        columns: [
            { data: "com_cod" },
            { data: "com_tipo", render: function(data) {
                return data == "I" ? "Incorporacion" : ( data == "D" ? "Desincorporacion" : "Reasignacion");
            }},
            { data: "com_origen" },
            { data: "dep_des" },
            { data: "com_fecha_comprobante" },
            { data: "total_bienes" },
            {
                defaultContent: "",
                render: function (data, type, row, meta) {
                    
                    btn = `<div class="btn-group" >
                    <button class="btn btn-sm btn-default" title="Consultar" onclick="bConsul(this);" data-control="${controller}" 
                            data-codigo="${row.com_cod}" data-toggle="modal" data-target="#ModalConsultar" 
                        data-dismiss="modal"><i class="fas fa-list"></i>
                    </button>
                    <a href="../PDF/Vis_Comprobante/${row.com_cod}" target="_blank" class="btn btn-sm btn-danger" title="Ver comprobante">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                    </div>`;

                    return btn;
                }
                
            },
        ],
        language: {
            url: `${host_url}/Views/Js/DataTables.config.json`,
        },
    });

    // $(document.formulario).on('submit', (e)=>{
    //     e.preventDefault();
        
    //     let data = new FormData(e.target);

    //     fetch(`${host_url}/PDFController/Inventario`, {
    //         body: data,
    //         method: 'POST'
    //     }).then( response => response.text() ).then( res => {
            
    //         // let win = window.open(`${host_url}/Views/Contents/pdf/Vis_InventarioBienes.php`);
    //         // // win.document.body.innerHTML = "<h1>hola mundo</h1>";
    //         // win.document.write("<h1>hola mundo</h1>")
    //         let docDefinition = {
    //             content: res
    //         };

    //         pdfMake.createPdf(docDefinition).open();
    //     }).catch(Error => console.error(Error));
    // });
});