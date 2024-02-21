 // Função para construir e adicionar o select ao DOM
 function construirSelect(data, atributo, field, nameData) {  

    document.getElementById(field).innerHTML = ''
    // Criar o elemento select
    var selectElement = document.createElement("select");
    selectElement.classList.add('form-control')
    selectElement.setAttribute('name', nameData);
    
    // Iterar sobre o array de opções e criar elementos option
    for (var i = 0; i < data.length; i++) {

        var obj = data[i];
        var keys = Object.keys(obj);       

        var optionElement = document.createElement("option");
        console.log('valor array',data[i][keys[1]])
        console.log('atributo', atributo)
        if (data[i][keys[1]] === atributo) {
            optionElement.selected = true;
        }
        optionElement.value = obj[keys[0]]; // Valor da opção
        optionElement.text = obj[keys[1]]; // Texto da opção
        selectElement.appendChild(optionElement); // Adicionar a opção ao select
    }
  

    // Adicionar o select ao container (div, por exemplo)
    document.getElementById(field).appendChild(selectElement);
}

function tratarFieldNull(fieldData){

    if(fieldData == null || fieldData == 'null'){
        return ''
    }
    return fieldData;
}

const clearMessageErrorAll = () => {
    const fields = document.querySelectorAll('.text-danger');
    fields.forEach((item)=>{
        item.innerHTML = '';
    })    
}

const clearInput = (option) => {

    if (typeof option == 'string') {
        document.querySelector(`#${option}`).value = '';
    } else {
        option.forEach((e) => {
            document.querySelector(`#${e}`).value = '';
        })
    }
    
    //document.querySelector('#option').value = '';
}


const validateErros = (errors, locale) => {
    let r = document.getElementById(locale).innerHTML = '';
    if (errors) {
        r = document.getElementById(locale).innerHTML = `<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ${errors}!`
    }
    return r;
}

const validateErrosInput = (errors, locale) => {
    let r = document.querySelector(`#${locale}`)
    if(errors) {
        r.classList.add('required')
    }
}

const clearInputSelectError = (option) => {
    if (typeof option == 'string') {
        document.getElementById(option).classList.remove('required')
    } else {
        option.forEach((e) => {
            document.getElementById(e).classList.remove('required')
        })
    } 
}

const clearMessageError = (option) => {

    if (typeof option == 'string') {
        document.getElementById(option).innerHTML = '';
    } else {
        option.forEach((e) => {
            document.getElementById(e).innerHTML = '';
        })
    }
}

function showAlertToast(status, message) {

    var text = '';
    if(message){
        text = message
    }

    console.log('status',status)

    toastr.options = {
      closeButton: true, // Exibir botão de fechar
      positionClass: 'toast-top-right',
      timeOut: 3000,
      progressBar: true, // Posição da notificação (pode ser 'toast-top-right', 'toast-top-left', 'toast-bottom-right', 'toast-bottom-left', etc.)
    };
  
    if (status) {
      toastr.success(`<b>Parabéns! <br>Operação realizada com sucesso!</b><br>${text}`);
    } else {
      toastr.error(`<b>Ops! ${text}</b>`);
    }
  
}
function tratarDiaSemana(dia, pExt)
{
    diaSemana = "";
    switch (dia) {
        case 2:
            diaSemana = pExt ? "segunda-feira" : "SEG";
            break;
        case 3:
            diaSemana = pExt ? "terça-feira" : "TER";
            break;
        case 4:
            diaSemana = pExt ? "quarta-feira" : "QUA";
            break;
        case 5:
            diaSemana = pExt ? "quinta-feira" : "QUI";
            break;
        case 6:
            diaSemana = pExt ? "sexta-feira" : "SEX";
            break;
    }    
    return diaSemana;
}