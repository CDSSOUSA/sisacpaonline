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
                'id' => 'cadastrarUsuarioAcompanhanteForm'
            ];
            echo form_open('api/usuario/cadastrar_usuario_acompanhante', $atributos_formulario);
            ?>

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

                <label class="col-sm-3 col-form-label font-weight-bold">CNS do Acompanhante: *</label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nCnsUsuario')" type="text" name="nCnsUsuario"
                                class="form-control" placeholder="Cartão do SUS do Acompanhante">
                        </div>
                        <p class="text-danger mb-1" id="nCnsUsuario">
                        </p>

                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">CPF do Acompanhante: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nCpfUsuario')" type="text" name="nCpfUsuario"
                                class="form-control cpf" placeholder="CPF Acompanhante">
                        </div>
                        <p class="text-danger mb-1" id="nCpfUsuario">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-3 col-form-label font-weight-bold">NIS do Acompanhante: </label>

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-line">
                            <input onclick="clearMessageError('nNisUsuario')" type="text" name="nNisUsuario"
                                class="form-control nis" placeholder="NIS Acompanhante">
                        </div>

                        <p class="text-danger mb-1" id="nNisUsuario">
                        </p>
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

<script>
    
    const URL_BASE = "http://localhost/sisacpaonline/public/";
    const URI_API_USUARIO = "api/usuario";

    const cadastrarUsuarioAcompanhanteForm = document.getElementById("cadastrarUsuarioAcompanhanteForm");


    if (cadastrarUsuarioAcompanhanteForm) {

        cadastrarUsuarioAcompanhanteForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataForm = new FormData(cadastrarUsuarioAcompanhanteForm);

            await axios
                .post(`${URL_BASE}${URI_API_USUARIO}/cadastrar_usuario_acompanhante`, dataForm, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                    
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

                        cadastrarUsuarioAcompanhanteForm.reset();

                        setTimeout(function() {
                          window.location.href = `${URL_BASE}usuario/detalhar_usuario/${dados.idUsuario}`;
                        }, 2000); // Redireciona após 5 segundos*/
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