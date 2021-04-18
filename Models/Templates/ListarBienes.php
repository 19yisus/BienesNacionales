<?php 
if($con){
    // TERCERA CONSULTA
    $con3 -> bindParam(":modelo",$con['bien_mod_cod']);
    $con3 -> execute();
    $con3 = $con3 -> fetch(PDO::FETCH_ASSOC);
    // ./EXECUCION DE LA TERCERA CONSULTA

    // CUARTA CONSULTA
    $con4 -> bindParam(":cod_bien", $cod);
    $con4 -> execute();
    $con4 = $con4 -> fetch(PDO::FETCH_ASSOC);
    // ./EXECUCION DE LA CUARTA CONSULTA

    //VALIACION DE LA CANTIDAD DE BIENES MATERIALES ASIGNADOS A UN BIEN ELECTRONICO
    if($con4['cantidad'] > 0){
        $con5 -> bindParam("link",$cod);
        $con5 -> execute();


        $extra = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos de los materiales asignados a este bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>descripcion</th>
                                    <th>precio</th>
                                    <th>categoria</th>
                                    <th>serial</th>
                                </tr>
                            </thead>
                            <tbody>';


        while($row = $con5 -> fetch(PDO::FETCH_ASSOC)){
            $extra .= '
                                <tr>
                                    <td>'.$row["bien_cod"].'</td>
                                    <td>'.$row["bien_des"].'</td>
                                    <td>'.$row["bien_precio"].'</td>
                                    <td>'.$row["cat_des"].'</td>
                                    <td>'.$row["bien_serial"].'</td>
                                </tr>
                            ';
        }

        $extra .= '			</tbody>
                        </table>
                    </div>
                </div>';

    }else{
        $extra = '';
    }
    //VALIDACIONES DE ESTADOS
    $estado = ($con['bien_estado'] == 1) ? 'Activo' : 'Innactivo';

    //VALIDACIONES DE MOVIMIENTOS DEL BIEN
    if($con2['mov_com_cod']){
        if($con2['mov_com_desincorporacion']){
            $movimientos = "Desincoporado";
        }else{
            $movimientos = "Incorporado";
        }
    }else{
        $movimientos = "No incorporado";
    }
    $encabezados2 = '';

    if($con['cat_cod'] == 'BS'){

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del Semoviente</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Especie</th>
                                    <th>Raza</th>
                                    <th>Sexo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con3["mar_des"].'</td>
                                    <td>'.$con3["mod_des"].'</td>
                                    <td>'.$con["bien_sexo"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';

    }else if($con['cat_cod'] == "EL"){
        $con6 -> bindParam("codBien",$cod);
        $con6 -> execute();
        $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Serial</th>
                                    <th>Catalogo</th>
                                    <th>Componentes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con3["mar_des"].'</td>
                                    <td>'.$con3["mod_des"].'</td>
                                    <td>'.$con6["color_des"].'</td>
                                    <td>'.$con["bien_serial"].'</td>
                                    <td>'.$con["bien_catalogo"].'</td>
                                    <td>'.$con4["cantidad"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>'.$extra;

    }else if($con['cat_cod'] == "IN"){

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Descripcion del terreno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con["bien_terreno"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';

    }else if($con['cat_cod'] == "MA"){

        $con6 -> bindParam("codBien",$cod);
        $con6 -> execute();
        $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Serial</th>
                                    <th>Catalogo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con3["mar_des"].'</td>
                                    <td>'.$con3["mod_des"].'</td>
                                    <td>'.$con6["color_des"].'</td>
                                    <td>'.$con["bien_serial"].'</td>
                                    <td>'.$con["bien_catalogo"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';
    }else if($con['cat_cod'] == "OF"){

        $con6 -> bindParam("codBien",$cod);
        $con6 -> execute();
        $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Catalogo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con3["mar_des"].'</td>
                                    <td>'.$con3["mod_des"].'</td>
                                    <td>'.$con6["color_des"].'</td>
                                    <td>'.$con["bien_catalogo"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';
    }else if($con['cat_cod'] == "TP"){

        $encabezados2 = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos del bien</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Anio</th>
                                    <th>Componentes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con["bien_placa"].'</td>
                                    <td>'.$con3["mar_des"].'</td>
                                    <td>'.$con3["mod_des"].'</td>
                                    <td>'.$con["bien_anio"].'</td>
                                    <td>'.$con4["cantidad"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>'.$extra;
    }
    $card = '
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Catalogo de bienes</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th>Movimientos</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$con["bien_cod"].'</td>
                                    <td>'.$con["bien_des"].'</td>
                                    <td>'.$con["bien_fecha_ingreso"].'</td>
                                    <td>'.$con["bien_precio"].'</td>
                                    <td>'.$con["cat_des"].'</td>
                                    <td class="text-'.(($movimientos == "No incorporado" ) ? "danger" : "success").'" >'.$movimientos.'</td>
                                    <td class="text-'.(($estado == "Activo") ? "success" : "danger").'" >'.$estado.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';

    $card .= $encabezados2;
}else{

    $card = '
    <div class="card">
        <div class="card-body table-responsive p-2">
            <h4 class="text-center text-danger">Sin Clasificaciones Registradas</h4>
        </div>
    </div>';
}