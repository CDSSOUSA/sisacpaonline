<?php

use App\Models\AtendimentoModel;

echo $this->extend('layout/home');
echo $this->section('content');
//dd($alocacoesProfissional, $dadosProfissional);
$idProfissional = $dadosProfissional->idProfissional;
$nomeProfissional = $dadosProfissional->nomeProfissional;
$modalidade = session()->get('triagem') == 'TRIAGEM' ? 'TRIAGEM' : $dadosProfissional->modalidade;

//$dadosUsuario = $this->Usuario_model->getById($idUsuario)->row();
$modalidadeFrequencia = array('SERVICO SOCIAL', 'MEDICO NEUROLOGISTA', 'MEDICO');

$nomeUsuario = $dadosUsuario->nomeUsuario;
$op = session()->get('opcaoAtendimento');


?>

<section class="content">
    <div class="container-fluid">
        <?php

        echo view('layout/alert/alert-sucesso');
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
                            <?php echo $titulo; ?>
                            <small>* campos de preenchimento obrigatórios.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('atendimento/cadastrar_atendimento02/' . ($dadosUsuario->idUsuario), $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        echo form_hidden('nIdProfissional', $idProfissional);
                        echo form_hidden('nNomeProfissional', $nomeProfissional);
                        echo form_hidden('nNomeUsuario', $nomeUsuario);
                        echo form_hidden('modalidade', $modalidade);
                        //echo form_input('modalidade', 1);
                        $acompanhante = $dadosUsuario->acompanhante;
                        ?>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Id | Nome completo: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4>

                                            <?php echo $dadosUsuario->idUsuario . ' - ' . $nomeUsuario; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label><?php echo anchor('atendimento/form_cadastrar_atendimento/' . encrypt($dadosUsuario->idUsuario), '...', array('class' => 'btn bg-grey', 'title' => 'Mudar profissional')); ?> Nome do profissional / Modalidade * </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?php echo $nomeProfissional; ?> - <?php echo $modalidade; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Tipo de atendimento: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h4><?php echo tratarTipoAtendimento($op); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Frequência do atendimento: *</label>
                            </div>

                            <?php
                            if ($modalidade == 'TRIAGEM') { ?>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <h4>
                                                <?php echo 'ÚNICO - ' . session()->get('triagem');
                                                echo form_hidden('nFrequencia', 'U');
                                                ?></h4>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($acompanhante == 'S') { ?>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <h4><?php echo 'ÚNICO';
                                                echo form_hidden('nFrequencia', 'U');
                                                ?></h4>

                                        </div>
                                    </div>
                                </div>

                            <?php } else 
                            if (!in_array($modalidade, $modalidadeFrequencia)) { ?>

                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <h4><?php echo 'CONTÍNUO';
                                                echo form_hidden('nFrequencia', 'C');
                                                ?>
                                            </h4>

                                        </div>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nFrequencia" value="U" <?php echo set_radio('nFrequencia', 'U', FALSE); ?> type="radio" class="with-gap" id="iFrequenciaU" />
                                            <label for="iFrequenciaU">ÚNICO</label>
                                            <input name="nFrequencia" value="C" <?php echo set_radio('nFrequencia', 'C', FALSE); ?> type="radio" id="iFrequenciaC" class="with-gap" />
                                            <label for="iFrequenciaC">CONTÍUNO</label>
                                        </div>

                                        <span style="color:red"><?= session()->get('errors')['nFrequencia'] ?? ''; ?></span>
                                    </div>
                                </div>

                            <?php } ?>


                        </div>



                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Dia | Horário </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="nHorario">
                                            <option value="">selecione ...</option>
                                            <?php
                                            //dd($alocacoesProfissional);

                                            foreach ($alocacoesProfissional as $alocacao) {
                                                //dd($alocacoesProfissional);
                                                $modelAtendimento = new AtendimentoModel;
                                                $a = $modelAtendimento->getAlocacaoAtendimento($alocacao->idAlocacao);
                                                //dd($a);


                                                if ($op == 'I') {
                                                    if (!$a) {
                                                        echo ' <option value="' . $alocacao->idAlocacao . '">' . tratarDiaSemana($alocacao->diaSemana) . ' - ' . $alocacao->horaInicio . '</option>';
                                                    }
                                                } else {
                                                    echo ' <option value="' . $alocacao->idAlocacao . '">' . tratarDiaSemana($alocacao->diaSemana) . ' - ' . $alocacao->horaInicio . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <span style="color:red"><?= session()->get('errors')['nHorario'] ?? ''; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('atendimento/form_cadastrar_atendimento/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <?php
            $atendimentosUsuario = $modelAtendimento->getAtendimentos($dadosUsuario->idUsuario);
            //if($atendimentosUsuario->num_rows()>=1){ 
            ?>

            <?php // }  
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <?php
                        echo '<h2>HORÁRIOS DOS ATENDIMENTOS</h2>';
                        echo '<small>' . $dadosUsuario->idUsuario . ' - ' . $nomeUsuario . '</small>';
                        ?>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="iTabelaHorario">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Dia Sem.</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Data</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Hr. Início</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Hr. Fim</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Profissional</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Modalidade</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($atendimentosUsuario as $atendimento) {
                                ?>
                                    <tr>
                                        <td> <?php echo $atendimento->diaSemana . ' - ' . tratarDiaSemana($atendimento->diaSemana); ?></td>
                                        <td> <?php echo converteParaDataBrasileira($atendimento->dataPrevisaoAtendimento); ?></td>
                                        <td> <?php echo $atendimento->horaInicio; ?></td>
                                        <td> <?php echo $atendimento->horaFim; ?></td>
                                        <td> <?php echo $atendimento->nomeProfissional; ?></td>
                                        <td> <?php echo $atendimento->modalidade; ?></td>
                                        <td class="text-center"> 
                                            <button class="btn bg-red waves-effect" onclick=delTeacher(<?= $atendimento->idAtendimento; ?>) type="button" class="btn btn-primary" data-toggle="modal" data-target="#desativarAtendimento">
                                                <span class="badge">R</span> emover </button>

                                        </td>
                                    </tr>

                    </div>

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
<div class="modal fade" id="desativarAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-red modal-sm">
            <div class="modal-header">
                <h5 class="modal-title">ATENÇÃO ::</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => ''
                );

                echo form_open('atendimento/desativar_atendimento', $atributos_formulario);

                ?>
                <input type="hidden" id="idDeleteTeacher" name="nIdAtendimento" style="color: red">
                <input type="hidden" id="idDeleteTeacher" name="nEtapa" value="2">
                <h4>Confirmar
                    a exclusão?</h4>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-link waves-effect">Salvar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>