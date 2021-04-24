<?php
    if(!$con){
?>
<div class="card">
    <div class="card-body table-responsive p-2">
        <h4 class="text-center text-danger">Sin Clasificaciones Registradas</h4>
    </div>
</div>
<?php
    }else{
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
?>
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
                    <td><?php echo $con["bien_cod"]; ?></td>
                    <td><?php echo $con["bien_des"]; ?></td>
                    <td><?php echo $con["bien_fecha_ingreso"]; ?></td>
                    <td><?php echo $con["bien_precio"]; ?></td>
                    <td><?php echo $con["cat_des"]; ?></td>
                    <td class="text-<?php echo (($movimientos == "No incorporado" ) ? "danger" : "success"); ?>" ><?php echo $movimientos; ?></td>
                    <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php   
        if($con['cat_cod'] == 'BS'){
        ?>
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
                                    <td><?php echo $con3["mar_des"]; ?></td>
                                    <td><?php echo $con3["mod_des"]; ?></td>
                                    <td><?php echo $con["bien_sexo"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    <?php

        }else if($con['cat_cod'] == "EL"){
            $con6 -> bindParam("codBien",$cod);
            $con6 -> execute();
            $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);

        ?>
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
                                    <td><?php echo $con3["mar_des"]; ?></td>
                                    <td><?php echo $con3["mod_des"]; ?></td>
                                    <td><?php echo $con6["color_des"]; ?></td>
                                    <td><?php echo $con["bien_serial"]; ?></td>
                                    <td><?php echo $con["bien_catalogo"]; ?></td>
                                    <td><?php echo $con4["cantidad"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php                
            //VALIACION DE LA CANTIDAD DE BIENES MATERIALES ASIGNADOS A UN BIEN ELECTRONICO
            if($con4['cantidad'] > 0){
                $con5 -> bindParam("link",$cod);
                $con5 -> execute();
            ?>
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
                            <tbody>
                            <?php
                                while($row = $con5 -> fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?php echo $row["bien_cod"]; ?></td>
                                    <td><?php echo $row["bien_des"]; ?></td>
                                    <td><?php echo $row["bien_precio"]; ?></td>
                                    <td><?php echo $row["cat_des"]; ?></td>
                                    <td><?php echo $row["bien_serial"]; ?></td>
                                </tr>
                            <?php }

                            ?>
                    		</tbody>
                        </table>
                    </div>
                </div>

                <?php

            }   

        }else if($con['cat_cod'] == "IN"){

        ?>
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
                                    <td><?php echo $con["bien_terreno"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php

        }else if($con['cat_cod'] == "MA"){

            $con6 -> bindParam("codBien",$cod);
            $con6 -> execute();
            $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);
        ?>
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
                                    <td><?php echo $con3["mar_des"]; ?></td>
                                    <td><?php echo $con3["mod_des"]; ?></td>
                                    <td><?php echo $con6["color_des"]; ?></td>
                                    <td><?php echo $con["bien_serial"]; ?></td>
                                    <td><?php echo $con["bien_catalogo"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php
        }else if($con['cat_cod'] == "OF"){

            $con6 -> bindParam("codBien",$cod);
            $con6 -> execute();
            $con6 = $con6 -> fetch(PDO::FETCH_ASSOC);

        ?>
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
                                    <td><?php echo $con3["mar_des"]; ?></td>
                                    <td><?php echo $con3["mod_des"]; ?></td>
                                    <td><?php echo $con6["color_des"]; ?></td>
                                    <td><?php echo $con["bien_catalogo"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php
        }else if($con['cat_cod'] == "TP"){
        ?>
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
                                    <td><?php echo $con["bien_placa"]; ?></td>
                                    <td><?php echo $con3["mar_des"]; ?></td>
                                    <td><?php echo $con3["mod_des"]; ?></td>
                                    <td><?php echo $con["bien_anio"]; ?></td>
                                    <td><?php echo $con4["cantidad"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php
    }
        if($con2['mov_com_cod']){
            $movimientos_res = $this->Query($movimiento_sql)->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($movimientos_res);


            $dep_sql = "SELECT CONCAT(dependencia.dep_des,' - ',nucleo.nuc_des) AS ubicacion FROM dependencia
					INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod WHERE dependencia.dep_cod = '$dep' ";
            
?>
            <!-- <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detalles del bien</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Dependencia usuaria</th>
                                <th>Dependencia anterior</th>
                                <th>ultimo movimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->
<?php
        }



    }
?>