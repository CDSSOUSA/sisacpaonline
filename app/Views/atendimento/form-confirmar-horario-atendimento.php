<?php
echo $this->extend('layout/home');
echo $this->section('content');
$uri = current_url(true);



$idUsuario = $dadosAtendimento->idUsuario;
$nomeUsuario = $dadosAtendimento->nomeUsuario;
$nomeProfissional = $dadosAtendimento->nomeProfissional;
$modalidade = $dadosAtendimento->modalidade;
$horaInicio = $dadosAtendimento->horaInicio;
$idProfissional = $dadosAtendimento->idProfissional;
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
                            <?php echo $titulo . ' <span class="badge bg-blue-grey">'. '</span> <small>* campos de preenchimento obrigatório.</small>';?>
                        </h2>
                        
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('atendimento/confirma_presenca_usuario_horario', $atributos_formulario);
                        
                        echo form_input('nIdAtendimento', $idAtendimento);
                        echo form_input('nDiaSemana', $dia);
                        echo form_input('nDataAtendimento', $dataAtendimento);
                        echo form_input('nAcao', $acao);
                        echo form_input('nFrequencia', $frequencia);
                        //echo form_input('nDataAtendimento', $this->uri->segment(3));

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
                                <label for="">Profissional | Modalidade:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>
                                            <?php echo abrevPalavras($nomeProfissional,2).' - '.$modalidade; ?>
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
                                            <?php echo tratarDiaSemana($dia).' - '.$horaInicio; ?>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Data atendimento:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo converteParaDataBrasileira($uri->getSegment(6)); ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Horário confirmado: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nHoraAtendimento" class="form-control hora" placeholder="Digite o horário confirmado" value="<?=set_value('nHoraAtendimento', date('H:i')); ?>"/>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nHoraAtendimento'] ?? ''; ?></span>
                                </div>
                            </div>
                        </div>
                          
                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                if($uri->getSegment(8) == 'A'){
                                    echo gerarbotaoVoltar('atendimento/listarAnteriorAtendimento/'.$uri->getFragment(6).'/'.$uri->getSegment(7));

                                } else {
                                    echo gerarbotaoVoltar('atendimento/listar_atendimento');
                                }
                             
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
<?php $this->endSection();
