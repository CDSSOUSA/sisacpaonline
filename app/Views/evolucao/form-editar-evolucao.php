<?php
echo $this->extend('layout/home');
echo $this->section('content');

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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo $titulo; ?>
                            <small><span class="badge">  <?php echo $dadosEvolucao->numeroRegistro; ?></span></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('evolucao/editar_evolucao', $atributos_formulario);
                        echo form_hidden('nIdRegistroAtendimento', $dadosEvolucao->idRegistroAtendimento);
                        echo form_hidden('nIdUsuario', $dadosEvolucao->idUsuario);
                        ?>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <?php
                                echo gerarbotaoVoltar('evolucao/listar_historico_evolucao/' . encrypt($dadosEvolucao->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Id | Nome completo: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                    <?php echo '<h4>'.$dadosEvolucao->idUsuario . ' - ' . $dadosEvolucao->nomeUsuario. '</h4>';?>
                                    </div>
                                </div>
                                <span style="color:red"><?= session()->get('errors')['nNomeUsuario']??'';?></span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data atendimento | Dia semana | Hora: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                    <?php echo '<h4>'.converteParaDataBrasileira($dadosEvolucao->dataAtendimento) . ' - ' . tratarDiaSemana($dadosEvolucao->diaSemana). ' - '.$dadosEvolucao->horaInicio. '</h4>';?>
                                    </div>
                                </div>
                                <span style="color:red"><?= session()->get('errors')['nNomeUsuario']??'';?></span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Profissional | Modalidade: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                    <?php echo '<h4>'.$dadosEvolucao->nomeProfissional . ' - ' . $dadosEvolucao->modalidade. '</h4>';?>
                                    </div>
                                </div>
                                <span style="color:red"><?= session()->get('errors')['nNomeUsuario']??'';?></span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Registrado da evolução: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                    <?php echo '<h4>'.converteParaDataHoraCompletaBrasileira($dadosEvolucao->dataRegistroEvolucao). '</h4>';?>
                                    </div>
                                </div>
                                <span style="color:red"><?= session()->get('errors')['nNomeUsuario']??'';?></span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Texto evolução: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                    <textarea rows="4" name="nTextoEvolucao" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nTextoEvolucao', tratarEvolucao(base64_decode($dadosEvolucao->textoEvolucao))); ?></textarea>
                                   
                                    </div>
                                </div>
                                <span style="color:red"><?= session()->get('errors')['nTextoEvolucao']??'';?></span>
                            </div>
                        </div>
                       
                      


                        <div class="row clearfix">
                            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-5 col-xs-offset-6">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('evolucao/listar_historico_evolucao/' . encrypt($dadosEvolucao->idUsuario));
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
