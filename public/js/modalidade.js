const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_MODALIDADE = "api/modalidade";



const cadastrarModalidadeForm = document.getElementById("cadastrarModalidadeForm");

if(cadastrarModalidadeForm){

    cadastrarModalidadeForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(cadastrarModalidadeForm);

        await axios
            .post(`${URL_BASE}${URI_API_MODALIDADE}/cadastrar_modalidade`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
              
                if (response.data.error) {
                   
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(
                        response.data.msgs.nDescricaoModalidade,
                        "iErrorDescricao"
                    );
                   
                    validateErros(
                        response.data.msgs.nCbo,
                        "iErrorCbo"
                    );                   
                    
                } else {

                    showAlertToast(true);                    
                    cadastrarModalidadeForm.reset();

                    setTimeout(function() {
                        window.location.href = `${URL_BASE}modalidade/form_editar_modalidade`;
                    }, 2000); 
                }
            }).catch((error) =>{                
                showAlertToast(false, error);
            }) 
    })

}

listarModalidade();

async function listarModalidade() {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios
        .get(`${URL_BASE}${URI_API_MODALIDADE}/listarModalidade/`)
        .then((response) => {
            const data = response.data;

            //console.log('lisata', data)

            document.querySelector(
                "#tb_modalidade > tbody"
            ).innerHTML = `${loadDataModalidade(data)}`;

            document.querySelector("#totalModalidade").textContent = `Total de modalidades :: ${data.length}`;
        })
        .catch((error) => console.log(error));
}

var data = new Date();
var dia = String(data.getDate()).padStart(2, '0');
var mes = String(data.getMonth() + 1).padStart(2, '0');
var ano = data.getFullYear();
dataAtual = ano + '-' + mes + '-' + dia;

function loadDataModalidade(data) {
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
                    <td>${elem.nomeModalidade}${elem.created_at == dataAtual ? ' <span class="badge badge-pill badge-primary"> Novo</span>' :'' }</td>
                    <td>${elem.cbo}</td>
                    <td class="text-center">
                    `;

      
            row += `<a href="#/" onclick = "editar_modalidade('${elem.idProfissional}')" class = "btn btn-icon btn-primary" title = "Editar modalidade" data-toggle = "modal" data-target = "#editarModalidade">
                           <i class="feather icon-edit"></i>
                        </a>
                        `
       
        row += `                      
                    </td>                                       
                </tr>`;
    });

    

    return row;
}
