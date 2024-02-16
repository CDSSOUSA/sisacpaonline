<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div>
    <small id="totalProfissionais">* campos de preenchimento obrigatório.</small>
    <small id="contadorAtivo" style="display:block">* campos de preenchimento obrigatório.</small>
    <small id="contadorInativo">* campos de preenchimento obrigatório.</small>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-striped table-head-fixed text-nowrap" id="tb_profissionais">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome
                                profissional</th>
                            <th class="text-center">
                                CNS</th>
                            <th class="text-center">
                                CPF</th>
                            <th>
                                Modalidade</th>
                            <th>Tipo
                            </th>
                            <th>Status</th>
                            <th class="text-center">Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?=$this->include('profissional/modal/form-editar-profissional');?>
<?=$this->include('profissional/modal/form-ativar-desativar-profissional');?>
<?=$this->include('profissional/modal/form-alocar-profissional');?>
<?=$this->include('profissional/modal/listar-alocacao-profissional');?>
<?=$this->include('profissional/modal/form-remover-alocacao-profissional');?>
<?=$this->include('profissional/modal/visualizar-agenda-profissional');?>

<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/profissional.js"></script>
<?= $this->endSection(); ?>