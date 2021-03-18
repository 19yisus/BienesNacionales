<!-- jQuery -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo constant('URL');?>Views/Assets/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/toastr/toastr.min.js"></script>
<!-- JQUERY VALIDACION AND ADITIONAL METHODS -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/jquery-validation/additional-methods.js"></script>
<!-- DataTables -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-select/js/dataTables.select.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/jszip/jszip.min.js"></script>

<!-- ChartJS -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/inputmask/inputmask.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/inputmask/jquery.inputmask.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/select2/js/select2.min.js"></script>

<?php if($nameController != ''){ ?>
  <script src="<?php echo constant('URL');?>Views/Js/<?php echo $nameController.'/'.$nameController;?>.js"></script>
  <script src="<?php echo constant('URL');?>Views/Js/JqueryValidations/<?php echo $nameController;?>.js"></script>
<?php    }?>
