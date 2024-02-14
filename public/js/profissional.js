const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_PROFISSIONAL = "api/profissional";
const URI_API_ATENDIMENTO = "api/atendimento";
const URI_API_MODALIDADE = "api/modalidade";
const URI_API_ALOCACAO = "api/alocacao";
const dataTipo = [
    {
        ident: "F",
        desc: "FUNCIONARIO",
    },
    {
        ident: "V",
        desc: "VOLUNTARIO",
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

            //console.log('lisata', data)

            document.querySelector(
                "#tb_profissionais > tbody"
            ).innerHTML = `${loadDataProfissional(data)}`;

            document.querySelector("#totalProfissionais").textContent = `Total de profissionais :: ${data.length}`;
        })
        .catch((error) => console.log(error));
}
var data = new Date();
var dia = String(data.getDate()).padStart(2, '0');
var mes = String(data.getMonth() + 1).padStart(2, '0');
var ano = data.getFullYear();
dataAtual = ano + '-' + mes + '-' + dia;
console.log(dataAtual);

function loadDataProfissional(data) {
    let row = "";
    let display = "";
    let color = "text-white";
    let marcador = "";

    let contadorAtivo = 0;
    let contadorInativo = 0;

    

    //if (data) {
    data.forEach((elem, indice) => {
        row += `
                <tr style="${elem.ativo == "INATIVO" ? "text-decoration: line-through; color:gray;" : "text-decoration: none"}">    
                <td>${indice+1}</td>
                    <td>${elem.nomeProfissional}${elem.created_at == dataAtual ? ' <span class="badge badge-pill badge-primary"> Novo</span>' :'' }</td>
                    <td>${tratarFieldNull(elem.cnsProfissional)}</td>
                    <td>${elem.cpfProfissional
            }</td>                                                         
                    <td>${elem.modalidade}</td>   
                    <td>${tratarTipoProfissional(elem.tipoProfissional)}</td>   
                    <td>${elem.ativo}</td>   
                    <td class="text-center">`;

        if (elem.ativo == "ATIVO") {
            contadorAtivo++
            row += `<a href="" onclick = "editar_profissional('${elem.idProfissional}')" class = "btn btn-icon btn-primary" title = "Editar profissional" data-toggle = "modal" data-target = "#editarProfissional">
                           <i class="feather icon-edit"></i>
                        </a>
                        <a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','N')" class = "btn btn-icon btn-danger" title = "Desativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
                        <i class="feather icon-slash"></i>
                        </a>
                        <a href="#/" onclick = "alocar_profissional('${elem.idProfissional}')" class = "btn btn-icon btn-warning" title = "Alocar Profissional" data-toggle = "modal" data-target = "#alocarProfissionalModal">
                        <i class="fas fa-table"></i>
                        </a>
                        <a href="#/" onclick = "visualizar_agenda_profissional('${elem.idProfissional}')" class = "btn btn-icon btn-info" title = "Alocar Profissional" data-toggle = "modal" data-target = "#visualizarAgendaProfissionalModal">
                        <i class="feather icon-calendar"></i>
                        </a>`
        } else {
            contadorInativo++
            row += `<a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','S')" class = "btn btn-icon btn-success" title = "Ativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
            <i class="feather icon-check"></i>
                        </a>`;
        }
        row += `                      
                    </td>                                       
                </tr>`;
    });

    document.querySelector('#contadorAtivo').textContent = `Ativos :: ${contadorAtivo}`
    document.querySelector('#contadorInativo').textContent = `Inativos :: ${contadorInativo}`

    return row;
}

/* editar profissional*/
//const envioProfissional = document.querySelector('#btnSalvarProfissional');
const cadastrarProfissionalForm = document.getElementById("cadastrarProfissionalForm");

if(cadastrarProfissionalForm){

    cadastrarProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(cadastrarProfissionalForm);

        await axios
            .post(`${URL_BASE}${URI_API_PROFISSIONAL}/cadastrar_profissional`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
              
                if (response.data.error) {
                   
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(
                        response.data.msgs.nNomeProfissional,
                        "iErrorNomeProfissional"
                    );
                    validateErros(
                        response.data.msgs.nGenero,
                        "iErrorGenero"
                    );
                    validateErros(
                        response.data.msgs.nCpfProfissional,
                        "iErrorCpfProfissional"
                    );
                    validateErros(
                        response.data.msgs.nCnsProfissional,
                        "iErrorCnsProfissional"
                    );
                    validateErros(
                        response.data.msgs.nTipoProfissional,
                        "iErrorTipoProfissional"
                    );
                    validateErros(
                        response.data.msgs.nModalidade,
                        "iErrorModalidade"
                    );
                    
                } else {
                    //activeSeriesModal.hide();
                    showAlertToast(true);

                    //console.log(response.data);

                    cadastrarProfissionalForm.reset();

                    setTimeout(function() {
                        window.location.href = `${URL_BASE}profissional/form_editar_profissional`;
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
            }).catch((error) =>{                
                showAlertToast(false, error);
            }) 
    })

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
            ).value = `${dados[0]["nomeProfissional"]}`;
            document.getElementById("cnsProfissional").value = tratarFieldNull(
                `${dados[0]["cnsProfissional"]}`
            );
            document.getElementById("cpfProfissional").value = tratarFieldNull(
                `${dados[0]["cpfProfissional"]}`
            );
            document.getElementById(
                "conselhoClasse"
            ).value = `${dados[0]["numeralConselhoClasse"]}`;
            document.getElementById(
                "id"
            ).value = `${dados[0]["id"]}`;

            construirSelect(
                dataModalidade,
                dados[0]["modalidade"],
                "modalidades",
                "nModalidade"
            );

            construirSelect(
                dataTipo,
                tratarTipoProfissional(dados[0]["tipoProfissional"]),
                "tipos",
                "nTipoProfissional"
            );

            const genero = document.querySelector("#genero");
            genero.innerHTML = "";

            let checkedMasc = "";
            let checkedFem = "";

            const generoValue = `${dados[0]["genero"]}`.toUpperCase();

            if (generoValue === "M") {
                checkedMasc = 'checked="true"';
            } else {
                checkedFem = 'checked="true"';
            }

            let optionGenero = `<div class="icheck-material-teal"><input name="nGenero" type="radio" ${checkedMasc} class="with-gap" id="iGeneroMasc" value="M"/>
                <label for="iGeneroMasc">Masc</label></div>`;
            optionGenero += `<div class="icheck-material-teal"><input name="nGenero" type="radio" ${checkedFem} id="iGeneroFemi" class="with-gap" value="F"/>
                <label for="iGeneroFemi">Femi</label></div>`;
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

                const data = response;
                console.log('erro de validadcao',data)
                if (data.data.error == true) {
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
                    showAlertToast(true);
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
            document.getElementById("idAtivaDesativa").value =
            `${dados[0]['id']}`;
            document.getElementById("statusAtivaDesativa").value = `${dados[0]["ativo"] == "S" ? "N" : "S"
                }`;
            document.getElementById(
                "nomeProfissionalAtivaDesativa"
            ).textContent = `${dados[0]["nomeProfissional"]}`;

            const aviso = document.getElementById("aviso");
            const titleFormAtivarDesativar = document.getElementById(
                "titleFormAtivarDesativar"
            );

            if (dados[0]["ativo"] == "S") {
                aviso.style.display = "block";
                titleFormAtivarDesativar.textContent = "DESATIVAR PROFISSIONAL";
            } else {
                aviso.style.display = "none";
                titleFormAtivarDesativar.textContent = "ATIVAR PROFISSIONAL";
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
                    showAlertToast(true);
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

            console.log('aqui',dados)

            document.getElementById("idProfissionalAlocar").value = idProfissional;

            document.getElementById(
                "nomeProfissionalAlocar"
            ).textContent = `${dados[0]["nomeProfissional"]} - ${dados[0]["modalidade"]}`;

            document.querySelector("#iTotalAlocacao").textContent = `${dados['totalAlocacao']} de 95 possíveis`

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
                    <div class="icheck-material-teal icheck-inline">
                        <input type="checkbox" id="i${i}" class="marcarTodos" name="nDia[]"
                                    value="${i}" onclick="clearMessageError('iDiasAtendimento')" /> 
                                    <label class="m-1" for="i${i}"> 
                                        ${tratarDiaSemana(i)}
                                    </label>
                    </div>`;
            }

            document.querySelector("#diaSemanaDiv").innerHTML = checkboxDiaSemana;

            let checkboxHoraInicio = "";
            
            for (var m = 0; m < horariosManha.length; m++) {
               
                checkboxHoraInicio += `
                <div class="icheck-material-teal icheck-inline m-0 p-0"><input type="checkbox" id="m${m + 2
                    }" class="marcarTodos" name="nHorarioManha[]"
                                    value="${horariosManha[m]
                    }" onclick="clearMessageError(['iHorarioManha','iMensagem'])" /> 
                                    <label class="m-1"for="m${m + 2}"> ${horariosManha[m]
                    }</label></div>`;
            }

            let checkboxHoraFim = "";
            

            for (var t = 0; t < horariosTarde.length; t++) {
               
                checkboxHoraFim += `
                <div class="icheck-material-teal icheck-inline m-0 p-0"><input type="checkbox" id="t${t + 2
                    }" class="marcarTodos" name="nHorarioTarde[]"
                                    value="${horariosTarde[t]
                    }" onclick="clearMessageError(['iHorarioTarde','iMensagem'])" /> 
                                    <label class="m-1" for="t${t + 2}"> ${horariosTarde[t]
                    }</label></div>`;
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
                        <a href='#' class="btn btn-icon btn-danger" data-toggle= "modal"
                        data-target = "#removerAlocacaoProfissionalModal" data-title = "tooltip"
                        data-placement= "top"
                        title = "Remover alocação"
                        onclick = remover_alocacao_profissional('${elem.idAlocacao}')>
                            <i class="fa fa-trash"></>
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

async function visualizar_agenda_profissional(idProfissional){
    const dia = 2
    await axios
        .get(
            `${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`
        )
        .then((response) => {
            $("#alocarProfissionalModal").modal("hide");
            const data = response.data;

            console.log('alocao',data);

            document.querySelector('#idNomeAgenda').textContent = `${data[0].idProfissional} - ${data[0].nomeProfissional}`
            document.querySelector('#modalidadeAgenda').textContent = `${data[0].modalidade}`

            document.querySelector('#myTab').innerHTML = gerarDiasAbas()
            //document.querySelector('#myTagbContent').innerHTML = gerarConteudoAbas(data)
            gerarConteudoAbas(idProfissional)
            
            
        })
        .catch((error) => console.log(error));
}

function gerarDiasAbas ()
{
    let item = ``

    for (let dia = 2; dia <= 6; dia++) {
        let diaExtenso = tratarDiaSemana(dia)
       item += `<li class="nav-item">
       <a class="nav-link text-uppercase ${dia == 2 ? 'active' : ''}" id="${(diaExtenso)}-tab" data-toggle="tab" href="#${(diaExtenso)}" role="tab" aria-controls="home" aria-selected="true">${(diaExtenso)}</a>
   </li>`
        
    }    
    return item
}

/*async function getAgendaProfissional(dia, idProfissional){
    //let liTeacher = document.querySelector(`#${tratarDiaSemana(dia)}`);
    //liTeacher.innerHTML = ''; 
    await axios
    .get(
        `${URL_BASE}${URI_API_PROFISSIONAL}/getAlocacaoDia/${dia}/${idProfissional}`
        )
        .then((response) => {
            const data = response.data
            console.log('dia semana prof',data)
            let divInsert = document.querySelector(`#${tratarDiaSemana(dia)}`)
            //data.idAlocacao
            data.forEach((elem, indice) => {
                //const li = document.createElement("li");
                divInsert.innerHTML += `                                
                                <p class="mb-0">
                                    ${elem.diaSemana} - ${elem.horaInicio}
                                </p>
                    `;
                })
                
               
                
               
        })
        .catch(error => {
            console.log(error)
        })
        

}*/

async function getAgendaProfissional(dia, idProfissional) {
    try {
        const response = await axios.get(`${URL_BASE}${URI_API_PROFISSIONAL}/getAlocacaoDia/${dia}/${idProfissional}`);
        const data = response.data;
        console.log('dia semana prof', data);

        let divInsertContent = '';
        for (const [indice, elem] of data.entries()) {
            const status = await getAgendaProfissionalAlocada(elem.diaSemana, idProfissional, elem.horaInicio);
            divInsertContent += `
                <tr>
                    <td>${indice + 1}</td>
                    <td>${elem.horaInicio}</td>
                    <td>${status}</td>
                </tr>`;
        };

        return divInsertContent;
    } catch (error) {
        console.log(error);
        return ''; // Ou outra manipulação de erro que seja adequada ao seu caso
    }
}

async function getAgendaProfissionalAlocada(dia, idProfissional, horaInicio) {
    try {
        const response = await axios.get(`${URL_BASE}${URI_API_ATENDIMENTO}/getAgendaProfissionalAlocada/${dia}/${idProfissional}/${horaInicio}`);
        const data = response.data;
        console.log('Resposta da API:', response); // Adicione esta linha para verificar a resposta da API
        console.log('Dados:', data.length); // Adicione esta linha para verificar os dados retornados
        if (Object.keys(data).length === 0) { // Verifica se data está vazio
            return 'Horário Vago';
        }
        return `${data.cns} - ${data.idUsuario}`;
    } catch (error) {
        console.log(error);
        return ''; // Ou outra manipulação de erro que seja adequada ao seu caso
    }
}

/*function gerarConteudoAbas (idProfissional)
{
    //console.log('conteudo',data)
    let item = ``

    for (let dia = 2; dia <= 6; dia++) {
       item += `<div class="tab-pane fade ${dia == 2 ? 'active show' : ''}" id="${tratarDiaSemana(dia)}" role="tabpanel" aria-labelledby="${tratarDiaSemana(dia)}-tab">      
            
            ${getAgendaProfissional(dia,idProfissional)}
       
   </div>`
        
    }    

    
    return item
}*/

async function gerarConteudoAbas(idProfissional) {
    let item = ``;

    for (let dia = 2; dia <= 6; dia++) {
        const conteudo = await getAgendaProfissional(dia, idProfissional);
        item += `<div class="tab-pane fade ${dia == 2 ? 'active show' : ''}" id="${tratarDiaSemana(dia)}" role="tabpanel" aria-labelledby="${tratarDiaSemana(dia)}-tab">      
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Qtde</th>
                        <th scope="col">Hora de início</th>
                        <th scope="col">CNS | Id | Nome Usuário | Data nasc | Idade | CPF</th>
                    </tr>
                </thead>
                <tbody>
                    ${conteudo}
                </tbody>
            </table>
        </div>`;
    }

    document.querySelector('#myTagbContent').innerHTML = item; // Adiciona o conteúdo no elemento
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
