<?php
echo $this->extend('layout/home');
echo $this->section('content');

$dados = $dadosAtendimento;
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
                echo view('layout/alert/alert-sucesso');
                echo view('layout/alert/alert-erro');
                echo view('layout/alert/alert-erro-preenchimento');
                session()->remove('erro');
                session()->remove('sucesso');
                ?>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2><?php echo ($titulo . ' <span class="badge bg-blue-grey">' . $numeroRegistro . '</span> <small>* campos de preenchimento obrigatório.</small>');
                        ?></h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('atendimento/justificar_falta_profissional', $atributos_formulario);
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
                                        <h5><?php echo ($idUsuario . ' - ' . $nomeUsuario); ?></h5>
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
                                        <h5>
                                            
                                            <?php echo $nomeProfissional.' - '.$modalidade; ?>
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
                                <label for="">Dia | Horário:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo tratarDiaSemana($diaSemana).' - '.$horaInicio; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Texto da justificddfafativa: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nTextoJustificativa" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nTextoJustificativa'); ?></textarea>
                                    </div>                                    
                                    <span style="color:red"><?= session()->get('errors')['nTextoJustificativa'] ?? ''; ?></span>
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
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('atendimento/listar_faltas_profissional/'.encrypt($idUsuario));
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
<?php echo $this->endSection();
