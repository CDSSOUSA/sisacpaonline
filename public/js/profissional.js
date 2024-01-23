
const URL_BASE = 'http://localhost/sisacpaonline/public/api/profissional';

listarProfissionais();

async function listarProfissionais() {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios.get(`${URL_BASE}/listarProfissional/`)
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
                        <a href="#/" onclick = "confirmarPresencaUsuarioHorario(${elem.idProfissional})" class = "btn bg-teal waves-effect" title = "Confirmar atendimento" data-toggle = "modal" data-target = "#registrarPresencaUsuario">
                           C
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

function tratarTipoProfissional(tipo){
    return tipo
}