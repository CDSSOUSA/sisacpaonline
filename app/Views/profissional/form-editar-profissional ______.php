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
            <div class="col-12 p-2">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <h3 class="card-title font-weight-bold"><?=$titulo?> ::</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <?=anchor('profissional/form_cadastrar_profissional','<i class="fas fa-plus"></i> Novo
                                        profissional',["class"=>"btn btn-secondary btn-sm"]);?>

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0" style="height: 600px;">
                        <table class="table table-head-fixed text-nowrap" id="tb_profissionais">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Nome
                                        profissional</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">
                                        CNS</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">
                                        CPF</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">
                                        Modalidade</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Tipo
                                    </th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Status
                                    </th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>


    </div>
    </div>
    <small id="totalProfissionais">* campos de preenchimento obrigatório.</small>
    <small id="contadorAtivo" style="display:block">* campos de preenchimento obrigatório.</small>
    <small id="contadorInativo">* campos de preenchimento obrigatório.</small>
</section>

<div class="modal fade" id="editarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title">
                    <?php echo $titulo; ?> ::
                </h4>
                <small>* campos de preenchimento obrigatório.</small>

            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'editProfissionalForm'
                );

                echo form_open('api/profissional/edita_profissional', $atributos_formulario);
                ?>

                <input type="text" id="idProfissional" name="nIdProfissional">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nomeProfissional" name="nNomeProfissional" class="form-control"
                                    onfocus="clearMessageError('iNomeProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iNomeProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Genero: * </label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="genero">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">CNS Profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cnsProfissional" name="nCnsProfissional" class="form-control"
                                    onfocus="clearMessageError('iCnsProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iCnsProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">CPF Profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cpfProfissional" name="nCpfProfissional" class="form-control"
                                    onfocus="clearMessageError('iCpfProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iCpfProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Núm. Cons. de Classe: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="conselhoClasse" name="nConselhoClasse" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Tipo profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="tipos"></div>
                            <span class="messageErro" style="color:red" id="iTipoProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Modalidade: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="modalidades"></div>
                            <span class="messageErro" style="color:red" id="iModalidadeProfissional"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                        class="badge">C</span> ANCELAR</button>

                <?= session()->get('botaoSalvar'); ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="ativarDesativarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title" id="titleFormAtivarDesativar"></h4>
                <small> </small>

            </div>
            <div class="modal-body">
                <div id="aviso" style="display:none" class="alert bg-red alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <strong>ATENÇÃO!</strong> Após desativar o PROFISSIONAL todos os registros de: alocação, atendimento
                    e permissão serão desativados, não sendo possível recuperá-los.
                </div>

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'ativarDesativarProfissionalForm'
                );
                echo form_open('api/profissional/ativa_desativa_profissional', $atributos_formulario);
                ?>

                <input type="text" id="idProfissionalAtivaDesativa" name="nIdProfissional">
                <input type="text" id="statusAtivaDesativa" name="nAtivaDesativa">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="nomeProfissionalAtivaDesativa">
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                        class="badge">C</span> ANCELAR</button>

                <?= session()->get('botaoSalvar'); ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="alocarProfissionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title">
                    ALOCAR PROFISSIONAL ::
                </h4>
                <small>* campos de preenchimento obrigatório.</small>

            </div>
            <div class="modal-body">
                <!-- <div class="body table-responsive" id="tbAlocacaoProfissionalManha" style="border:1px red solid;"></div> -->


                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'alocarProfissionalForm'
                );

                echo form_open('api/profissional/aloca_profissional', $atributos_formulario);
                ?>

                <input type="text" id="idProfissionalAlocar" name="nIdProfissional">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="nomeProfissionalAlocar"></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Horários cadastrados: </label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="iTotalAlocacao"></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label>Dias de atendimento *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="demo-checkbox-new">
                                <a class="btn bg-green" onclick="marcardesmarcar();"> <i class="fa fa-check"></i>
                                    todos</a><br><br>
                                <div class="icheck-primary d-inline">
                                    <div id="diaSemanaDiv"></div>
                                </div>
                                <span class="messageErro" style="color:red" id="iDiasAtendimento"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label>Horário::Manhã: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="demo-checkbox-new">

                                <div id="horaInicioNew"></div>

                                <span class="messageErro" style="color:red" id="iHorarioManha"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label>Horário::Tarde: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="demo-checkbox-new">

                                <div id="horaFimNew"></div>

                                <span class="messageErro" style="color:red" id="iHorarioTarde"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">

                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="hidden" id="idProfissionalAlocar" name="nMensagem">
                            </div>
                            <span class="messageErro" style="color:red" id="iMensagem"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div style="display: flex;">
                    <div id="btnSalvar" style="flex: 2; padding: 10px; text-align: left;">
                        <a href="#" class="btn btn-warning waves-effect disabled" id="btnListarAlocacao"><span
                                class="badge">L</span>
                            ISTAR ALOCAÇÕES</a>
                    </div>
                    <div style="flex: 2; padding: 10px;">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                                class="badge">C</span> ANCELAR</button>
                        <?= session()->get('botaoSalvar'); ?>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="listarAlocacaoProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title">
                    ALOCAÇÕES DO PROFISSIONAL ::
                </h4>
                <small id="nomeProfissionalSmall">* campos de preenchimento obrigatório.</small>

            </div>
            <div class="modal-body">

                <div class="body table-responsive p-0" style="height: 500px;">
                    <table id="tb_alocacao_profissional" class="table table-head-fixed text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-weight: bold; color: black; font-size: 14px;">Dia semana</th>
                                <th style="font-weight: bold; color: black; font-size: 14px;">Hora início</th>
                                <th style="font-weight: bold; color: black; font-size: 14px;">Hora fim</th>
                                <th style="font-weight: bold; color: black; font-size: 14px;">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div style="display: flex;">
                    <div id="btnSalvar" style="flex: 2; padding: 10px; text-align: left;">
                        <a href="#" class="btn btn-warning waves-effect" id="btVoltarAlocacaoProfissional"
                            data-toggle="modal" data-target="#alocarProfissionalModal">
                            <span class="badge">
                                V
                            </span> OLTAR</a>
                        </a>
                    </div>
                    <div style="flex: 2; padding: 10px;">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                                class="badge">C</span> ANCELAR</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<div class="modal fade" id="removerAlocacaoProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">REMOVER ALOCAÇÃO </h5>
                <small class="d-block" id="nomeProfissionalAlocacaoSmall"></small>

            </div>
            <div class="modal-body">
                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'removerAlocacaoProfissionalForm'
                );

                echo form_open('', $atributos_formulario);
                ?>

                <input type="text" id="idAlocacao" name="nIdAlocacao">
                <input type="text" id="idAlocacaoProfissional" name="nIdProfissional">

                <h4>Confirmar a exclusão?</h4>
                <h5 id="dataALocacao"></h5>
            </div>

            <div class="modal-footer">
                <div style="display: flex;">
                    <div id="btnSalvar" style="flex: 2; padding: 10px; text-align: left;">
                        <a href="#" class="btn btn-link waves-effect" id="btnVoltarAlocacaoProfissional"
                            data-toggle="modal" data-target="#listarAlocacaoProfissional">
                            CANCELAR
                        </a>
                    </div>
                    <div style="flex: 2; padding: 10px;">
                        <button type="submit" class="btn btn-danger waves-effect">SIM</button>
                    </div>
                </div>
            </div>




            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="visualizarAgendaProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title">
                    AGENDA DO PROFISSIONAL ::
                </h4>
                <small id="">Fornece a lista de todos os atendimentos.</small>

            </div>
            <div class="modal-body">

                <h4>461 - NICODEMUS DE OLIVEIRA SOBRINHO</h4>
                <h4>SERVICO SOCIAL - CRESS</h4>
                <h4>CNS: ...</h4>
                <h4>Número Conselho: CRESS 3385</h4>
                <h4>Período:: 29/01/2024 a 02/02/2024</h4><a
                    href="http://localhost/sistemaAcpaNovo/form_visualizar_agenda"
                    class="btn bg-orange waves-effect"><span class="badge">V</span> OLTAR</a>&nbsp;&nbsp; <div
                    class="btn-group">
                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">print</i> AGENDA LOCAL <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgenda/461/semana" target="_blank"
                                class="waves-effect waves-block">SEMANA ATUAL</a> </li>
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgenda/461/next" target="_blank"
                                class="waves-effect waves-block"> PRÓXIMA SEMANA</a> </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">print</i> AGENDA SUS <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgendaSus/461/atual" target="_blank"
                                class="waves-effect waves-block">MÊS ATUAL</a> </li>
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgendaSus/461/next" target="_blank"
                                class="waves-effect waves-block">PRÓXIMO MÊS</a> </li>
                    </ul>
                </div>
                <hr>

                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="pt-2 px-3">
                                <h3 class="card-title">Card Title</h3>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-home-tab" data-toggle="pill"
                                    href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                    aria-selected="false">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                    aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages"
                                    aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"
                                    aria-selected="false">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade" id="custom-tabs-two-home" role="tabpanel"
                                aria-labelledby="custom-tabs-two-home-tab">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus
                                ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non
                                magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper
                                ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam
                                id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                                turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et
                                varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut
                                porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a
                                nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac
                                condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta
                                consectetur.
                            </div>
                            <div class="tab-pane fade active show" id="custom-tabs-two-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-two-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra
                                purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et
                                ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl
                                ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus,
                                elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-two-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus
                                volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum.
                                Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec
                                augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc.
                                Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus
                                efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum.
                                Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum
                                metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare
                                magna.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-two-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis
                                tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque
                                tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum
                                consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra.
                                Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut
                                nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet
                                accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>

                </div>




                <div class="header activatortext-center bg-blue-grey">
                    <h3>terça-feira - 30/01/2024 </h3>
                </div>

                <table class="table table-hover" style="width: 70%;">
                    <thead>
                        <tr>
                            <th>Qtde </th>
                            <th>Hora </th>
                            <th>CNS | Id | Nome Usuário | Data nasc | Idade | CPF
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>13:00:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>2</td>
                            <td>13:30:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>3</td>
                            <td>14:00:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>4</td>
                            <td>14:30:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>5</td>
                            <td>15:30:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>6</td>
                            <td>16:00:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>7</td>
                            <td>16:30:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>

                        <tr>
                            <td>8</td>
                            <td>17:00:00</td>
                            <td>
                                <span style="color:green; font-size:15px; font-weight: bold;">Horário
                                    vago</span>

                            </td>

                        </tr>


                    </tbody>
                </table>





            </div>

            <div class="modal-footer">
                <div style="display: flex;">
                    <div id="btnSalvar" style="flex: 2; padding: 10px; text-align: left;">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                                class="badge">C</span> ANCELAR</button>
                    </div>
                    <div style="flex: 2; padding: 10px;">
                        <button type="submit" class="btn btn-danger waves-effect">SIM</button>
                    </div>
                </div>
            </div>




            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/profissional.js"></script>
<?= $this->endSection(); ?>