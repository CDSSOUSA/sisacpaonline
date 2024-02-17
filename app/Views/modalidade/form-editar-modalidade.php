<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-striped table-head-fixed text-nowrap" id="tb_modalidade">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>CBO</th>                            
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?=$this->include('modalidade/modal/form-modal-editar-modalidade');?>


<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/modalidade.js"></script>
<?= $this->endSection(); ?>