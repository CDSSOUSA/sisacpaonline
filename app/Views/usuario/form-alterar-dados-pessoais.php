<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>

<section class="content">
    <div class="container-fluid">
        
        <div class="row clearfix">
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
                            <?php echo $titulo; ?>
                            <small>
                                <h2><?=$dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario?></h2>
                               
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('usuario/alterar_dados_pessoais', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        echo csrf_field();
                        ?>


                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="">
                                    <div class="form-line text-center">

                                        <?php
                                        echo img(array('src' => 'img/fotos/' . $dadosUsuario->fotoUsuario, 'height' => '80', 'widht' => '80', 'class' => 'image-area'));
                                        echo '<br>' . anchor('form_alterar_dados_foto/' . encrypt($dadosUsuario->idUsuario), 'Alterar', array('class' => 'text-center', 'title' => 'Alterar foto usuário'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <?php
                                //echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome completo: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="" name="nNomeUsuario" value="<?php echo set_value('nNomeUsuario', $dadosUsuario->nomeUsuario); ?>" class="form-control">
                                    </div>
                                </div>
                                <span style="color: red"><?= session()->get('errors')['nCodigo']??'';?></span>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data nasc: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="" name="nDataNascimento" value="<?php echo set_value('nDataNascimento', converteParaDataBrasileira($dadosUsuario->dataNascimento)); ?>" class="form-control data">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nDataNascimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Idade do diagnóstico: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeDiagnostico" value="<?php echo set_value('nIdadeDiagnostico', $dadosUsuario->idadeDiagnostico); ?>" class="form-control apenasNumero" placeholder="Idade diagnóstico">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Gênero: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if ($dadosUsuario->genero == 'M') {
                                            ?>
                                                <input name="nGenero" type="radio" checked="true" class="with-gap" id="iGeneroMasc" value="M" <?php echo set_radio('nGenero', 'M', false); ?> />
                                                <label for="iGeneroMasc">MASC</label>
                                                <input name="nGenero" type="radio" id="iGeneroFemi" class="with-gap" value="F" <?php echo set_radio('nGenero', 'F', false); ?> />
                                                <label for="iGeneroFemi">FEMI</label>

                                            <?php
                                            } else {
                                            ?>
                                                <input name="nGenero" type="radio" class="with-gap" id="iGeneroMasc" value="M" <?php echo set_radio('nGenero', 'M', false); ?> />
                                                <label for="iGeneroMasc">MASC</label>
                                                <input name="nGenero" type="radio" checked="true" id="iGeneroFemi" class="with-gap" value="F" <?php echo set_radio('nGenero', 'F', false); ?> />
                                                <label for="iGeneroFemi">FEMI</label>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CNS do usuário: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCnsUsuario" value="<?php echo set_value('nCnsUsuario', $dadosUsuario->cnsUsuario); ?>" class="form-control cns" placeholder="Cartão SUS do usuário">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nCnsUsuario']??'';?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CPF do usuário: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCpfUsuario" value="<?php echo set_value('nCpfUsuario', $dadosUsuario->cpfUsuario); ?>" class="form-control cpf" placeholder="CPF usuário">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nCpfUsuario']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>NIS do usuário: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNisUsuario"  value="<?= old('nNisUsuario', $dadosUsuario->nisUsuario) ?>" class="form-control nis" placeholder="NIS usuário">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nNisUsuario']??'';?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Telefone:</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nTelefone" id="" value="<?php echo set_value('nTelefone', $dadosUsuario->telefone); ?>" class="form-control telefone" placeholder="Telefone">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nTelefone']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome do cuidador: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="" name="nNomeCuidador" value="<?= old('nNomeCuidador', $dadosUsuario->nomeCuidador) ?>" class="form-control" placeholder="Nome cuidador">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nNomeCuidador']??'';?></span>

                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Tipo Escola? </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">

                                            <?php if ($dadosUsuario->tipoEscolaRegular == '1') : ?>
                                                <input name="nTipoEscola" value="1" checked="true" <?php echo set_radio('nTipoEscola', '1', FALSE); ?> type="radio" class="with-gap" id="iTipoEscolaPublica" />
                                                <label for="iTipoEscolaPublica">PÚBLICA</label>

                                                <input name="nTipoEscola" value="2" <?php echo set_radio('nTipoEscola', '2', FALSE); ?> type="radio" id="iTipoEscolaPrivada" class="with-gap" />
                                                <label for="iTipoEscolaPrivada">PRIVADA</label>
                                            <?php elseif ($dadosUsuario->tipoEscolaRegular == '2') : ?>
                                                <input name="nTipoEscola" value="1" <?php echo set_radio('nTipoEscola', '1', FALSE); ?> type="radio" class="with-gap" id="iTipoEscolaPublica" />
                                                <label for="iTipoEscolaPublica">PÚBLICA</label>

                                                <input name="nTipoEscola" value="2" checked="true" <?php echo set_radio('nTipoEscola', '2', FALSE); ?> type="radio" id="iTipoEscolaPrivada" class="with-gap" />
                                                <label for="iTipoEscolaPrivada">PRIVADA</label>
                                            <?php else : ?>
                                                <input name="nTipoEscola" value="1" <?php echo set_radio('nTipoEscola', '1', FALSE); ?> type="radio" class="with-gap" id="iTipoEscolaPublica" />
                                                <label for="iTipoEscolaPublica">PÚBLICA</label>

                                                <input name="nTipoEscola" value="2" <?php echo set_radio('nTipoEscola', '2', FALSE); ?> type="radio" id="iTipoEscolaPrivada" class="with-gap" />
                                                <label for="iTipoEscolaPrivada">PRIVADA</label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nTipoEscola']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Escola: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nEscola" value="<?php echo set_value('nEscola', $dadosUsuario->escolaOrigem); ?>" class="form-control" placeholder="Escola">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nEscola']??'';?></span>

                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Endereço da escola: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nEnderecoEscola" value="<?php echo set_value('nEnderecoEscola', $dadosUsuario->enderecoEscola); ?>" class="form-control" placeholder="Endereço da escola">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nEnderecoEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Contato da escola: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nContatoEscola" value="<?php echo set_value('nContatoEscola', $dadosUsuario->contatoEscola); ?>" class="form-control" placeholder="Contato da escola">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nContatoEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Horário:</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->horario)) {
                                            ?>
                                                <input name="nHorario" value="MANHÃ" <?php echo set_radio('nHorario', 'MANHÃ', FALSE); ?> type="radio" class="with-gap" id="iManha" />
                                                <label for="iManha">MANHÃ</label>
                                                <input name="nHorario" value="TARDE" <?php echo set_radio('nHorario', 'TARDE', FALSE); ?> type="radio" class="with-gap" id="iTarde" />
                                                <label for="iTarde">TARDE</label>
                                                <input name="nHorario" value="INTEGRAL" <?php echo set_radio('nHorario', 'INTEGRAL', FALSE); ?> type="radio" class="with-gap" id="iIntegral" />
                                                <label for="iIntegral">INTEGRAL</label>

                                            <?php
                                            } else if ($dadosUsuario->horario == 'MANHÃ') {
                                            ?>
                                                <input name="nHorario" value="MANHÃ" checked="true" <?php echo set_radio('nHorario', 'MANHÃ', FALSE); ?> type="radio" class="with-gap" id="iManha" />
                                                <label for="iManha">MANHÃ</label>
                                                <input name="nHorario" value="TARDE" <?php echo set_radio('nHorario', 'TARDE', FALSE); ?> type="radio" class="with-gap" id="iTarde" />
                                                <label for="iTarde">TARDE</label>
                                                <input name="nHorario" value="INTEGRAL" <?php echo set_radio('nHorario', 'INTEGRAL', FALSE); ?> type="radio" class="with-gap" id="iIntegral" />
                                                <label for="iIntegral">INTEGRAL</label>
                                            <?php
                                            } else if ($dadosUsuario->horario == 'TARDE') {
                                            ?>
                                                <input name="nHorario" value="MANHÃ" <?php echo set_radio('nHorario', 'MANHÃ', FALSE); ?> type="radio" class="with-gap" id="iManha" />
                                                <label for="iManha">MANHÃ</label>
                                                <input name="nHorario" value="TARDE" checked="true" <?php echo set_radio('nHorario', 'TARDE', FALSE); ?> type="radio" class="with-gap" id="iTarde" />
                                                <label for="iTarde">TARDE</label>
                                                <input name="nHorario" value="INTEGRAL" <?php echo set_radio('nHorario', 'INTEGRAL', FALSE); ?> type="radio" class="with-gap" id="iIntegral" />
                                                <label for="iIntegral">INTEGRAL</label>

                                            <?php } else {
                                            ?>
                                                <input name="nHorario" value="MANHÃ" <?php echo set_radio('nHorario', 'MANHÃ', FALSE); ?> type="radio" class="with-gap" id="iManha" />
                                                <label for="iManha">MANHÃ</label>
                                                <input name="nHorario" value="TARDE" <?php echo set_radio('nHorario', 'TARDE', FALSE); ?> type="radio" class="with-gap" id="iTarde" />
                                                <label for="iTarde">TARDE</label>
                                                <input name="nHorario" value="INTEGRAL" checked="true" <?php echo set_radio('nHorario', 'INTEGRAL', FALSE); ?> type="radio" class="with-gap" id="iIntegral" />
                                                <label for="iIntegral">INTEGRAL</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nHorario']??'';?></span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Professor(a) sala regular: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nProfessorRegular" value="<?php echo set_value('nProfessorRegular', $dadosUsuario->professorSalaRegular); ?>" class="form-control" placeholder="Professor de sala regular">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nProfessorRegular']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Autoriza uso de imagem? *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->autorizaImagem)) {
                                            ?>
                                                <input name="nAutorizaImagem" value="S" <?php echo set_radio('nAutorizaImagem', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutorizaImagemSim" />
                                                <label for="iAutorizaImagemSim">SIM</label>
                                                <input name="nAutorizaImagem" value="N" <?php echo set_radio('nAutorizaImagem', 'N', FALSE); ?> type="radio" id="iAutorizaImagemNao" class="with-gap" />
                                                <label for="iAutorizaImagemNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->autorizaImagem == 'S') {
                                            ?>
                                                <input name="nAutorizaImagem" checked="true" value="S" <?php echo set_radio('nBrinca', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutorizaImagemSim" />
                                                <label for="iAutorizaImagemSim">SIM</label>
                                                <input name="nAutorizaImagem" value="N" <?php echo set_radio('nAutorizaImagem', 'N', FALSE); ?> type="radio" id="iAutorizaImagemNao" class="with-gap" />
                                                <label for="iAutorizaImagemNao">NÃO</label>
                                            <?php } else {
                                            ?>
                                                <input name="nAutorizaImagem" value="S" <?php echo set_radio('nAutorizaImagem', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutorizaImagemSim" />
                                                <label for="iAutorizaImagemSim">SIM</label>
                                                <input name="nAutorizaImagem" value="N" checked="true" <?php echo set_radio('nAutorizaImagem', 'N', FALSE); ?> type="radio" id="iAutorizaImagemNao" class="with-gap" />
                                                <label for="iAutorizaImagemNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nAutorizaImagem']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Mora ou reside com: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nMoraCom" value="<?php echo set_value('nMoraCom', $dadosUsuario->moraCom); ?>" id="" placeholder="Mora ou reside com: Ex.: Pai, Mãe, Avó, ...">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nMoraCom']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CEP: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input id="iCep" name="nCep" type="text" value="<?php echo set_value('nCep', $dadosUsuario->cep); ?>" class="form-control cep" placeholder="CEP" pattern="[0-9]+$" title="Digite apenas números">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Logradouro: *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nLogradouro" value="<?php echo set_value('nLogradouro', $dadosUsuario->logradouro); ?>" id="iLogradouro" placeholder="Logradouro">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nLogradouro']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Bairro: *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nBairro" value="<?php echo set_value('nBairro', $dadosUsuario->bairro); ?>" id="iBairro" placeholder="Bairro">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nBairro']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Número: *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iNumeroLogradouro" class="form-control" name="nNumeroLogradouro" value="<?php echo set_value('nNumeroLogradouro', $dadosUsuario->numeroLogradouro); ?>" placeholder="Numero logradouro">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nNumeroLogradouro']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Complemento: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nComplemento" value="<?php echo set_value('nComplemento', $dadosUsuario->complemento); ?>" id="iComplemento" placeholder="Complemento">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Ponto referência: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nPontoReferencia" value="<?php echo set_value('nPontoReferencia', $dadosUsuario->pontoReferencia); ?>" id="iPontoReferencia" placeholder="Ponto de referencia">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nPontoReferencia']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Cidade | Uf: *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="nCidade">
                                            <option value="<?php echo $dadosUsuario->cidade; ?>" <?php echo set_select('nCidade', $dadosUsuario->cidade); ?>>
                                                <?php echo $dadosUsuario->cidade; ?></option>
                                            <?php
                                            foreach ($modelCidade->findAll() as $cidade) {
                                                echo ' <option value="' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '" ' . set_select('nCidade', $cidade->nomeCidade . ' - ' . $cidade->ufCidade, false) . '>' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nCidade']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        



                        <div class="row clearfix">
                            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-5 col-xs-offset-6">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
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
<?= $this->endSection();?>