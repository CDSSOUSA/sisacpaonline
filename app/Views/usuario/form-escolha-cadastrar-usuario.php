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
                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php                                
                                    echo anchor('usuario/form_cadastrar_usuario', '<span class="badge">U</span> SUÁRIO - SIMPLIFICADO', ['class' => 'btn btn-success btn-lg']);
                                    echo nbs(5);
                                    echo anchor('usuario/form_cadastrar_usuario_acompanhante', '<span class="badge">A</span> COMPANHANTE', ['class' => 'btn btn-warning btn-lg']); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>