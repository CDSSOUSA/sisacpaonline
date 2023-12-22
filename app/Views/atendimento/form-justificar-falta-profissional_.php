<?php
$dados = $dadosAtendimento->row();
$dataAtendimento = $dados->dataAtendimento;
$idUsuario = $dados->idUsuario;
$nomeUsuario = $dados->nomeUsuario;
$idRegistroAtendimento = $dados->idRegistroAtendimento;
$nomeProfissional = $dados->nomeProfissional;
$numeroRegistro = $dados->numeroRegistro;
$modalidade = $dados->modalidade;
$diaSemana = $dados->diaSemana;
$horaInicio = $dados->horaInicio;
$idAtendimento = $dados->idAtendimento;
$idProfissional = $dados->idProfissional;
?>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                $this->load->view('modelo/alert/alert-sucesso');
                $this->load->view('modelo/alert/alert-erro');
                $this->load->view('modelo/alert/alert-erro-preenchimento');
                ?>
                <div class="card">
                    <div class="header bg-indigo">
                        <?php echo heading($titulo . ' <span class="badge bg-blue-grey">' . $numeroRegistro . '</span> <small>* campos de preenchimento obrigatório.</small>', 2);
                        ?>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('justificar_falta_profissional', $atributos_formulario);
                        echo form_hidden('nIdRegistroAtendimento', $idRegistroAtendimento);
                        echo form_hidden('nDataAtendimento', $dataAtendimento);
                        echo form_hidden('nIdUsuario', $idUsuario);
                        echo form_hidden('nIdAtendimento', $idAtendimento);
                        echo form_hidden('nIdProfissional', $idProfissional);
                        ?>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Id | Nome usuário:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo heading($idUsuario . ' - ' . $nomeUsuario, 5); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Profissional | Modalidade:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo heading($nomeProfissional.' - '.$modalidade, 5); ?>
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
                                        <?php echo heading(converteParaDataBrasileira($dataAtendimento), 5); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Dia | Horário:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo heading(tratarDiaSemana($diaSemana).' - '.$horaInicio, 5); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Texto da justificativa: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nTextoJustificativa" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nTextoJustificativa'); ?></textarea>
                                    </div>
                                    <span style="color:red"><?php echo form_error('nTextoJustificativa'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="">Repetir a justificativa para:</label>  
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">  
                                                                                            
                                                    <input type="checkbox" id="iRepeteDatas" class="checkbox-inline" name="nRepeteDatas" value="S"
                                                    <?php echo set_checkbox('nRepeteDatas', 'S', FALSE); ?> /> <label
                                                    for="iRepeteDatas"> Todas as faltas na mesma data? </label><br>                                                                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                echo $this->session->userdata('botaoSalvar');
                                echo $this->session->userdata('botaoLimpar');
                                echo gerarbotaoVoltar('listar_faltas_profissional/'.md5($idUsuario));
                                ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</section>
