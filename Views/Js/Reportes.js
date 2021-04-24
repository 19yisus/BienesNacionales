$(document).ready( ()=>{
    const controller = 'TransaccionController';

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
});