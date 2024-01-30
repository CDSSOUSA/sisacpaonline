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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo 'LISTA DE PROFISSIONAIS ATIVOS'; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tb_profissionais">
                                <thead>
                                    <tr>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Nome
                                            profissional</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;"
                                            class="text-center">CNS</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;"
                                            class="text-center">CPF</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">
                                            Modalidade</th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Tipo
                                        </th>
                                        <th style="font-weight: bold; color: black; font-size: 18px;">Ações
                                        </th>
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
    </div>
</section>
<div class="modal fade" id="editarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title"> <?php echo $titulo; ?> ::</h4>                
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



                //echo form_input('nIdAtendimento', $atendimento->idAtendimento);
                /*echo form_input('nDiaSemana', $dia);
                echo form_input('nDataAtendimento', $dataAtendimento);
                echo form_input('nAcao', $acao);
                echo form_input('nFrequencia', $frequencia);*/


                ?>

                <input type="text" id="idProfissional" name="nIdProfissional">  
                
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                            <input 
                                type="text" 
                                id="nomeProfissional" 
                                name="nNomeProfissional" 
                                class="form-control"
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
                                <input 
                                    type="text" 
                                    id="cnsProfissional" 
                                    name="nCnsProfissional" 
                                    class="form-control"
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
                                <input 
                                    type="text" 
                                    id="cpfProfissional" 
                                    name="nCpfProfissional" 
                                    class="form-control"
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
                                <input 
                                    type="text" 
                                    id="conselhoClasse" 
                                    name="nConselhoClasse" 
                                    class="form-control">                                
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
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span class="badge">C</span> ANCELAR</button>

                <?= session()->get('botaoSalvar'); ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
  <script src="<?=base_url()?>js/profissional.js"></script>
<?= $this->endSection(); ?>