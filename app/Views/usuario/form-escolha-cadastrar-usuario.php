<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col"></div>
            <div class="col-sm-8 d-flex justify-content-between">
                <?= anchor('usuario/form_cadastrar_usuario', '<i class="fa fa-user"></i> USUÁRIO - SIMPLIFICADO', ['class' => 'main_bt btn-lg']); ?>
                <?= anchor('usuario/form_cadastrar_usuario_acompanhante', '<i class="fa fa-user-alt"></i> ACOMPANHANTE', ['class' => 'main_back_bt btn-lg']); ?>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>

<script>
    const subTitulo = document.querySelector('#subTitulo')
    subTitulo.textContent = 'Escolha uma opção para iniciar o cadastro de usuário.'                
</script>
<?= $this->endSection(); ?>