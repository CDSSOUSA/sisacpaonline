<?php
echo $this->extend('layout/home');
echo $this->section('content');

?>

<section class="content">
    <div class="container-fluid">

        <!--Input -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="msg"></div>
                <?php
                echo view('layout/alert/alert-sucesso');
                echo view('layout/alert/alert-erro');
                echo view('layout/alert/alert-erro-preenchimento');
                session()->remove('erro');
                session()->remove('sucesso');

                /*if (session()->get('confirmadoAtendimento')) {

                    echo view('layout/alert/alert-atendimento-confirmado');
                }*/
                ?>
                <div class="card">
                    <div class="header bg-indigo">

                        <?php
                        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                        echo '<h2>';
                        echo 'HORÁRIOS DOS ATENDIMENTOS' . '<small>' . (strftime('%A, %d de %B de %Y', strtotime(date('Y-m-d')))) . '</small>';
                        echo '</h2>';
                        echo '<br>';
                        ?>
                    </div>

                    <div class="body table-responsive">

                        <table id="tb_series_schedule" class="table table-hover">
                            <thead class="sticky-top">
                                <tr>
                                    <th>Id|Usuário</th>
                                    <th>Profissional</th>
                                    <th>Modalidade</th>
                                    <th>Hr. Início</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="registrarPresencaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title">Confirmar Atendimento ::</h4><br>

            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'editSeriesForm'
                );

                echo form_open('api/atendimento/confirmaPresencaUsuarioHorario', $atributos_formulario);



                //echo form_input('nIdAtendimento', $atendimento->idAtendimento);
                /*echo form_input('nDiaSemana', $dia);
                echo form_input('nDataAtendimento', $dataAtendimento);
                echo form_input('nAcao', $acao);
                echo form_input('nFrequencia', $frequencia);*/


                ?>

                <input type="hidden" id="idAtendimento" name="nIdAtendimento">
                <input type="text" id="dataAtendimento" name="nDataAtendimento">
                <input type="hidden" id="dia" name="nDiaSemana">
                <input type="hidden" id="acao" name="nAcao">
                <input type="hidden" id="frequencia" name="nFrequencia">


                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Id | Nome usuário:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h5 id="iIdUsuarioNome"></h5>
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
                                <h5 id="iNomeProfModalidade"></h5>

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
                                <h5 id="iDiaHoraInicio"></h5>
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
                                <h5 id="dataAtendimentoFake">

                                    <?php echo converteParaDataBrasileira(session()->get('dataConfirmacao')) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Horário confirmado: * </label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="iHoraAtendimento" name="nHoraAtendimento" class="form-control hora" onfocus="eraseAlert(['iLabelHorarioConfirmado']);" placeholder="Digite o horário confirmado" />
                            </div>
                            <span style="color:red" id="iLabelHorarioConfirmado"></span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span class="badge">C</span> ANCELAR</button>

                <?= session()->get('botaoSalvar'); ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php $this->endSection();
