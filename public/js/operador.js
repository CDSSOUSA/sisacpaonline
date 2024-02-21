const URL_BASE = "http://localhost/sisacpaonline/public/";
const URI_API_OPERADOR = "api/operador";
var data = new Date();
var dia = String(data.getDate()).padStart(2, "0");
var mes = String(data.getMonth() + 1).padStart(2, "0");
var ano = data.getFullYear();
dataAtual = ano + "-" + mes + "-" + dia;
const dataTipo = [
    {
        ident: "O",
        desc: "SECRETÁRIO(A)",
    },
    {
        ident: "A",
        desc: "ADMINISTRADOR(A)",
    },
    {
        ident: "S",
        desc: "SUPER ADMINISTRADOR(A)",
    },
    {
        ident: "P",
        desc: "PROFISSIONAL OPERADOR(A)",
    },
];



listarOperador();

async function listarOperador() {
    //showLoading()
    //idSerie = localStorage.getItem('idSeriesStorege');
    //console.log('carregando localstorage no lisSeries' + idSerie)
    await axios
        .get(`${URL_BASE}${URI_API_OPERADOR}/listarOperador/`)
        .then((response) => {
            const data = response.data;

            console.log("lisata", data);

            const tableOperador = document.querySelector("#tb_operador > tbody");
            if (tableOperador) {
                tableOperador.innerHTML = `${loadDataOperador(data)}`;
            }
        })
        .catch((error) => console.log(error));
}

function loadDataOperador(data) {
    let row = "";
    let display = "";
    let color = "text-white";
    let marcador = "";

    data.forEach((elem, indice) => {
        row += `
                <tr style="${elem.ativo == "N"
                ? "text-decoration: line-through; color:gray;"
                : "text-decoration: none"
            }">    
                <td>${indice + 1}</td>
                    <td>${elem.nomeOperador}${elem.created_at == dataAtual
                ? ' <span class="badge badge-pill badge-primary"> Novo</span>'
                : ""
            }</td>
                    <td>${tratarTipoOperador(elem.tipoOperador)}</td>`
                    row +=`<td class="text-center">`
                    if (elem.ativo === 'S') {
                        row +=`<a href="#/" onclick = "editar_operador('${elem.idOperador
            }')" class = "btn btn-icon btn-primary" title = "Editar Operador" data-toggle = "modal" data-target = "#editarOperadorModal">
                            <i class="feather icon-edit"></i>
                        </a>
                        <a href="#/" onclick = "desativar_operador('${elem.idOperador
            }')" class = "btn btn-icon btn-danger" title = "Desativar Operador" data-toggle = "modal" data-target = "#desativarOperadorModal">
                            <i class="feather icon-trash"></i>
                        </a>
                        <a href="#/" onclick = "permitir_operador('${elem.idOperador
            }')" class = "btn btn-icon btn-warning" title = "Permitir Operador" data-toggle = "modal" data-target = "#permitirOperadorModal">
                            <i class="fa fa-lock"></i>
                        </a>
                    `
        } else {
            row += `<a href="#/" onclick = "ativar_operador('${elem.idOperador}')" class = "btn btn-icon btn-success" title = "Ativar Operador">
            <i class="feather icon-check"></i>
                        </a>`
                    }                                       
                });
                row +=`</td></tr>`;

    return row;
}

async function permitir_operador(idOperador) {
    await axios
        .get(
            `${URL_BASE}${URI_API_OPERADOR}/getMenuPermissaoOperador/${idOperador}`
        )
        .then((response) => {
            const dados = response.data;

            const nomeOperadorPermissao = document.querySelector("#nomeOperadorPermissao")
            nomeOperadorPermissao.textContent = dados.NOME

            // Seleciona o elemento onde os resultados serão exibidos
            var resultadoDiv = document.getElementById("resultado"); 

            // Limpa o conteúdo existente
            resultadoDiv.innerHTML = '';

            delete dados.NOME;

            // Itera sobre as chaves do objeto 'dados' (nomes dos operadores)
            for (var operador in dados) {
                if (dados.hasOwnProperty(operador)) {
                    // Cria um elemento de título para o operador
                    var divP = document.createElement("div");
                    divP.classList.add("col-md-6", "col-xl-6");

                    var divCard = document.createElement("div");
                    divCard.classList.add("card", "bg-light");

                    divP.appendChild(divCard);

                    var operadorTitulo = document.createElement("h5");
                    operadorTitulo.classList.add("card-header");
                    operadorTitulo.textContent = `Menu: ${operador}`;

                    divCard.appendChild(operadorTitulo);

                    resultadoDiv.appendChild(divP);

                    // Cria um novo divCardBody para cada operador
                    var divCardBody = document.createElement("div");
                    divCardBody.classList.add("card-body");

                    // Itera sobre os menus e permissões do operador
                    var permissoes = dados[operador];
                    for (var i = 0; i < permissoes.length; i++) {
                        var permissao = permissoes[i];

                        var parag = document.createElement("p");

                        if (permissao.ativo != null) {
                            parag.innerHTML = `${permissao.nomeMenu} <a onclick="removerPermissao('${idOperador}', '${permissao.idPermissao}')" title="Remover Permissão" href="#"><span class="badge badge-pill badge-danger">Remover</span></a>`;
                        } else {
                            parag.innerHTML = `${permissao.nomeMenu} <a onclick="adicionarPermissao('${idOperador}', '${permissao.idPermissao}')" title="Adicionar Permissão" href="#"><span class="badge badge-pill badge-success">Adicionar</span></a>`;
                        }

                        divCardBody.appendChild(parag);
                    }

                    // Adiciona divCardBody ao divCard
                    divCard.appendChild(divCardBody);
                }
            }
        })
        .catch((error) => console.log(error));
}
async function editar_operador(idOperador){

    await axios
        .get(
            `${URL_BASE}${URI_API_OPERADOR}/getDataOperadorId/${idOperador}`
        )
        .then((response) => {
            const dados = response.data; 
            console.log(dados)         

            document.querySelector("#iNomeOperador").value = dados[0].nomeOperador;
            
            construirSelect(
                dataTipo,
                tratarTipoOperador(dados[0]["tipoOperador"]),
                "operadores",
                "nTipoOperador"
            );

            document.querySelector('#idOperadorEdit').value =dados[0].idOperador
            document.querySelector('#idEdit').value =dados[0].id
            document.querySelector('#iIdentificador').value =dados[0].identificador

        }).catch((error)=>{
            console.log(error)
        })
}
async function desativar_operador(idOperador){

    await axios
        .get(
            `${URL_BASE}${URI_API_OPERADOR}/getDataOperadorId/${idOperador}`
        )
        .then((response) => {
            const dados = response.data; 
            console.log(dados)         

            document.querySelector("#iNomeOperadorDesativar").textContent = dados[0].nomeOperador;            
           

            document.querySelector('#idOperadorDesativar').value =dados[0].idOperador
            document.querySelector('#idDesativar').value =dados[0].id
           

        }).catch((error)=>{
            console.log(error)
        })
}

function tratarTipoOperador(tipo) {
    switch (tipo) {
        case "O":
            return "SECRETÁRIO(A)";
        case "A":
            return "ADMINISTRADOR(A)";
        case "S":
            return "SUPER ADMINISTRADOR(A)";
        case "P":
            return "PROFISSIONAL OPERADOR(A)";
    }
    return "";
}
