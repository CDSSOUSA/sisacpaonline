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
                            <?= $titulo; ?>
                            <small>* Escolha uma opção para iniciar o cadastro de usuário.</small>
                        </h2>
                    </div>
                    <div class="body">                       
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');
                        echo form_open($metodo, $atributos_formulario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Nome do profissional: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="nIdProfissional">
                                            <option value="">selecione ...</option>
                                            <?php
                                            foreach ($profissionais AS $profissional) {
                                                echo ' <option value="' . md5($profissional->idProfissional).'">' . $profissional->idProfissional . ' - ' . $profissional->nomeProfissional . ' - '.$profissional->modalidade. '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>                                   
                                    <span style="color:red"><?= session()->get('errors')['nIdProfissional']??'';?></span> 
                                </div>


                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php echo session()->get('botaoPesquisar'); ?>
                            </div>
                        </div>
                      <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>