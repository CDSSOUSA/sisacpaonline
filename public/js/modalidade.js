const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_MODALIDADE = "api/modalidade";
var data = new Date();
var dia = String(data.getDate()).padStart(2, '0');
var mes = String(data.getMonth() + 1).padStart(2, '0');
var ano = data.getFullYear();
dataAtual = ano + '-' + mes + '-' + dia;



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

            const tableModalidade = document.querySelector("#tb_modalidade > tbody")
            if(tableModalidade){
                tableModalidade.innerHTML = `${loadDataModalidade(data)}`;                
            }
            

        })
        .catch((error) => console.log(error));
}



function loadDataModalidade(data) {
    let row = "";
    let display = "";
    let color = "text-white";
    let marcador = ""; 
   
    data.forEach((elem, indice) => {
        row += `
                <tr style="${elem.ativo == "INATIVO" ? "text-decoration: line-through; color:gray;" : "text-decoration: none"}">    
                <td>${indice+1}</td>
                    <td>${elem.nomeModalidade}${elem.created_at == dataAtual ? ' <span class="badge badge-pill badge-primary"> Novo</span>' :'' }</td>
                    <td>${elem.cbo}</td>
                    <td class="text-center">
                        <a href="#/" onclick = "editar_modalidade('${elem.idModalidade}')" class = "btn btn-icon btn-primary" title = "Editar modalidade" data-toggle = "modal" data-target = "#editarModalidadeModal">
                            <i class="feather icon-edit"></i>
                        </a>
                    </td>                                       
                </tr>`;
    });   

    return row;
}

async function editar_modalidade(idModalidade){
    clearMessageErrorAll();
    await axios
        .get(
            `${URL_BASE}${URI_API_MODALIDADE}/getDataModalidadeId/${idModalidade}`
        )
        .then((response) => {
            const data = response.data; 

            console.log(data)
            
            document.querySelector('#iDescricao').value = `${data[0]['nomeModalidade']}`
            document.querySelector('#iCbo').value = `${data[0]['cbo']}`
            document.querySelector('#idModalidade').value = `${data[0]['idModalidade']}`

            
        })
        .catch((error) => console.log(error));

}

const editModalidadeForm = document.getElementById("editModalidadeForm");
if (editModalidadeForm) {
    editModalidadeForm.addEventListener("submit", async (e) => {
       
        e.preventDefault();

        const dataForm = new FormData(editModalidadeForm);

        await axios
            .post(`${URL_BASE}${URI_API_MODALIDADE}/edita_modalidade`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {

                const data = response;

                if (data.data.error == true) {
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
                    editModalidadeForm.reset();                    
                    $("#editarModalidadeModal").modal("hide");
                    listarModalidade();
                }
            });
    });
}

