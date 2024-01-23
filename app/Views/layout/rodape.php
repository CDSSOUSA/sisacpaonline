
<!-- Jquery Core Js -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.js'); ?>"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url('plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php //echo base_url('plugins/jquery-slimscroll/jquery.slimscroll.js'); ?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url('plugins/node-waves/waves.js'); ?>"></script>

<!-- Autosize Plugin Js -->
<script src="<?php echo base_url('plugins/autosize/autosize.js'); ?>"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo base_url('plugins/momentjs/moment.js'); ?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>

<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo base_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap-datepicker/dist/js/bootstrap-datepicker-pt-BR.js'); ?>"></script>

<!-- Custom Js -->
<script src="<?php echo base_url('js/admin.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/forms/basic-form-elements.js'); ?>"></script>

<!-- Demo Js -->
<script src="<?php //echo base_url('js/demo.js'); ?>"></script>

<!-- Masc-->
<script src="<?php echo base_url('plugins/mask/jquery.mask.min.js'); ?>"></script>

<script src="<?php echo base_url('plugins/mask/jquery.maskMoney.js'); ?>"></script>



<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url('plugins/jquery-datatable/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/buttons.flash.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-datatable/extensions/export/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/tables/jquery-datatable.js'); ?>"></script>

<!-- Scripts -->
<script src="<?php echo base_url('js/axios.min.js'); ?>"></script>
<script src="<?php echo base_url('js/pages/ui/modals.js'); ?>"></script>
<script src="<?php echo base_url("js/jquery.maxlength.js"); ?>"></script>
<script src="<?php echo base_url('js/script.js'); ?>"></script>
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
