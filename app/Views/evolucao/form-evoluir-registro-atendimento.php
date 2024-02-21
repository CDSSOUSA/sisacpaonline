<?php
echo $this->extend('layout/home');
echo $this->section('content');

$dataAtendimento = $atendimento->dataAtendimento;
$idUsuario = $atendimento->idUsuario;
$nomeUsuario = $atendimento->nomeUsuario;
$idRegistroAtendimento = $atendimento->idRegistroAtendimento;
$nomeProfissional = $atendimento->nomeProfissional;
$numeroRegistro = $atendimento->numeroRegistro;
?>

<div class="row">
    <div class="col-xl-12">

        <?php
        $atributos_formulario = array(
            'role' => 'form',
            'class' => 'form-horizontal',
            'id' => 'escreverEvolucaoForm'
        );
        echo form_open('evolucao/evoluir_registro_atendimento', $atributos_formulario);
        echo form_hidden('nIdRegistroAtendimento', encrypt($idRegistroAtendimento));
        ?>

        <div class="form-group row">
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

        <div class="form-group row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                <label for="">Profissional:</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <h5>

                            <?php echo $nomeProfissional; ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                <label for="">Data do atendimento:</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <h5>

                            <?php echo converteParaDataBrasileira($dataAtendimento); ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                <label for="">
                    Use o texto complementar: 
                    </label>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="demo-checkbox">
                        <?php foreach ($textoPadraoEvolucao as $key => $item): ?>
                            <div class="icheck-material-teal">
                                <input 
                                    type="checkbox" 
                                    id="<?= $key; ?>" class="checkbox-inline" 
                                    name="<?= $key; ?>"
                                    value="<?= $item; ?>"
                                    onclick="clearMessageError('iErrorTextoEvolucao')" />
                                <label for="<?= $key; ?>">
                                    <?= $item; ?>
                                </label><br>
                            </div>
                        <?php endforeach; ?>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                <label for="iTextoEvolucao">Texto da evoluçao: *</label>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="form-group">
                    
                    <div class="form-line">
                        <textarea
                            id ="iTextoEvolucao" 
                            rows="4" 
                            name="nTextoEvolucao" 
                            class="form-control no-resize textareaLimite2"
                            placeholder="Digite o texto ... Enter para mudar de linha."
                            onclick="clearMessageError('iErrorTextoEvolucao')">
                        </textarea>
                    </div>

                    <p
                    style="" 
                    class="text-danger mb-1"
                    id="iErrorTextoEvolucao">
                </p>   
                </div>
            </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-3 hidden"></label>
            <div class="col-sm-9 d-flex justify-content-between">
                              
                <?= gerarbotaoVoltar('evolucao/form_escrever_evolucao_data_atendimento');?>
                <?= session()->get('botaoLimpar'); ?>     
                <?= session()->get('botaoSalvar'); ?>
                <a onclick="historico_evolucao()" href="#" class="main_back_bt" data-toggle = "modal" data-target = "#historicoEvolucaoModal"><i class="fa fa-table"></i> Histórico Evolução</a>     
                
            </div>    
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?=$this->include('evolucao/modal/form-modal-historico-evolucao');?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>

                            <?php
                            echo 'HISTÓRICO DE EVOLUÇÃO DOS ATENDIMENTOS <small>' . $idUsuario . ' - ' . $nomeUsuario . '</small>';
                            ?>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">EVOLUÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$evolucoes = $this->RegistroAtendimento_model->getEvolucao(md5($idUsuario), $atendimento->idOperador)->result();
                                

                                foreach ($dadosEvolucao as $evolucao) {
                                    ?>
                                    <tr>
                                        <td>

                                            <div class="card">
                                                <div class="header bg-blue-grey">
                                                    <h2>
                                                        Data do atendimento:
                                                        <?php echo converteParaDataBrasileira($evolucao->dataAtendimento) . ' - ' . tratarDiaSemana($evolucao->diaSemana) . ' - ' . $evolucao->horaInicio . ' - <span class="badge">' . $evolucao->numeroRegistro . '</span> <small>Profissional: ' . $evolucao->nomeProfissional . ' - ' . $evolucao->modalidade . '</small><small>Registro da evolução em : ' . converteParaDataHoraCompletaBrasileira($evolucao->dataRegistroEvolucao) . '</small>'; ?>
                                                    </h2>
                                                </div>
                                                <div class="body">
                                                    <?php echo tratarEvolucao(base64_decode($evolucao->textoEvolucao), true); ?>
                                                </div>

                                            </div>
                                            <div>
                                                <?php echo anchor('evolucao/form_editar_evolucao/' . encrypt($evolucao->idRegistroAtendimento), '<span class="badge">E</span> ditar', array('class' => 'btn bg-teal waves-effect')); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>

<script>

    const URL_BASE = "http://localhost/sisacpaonline/public/";
    const URI_API_EVOLUCAO = "api/evolucao";
    const subTitulo = document.querySelector('#subTitulo')
    subTitulo.textContent =
        '<?= 'Registro: ' . $numeroRegistro . '\n' . ' * campos de preenchimento obrigatório'; ?>'

    const escreverEvolucaoForm = document.querySelector("#escreverEvolucaoForm");

if (escreverEvolucaoForm) {
    escreverEvolucaoForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(escreverEvolucaoForm);

        await axios
            .post(`${URL_BASE}${URI_API_EVOLUCAO}/escrever_evolucao`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(response.data.msgs.nTextoEvolucao, "iErrorTextoEvolucao");
                    
                } else {
                    showAlertToast(true);
                    escreverEvolucaoForm.reset();

                    setTimeout(function () {
                        window.location.href = `${URL_BASE}evolucao/form_escrever_evolucao_data_atendimento`;
                    }, 2000);
                }
            })
            .catch((error) => {
                showAlertToast(false, error);
            });
    });
}

</script>

<?php $this->endSection();
