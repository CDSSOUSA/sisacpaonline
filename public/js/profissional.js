
const URL_BASE = 'http://localhost/sisacpaonline/public/';
const URI_API_PROFISSIONAL = 'api/profissional';
const URI_API_MODALIDADE = 'api/modalidade';

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
        //console.log(elem.id)
        /*if (elem.status == 'I') {
            display = 'disabled'
            color = 'text-secondary'
        }*/
        //marcador = elem.acompanhante == 'S' ? ' * ' : elem.acompanhante;
        row += `<tr>
                    <td>${elem.nomeProfissional}</td>
                    <td>${elem.cnsProfissional}</td>
                    <td>${elem.cpfProfissional}</td>                                                         
                    <td>${elem.modalidade}</td>   
                    <td>${tratarTipoProfissional(elem.tipoProfissional)}</td>   
                    <td class="text-center">
                        <a href="#/" onclick = "editar_profissional(${elem.idProfissional})" class = "btn bg-teal waves-effect" title = "Editar profissional" data-toggle = "modal" data-target = "#editarProfissional">
                           E
                        </a>
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idProfissional})" class = "btn bg-red waves-effect" title = "Falta Usuário" data-toggle = "modal" data-target = "#modal-lg">
                           F
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

async function editar_profissional(idProfissional) {
    // await axios.get(URL_BASE + '/teacher/delete/' + id)
    //     .then(response => {
    //         const data = response.data;
    //         if (data) {
    //             console.log(data);

    //deleteTeacherModal.show();
  
    const dataModalidade = await getDataModalidade();

    await axios.get(`${URL_BASE}${URI_API_PROFISSIONAL}/getDataProfissional/${idProfissional}`)
    .then(response => {
        var dados = response.data
        console.log(dados)
        //eraseAlert('iLabelHorarioConfirmado')  

        // document.getElementById('iIdUsuarioNome').innerText = `${dados.idUsuario} -  ${dados.nomeUsuario}`
        // document.getElementById('iNomeProfModalidade').innerText = `${dados.nomeProfissional} -  ${dados.modalidade}`
        // document.getElementById('iDiaHoraInicio').innerText = `${dados.diaSemana} -  ${dados.horaInicio}`
        // document.getElementById('iHoraAtendimento').value = `${dados.horaConfirmacao}`

         document.getElementById('idProfissional').value = idProfissional
         document.getElementById('nomeProfissional').value = `${dados['nomeProfissional']}`
         document.getElementById('cnsProfissional').value = `${dados['cnsProfissional']}`
         document.getElementById('conselhoClasse').value = `${dados['numeralConselhoClasse']}`
      
            document.getElementById("modalidades").innerHTML = ''
          
            construirSelect(dataModalidade, dados['modalidade'])

            const genero = document.querySelector('#genero');
            genero.innerHTML = ''

            let checkedMasc = ''
            let checkedFem = ''

            const generoValue = `${dados['genero']}`.toUpperCase();

            if(generoValue === 'M') {
                checkedMasc = 'checked="true"';                    
            } else {
                checkedFem = 'checked="true"';                 
            }           

            let optionGenero = `<input name="nGenero" type="radio" ${checkedMasc} class="with-gap" id="iGeneroMasc" value="M"/>
                <label for="iGeneroMasc">Masc</label>`
                optionGenero += `<input name="nGenero" type="radio" ${checkedFem} id="iGeneroFemi" class="with-gap" value="F"/>
                <label for="iGeneroFemi">Femi</label>`
                genero.innerHTML = optionGenero;
       
        

        
         
         // document.getElementById('acao').value = 'H'
        // document.getElementById('frequencia').value = `${dados.frequencia}`
        // document.getElementById('dataAtendimento').value = `${dados.dataPrevisaoAtendimento}`
        // document.getElementById('dataAtendimentoFake').innerText = `${inverterData(dados.dataPrevisaoAtendimento)}`

        //eraseAlert('msg')       

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
    

    // Chamar a função para construir o select
    //construirSelect();
}

async function getDataModalidade()
{
    const teses = await fetch(`${URL_BASE}${URI_API_MODALIDADE}/getDataModalidade`)
    return await teses.json();
}

function tratarTipoProfissional(tipo){

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

