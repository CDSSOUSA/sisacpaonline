
    <!-- Required Js -->
    <script src="<?=base_url()?>assets/js/vendor-all.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/pcoded.min.js"></script>
    <!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url('plugins_original/jquery-datatable/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/buttons.flash.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/jquery-datatable/extensions/export/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/tables/jquery-datatable.js'); ?>"></script>

      <script src="<?= base_url();?>assets/js/toastr.min.js"></script>

      <!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo base_url('plugins_original/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap-datepicker/dist/js/bootstrap-datepicker-pt-BR.js'); ?>"></script>

      <!-- Masc-->
<script src="<?php echo base_url('plugins_original/mask/jquery.mask.min.js'); ?>"></script>

<script src="<?php echo base_url('plugins_original/mask/jquery.maskMoney.js'); ?>"></script>

      <!-- Scripts -->
<script src="<?php echo base_url('js/axios.min.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/ui/modals.js'); ?>"></script>
<script src="<?php echo base_url("js/jquery.maxlength.js"); ?>"></script>
<script src="<?php echo base_url('js/script.js'); ?>"></script>
<script src="<?php echo base_url('js/utils.js'); ?>"></script>
<?= $this->renderSection('script-js');?>



</body>

</html>