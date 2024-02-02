const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_PROFISSIONAL = "api/profissional";
const URI_API_MODALIDADE = "api/modalidade";
const dataTipo = [
    {
        ident: "F",
        desc: "FUNCIONARIO",
    },
    {
        ident: "V",
        desc: "VOLUNTÁRIO",
    },
    {
        ident: "O",
        desc: "OUTROS",
    },
];

listarProfissionais();

async function listarProfissionais() {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios
        .get(`${URL_BASE}${URI_API_PROFISSIONAL}/listarProfissional/`)
        .then((response) => {
            const data = response.data;

            document.querySelector(
                "#tb_profissionais > tbody"
            ).innerHTML = `${loadDataProfissional(data)}`;            
        })
        .catch((error) => console.log(error));
}

function loadDataProfissional(data) {
    let row = "";
    let display = "";
    let color = "text-white";
    let marcador = "";

    //if (data) {
    data.forEach((elem, indice) => {
        row += `<tr class="${elem.ativo == "INATIVO" ? "font-line-through col-grey" : ""
            }">
                    <td>${elem.nomeProfissional}</td>
                    <td>${tratarFieldNull(elem.cnsProfissional)}</td>
                    <td>${elem.cpfProfissional
            }</td>                                                         
                    <td>${elem.modalidade}</td>   
                    <td>${tratarTipoProfissional(elem.tipoProfissional)}</td>   
                    <td>${elem.ativo}</td>   
                    <td class="text-center">`;

        if (elem.ativo == "ATIVO") {
            row += `<a href="" onclick = "editar_profissional('${elem.idProfissional}')" class = "btn bg-teal waves-effect" title = "Editar profissional" data-toggle = "modal" data-target = "#editarProfissional">
                           E
                        </a>
                        <a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','N')" class = "btn bg-red waves-effect" title = "Desativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
                           D
                        </a>
                        <a href="#/" onclick = "alocar_profissional('${elem.idProfissional}')" class = "btn bg-orange waves-effect" title = "Alocar Profissional" data-toggle = "modal" data-target = "#alocarProfissional">
                           A
                        </a>`;
        } else {
            row += `<a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','S')" class = "btn bg-success waves-effect" title = "Ativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
                           A
                        </a>`;
        }
        row += `
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idProfissional})" class = "btn bg-indigo waves-effect" title = "Escrever observação" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                            O
                        </a>
                    </td>                                       
                </tr>`;
    });

    return row;
}
async function ativar_desativar_profissional(idProfissional, status) {
    clearMessageErrorAll();

    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`
        )
        .then((response) => {
            var dados = response.data;
            document.getElementById("idProfissionalAtivaDesativa").value =
                idProfissional;
            document.getElementById("statusAtivaDesativa").value = `${dados["ativo"] == "S" ? "N" : "S"
                }`;
            document.getElementById(
                "nomeProfissionalAtivaDesativa"
            ).textContent = `${dados["nomeProfissional"]}`;

            const aviso = document.getElementById("aviso");
            const titleFormAtivarDesativar = document.getElementById(
                "titleFormAtivarDesativar"
            );

            if (dados["ativo"] == "S") {
                aviso.style.display = "block";
                titleFormAtivarDesativar.textContent = "DESATIVAR PROFISSIONAL ::";
            } else {
                aviso.style.display = "none";
                titleFormAtivarDesativar.textContent = "ATIVAR PROFISSIONAL ::";
            }
        })
        .catch((error) => console.log(error));
}

const ativarDesativarProfissionalForm = document.getElementById(
    "ativarDesativarProfissionalForm"
);

if (ativarDesativarProfissionalForm) {
    ativarDesativarProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(ativarDesativarProfissionalForm);

        await axios
            .post(
                `${URL_BASE}${URI_API_PROFISSIONAL}/ativa_desativa_profissional`,
                dataForm,
                {
                    headers: {
                        "Content-Type": "application/json",
                    },
                }
            )
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");
                } else {
                    showAlertToast(response.data.status);
                    ativarDesativarProfissionalForm.reset();
                    $("#ativarDesativarProfissional").modal("hide");
                    listarProfissionais();
                }
            })
            .catch((error) => console.log(error));
    });
}

async function listar_alocacao_profissional(idProfissional){
    
    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getAlocacaoProfissional/${idProfissional}`
        )
        .then((response)=>{            
            $("#alocarProfissional").modal("hide");
            const data = response.data;
            
            document.querySelector(
                "#tb_alocacao_profissional > tbody"
            ).innerHTML = `${loadDataAlocacaoProfissional(data)}`;
                
        })
        .catch((error) => console.log(error));
}

function loadDataAlocacaoProfissional(data){
    
    let row = ''
    data.forEach((elem, indice) => {
        const nomeProfissionalSmall = document.querySelector('#nomeProfissionalSmall')
        nomeProfissionalSmall.textContent = elem.nomeProfissional

        row += `<tr>
                    <td>${elem.diaSemana} - ${tratarDiaSemana(parseInt(elem.diaSemana,10))}</td>
                    <td>${elem.horaInicio}</td>
                    <td>${elem.horaFim}</td>
                    <td class="text-center">
                        <a href='#' class="btn bg-red waves-effect" data-toggle= "modal"
                        data-target = "#smallModal" data-title = "tooltip"
                        data-placement= "top"
                        title = "Remover alocação">
                            <span class="badge"> R </span> emover
                    </td>
                </tr>`
    })
    return row
}
async function editar_profissional(idProfissional) {
    clearMessageErrorAll();

    const dataModalidade = await getDataModalidade();

    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`
        )
        .then((response) => {
            var dados = response.data;

            document.getElementById("idProfissional").value = idProfissional;
            document.getElementById(
                "nomeProfissional"
            ).value = `${dados["nomeProfissional"]}`;
            document.getElementById("cnsProfissional").value = tratarFieldNull(
                `${dados["cnsProfissional"]}`
            );
            document.getElementById("cpfProfissional").value = tratarFieldNull(
                `${dados["cpfProfissional"]}`
            );
            document.getElementById(
                "conselhoClasse"
            ).value = `${dados["numeralConselhoClasse"]}`;

            construirSelect(
                dataModalidade,
                dados["modalidade"],
                "modalidades",
                "nModalidade"
            );

            construirSelect(
                dataTipo,
                tratarTipoProfissional(dados["tipoProfissional"]),
                "tipos",
                "nTipoProfissional"
            );

            const genero = document.querySelector("#genero");
            genero.innerHTML = "";

            let checkedMasc = "";
            let checkedFem = "";

            const generoValue = `${dados["genero"]}`.toUpperCase();

            if (generoValue === "M") {
                checkedMasc = 'checked="true"';
            } else {
                checkedFem = 'checked="true"';
            }

            let optionGenero = `<input name="nGenero" type="radio" ${checkedMasc} class="with-gap" id="iGeneroMasc" value="M"/>
                <label for="iGeneroMasc">Masc</label>`;
            optionGenero += `<input name="nGenero" type="radio" ${checkedFem} id="iGeneroFemi" class="with-gap" value="F"/>
                <label for="iGeneroFemi">Femi</label>`;
            genero.innerHTML = optionGenero;
        })
        .catch((error) => console.log(error));
}

const editProfissionalForm = document.getElementById("editProfissionalForm");
if (editProfissionalForm) {
    editProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(editProfissionalForm);

        await axios
            .post(`${URL_BASE}${URI_API_PROFISSIONAL}/edita_profissional`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(
                        response.data.msgs.nNomeProfissional,
                        "iNomeProfissional"
                    );
                    validateErros(
                        response.data.msgs.nCpfProfissional,
                        "iCpfProfissional"
                    );
                    validateErros(
                        response.data.msgs.nCnsProfissional,
                        "iCnsProfissional"
                    );
                    validateErros(
                        response.data.msgs.nTipoProfissional,
                        "iTipoProfissional"
                    );
                    validateErros(
                        response.data.msgs.nModalidade,
                        "iModalidadeProfissional"
                    );
                    //document.getElementById('iCnsProfissional').innerHTML = response.data.msgs.nCnsProfissional
                    //document.getElementById('iHoraAtendimento').value = '00:00'
                    //editSerieForm.reset();
                    /*validateErros(response.data.msgs.description, 'fieldAlertErrorDescriptionSeriesEdit')
                          validateErros(response.data.msgs.classification, 'fieldAlertErrorTurmaEdit')
                          validateErros(response.data.msgs.series, 'fieldAlertDuplicativeEdit')
                          //validateErros(response.data.msgs.name, 'fieldlertErrorEditName')*/
                } else {
                    //activeSeriesModal.hide();
                    showAlertToast(response.data.status);
                    editProfissionalForm.reset();
                    //editProfissionalForm.hide();
                    $("#editarProfissional").modal("hide");

                    //addSeriesForm.reset();
                    //editSerieModal.hide()
                    //localStorage.setItem('idSeriesStorege', response.data.id)
                    //loadToast(typeSuccess, titleSuccess, messageSuccess);

                    listarProfissionais();
                }
            });
    });
}

async function alocar_profissional(idProfissional) {
    //clearMessageErrorAll()
    $('#listarAlocacaoProfissional').modal('hide')
    atualizarHoraFim();

    const horaFim = document.querySelector("#horaFim");
    if (horaFim) {
        horaFim.value = "";
    }

    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`
        )
        .then((response) => {
            var dados = response.data;
            document.getElementById("idProfissionalAlocar").value = idProfissional;

            document.getElementById(
                "nomeProfissionalAlocar"
            ).textContent = `${dados["nomeProfissional"]}`;

            const btVoltarAlocacaoProfissional = document.querySelector('#btVoltarAlocacaoProfissional')
            btVoltarAlocacaoProfissional.setAttribute('onclick', `alocar_profissional('${idProfissional}')`)

            let checkboxDiaSemana = "";
            for (let i = 2; i <= 6; i++) {
                checkboxDiaSemana += `<input type="checkbox" id="i${i}" class="marcarTodos checkbox-inline" name="nDia[]"
                                    value="${i}" onclick="clearMessageError('iDiasAtendimento')" /> 
                                    <label for="i${i}"> ${tratarDiaSemana(i)}
                                </label><br>`;
            }

            document.querySelector("#diaSemanaDiv").innerHTML = checkboxDiaSemana;

            document.querySelector("#horaInicioDiv").innerHTML =
                defineSelectHoraInicio();

            const btnListarAlocacao = document.querySelector('#btnListarAlocacao')
            btnListarAlocacao.setAttribute('onclick',`listar_alocacao_profissional('${idProfissional}')`)
            btnListarAlocacao.setAttribute('data-toggle','modal')
            btnListarAlocacao.setAttribute('data-target','#listarAlocacaoProfissional')          

            /*const aviso = document.getElementById('aviso');
                  const titleFormAtivarDesativar = document.getElementById('titleFormAtivarDesativar');
      
                  if(dados['ativo'] == 'S'){
                      aviso.style.display = 'block';
                      titleFormAtivarDesativar.textContent = 'DESATIVAR PROFISSIONAL ::'
                  } else {
                      aviso.style.display = 'none';
                      titleFormAtivarDesativar.textContent = 'ATIVAR PROFISSIONAL ::'
                  }*/
        })
        .catch((error) => console.log(error));
}

function defineSelectHoraInicio() {
      // Defina um objeto com as opções desejadas
      var opcoes = [
        "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30",
        "11:00", "11:30", "13:00", "13:30", "14:00", "14:30", "15:00",
        "15:30", "16:00", "16:30", "17:00", "17:30"
    ];

    // Construa o HTML do select com base no objeto de opções
    var selectHTML = '<select id="horaInicio" class="form-control" name="nHoraInicio" onchange="atualizarHoraFim()">\n';
    selectHTML += '<option value="">selecione...</option>\n';

    opcoes.forEach(function (opcao) {
        selectHTML += '<option value="' + opcao + '">' + opcao + '</option>\n';
    });

    selectHTML += '</select>';

    return selectHTML;
}

const alocarProfissionalForm = document.getElementById(
    "alocarProfissionalForm"
);
if (alocarProfissionalForm) {
    alocarProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(alocarProfissionalForm);

        await axios
            .post(`${URL_BASE}${URI_API_PROFISSIONAL}/aloca_profissional`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(response.data.msgs.nDia, "iDiasAtendimento");
                    validateErros(response.data.msgs.nHoraInicio, "iHoraInicio");
                    validateErros(response.data.msgs.nHoraFim, "iHoraFim");
                } else {
                    //activeSeriesModal.hide();
                    showAlertToast(response.data.status);
                    editProfissionalForm.reset();
                    //editProfissionalForm.hide();
                    $("#editarProfissional").modal("hide");

                    //addSeriesForm.reset();
                    //editSerieModal.hide()
                    //localStorage.setItem('idSeriesStorege', response.data.id)
                    //loadToast(typeSuccess, titleSuccess, messageSuccess);

                    listarProfissionais();
                }
            });
    });
}

async function getDataModalidade() {
    const teses = await fetch(
        `${URL_BASE}${URI_API_MODALIDADE}/getDataModalidade`
    );
    return await teses.json();
}

function tratarTipoProfissional(tipo) {
    switch (tipo) {
        case "V":
            return "VOLUNTARIO";
        case "F":
            return "FUNCIONARIO";
        case "O":
            return "OUTROS";
    }
    return "";
}

atualizarHoraFim();

function atualizarHoraFim() {
    clearMessageError("iHoraInicio");

    var horaInicioSelect = document.getElementById("horaInicio");
    var containerHoraFim = document.getElementById("containerHoraFim");

    // Remover o select de hora de término atual, se existir
    containerHoraFim.innerHTML = "";

    // Criar um novo select de hora de término
    var selectElement = document.createElement("select");
    selectElement.classList.add("form-control");
    selectElement.setAttribute("name", "nHoraFim");
    selectElement.setAttribute("id", "horaFim");
    selectElement.setAttribute("onchange", "clearMessageError('iHoraFim')");

    // Adicionar uma opção padrão ao novo select
    var defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "selecione...";
    selectElement.appendChild(defaultOption);

    if (horaInicioSelect) {
        // Obter a hora de início selecionada
        var horaInicioSelecionada = horaInicioSelect.value;

        // Verificar se uma hora de início válida foi selecionada
        if (horaInicioSelecionada) {
            // Criar opções para a hora de término começando da próxima meia hora
            var partesHoraInicio = horaInicioSelecionada.split(":");
            var horaAtual = parseInt(partesHoraInicio[0], 10);
            var minutosAtual = parseInt(partesHoraInicio[1], 10);

            while (horaAtual < 18 || (horaAtual === 18 && minutosAtual === 30)) {
                minutosAtual += 30;

                if (minutosAtual === 60) {
                    minutosAtual = 0;
                    horaAtual += 1;
                }

                var horaFim = pad(horaAtual) + ":" + pad(minutosAtual);
                var option = document.createElement("option");
                option.value = horaFim;
                option.textContent = horaFim;
                selectElement.appendChild(option);
            }
        }
    }

    // Adicionar o novo select ao container
    containerHoraFim.appendChild(selectElement);
}

function pad(num) {
    return (num < 10 ? "0" : "") + num;
}
