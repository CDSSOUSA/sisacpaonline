
const URL_BASE = 'http://localhost/sisacpaonline/public/';
const URI_API_PROFISSIONAL = 'api/profissional';
const URI_API_MODALIDADE = 'api/modalidade';
const dataTipo = [
    {
        'ident': 'F',
        'desc': 'FUNCIONARIO'
    },
    {
        'ident': 'V',
        'desc': 'VOLUNTÁRIO'
    },
    {
        'ident': 'O',
        'desc': 'OUTROS'
    }
]

listarProfissionais();

async function listarProfissionais() {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios.get(`${URL_BASE}${URI_API_PROFISSIONAL}/listarProfissional/`)
        .then(response => {
            const data = response.data;
            console.log(data);

            document.querySelector("#tb_profissionais > tbody").innerHTML = `${loadDataProfissional(data)}`;
            //document.getElementById('li_series').innerHTML = list(data)
            //document.getElementById('amount_series').innerHTML = `  + ${data.length}`
            //showSeries(idSerie)
            //hideLoading();
        }
        )
        .catch(error => console.log(error))
}

function loadDataProfissional(data) {

    let row = ''
    let display = ''
    let color = 'text-white'
    let marcador = ''

    //if (data) {
    data.forEach((elem, indice) => {
      
        /*if (elem.status == 'I') {
            display = 'disabled'
            color = 'text-secondary'
        }*/
        //marcador = elem.acompanhante == 'S' ? ' * ' : elem.acompanhante;
        row += `<tr>
                    <td>${elem.nomeProfissional}</td>
                    <td>${tratarFieldNull(elem.cnsProfissional)}</td>
                    <td>${elem.cpfProfissional}</td>                                                         
                    <td>${elem.modalidade}</td>   
                    <td>${tratarTipoProfissional(elem.tipoProfissional)}</td>   
                    <td class="text-center">
                        <a href="" onclick = "editar_profissional('${elem.idProfissional}')" class = "btn bg-teal waves-effect" title = "Editar profissional" data-toggle = "modal" data-target = "#editarProfissional">
                           E
                        </a>
                        <a href="#/" onclick = "ativar_desativar_profissional('${elem.idProfissional}','N')" class = "btn bg-red waves-effect" title = "Ativar Profissional" data-toggle = "modal" data-target = "#ativarDesativarProfissional">
                           D
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idProfissional})" class = "btn bg-orange waves" title = "Falta Profissional" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                            P
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idProfissional})" class = "btn bg-indigo waves-effect" title = "Escrever observação" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                            O
                        </a>
                    </td>                                       
                </tr>`

    })

    return row;
}
async function ativar_desativar_profissional(idProfissional,status){

    clearMessageErrorAll()   

    await axios.get(`${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`)
        .then(response => {
            var dados = response.data           
            document.getElementById('idProfissionalAtivaDesativa').value =  idProfissional
            document.getElementById('statusAtivaDesativa').value = `${dados['ativo']== 'S'? 'N' : 'S'}` 
            document.getElementById('nomeProfissionalAtivaDesativa').value = `${dados['nomeProfissional']}` 
           
        })
        .catch(error => console.log(error))
}

const ativarDesativarProfissionalForm = document.getElementById('ativarDesativarProfissionalForm');
console.log(ativarDesativarProfissionalForm);

if (ativarDesativarProfissionalForm) {
    ativarDesativarProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(ativarDesativarProfissionalForm);

        await axios.post(`${URL_BASE}${URI_API_PROFISSIONAL}/ativa_desativa_profissional`, dataForm, {
            headers: {
                "Content-Type": "application/json"                
            }
        }).then(response => {
            console.log(response.data);
            if (response.data.error) {
                showAlertToast(false, 'Erros no preechimento!');  
                console.log(response.data.error)
                validateErros(response.data.msgs.nNomeProfissional, 'iNomeProfissional')
                validateErros(response.data.msgs.nCpfProfissional, 'iCpfProfissional')
                validateErros(response.data.msgs.nCnsProfissional, 'iCnsProfissional')
                validateErros(response.data.msgs.nTipoProfissional, 'iTipoProfissional')
                validateErros(response.data.msgs.nModalidade, 'iModalidadeProfissional')
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
                ativarDesativarProfissionalForm.reset();
                //editProfissionalForm.hide();
                $('#ativarDesativarProfissional').modal('hide')
               
                //addSeriesForm.reset();
                //editSerieModal.hide()
                //localStorage.setItem('idSeriesStorege', response.data.id)
                //loadToast(typeSuccess, titleSuccess, messageSuccess);

                listarProfissionais();
            }
        })
    });
}

async function editar_profissional(idProfissional) {

    clearMessageErrorAll()   

    const dataModalidade = await getDataModalidade();  

    await axios.get(`${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`)
        .then(response => {
            var dados = response.data
           
            document.getElementById('idProfissional').value =  idProfissional
            document.getElementById('nomeProfissional').value = `${dados['nomeProfissional']}`
            document.getElementById('cnsProfissional').value = tratarFieldNull(`${dados['cnsProfissional']}`)
            document.getElementById('cpfProfissional').value = tratarFieldNull(`${dados['cpfProfissional']}`)
            document.getElementById('conselhoClasse').value = `${dados['numeralConselhoClasse']}`

            construirSelect(dataModalidade, dados['modalidade'], "modalidades", 'nModalidade')

            construirSelect(dataTipo, tratarTipoProfissional(dados['tipoProfissional']), "tipos", 'nTipoProfissional')

            const genero = document.querySelector('#genero');
            genero.innerHTML = ''

            let checkedMasc = ''
            let checkedFem = ''

            const generoValue = `${dados['genero']}`.toUpperCase();

            if (generoValue === 'M') {
                checkedMasc = 'checked="true"';
            } else {
                checkedFem = 'checked="true"';
            }

            let optionGenero = `<input name="nGenero" type="radio" ${checkedMasc} class="with-gap" id="iGeneroMasc" value="M"/>
                <label for="iGeneroMasc">Masc</label>`
            optionGenero += `<input name="nGenero" type="radio" ${checkedFem} id="iGeneroFemi" class="with-gap" value="F"/>
                <label for="iGeneroFemi">Femi</label>`
            genero.innerHTML = optionGenero;
           
        })
        .catch(error => console.log(error))
}

const editProfissionalForm = document.getElementById('editProfissionalForm');
console.log(editProfissionalForm);

if (editProfissionalForm) {
    editProfissionalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(editProfissionalForm);

        await axios.post(`${URL_BASE}${URI_API_PROFISSIONAL}/edita_profissional`, dataForm, {
            headers: {
                "Content-Type": "application/json"                
            }
        }).then(response => {
            console.log(response.data);
            if (response.data.error) {
                showAlertToast(false, 'Erros no preechimento!');  
                console.log(response.data.error)
                validateErros(response.data.msgs.nNomeProfissional, 'iNomeProfissional')
                validateErros(response.data.msgs.nCpfProfissional, 'iCpfProfissional')
                validateErros(response.data.msgs.nCnsProfissional, 'iCnsProfissional')
                validateErros(response.data.msgs.nTipoProfissional, 'iTipoProfissional')
                validateErros(response.data.msgs.nModalidade, 'iModalidadeProfissional')
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
                $('#editarProfissional').modal('hide')
               
                //addSeriesForm.reset();
                //editSerieModal.hide()
                //localStorage.setItem('idSeriesStorege', response.data.id)
                //loadToast(typeSuccess, titleSuccess, messageSuccess);

                listarProfissionais();
            }
        })
    });
}


async function editProfissional(){

}

async function getDataModalidade() {
    const teses = await fetch(`${URL_BASE}${URI_API_MODALIDADE}/getDataModalidade`)
    return await teses.json();
}

function tratarTipoProfissional(tipo) {

    switch (tipo) {
        case 'V':
            return 'VOLUNTARIO'
        case 'F':
            return 'FUNCIONARIO'
        case 'O':
            return 'OUTROS'
    }
    return ''
}
