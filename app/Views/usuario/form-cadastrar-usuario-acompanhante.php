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
                            <?= $titulo; ?>
                            <small>* Escolha uma opção para iniciar o cadastro de usuário.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');
                        echo form_open('usuario/cadastrar_usuario_acompanhante', $atributos_formulario);
                        ?>
                       
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Nome: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNomeUsuario" value="<?php echo set_value('nNomeUsuario') ?>" class="form-control" autofocus placeholder="Nome">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeUsuario']??'';?></span>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Data nascimento: *</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nDataNascimento" value="<?php echo set_value('nDataNascimento') ?>" class="form-control data" placeholder="Data nascimento">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDataNascimento']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>CNS do Acompanhante: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCnsUsuario" value="<?php echo set_value('nCnsUsuario') ?>" class="form-control" placeholder="Cartão do SUS do Acompanhante">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCnsUsuario']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>CPF do Acompanhante: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCpfUsuario" value="<?php echo set_value('nCpfUsuario') ?>" class="form-control cpf" placeholder="CPF Acompanhante">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfUsuario']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>NIS do Acompanhante: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNisUsuario" value="<?php echo set_value('nNisUsuario') ?>" class="form-control nis" placeholder="NIS Acompanhante">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNisUsuario']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Gênero: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nGenero" type="radio" value="M" <?php echo set_radio('nGenero', 'M', FALSE); ?> class="with-gap" id="iGeneroMasc" />
                                            <label for="iGeneroMasc">MASC</label>
                                            <input name="nGenero" type="radio" id="iGeneroFemi" value="F" <?php echo set_radio('nGenero', 'F', FALSE); ?> class="with-gap" />
                                            <label for="iGeneroFemi">FEMI</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGenero']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Telefone:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nTelefone" id="" value="<?php echo set_value('nTelefone'); ?>" class="form-control telefone" placeholder="Telefone">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefone']??'';?></span>
                                </div>
                            </div>
                        </div>     
                        <hr>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>CEP: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input id="iCep" name="nCep" type="text" value="<?php echo set_value('nCep'); ?>" class="form-control cep" placeholder="CEP" pattern = "[0-9]+$" title = "Digite apenas números">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Logradouro: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iLogradouro" class="form-control" name="nLogradouro" value="<?php echo set_value('nLogradouro'); ?>" id="iLogradouro" placeholder="Logradouro">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nLogradouro']??'';?></span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Bairro: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nBairro" value="<?php echo set_value('nBairro'); ?>" id="iBairro" placeholder="Bairro">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nBairro']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Número: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iNumeroLogradouro" class="form-control" name="nNumeroLogradouro" value="<?php echo set_value('nNumeroLogradouro'); ?>" placeholder="Numero logradouro">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNumeroLogradouro']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Complemento: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nComplemento" value="<?php echo set_value('nComplemento'); ?>" id="iComplemento" placeholder="Complemento">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Ponto referência: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nPontoReferencia" value="<?php echo set_value('nPontoReferencia'); ?>" id="iPontoReferencia" placeholder="Ponto de referencia">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPontoReferencia']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Cidade | Uf: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="nCidade">
                                            
                                            <option value="CAMPINA GRANDE - PB"> CAMPINA GRANDE-PB</option>
                                            <?php
                                            $cidades = $modelCidade->getCidades();
                                            foreach ($cidades AS $cidade)
                                            {
                                                echo ' <option value="' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '" ' . set_select('nCidade', $cidade->nomeCidade . ' - ' . $cidade->ufCidade, FALSE) . '>' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCidade']??'';?></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                    echo session()->get('botaoSalvar');
                                    echo session()->get('botaoLimpar');                                
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

<?= $this->endSection(); ?>