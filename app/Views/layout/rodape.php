<!-- Jquery Core Js -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>


<!-- Bootstrap Core Js -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/js/adminlte.min.js?v=3.2.0'); ?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url('plugins_original/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo base_url('plugins_original/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap-datepicker/dist/js/bootstrap-datepicker-pt-BR.js'); ?>"></script>

<!-- Masc-->
<script src="<?php echo base_url('plugins_original/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins_original/mask/jquery.maskMoney.js'); ?>"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Scripts -->
<script src="<?php echo base_url('js/axios.min.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/ui/modals.js'); ?>"></script>
<script src="<?php echo base_url("js/jquery.maxlength.js"); ?>"></script>
<script src="<?php echo base_url('js/script.js'); ?>"></script>
<script src="<?php echo base_url('js/utils.js'); ?>"></script>
<?= $this->renderSection('script-js');?>
<script type="text/javascript">

    $(document).ready(function () {
        var radioFrequentaEscola = $("input[name='nFrequentaEscola']:checked").val();
        if (radioFrequentaEscola === "S") {
            $("#iNomeEscola").attr("disabled", false);
        } else {
            $("#iNomeEscola").attr("disabled", true);
        }
    });

   

</script>
<script>
     function myFunction() {
        var x = document.getElementById("password");
        var y = document.getElementById("password2");
        
        if (x.type === "password" && y.type ==="password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
        x.focus();
        $('#iv').toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open');
    }
</script>
<script>
  // JavaScript para adicionar classe .full-height em telas menores
  window.addEventListener('resize', function() {
    const scrollable = document.querySelector('.scrollable');
    if (window.innerWidth <= 768) {
      scrollable.classList.add('full-height');
    } else {
      scrollable.classList.remove('full-height');
    }
  });
</script>


</body>
</html>



