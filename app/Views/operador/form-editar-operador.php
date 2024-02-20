<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-striped table-head-fixed text-nowrap" id="tb_operador">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Tipo</th>                            
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?=$this->include('operador/modal/form-modal-permitir-operador');?>
<?=$this->include('operador/modal/form-modal-editar-operador');?>
<?=$this->include('operador/modal/form-modal-desativar-operador');?>
<?php
   
?>
<script>
   /*$(document).ready(() => {
        $("#tb_operador").DataTable({
            data: <?php  //json_encode($dataOperador);?>,
            columns: [
                { data: null, render: function (data, type, row, meta) {
                // 'meta.row' contém o número da linha atual
                return meta.row + 1; // Começando do 1 em vez de 0
            }},
                {data:'nome'},
                {data:'tipoOperador'},
                {data: null, render: function (data, type, row, meta) {
                    return '<button class="btn btn-primary btn-editar" data-id="' + row.id + '">Editar</button>' +
                           '<button class="btn btn-danger btn-excluir" data-id="' + row.id + '">Excluir</button>';
                }}
            ]
        })
    })*/

    function tratarTipoOperador(tipo) {
    switch (tipo) {
        case "O":
            return "SECRETÁRIO(A)";
        case "A":
            return "ADMINISTRADOR(A)";
        case "S":
            return "SUPER ADMINISTRADOR(A)";
        case "P":
            return "PROFISSIONAL OPERADOR(A)";
    }
    return "";
}

    
</script>


<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/operador.js"></script>
<?= $this->endSection(); ?>