<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="body">
            <?php
            $atributos_formulario = [
                'role' => 'form',
                'class' => 'form-horizontal',
                'id' => 'cadastrarUsuarioForm'
            ];
            echo form_open('api/operador/cadastrar_usuario_simplificado', $atributos_formulario);
            ?>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bold">Incluir na lista de espera? *</label>
                <div class="col-sm-8">
                    <div class="icheck-material-teal icheck-inline">
                        <input onclick="clearMessageError('nListaEspera')" name="nListaEspera" value="S" type="radio"
                            class="with-gap" id="iListaSim" />
                        <label for="iListaSim">SIM</label>
                    </div>

                    <div class="icheck-material-teal icheck-inline">
                        <input onclick="clearMessageError('nListaEspera')" name="nListaEspera" value="N" type="radio"
                            id="iListaNao" class="with-gap" />
                        <label for="iListaNao">NÃO</label>
                    </div>
                    <br>
                    <p class="text-danger mb-1" id="nListaEspera">
                    </p>

                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bold">Nome: *</label>
                <div class="col-sm-8">
                    <input onclick="clearMessageError('nNomeUsuario')" type="text" name="nNomeUsuario"
                        class="form-control" autofocus placeholder="Nome">
                    <p class="text-danger mb-1" id="nNomeUsuario">
                    </p>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Data nascimento: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nDataNascimento')" type="text" name="nDataNascimento"
                                class="form-control flatpickr flatpickr-input active" placeholder="Data nascimento">
                        </div>
                        <p class="text-danger mb-1" id="nDataNascimento">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">CNS do Usuário: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nCnsUsuario')" type="text" name="nCnsUsuario"
                                class="form-control" placeholder="Cartão do SUS do Usuário">
                        </div>
                        <p class="text-danger mb-1" id="nCnsUsuario">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">CPF do Usuario: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nCpfUsuario')" type="text" name="nCpfUsuario"
                                class="form-control cpf" placeholder="CPF Usuário">
                        </div>
                        <p class="text-danger mb-1" id="nCpfUsuario">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">NIS do Usuario: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNisUsuario')" type="text" name="nNisUsuario"
                                class="form-control nis" placeholder="NIS Usuário">
                        </div>

                        <p class="text-danger mb-1" id="nNisUsuario">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Idade do diagnóstico: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nIdadeDiagnostico" class="form-control"
                                placeholder="Idade diagnóstico">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Gênero: *</label>

                <div class="col-sm-8">

                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-indigo icheck-inline">
                                <input onclick="clearMessageError('nGenero')" name="nGenero" type="radio" value="M"
                                    class="with-gap" id="iGeneroMasc" />
                                <label for="iGeneroMasc">MASC</label>
                            </div>
                            <div class="icheck-material-orange icheck-inline">
                                <input onclick="clearMessageError('nGenero')" name="nGenero" type="radio"
                                    id="iGeneroFemi" value="F" class="with-gap" />
                                <label for="iGeneroFemi">FEMI</label>
                            </div>
                        </div>
                        <p class="text-danger mb-1" id="nGenero">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Telefone:</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nTelefone')" type="text" name="nTelefone"
                                class="form-control telefone" placeholder="Telefone">
                        </div>
                        <p class="text-danger mb-1" id="nTelefone">
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Frequenta outra escola? *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nFrequentaEscola')"
                                name="nFrequentaEscola" value="S"
                                    type="radio" id="iFrequentaSim" />
                                <label for="iFrequentaSim">SIM</label>
                            </div>

                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nFrequentaEscola')"
                                name="nFrequentaEscola" value="N"
                                    type="radio" id="iFrequentaNao" />
                                <label for="iFrequentaNao">NÃO</label>
                            </div>
                        </div>
                        <p class="text-danger mb-1" id="nFrequentaEscola">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Tipo Escola? </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="marcarRadioButton()" name="nTipoEscola" value="1" type="radio"
                                    class="with-gap" id="iTipoEscolaPublica" />
                                <label for="iTipoEscolaPublica">PÚBLICA</label>
                            </div>

                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="marcarRadioButton()" name="nTipoEscola" value="2" type="radio"
                                    id="iTipoEscolaPrivada" class="with-gap" />
                                <label for="iTipoEscolaPrivada">PRIVADA</label>
                            </div>
                        </div>
                        <p class="text-danger mb-1" id="nTipoEscola">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Escola: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNomeEscola')" type="text" name="nNomeEscola"
                                id="iNomdeEscola" class="form-control" placeholder="Nome escola">
                        </div>
                        <p class="text-danger mb-1" id="nNomeEscola">
                        </p>

                    </div>
                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Série | Ano: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nSerieAno')" type="text" name="nSerieAno"
                                class="form-control" placeholder="Série | Ano">
                        </div>
                        <p class="text-danger mb-1" id="nSerieAno">
                        </p>

                    </div>
                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Frequenta Escola|Associação Especial|CAPS
                    *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nFrequentaEscolaEspecial')" name="nFrequentaEscolaEspecial"
                                    value="S" type="radio" class="with-gap" id="iFrequentaEspecialSim" />
                                <label class="" for="iFrequentaEspecialSim">SIM</label>
                            </div>
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nFrequentaEscolaEspecial')"
                                    name="nFrequentaEscolaEspecial" value="N" type="radio"
                                    id="iFrequentaEspecialNao" class="with-gap" />
                                <label class="" for="iFrequentaEspecialNao">NÃO</label>
                            </div>
                        </div>
                        <p class="text-danger mb-1" id="nFrequentaEscolaEspecial">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Possui cuidador? *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nCuidador')" name="nCuidador" value="S"
                                    type="radio" class="with-gap" id="iCuidadorSim" />
                                <label for="iCuidadorSim">SIM</label>

                            </div>
                            <div class="icheck-material-teal icheck-inline">
                                <input onclick="clearMessageError('nCuidador')" name="nCuidador" value="N"
                                    type="radio" id="iCuidadorNao" class="with-gap" />
                                <label for="iCuidadorNao">NÃO</label>
                            </div>
                        </div>
                        <p class="text-danger mb-1" id="nCuidador">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Médico que acompanha: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nMedico')" type="text" name="nMedico" id=""
                                class="form-control" placeholder="Médico que acompanha">
                        </div>
                        <p class="text-danger mb-1" id="nMedico">
                        </p>

                    </div>
                </div>

            </div>

            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Telefone médico que acompanha: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nTelefoneMedicoAcompanhante')" type="text"
                                name="nTelefoneMedicoAcompanhante" id="" class="form-control telefone"
                                placeholder="Telefone do médico">
                        </div>
                        <p class="text-danger mb-1" id="nTelefoneMedicoAcompanhante">
                        </p>

                    </div>
                </div>

            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Atendimento: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="icheck-material-teal icheck-inline">

                                <input type="checkbox" id="iFezAtendimento" class="checkbox-inline"
                                    name="nFezAtendimento" value="S" /> <label for="iFezAtendimento"> FEZ ATENDIMENTO;
                                    E OU </label><br>
                            </div>
                            <div class="icheck-material-teal icheck-inline">
                                <input type="checkbox" id="iFazAtendimento" class="checkbox-inline"
                                    name="nFazAtendimento" value="S" /> <label for="iFazAtendimento"> FAZ ATENDIMENTO
                                </label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Nome responsável: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNomePai')" type="text" name="nNomePai"
                                class="form-control" placeholder="Nome responsável">
                        </div>
                        <p class="text-danger mb-1" id="nNomePai">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Contato responsável: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nTelefonePai')" type="text" name="nTelefonePai" id=""
                                class="form-control telefone" placeholder="Contato responsável">
                        </div>
                        <p class="text-danger mb-1" id="nTelefonePai">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Nome responsável: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNomeMae')" type="text" name="nNomeMae"
                                class="form-control" placeholder="Nome responsável">
                        </div>
                        <p class="text-danger mb-1" id="nNomeMae">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Contato responsável: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nTelefoneMae" id="" onclick="clearMessageError('nTelefoneMae')"
                                class="form-control telefone" placeholder="Contato responsável">
                        </div>
                        <p class="text-danger mb-1" id="nTelefoneMae">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Mora ou reside com:</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nMoraCom')" type="text" name="nMoraCom" id=""
                                class="form-control" placeholder="Mora ou reside com: Ex.: Pai, Mãe, Avó...">
                        </div>
                        <p class="text-danger mb-1" id="nMoraCom">
                        </p>

                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">CEP: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input id="iCep" name="nCep" type="text" class="form-control cep" placeholder="CEP"
                                pattern="[0-9]+$" title="Digite apenas números">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Logradouro: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nLogradouro')" type="text" id="iLogradouro"
                                class="form-control" name="nLogradouro" id="iLogradouro" placeholder="Logradouro">
                        </div>
                        <p class="text-danger mb-1" id="nLogradouro">
                        </p>

                    </div>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Bairro: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nBairro')" type="text" class="form-control"
                                name="nBairro" id="iBairro" placeholder="Bairro">
                        </div>
                        <p class="text-danger mb-1" id="nBairro">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Número: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNumeroLogradouro')" type="text" id="iNumeroLogradouro"
                                class="form-control" name="nNumeroLogradouro" placeholder="Numero logradouro">
                        </div>
                        <p class="text-danger mb-1" id="nNumeroLogradouro">
                        </p>

                    </div>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Complemento: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nComplemento" id="iComplemento"
                                placeholder="Complemento">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Ponto referência: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nPontoReferencia')" type="text" class="form-control"
                                name="nPontoReferencia" id="iPontoReferencia" placeholder="Ponto de referencia">
                        </div>
                        <p class="text-danger mb-1" id="nPontoReferencia">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">Cidade | Uf: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <select onclick="clearMessageError('nCidade')" class="form-control show-tick"
                                name="nCidade">

                                <option value="CAMPINA GRANDE - PB"> CAMPINA GRANDE-PB</option>
                                <?php
                                $cidades = $modelCidade->getCidades();
                                foreach ($cidades as $cidade) {
                                    echo ' <option value="' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '" ' . set_select('nCidade', $cidade->nomeCidade . ' - ' . $cidade->ufCidade, FALSE) . '>' . $cidade->nomeCidade . ' - ' . $cidade->ufCidade . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <p class="text-danger mb-1" id="nCidade">
                        </p>

                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 hidden"></label>
                <div class="col-sm-8 d-flex justify-content-between">
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
<script>
    
    const URL_BASE = "http://localhost/sisacpaonline/public/";
    const URI_API_USUARIO = "api/usuario";

    const cadastrarUsuarioForm = document.getElementById("cadastrarUsuarioForm");


    if (cadastrarUsuarioForm) {

        cadastrarUsuarioForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataForm = new FormData(cadastrarUsuarioForm);

            await axios
                .post(`${URL_BASE}${URI_API_USUARIO}/cadastrar_usuario_simplificado`, dataForm, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                    console.log(response.error)
                    const dados = response.data  

                    if (response.data.error) {

                        showAlertToast(false, "Erros no preechimento!");
                        validateErros(
                            response.data.msgs,
                        );


                    } else {
                        //activeSeriesModal.hide();
                        showAlertToast(true);

                        //console.log(response.data);

                        cadastrarUsuarioForm.reset();

                        setTimeout(function() {
                            window.location.href = `${URL_BASE}usuario/detalhar_usuario/${dados.idUsuario}`
                        }, 2000); // Redireciona após 5 segundos
                        //listarProfissionais();
                        //editProfissionalForm.hide();
                        //$("#editarProfissional").modal("hide");

                        //addSeriesForm.reset();
                        //editSerieModal.hide()
                        //localStorage.setItem('idSeriesStorege', response.data.id)
                        //loadToast(typeSuccess, titleSuccess, messageSuccess);

                        //listarProfissionais();
                    }
                }).catch((error) => {
                    showAlertToast(false, error);
                })
        })

    }
</script>

<?= $this->endSection(); ?>