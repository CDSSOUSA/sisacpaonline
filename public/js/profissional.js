const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_PROFISSIONAL = "api/profissional";
const URI_API_MODALIDADE = "api/modalidade";
const URI_API_ALOCACAO = "api/alocacao";
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
const diasDaSemana = ["SEG", "TER", "QUA", "QUI", "SEX"];
const horariosManha = [
    "07:30-08:00",
    "08:00-08:30",
    "08:30-09:00",
    "09:00-09:30",
    "09:30-10:00",
    "10:00-10:30",
    "10:30-11:00",
    "11:00-11:30",
    "11:30-12:00",
];
const horariosTarde = [
    "13:00-13:30",
    "13:30-14:00",
    "14:00-14:30",
    "14:30-15:00",
    "15:00-15:30",
    "15:30-16:00",
    "16:00-16:30",
    "16:30-17:00",
    "17:00-17:30",
    "17:30-18:00",
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
                        <a href="#/" onclick = "alocar_profissional('${elem.idProfissional}')" class = "btn bg-orange waves-effect" title = "Alocar Profissional" data-toggle = "modal" data-target = "#alocarProfissionalModal">
                           A
                        </a>`;
        } else {
            row += `<a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','S')" class = "btn bg-success waves-effect" title = "Ativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
                           A
                        </a>`;
        }
        row += `                      
                    </td>                                       
                </tr>`;
    });

    return row;
}

/* editar profissional*/

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

/* ativar e desativar profissional */
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

/* alocar profissional*/
async function alocar_profissional(idProfissional) {
    clearMessageErrorAll()
    $("#listarAlocacaoProfissional").modal("hide");

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

            console.log(dados)

            document.getElementById("idProfissionalAlocar").value = idProfissional;

            document.getElementById(
                "nomeProfissionalAlocar"
            ).textContent = `${dados["nomeProfissional"]} - ${dados["modalidade"]}`;

            document.querySelector("#iTotalAlocacao").textContent = `${dados['totalAlocacao']} de 95 possíveiss`

            const btVoltarAlocacaoProfissional = document.querySelector(
                "#btVoltarAlocacaoProfissional"
            );
            btVoltarAlocacaoProfissional.setAttribute(
                "onclick",
                `alocar_profissional('${idProfissional}')`
            );

            let checkboxDiaSemana = "";
            for (let i = 2; i <= 6; i++) {
                checkboxDiaSemana += `
                                            <input type="checkbox" id="i${i}" class="marcarTodos" name="nDia[]"
                                    value="${i}" onclick="clearMessageError('iDiasAtendimento')" /> 
                                    <label for="i${i}"> ${tratarDiaSemana(
                    i
                )}</label>`;
            }

            document.querySelector("#diaSemanaDiv").innerHTML = checkboxDiaSemana;

            let checkboxHoraInicio = "";
            
            for (var m = 0; m < horariosManha.length; m++) {
               
                checkboxHoraInicio += `
                                            <input type="checkbox" id="m${m + 2
                    }" class="marcarTodos" name="nHorarioManha[]"
                                    value="${horariosManha[m]
                    }" onclick="clearMessageError(['iHorarioManha','iMensagem'])" /> 
                                    <label for="m${m + 2}"> ${horariosManha[m]
                    }</label>`;
            }

            let checkboxHoraFim = "";
            

            for (var t = 0; t < horariosTarde.length; t++) {
               
                checkboxHoraFim += `
                                            <input type="checkbox" id="t${t + 2
                    }" class="marcarTodos" name="nHorarioTarde[]"
                                    value="${horariosTarde[t]
                    }" onclick="clearMessageError(['iHorarioTarde','iMensagem'])" /> 
                                    <label for="t${t + 2}"> ${horariosTarde[t]
                    }</label>`;
            }

            document.querySelector("#horaInicioNew").innerHTML = checkboxHoraInicio;
            document.querySelector("#horaFimNew").innerHTML = checkboxHoraFim;

            const btnListarAlocacao = document.querySelector("#btnListarAlocacao");

            if(dados["totalAlocacao"] <= 0) {
                btnListarAlocacao.classList.add('disabled')
                return              

            } 

            btnListarAlocacao.setAttribute(
                "onclick",
                `listar_alocacao_profissional('${idProfissional}')`
            );

            btnListarAlocacao.classList.remove('disabled')
            btnListarAlocacao.setAttribute("data-toggle", "modal");
            btnListarAlocacao.setAttribute(
                "data-target",
                "#listarAlocacaoProfissional"
            );

        })
        .catch((error) => console.log(error));
}

const alocarProfissionalForm = document.getElementById(
    "alocarProfissionalForm"
);
if (alocarProfissionalForm) {
    alocarProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(alocarProfissionalForm);
        

        // Remover um campo específico (por exemplo, 'campo2')
        //dataForm.delete('nMensagem');
        //console.log([...dataForm.entries()]);

        await axios
            .post(`${URL_BASE}${URI_API_PROFISSIONAL}/aloca_profissional`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                var dados = response.data;
                //console.log(dados);
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(response.data.msgs.nDia, "iDiasAtendimento");
                    validateErros(response.data.msgs.nHorarioManha, "iHorarioManha");
                    validateErros(response.data.msgs.nHorarioTarde, "iHorarioTarde");
                    validateErros(response.data.msgs.nMensagem, "iMensagem");
                    return;
                }
                showAlertToast(
                    dados.status,
                    `Novo:: ${dados.insert}<br>Atualização:: ${dados.update}`
                );
                alocarProfissionalForm.reset();
                $("#alocarProfissionalModal").modal("hide");
                listarProfissionais();
            });
    });
}

/* listar alocacao profissional */
async function listar_alocacao_profissional(idProfissional) {

    $('#removerAlocacaoProfissionalModal').modal("hide");

    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getAlocacaoProfissional/${idProfissional}`
        )
        .then((response) => {
            $("#alocarProfissionalModal").modal("hide");
            const data = response.data;

            console.log(data);

            document.querySelector(
                "#tb_alocacao_profissional > tbody"
            ).innerHTML = `${loadDataAlocacaoProfissional(data)}`;
        })
        .catch((error) => console.log(error));
}

function loadDataAlocacaoProfissional(data) {
    let row = "";
    data.forEach((elem, indice) => {
        const nomeProfissionalSmall = document.querySelector(
            "#nomeProfissionalSmall"
        );
        nomeProfissionalSmall.textContent = elem.nomeProfissional;

        row += `<tr>
                    <td>${elem.diaSemana} - ${tratarDiaSemana(
            parseInt(elem.diaSemana, 10)
        )}</td>
                    <td>${elem.horaInicio}</td>
                    <td>${elem.horaFim}</td>
                    <td class="text-center">
                        <a href='#' class="btn bg-red waves-effect" data-toggle= "modal"
                        data-target = "#removerAlocacaoProfissionalModal" data-title = "tooltip"
                        data-placement= "top"
                        title = "Remover alocação"
                        onclick = remover_alocacao_profissional('${elem.idAlocacao}')>
                            <span class="badge"> R </span> emover
                    </td>
                </tr>`;
    });
    return row;
}


/* remover alocacao*/
async function remover_alocacao_profissional(idAlocacao){   

    $('#listarAlocacaoProfissional').modal("hide");

    await axios
        .get(
            `${URL_BASE}${URI_API_ALOCACAO}/getDataAlocacao/${idAlocacao}`
        )
        .then((response) => {

            //const idProfissional = 10;

            const data = response.data
            console.log(data)

            const idAlocacaoProfissional = document.querySelector('#idAlocacao')
            idAlocacaoProfissional.value = idAlocacao

            const btnVoltarAlocacaoProfissional = document.querySelector("#btnVoltarAlocacaoProfissional");
            btnVoltarAlocacaoProfissional.setAttribute(
                "onclick",
                `listar_alocacao_profissional('${data[0].idProfissional}')`
            );

            document.querySelector('#dataALocacao').textContent = `${tratarDiaSemana(parseInt(data[0].diaSemana,10))} 
                                                                    :: ${data[0].horaInicio}
                                                                    :: ${data[0].horaFim}`
            document.querySelector('#nomeProfissionalAlocacaoSmall').textContent = data[0].nomeProfissional

            document.querySelector('#idAlocacaoProfissional').value = data[0].idProfissional
            

        })
        .catch((error) => console.log(error)); 

}

const removerAlocacaoProfissionalForm = document.getElementById(
    "removerAlocacaoProfissionalForm"
);

if (removerAlocacaoProfissionalForm) {
    removerAlocacaoProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(removerAlocacaoProfissionalForm);

        const idProfissional = dataForm.get('nIdProfissional')

        console.log(idProfissional)
        

        // Remover um campo específico (por exemplo, 'campo2')
        //dataForm.delete('nMensagem');
        //console.log([...dataForm.entries()]);

        await axios
            .post(`${URL_BASE}${URI_API_ALOCACAO}/remover_alocacao`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                var dados = response.data;
                //console.log(dados);
                if (response.data.error) {
                    showAlertToast(false, "Error inesperado!");                   
                    return;
                }
                showAlertToast(
                    dados.status                    
                );
                removerAlocacaoProfissionalForm.reset();
                $("#removerAlocacaoProfissionalModal").modal("hide");
                $("#listarAlocacaoProfissional").modal("show");
                listar_alocacao_profissional(idProfissional);
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
