<?php
echo $this->extend('layout/home');
echo $this->section('content');

$dataAtendimento = $atendimento->dataAtendimento;
$idUsuario = $atendimento->idUsuario;
$nomeUsuario = $atendimento->nomeUsuario;
$idRegistroAtendimento = $atendimento->idRegistroAtendimento;
$nomeProfissional = $atendimento->nomeProfissional;
$numeroRegistro = $atendimento->numeroRegistro;
?>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                echo view('layout/alert/alert-sucesso');
                echo view('layout/alert/alert-erro');
                echo view('layout/alert/alert-erro-preenchimento');
                session()->remove('erro');
                session()->remove('sucesso');
                ?>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo $titulo . ' <span class="badge bg-blue-grey">' . $numeroRegistro .
                                '</span> <small>* campos de preenchimento obrigatório.</small>'; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('evolucao/evoluir_registro_atendimento', $atributos_formulario);
                        echo form_hidden('nIdRegistroAtendimento', $idRegistroAtendimento);
                        ?>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Id | Nome usuário:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo $idUsuario . ' - ' . $nomeUsuario; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Profissional:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo $nomeProfissional; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Data do atendimento:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo converteParaDataBrasileira($dataAtendimento); ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">
                                Use o texto complementar ::
                                        <br>Texto da evoluçao: *</label>
                            </div>                            

                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <?php foreach ($textoPadraoEvolucao as $key => $item) : ?>
                                            <input type="checkbox" id="<?= $key; ?>" class="checkbox-inline" name="<?= $key; ?>" value="<?= $item; ?>" <?php echo set_checkbox($key, $item); ?> />
                                            <label for="<?= $key; ?>"><?= $item; ?></label><br>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="form-line">
                                        <textarea rows="4" name="nTextoEvolucao" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nTextoEvolucao'); ?></textarea>
                                    </div>

                                    <span style="color:red"><?= session()->get('errors')['nTextoEvolucao'] ?? ''; ?></span>
                                </div>
                            </div>
                        </div>




                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('evolucao/form_escrever_evolucao_data_atendimento');
                                ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>

                            <?php
                            echo 'HISTÓRICO DE EVOLUÇÃO DOS ATENDIMENTOS <small>' . $idUsuario . ' - ' . $nomeUsuario . '</small>';
                            ?>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">EVOLUÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$evolucoes = $this->RegistroAtendimento_model->getEvolucao(md5($idUsuario), $atendimento->idOperador)->result();


                                foreach ($dadosEvolucao as $evolucao) {
                                ?>
                                    <tr>
                                        <td>

                                            <div class="card">
                                                <div class="header bg-blue-grey">
                                                    <h2>
                                                        Data do atendimento: <?php echo converteParaDataBrasileira($evolucao->dataAtendimento) . ' - ' . tratarDiaSemana($evolucao->diaSemana) . ' - ' . $evolucao->horaInicio . ' - <span class="badge">' . $evolucao->numeroRegistro . '</span> <small>Profissional: ' . $evolucao->nomeProfissional . ' - ' . $evolucao->modalidade . '</small><small>Registro da evolução em : ' . converteParaDataHoraCompletaBrasileira($evolucao->dataRegistroEvolucao) . '</small>'; ?>
                                                    </h2>
                                                </div>
                                                <div class="body">
                                                    <?php echo tratarEvolucao(base64_decode($evolucao->textoEvolucao),true); ?>
                                                </div>

                                            </div>
                                            <div> <?php echo anchor('evolucao/form_editar_evolucao/' . encrypt($evolucao->idRegistroAtendimento), '<span class="badge">E</span> ditar', array('class' => 'btn bg-teal waves-effect')); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection();
