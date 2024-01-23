<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>

<section class="content">
    <div class="container-fluid">
        <?php
            echo view('layout/alert/alert-erro');
            echo view('layout/alert/alert-erro-preenchimento');
            session()->remove('erro');
            session()->remove('sucesso');
        ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo 'LISTA DE PROFISSIONAIS ATIVOS'; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tb_profissionais">
                                <thead>
                                    <tr>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Nome
                                            profissional</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;"
                                            class="text-center">CNS</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;"
                                            class="text-center">CPF</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">
                                            Modalidade</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Tipo
                                        </th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Ações
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
  <script src="<?=base_url()?>js/profissional.js"></script>
<?= $this->endSection(); ?>