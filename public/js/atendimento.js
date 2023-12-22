
localStorage.setItem('dataAtendimento', localStorage.getItem('dataAtendimento'))

var dataAtendimento = localStorage.getItem('dataAtendimento');

const eraseAlert = (option) => {

    if (typeof option == 'string') {
        document.getElementById(option).innerHTML = '';
    } else {
        option.forEach((e) => {
            document.getElementById(e).innerHTML = '';
        })
    }
}


const URL_BASE = 'http://localhost/sisacpaonline/public/api/atendimento'

listarAtendimentos(dataAtendimento);


async function listarAtendimentos(dataAtendimento) {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios.get(`${URL_BASE}/listarAtendimentos/${dataAtendimento}`)
        .then(response => {
            const data = response.data;
            console.log(data);
            
            document.querySelector("#tb_series_schedule > tbody").innerHTML = `${loadDataSeries(data)}`;
            //document.getElementById('li_series').innerHTML = list(data)
            //document.getElementById('amount_series').innerHTML = `  + ${data.length}`
            //showSeries(idSerie)
            //hideLoading();
        }
        )
        .catch(error => console.log(error))
}

function loadDataSeries(data) {

    let row = ''
    let display = ''
    let color = 'text-white'
    let marcador = ''

    //if (data) {
    data.forEach((elem, indice) => {
        //console.log(elem.id)
        /*if (elem.status == 'I') {
            display = 'disabled'
            color = 'text-secondary'
        }*/
        marcador = elem.acompanhante == 'S' ? ' * ' : elem.acompanhante;
        row += `<tr>
                    <td><span title="Acompanhante" class="font-bold">${marcador}</span>${elem.idUsuario} - ${elem.nomeUsuario}</td>
                    <td>${elem.nomeProfissional}</td>
                    <td>${elem.modalidade}</td>                                                         
                    <td>${elem.horaInicio}</td>   
                    <td class="text-center">
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idAtendimento})" class = "btn bg-teal waves-effect" title = "Confirmar atendimento" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                           C
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idAtendimento})" class = "btn bg-red waves-effect" title = "Falta Usuário" data-toggle = "modal" data-target = "#modal-lg">
                           F
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idAtendimento})" class = "btn bg-orange waves" title = "Falta Profissional" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                            P
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idAtendimento})" class = "btn bg-indigo waves-effect" title = "Escrever observação" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                            O
                        </a>
                    </td>                                       
                </tr>`

    }) 

    return row;
}

const formAtendimentoAnterior = document.getElementById('formAtendimentoAnterior');

//async function atendimentosAnterior (){
    if (formAtendimentoAnterior) {
        formAtendimentoAnterior.addEventListener("submit", async (e) => {
            e.preventDefault();
    
            const dataForm = new FormData(formAtendimentoAnterior);
            console.log(dataForm);
            await axios.post(`${URL_BASE}/atendimentosAnterior`, dataForm, {
                headers: {
                    "Content-Type": "application/json"                
                }
            })
                .then(response => {
                    var data = response.data
                    console.log(response.data);
                    if (data.length > 0) {

                        localStorage.setItem('dataAtendimento', data[0].dataPrevisaoAtendimento)
                        showLoading()

                        window.location.href = `http://localhost/sisacpaonline/public/atendimento/listar_atendimento`
    
                        //console.log(response.data.error)
                        //document.getElementById('iLabelHorarioConfirmado').innerHTML = response.data.msgs.nHoraAtendimento
                        //document.getElementById('iHoraAtendimento').value = '00:00'
                        //editSerieForm.reset();
                        /*validateErros(response.data.msgs.description, 'fieldAlertErrorDescriptionSeriesEdit')
                        validateErros(response.data.msgs.classification, 'fieldAlertErrorTurmaEdit')
                        validateErros(response.data.msgs.series, 'fieldAlertDuplicativeEdit')
                        //validateErros(response.data.msgs.name, 'fieldlertErrorEditName')*/
                    } else {

                        document.getElementById('erroData').innerHTML = `Não existem atendimentos nesta data: "${dataForm.get('nDataAtendimento')}"`

                        //localStorage.setItem('dataAtendimento', '2023-09-30')
                        
                        //activeSeriesModal.hide();
                        //editSerieForm.reset();
                        //$('#registrarPresencaUsuario').modal('hide')
                        /*document.getElementById('msg').innerHTML = `
                        <div class="alert alert-show bg-teal alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Nenhum registro encontrado, ação realizada com sucesso!
                        </div>`*/
                        //addSeriesForm.reset();
                        //editSerieModal.hide()
                        //localStorage.setItem('idSeriesStorege', response.data.id)
                        //loadToast(typeSuccess, titleSuccess, messageSuccess);
                        
                        //window.location.href = `http://localhost/sisacpaonline/public/atendimento/listar_atendimento`
    
                        //listarAtendimentos(data[0].dataPrevisaoAtendimento);
                    }
                })
    
        })
    }
//}

function showLoading(){
    const div = document.createElement("div")
    //div.classList.add("loadOi");
    div.classList.add("loadding");
    div.setAttribute("id","loadding");
    //div.style.display = "flex"
    
    const divi = document.createElement("div")
    divi.classList.add("lds-ellipsis");
    divi.innerHTML = '<div></div><div></div><div></div><div></div>'
    //const span = document.createElement("span")
    //span.classList.add("loa")
    //span.innerText = "Carregando ..."
    // const label = document.createElement("label");
    // label.innerText = "Carregando..."
    div.appendChild(divi);
    //div.appendChild(span);
    document.body.appendChild(div)
    //const loadings = document.getElementsByClassName("page-loader-wrapper")
   // alert('oi')

/* <div class="loadOi" id="loadOi">
  <div class="ring">
  </div>
  <span class="loa"> Atualizando... </span>    
</div>   */

   //const load = document.getElementById('loadOi').style.display = "flex";
}



async function confirmarPresencaUsuarioHorario(idAtendimento) {
    // await axios.get(URL_BASE + '/teacher/delete/' + id)
    //     .then(response => {
    //         const data = response.data;
    //         if (data) {
    //             console.log(data);

    //deleteTeacherModal.show();
  
    

    await axios.get(`${URL_BASE}/getDataAtendimento/${idAtendimento}`)
    .then(response => {

        var dados = response.data
        console.log(dados)
        eraseAlert('iLabelHorarioConfirmado')  

        document.getElementById('iIdUsuarioNome').innerText = `${dados.idUsuario} -  ${dados.nomeUsuario}`
        document.getElementById('iNomeProfModalidade').innerText = `${dados.nomeProfissional} -  ${dados.modalidade}`
        document.getElementById('iDiaHoraInicio').innerText = `${dados.diaSemana} -  ${dados.horaInicio}`
        document.getElementById('iHoraAtendimento').value = `${dados.horaConfirmacao}`

        document.getElementById('idAtendimento').value = idAtendimento
        document.getElementById('dia').value = `${dados.diaSemanaPuro}`
        document.getElementById('acao').value = 'H'
        document.getElementById('frequencia').value = `${dados.frequencia}`
        document.getElementById('dataAtendimento').value = `${dados.dataPrevisaoAtendimento}`
        document.getElementById('dataAtendimentoFake').innerText = `${inverterData(dados.dataPrevisaoAtendimento)}`

        eraseAlert('msg')       

        //document.getElementById(locale).innerText = `${response.data[0].description}º${response.data[0].classification} - ${convertShift(response.data[0].shift)}`

        //shiftGlobal = response.data[0].shift
    })
    .catch(error => console.log(error))

    //getDataTeacher(id, 'nameTeacher')
    //          </div>`

    //         }
    //     })
    //     .catch(error => console.log(error))
    // //deleteModal.show()
}

function inverterData(data) {
    // Dividir a data em ano, mês e dia
    const partes = data.split('-');
    
    // Reorganizar as partes da data no novo formato
    const dataInvertida = `${partes[2]}/${partes[1]}/${partes[0]}`;
    
    return dataInvertida;
  }

const editSerieForm = document.getElementById('editSeriesForm');
console.log(editSerieForm);

if (editSerieForm) {
    editSerieForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dataForm = new FormData(editSerieForm);
        console.log(dataForm);
        await axios.post(`${URL_BASE}/confirmaPresencaUsuarioHorario`, dataForm, {
            headers: {
                "Content-Type": "application/json"                
            }
        })
            .then(response => {
                console.log(response.data);
                if (response.data.error) {

                    console.log(response.data.error)
                    document.getElementById('iLabelHorarioConfirmado').innerHTML = response.data.msgs.nHoraAtendimento
                    //document.getElementById('iHoraAtendimento').value = '00:00'
                    //editSerieForm.reset();
                    /*validateErros(response.data.msgs.description, 'fieldAlertErrorDescriptionSeriesEdit')
                    validateErros(response.data.msgs.classification, 'fieldAlertErrorTurmaEdit')
                    validateErros(response.data.msgs.series, 'fieldAlertDuplicativeEdit')
                    //validateErros(response.data.msgs.name, 'fieldlertErrorEditName')*/
                } else {
                    //activeSeriesModal.hide();
                    editSerieForm.reset();
                    $('#registrarPresencaUsuario').modal('hide')
                    document.getElementById('msg').innerHTML = `
                                <div class="alert alert-show bg-teal alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Parabéns, ação realizada com sucesso!
                                </div>`
                    //addSeriesForm.reset();
                    //editSerieModal.hide()
                    //localStorage.setItem('idSeriesStorege', response.data.id)
                    //loadToast(typeSuccess, titleSuccess, messageSuccess);

                    listarAtendimentos(dataForm.get('nDataAtendimento'));
                }
            })

    })
}
