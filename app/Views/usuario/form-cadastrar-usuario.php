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
                        echo form_open('usuario/cadastrar_usuario_simplificado', $atributos_formulario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Incluir na lista de espera? *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nListaEspera" value="S" <?php echo set_radio('nListaEspera', 'S', FALSE); ?> type="radio" class="with-gap" id="iListaSim" />
                                            <label for="iListaSim">SIM</label>
                                            <input name="nListaEspera" value="N" <?php echo set_radio('nListaEspera', 'N', FALSE); ?> type="radio" id="iListaNao" class="with-gap" />
                                            <label for="iListaNao">NÃO</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nListaEspera']??'';?></span>                                     
                                </div>
                            </div>
                        </div>
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
                                <label>CNS do Usuário: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCnsUsuario" value="<?php echo set_value('nCnsUsuario') ?>" class="form-control" placeholder="Cartão do SUS do Usuário">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCnsUsuario']??'';?></span> 
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>CPF do Usuario: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCpfUsuario" value="<?php echo set_value('nCpfUsuario') ?>" class="form-control cpf" placeholder="CPF Usuário">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfUsuario']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>NIS do Usuario: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNisUsuario" value="<?php echo set_value('nNisUsuario') ?>" class="form-control nis" placeholder="NIS Usuário">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNisUsuario']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Idade do diagnóstico: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeDiagnostico" value="<?php echo set_value('nIdadeDiagnostico') ?>" class="form-control" placeholder="Idade diagnóstico">
                                    </div>
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
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Frequenta outra escola? *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nFrequentaEscola" value="S" <?php echo set_radio('nFrequentaEscola', 'S', FALSE); ?> type="radio" class="with-gap" id="iFrequentaSim" />
                                            <label for="iFrequentaSim">SIM</label>

                                            <input name="nFrequentaEscola" value="N" <?php echo set_radio('nFrequentaEscola', 'N', FALSE); ?> type="radio" id="iFrequentaNao" class="with-gap" />
                                            <label for="iFrequentaNao">NÃO</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFrequentaEscola']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Tipo Escola? </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input onclick="marcarRadioButton()" name="nTipoEscola" value="1" <?php echo set_radio('nTipoEscola', '1', FALSE); ?> type="radio" class="with-gap" id="iTipoEscolaPublica" />
                                            <label for="iTipoEscolaPublica">PÚBLICA</label>

                                            <input onclick="marcarRadioButton()" name="nTipoEscola" value="2" <?php echo set_radio('nTipoEscola', '2', FALSE); ?> type="radio" id="iTipoEscolaPrivada" class="with-gap" />
                                            <label for="iTipoEscolaPrivada">PRIVADA</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoEscola']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Escola: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNomeEscola" id="iNomdeEscola" value="<?php echo set_value('nNomeEscola'); ?>" class="form-control" placeholder="Nome escola">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeEscola']??'';?></span> 
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Série | Ano: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nSerieAno" id="" value="<?php echo set_value('nSerieAno'); ?>" class="form-control" placeholder="Série | Ano">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSerieAno']??'';?></span> 
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Frequenta Escola|Associação Especial|CAPS *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nFrequentaEscolaEspecial" value="S" <?php echo set_radio('nFrequentaEscolaEspecial', 'S', FALSE); ?> type="radio" class="with-gap" id="iFrequentaEspecialSim" />
                                            <label for="iFrequentaEspecialSim">SIM</label>

                                            <input name="nFrequentaEscolaEspecial" value="N" <?php echo set_radio('nFrequentaEscolaEspecial', 'N', FALSE); ?> type="radio" id="iFrequentaEspecialNao" class="with-gap" />
                                            <label for="iFrequentaEspecialNao">NÃO</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFrequentaEscolaEspecial']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Possui cuidador? *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nCuidador" value="S" <?php echo set_radio('nCuidador', 'S', FALSE); ?> type="radio" class="with-gap" id="iCuidadorSim" />
                                            <label for="iCuidadorSim">SIM</label>
                                            <input name="nCuidador" value="N" <?php echo set_radio('nCuidador', 'N', FALSE); ?> type="radio" id="iCuidadorNao" class="with-gap" />
                                            <label for="iCuidadorNao">NÃO</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCuidador']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Médico que acompanha: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nMedico" id="" value="<?php echo set_value('nMedico'); ?>" class="form-control" placeholder="Médico que acompanha">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMedico']??'';?></span> 
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Telefone médico que acompanha: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nTelefoneMedicoAcompanhante" id="" value="<?php echo set_value('nTelefoneMedicoAcompanhante'); ?>" class="form-control telefone" placeholder="Telefone do médico">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefoneMedicoAcompanhante']??'';?></span> 
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Atendimento: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">

                                            <input type="checkbox" id="iFezAtendimento" class="checkbox-inline" name="nFezAtendimento" value="S"
                                                   <?php echo set_checkbox('nFezAtendimento', 'S'); ?> /> <label
                                                   for="iFezAtendimento"> FEZ ATENDIMENTO; E OU </label><br>
                                            <input type="checkbox"
                                                   id="iFazAtendimento" class="checkbox-inline" name="nFazAtendimento" value="S"
                                                   <?php echo set_checkbox('nFazAtendimento', 'S'); ?> /> <label
                                                   for="iFazAtendimento"> FAZ ATENDIMENTO </label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Nome responsável: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNomePai" id="" value="<?php echo set_value('nNomePai'); ?>" class="form-control" placeholder="Nome responsável">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomePai']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Contato responsável: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nTelefonePai" id="" value="<?php echo set_value('nTelefonePai'); ?>" class="form-control telefone" placeholder="Contato responsável">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefonePai']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Nome responsável: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNomeMae" id="" value="<?php echo set_value('nNomeMae'); ?>" class="form-control" placeholder="Nome responsável">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeMae']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Contato responsável: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nTelefoneMae" id="" value="<?php echo set_value('nTelefoneMae'); ?>" class="form-control telefone" placeholder="Contato responsável">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefoneMae']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Mora ou reside com:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nMoraCom" id="" value="<?php echo set_value('nMoraCom'); ?>" class="form-control" placeholder="Mora ou reside com: Ex.: Pai, Mãe, Avó...">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMoraCom']??'';?></span> 
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