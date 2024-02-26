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
       
            <div class="col d-flex justify-content-between">
                              
                <?= gerarbotaoVoltar('evolucao/form_escrever_evolucao_data_atendimento');?>
                <?= session()->get('botaoLimpar'); ?>     
                <?= session()->get('botaoSalvar'); ?>
                <a onclick="exibirHistoricoEvolucao('<?=encrypt($idUsuario)?>')" href="#" class="main_back_bt" data-toggle = "modal" data-target = "#historicoEvolucaoModal"><i class="fa fa-table"></i> Histórico Evolução</a>     
                
            </div>    
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?=$this->include('evolucao/modal/form-modal-historico-evolucao');?>
<?=$this->include('evolucao/modal/form-modal-editar-evolucao');?>


<script>

    const URL_BASE = "http://localhost/sisacpaonline/public/";
    const URI_API_EVOLUCAO = "api/evolucao";
    const subTitulo = document.querySelector('#subTitulo')
    subTitulo.innerHTML =
        '<?= '<p>Registro: <span class="badge badge-pill badge-info">'.$numeroRegistro . '<span></p> <p>' . ' * campos de preenchimento obrigatório</p>'; ?>'

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
async function exibirHistoricoEvolucao(idUsuario) {

    axios.get(
            `${URL_BASE}${URI_API_EVOLUCAO}/getHistorioEvolucao/${idUsuario}`
        )
        .then((response) => {
            const dados =response.data;
            document.querySelector('#resultHistorico').innerHTML = loadDataHistoricoEvolucao(dados)
        })
        .catch((error) => {
            console.log(error)
        })

    
}
var nomeUsuario = ''

function loadDataHistoricoEvolucao(dados) {
    
    let div = ''

    const totalHistorico =document.querySelector('#totalHistorico')
    totalHistorico.textContent = `A(s) ${dados.length.toString().padStart(2, '0')} última(s).`
    //for (var elem in dados) {
    dados.forEach((elem)=>{
        nomeUsuario = elem.nomeUsuario       
        const nomeUsuarioHistorico = document.querySelector('#nomeUsuarioHistorico')
        nomeUsuarioHistorico.textContent = nomeUsuario        

        
        div += `<div class="col-xl-12">
                        <div class="row">
                            <div class="col">
                                <div class="card text-left">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Data do atendimento:
                                            ${elem.dataAtendimento} -
                                            ${elem.diaSemana} - 
                                            ${elem.horaInicio}
                                            
                                    <span class="badge badge-pill badge-info">${elem.numeroRegistro}</span><br>
                                    <small>Profissional: ${elem.nomeProfissional} -
                                    ${elem.modalidade}</small><br>
                                    <small>Registro da evolução em : ${elem.dataRegistroEvolucao}</small>
                                        </h5>
                                        <blockquote class="blockquote">
                                            <p class="mb-2">
                                            ${elem.textoEvolucao}
                                               
                                            </p>

                                        </blockquote>

                                        <a href="#"
                                            onclick="editarEvolucao('${elem.idRegistroAtendimento}')"
                                            class="main_bt"
                                            data-toggle = "modal" 
                                            data-target = "#editarEvolucaoModal"><i class="fa fa-edit"></i> Editar</a>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>`
    })

    return div;

}
function fecharBt(idUsuario){
        $("#editarEvolucaoModal").modal("hide");
        $("#historicoEvolucaoModal").modal("show");

        //exibirHistoricoEvolucao(idUsuario);
    }
async function editarEvolucao(idEvolucao){   
    $("#historicoEvolucaoModal").modal("hide");
    axios.get(
            `${URL_BASE}${URI_API_EVOLUCAO}/getDataEvolucao/${idEvolucao}`
        )
        .then((response) => {
            const dados = response.data
            console.log(dados)
            document.querySelector('#iIdRegistroAtendimento').value = dados[0].idRegistroAtendimento
            document.querySelector('#iTextoEvolucaoEdicao').value = dados[0].textoEvolucao
            document.querySelector('#iRegistroEdicao').textContent = dados[0].registro
            document.querySelector('#btFecharEditarEvolucao').setAttribute('onclick', `fecharBt('${dados[0].idUsuario}')`);
            
            // const btFecharEditarEvolucao = document.querySelector('#btFecharEditarEvolucao')
            // btFecharEditarEvolucao.setAttribute('onclick','fecharBt('dados[0].idUsuario')')

        }). catch((error)=>{
            console.log(error)
        })
}

const editarEvolucaoForm = document.querySelector("#editarEvolucaoForm");

if (editarEvolucaoForm) {
    editarEvolucaoForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(editarEvolucaoForm);

        await axios
            .post(`${URL_BASE}${URI_API_EVOLUCAO}/editar_evolucao`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");
                    validateErros(response.data.msgs.nTextoEvolucao, "iErrorTextoEvolucaoEdicao");

                    
                } else {
                    showAlertToast(true);
                    editarEvolucaoForm.reset();
                    $("#editarEvolucaoModal").modal("hide");

                    //$("#historicoEvolucaoModal").modal("show");

                    //exibirHistoricoEvolucao()
                    // setTimeout(function () {                        
                    //     window.location.href = `${URL_BASE}evolucao/form_evoluir_atendimento/${dataForm.get('nIdRegistroAtendimento')}`;
                    // }, 2000);
                }
            })
            .catch((error) => {
                showAlertToast(false, error);
            });
    });
}

</script>

<?php $this->endSection();?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/evolucao.js"></script>
<?= $this->endSection(); ?>
