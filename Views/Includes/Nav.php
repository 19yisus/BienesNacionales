  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo constant('URL').'Views/'.$this->GetDatos('photo');?>"
          class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $this->GetDatos('user_name');?></span>
        </a>
        <!-- <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li class="user-header bg-primary">
            <img src="<?php //echo constant('URL'). $this->GetDatos('photo');?>" class="img-circle elevation-2" alt="User Image">
            <p>
              <small><?php //echo $_SESSION['cargo'];?> desde <?php //echo $_SESSION['fecha_cargo'];?></small>
            </p>
          </li>
          <li class="user-body bg-default">
            <p>
              <small><strong>Correo: </strong><?php //echo $_SESSION['correo'];?></small>

            </p>
            <p>
              <small><strong>Telefono: </strong><?php //echo $_SESSION['telefono'];?></small>
            </p>
          </li>
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Perfil</a>
            <a href="<?php //echo constant('URL');?>Login/Logout" class="btn btn-default btn-flat float-right">Salir</a>
          </li>
        </ul> -->
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-2">
      <!-- Brand Logo -->
      <a href="<?php echo constant('URL');?>" class="brand-link">
        <!-- <img src="views/img/b.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Bienes Nacionales</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?php echo constant('URL');?>Home" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <?php 
              if($this->IfSession()){
                if($this->GetDatos('permisos')['roles_name'] != 'Invitado'){
            ?>
            <li class="nav-item nas-treeview menu-close">
              <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-pen"></i>
                  <p>
                    Registros
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Nucleo/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nucleo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Dependencias/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dependencias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Personas/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Personas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Marcas/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marcas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Modelos/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Modelos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Especies/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Especies / Animales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Razas/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Razas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Clasificacion/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clasificacion</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Bienes/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bienes</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php }?>
          <?php if($this->GetDatos('permisos')['roles_name'] != 'Invitado'){?>
            <li class="nav-item has-treeview menu-close">
              <?php 
                // $ifTransaction1 = $this->Control('TransaccionController')->IfTransaccion('I'); 
                // $ifTransaction2 = $this->Control('TransaccionController')->IfTransaccion('D'); 
                // $ifTransaction3 = $this->Control('TransaccionController')->IfTransaccion('R');
                // $encargado_bienes = $this->Control('TransaccionController')->ConsultarEncargado(1);
                // $encargado_almacen = $this->Control('TransaccionController')->ConsultarEncargado(2);
                
                // $title_transaction = '';
                // if(!$ifTransaction1 && !$ifTransaction2 && !$ifTransaction3){
                //   $title_transaction = "En este momento no es posible realizar ninguna transaction";      
                // }else{
                //   if(!$ifTransaction1){
                //     $title_transaction = "En este momento no es posible realizar alguna incorporacion, no hay ningun bien registrado";
                //     if(!$ifTransaction2){
                //       $title_transaction = "En este momento no es posible realizar alguna reasignacion, no hay ningun bien desincorporado";
                //       if(!$ifTransaction3){
                //         $title_transaction = "En este momento no es posible realizar alguna desincorporacion, no hay ningun bienes incorporados";        
                //       }
                //     }
                //   }else{
                //     if($encargado_bienes == 'Sin-encargado'){
                //       $title_transaction = "No hay un encargado en bienes nacionales";
                //     }elseif($encargado_bienes == 'No-dependencia'){
                //       $title_transaction = "No existe bienes nacionales";
                //     }elseif($encargado_almacen == 'Sin-encargado'){
                //       $title_transaction = "No hay un encargado en almacen";
                //     }elseif($encargado_almacen == 'No-dependencia'){
                //       $title_transaction = "No existe almacen";
                //     }
                //   }
                // }
              ?>
              <a href="#" class="nav-link active" title="<?php //echo $title_transaction;?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Movimientos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php //if($this->Control('TransaccionController')->IfTransaccion('I') && $encargado_almacen != ''){ ?>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Transaccion/Incorporacion/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Incorporacion</p>
                  </a>
                </li>
                <?php
                  //}elseif($this->Control('TransaccionController')->IfTransaccion('D') && $encargado_almacen != ''){
                ?>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Transaccion/Desincorporacion/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Desincorporacion</p>
                  </a>
                </li>
                <?php
                  //}elseif($this->Control('TransaccionController')->IfTransaccion('R') && $encargado_almacen != ''){
                ?>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>Transaccion/Reasignacion/Vis_Index" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reasignacion</p>
                  </a>
  			        </li>
                <?php //}?>
              </ul>
            </li>
          <?php }?>
            <li class="nav-item">
              <a href="Reportes" class="nav-link active">
                <i class="nav-icon fas fa-file-pdf"></i>
                <p>
                  Reportes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>PDF/Vis_Reportes" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Comprobantes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo constant('URL');?>PDF/Vis_Inventario" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inventario</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php if($this->GetDatos('permisos')['roles_name'] == 'Super Admin' || $this->GetDatos('permisos')['roles_name'] == 'Admin'){?>
            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Configuracion
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <!-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php //echo constant('URL');?>configuracion/Vis_desactivados" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>usuarios</p>
                    </a>
                  </li>
                </ul> -->
            </li>
            <?php 
                } 
              }
            ?>
            <li class="nav-item">
              <a href="<?php echo constant('URL');?>Home/Vis_Ayuda" class="nav-link active">
                <i class="fas fa-info-circle"></i>
                <p class="pl-2">Ayuda ?</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL');?>Login/Logout" class="nav-link active">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Salir</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
