<?php
echo $this->extend('layout/home');
echo $this->section('content');

$idUsuario = $dadosUsuario->idUsuario;
$nomeUsuario = $dadosUsuario->nomeUsuario;
$nomeMae = $dadosUsuario->nomeMae;
$nomeResponsavel = $dadosUsuario->nomeResponsavel;
$acompanhante = $dadosUsuario->acompanhante;
$ticket = $acompanhante == 'S' ? 'Acompanhante' : 'Usuário';
$parentesco = $dadosUsuario->grauParentesco;
$dataNascimento = converteParaDataBrasileira($dadosUsuario->dataNascimento);
$cpfUsuario = mascaraCpf($dadosUsuario->cpfUsuario);
$cnsUsuario = mascaraCns($dadosUsuario->cnsUsuario);
$nisUsuario = mascaraNis($dadosUsuario->nisUsuario);
$telefone = $dadosUsuario->telefone;
$ativo = $dadosUsuario->ativo;
$estaListaEspera = $dadosUsuario->listaEspera;
$anoAtivo = session()->get('anoAtivo');
$estaMatriculado = $modelMatricula->getUsuarioMatriculado($idUsuario, $anoAtivo);




$exibirAtendimento = 'hide';
$exibirAnamnese = 'hide';
$exibirImpressao = 'hide';
$exibirAlterar = 'show';
$exibirMatricula = 'hide';
$exibirEvolucao = 'hide';
$exibirListaEspera = 'hide';
$exibirImpressaoAnamnese = 'hide';
$exibirEdicao = 'hide';
$exibirAlerta = 'hide';
$tipoOperador = session()->get('tipoOperador');
$exibirTermoDesligamento = 'hide';

$temAnamnese = $modelUsuario->getAnamneseEtapa07($idUsuario);

$matriculasDesligadas = $modelMatricula->getMatriculasDesligadas($idUsuario);


$op = array('A', 'O', 'S');

if (empty($nomeResponsavel)) {
    $exibirAlerta = 'show';
}

if ($ativo == 'S' && $estaMatriculado->getResult() && in_array($tipoOperador, $op) && empty(!$nomeResponsavel)) {
    $exibirAtendimento = 'show';
    $exibirImpressao = 'show';
    $exibirEdicao = 'show';
    $exibirAlerta = 'hide';
    $exibirMatricula = 'hide';
} else if ($estaListaEspera == 'S') {
    $exibirListaEspera = 'show';
} else if ($tipoOperador == 'P') {
    $exibirMatricula = 'hide';
    $exibirAlterar = 'hide';
} else {
    $exibirMatricula = 'show';
}

//atençao operador profissional - modificar */
if ($tipoOperador == 'P' && $ativo == 'S' && $estaMatriculado->countAllResults() >= 1) {
    $exibirEvolucao = 'show';
    $exibirAnamnese = 'show';
    $exibirMatricula = 'hide';
}

if ($tipoOperador == 'S' && $ativo == 'S' && $estaMatriculado->countAllResults() >= 1) {
    $exibirEvolucao = 'show';
    $exibirAnamnese = 'show';
    $exibirMatricula = 'show';
}

if ($tipoOperador == 'P' && $ativo == 'S' && $temAnamnese->liberaImpressao == 'S') {

    $exibirImpressaoAnamnese = 'show';
    $exibirMatricula = 'hide';
}
if ($estaMatriculado->getResult() && $matriculasDesligadas->getResult()) {
    $exibirTermoDesligamento = 'show';
}

if ($estaMatriculado->getResult()) {
    $exibirMatricula = 'hide';
}


?>
<section class="content">
    <div class="container-fluid">
        <?php echo view('layout/alert/alert-sucesso');
        echo view('layout/alert/alert-erro');
        session()->remove('erro');
        session()->remove('sucesso');
        ?>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="header bg-indigo">
                        <h2>
                            <?php
                            echo $titulo;
                            ?>
                            <small>Utilize uma das opões abaixo.</small>
                        </h2>
                    </div>
                    <div class="body">

                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('pesquisar_usuario', $atributos_formulario);

                        ?>
                        <div class="alert bg-green alert-dismissible <?php echo $exibirAlerta; ?>" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>IMPORTANTE!</strong> É necessário preencher os dados dos responsáveis.
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <span style="color:red" class="<?php echo $exibirAlerta; ?>"></span>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="">
                                    <div class="form-line text-center">

                                        <?php

                                        echo img(array('src' => 'img/fotos/' . $dadosUsuario->fotoUsuario, 'height' => '80', 'widht' => '80', 'class' => 'image-area'));
                                        echo '<br>' . anchor('usuario/form_alterar_dados_foto/' . encrypt($dadosUsuario->idUsuario), 'Alterar', array('class' => 'text-center', 'title' => 'Alterar foto usuário'));

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Id | Nome completo: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= $idUsuario . ' - ' . $nomeUsuario; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome do responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        $responsavel = $acompanhante == 'S' ? '<span style="color:orange;font-weight:bold">ACOMPANHANTE</span>' : $nomeResponsavel . ' - ' . $parentesco; ?>
                                        <h4><?= $responsavel; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data de nascimento: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= $dataNascimento . ' - ' . calcAge($dadosUsuario->dataNascimento); ?></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CNS do <?= $ticket; ?>: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= $cnsUsuario; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CPF do <?= $ticket; ?>: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= $cpfUsuario; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>NIS do <?= $ticket; ?>: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= $nisUsuario; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Telefone: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?= tratarCamposVazio($telefone); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($estaMatriculado->getRow()) : ?>


                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                    <label>Data da matrícula<i class="ri-contacts-book-upload-fill"></i>: </label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <h4><?= converteParaDataHoraCompletaBrasileira($estaMatriculado->getRow()->dataMatricula); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row clearfix">
                            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-5 col-xs-offset-5">
                                <?php
                                echo gerarbotaoVoltar('usuario/form_pesquisar_usuario');
                                ?>
                            </div>

                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            OPÇÕES
                            <small>Escolha uma das opções abaixo.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Basic Example -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php echo $exibirAlterar; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-pencil"></i> ALTERAR DADOS
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('usuario/form_alterar_dados_pessoais/' . encrypt($idUsuario), 'Dados Pessoais', array('class' => '')); ?></li>
                                                    <?php if ($acompanhante != 'S') : ?>
                                                        <li><?php echo anchor('usuario/form_alterar_dados_responsaveis/' . encrypt($idUsuario), 'Dados Responsáveis', array('class' => '')); ?></li>
                                                        <li><?php echo anchor('usuario/form_alterar_dados_aspectos_sociais/' . encrypt($idUsuario), 'Dados Aspectos Sociais', array('class' => $exibirEdicao)); ?></li>
                                                        <li><?php echo anchor('usuario/form_alterar_dados_comunicacao/' . encrypt($idUsuario), 'Dados Comunicação', array('class' => $exibirEdicao)); ?></li>
                                                        <li><?php echo anchor('usuario/form_alterar_dados_comportamento/' . encrypt($idUsuario), 'Dados Comportamento', array('class' => $exibirEdicao)); ?></li>
                                                        <li><?php echo anchor('usuario/form_alterar_dados_socializacao/' . encrypt($idUsuario), 'Dados Socialização', array('class' => $exibirEdicao)); ?></li>
                                                    <?php endif; ?>

                                                    <li><?php echo anchor('usuario/form_desligar_usuario/' . encrypt($idUsuario), 'Desligar', array('class' => $exibirEdicao, 'title' => 'Desligar Usuário')); ?></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php echo $exibirTermoDesligamento; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-pencil"></i> IMPRIMIR DE DESLIGAMENTO
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php
                                                    foreach ($matriculasDesligadas->getResult() as $matriculaDesligada) { ?>
                                                        <li><?php echo anchor('imprimir_termo_desligamento/' . encrypt($idUsuario) . '/' . $matriculaDesligada->idMatricula, 'Ano Matrícula - ' . $matriculaDesligada->anoMatricula, array('class' => 'show', 'target' => '_blank')); ?></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li><?php //echo anchor('form_escrever_anamnese/' . encrypt($idUsuario), 'Escrever Anamnese', array('class' => '')); 
                                                        ?></li>


                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show <?php echo $exibirAnamnese; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-pencil"></i> ANAMNESE
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('usuario/form_escrever_anamnese/' . encrypt($idUsuario), 'Escrever Anamnese', array('class' => '')); ?></li>
                                                    <li><?php echo anchor('imprimir_anamnese/' . encrypt($idUsuario), 'Imprimir Anamnese', array('class' => 'show'. $exibirImpressaoAnamnese, 'target' => '_blank')); ?></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php echo $exibirAtendimento; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-stethoscope"></i> ATENDIMENTOS
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('atendimento/form_cadastrar_atendimento/' . encrypt($idUsuario), 'Cadastrar Atendimento', array('class' => '')); ?></li>
                                                    <?php if ($acompanhante != 'S') : ?>
                                                        <li><?php echo anchor('atendimento/listar_faltas_usuario/' . encrypt($idUsuario), 'Listar Faltas Usuário', array('class' => '')); ?></li>
                                                        <li><?php echo anchor('atendimento/listar_faltas_profissional/' . encrypt($idUsuario), 'Listar Faltas Profissional', array('class' => '')); ?></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show <?php echo $exibirEvolucao; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-stethoscope"></i> HIST. DE EVOLUÇÃO
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('evolucao/listar_historico_evolucao/' . encrypt($idUsuario), 'Historico evolução', array('class' => '')); ?></li>
                                                    <li><?php echo anchor('evolucao/rel_evolucao_periodo/' . encrypt($idUsuario), 'Imprimir evolução', array('class' => '')); ?></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php echo $exibirImpressao; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-print"></i> IMPRESSÃO
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('vizualizar_atendimentos/' . encrypt($idUsuario), 'Atendimentos', array('class' => '')); ?></li>
                                                    <?php if ($acompanhante != 'S') : ?>
                                                        <li><?php echo anchor('imprimir_ficha_socio/' . encrypt($idUsuario), 'Ficha de Sócio', array('class' => '', 'target' => '_blank')); ?></li>
                                                        <li><?php echo anchor('imprimir_ficha_matricula/' . encrypt($idUsuario), 'Ficha Matrícula', array('class' => '', 'target' => '_blank')); ?></li>
                                                        <li><?php echo anchor('imprimir_declaracao_matricula/' . encrypt($idUsuario), 'Declaração Matrícula', array('class' => '', 'target' => '_blank')); ?>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show <?php echo $exibirMatricula; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-stethoscope"></i> MATRÍCULA
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('matricula/form_matricular_usuario/' . encrypt($idUsuario), 'Matricular Usuário', array('class' => '')); ?></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show <?php echo $exibirListaEspera; ?>">
                                <div class="card">
                                    <div class="header bg-blue-grey">
                                        <h2>
                                            <i class="fa fa-list-ol"></i> LISTA DE ESPERA
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><?php echo anchor('exibir_lista_espera', 'Atender Usuário', array('class' => '')); ?></li>
                                                    <li><?php echo anchor('exibir_lista_espera', 'Remover Usuário', array('class' => '')); ?></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <!-- #END# Basic Example -->
                        <?php echo gerarbotaoVoltar('usuario/form_pesquisar_usuario'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="smallModal<?php echo $idUsuario; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-red">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Atenção!</h4>
            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => ''
                );

                echo form_open('desligar_usuario/' . $idUsuario, $atributos_formulario);
                ?>
                <h4>1 - Todos os dados do usuário serão desativados. <br>2 - Confirmar o desligamento?</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">SIM</button>
                <button type="reset" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
            </div>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>