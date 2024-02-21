
    <!-- Required Js -->
    <script src="<?=base_url()?>assets/js/vendor-all.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/pcoded.min.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php // base_url('assets/datatables/datatables.min.js') ?>"></script>

      <script src="<?= base_url();?>assets/toastr/toastr.min.js"></script>

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