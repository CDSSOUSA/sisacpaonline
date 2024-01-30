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
    const fields = document.querySelectorAll('.messageErro');
    fields.forEach((item)=>{
        item.innerHTML = '';
    })
}

const validateErros = (errors, locale) => {
    let r = document.getElementById(locale).innerHTML = '';
    if (errors) {
        r = document.getElementById(locale).innerHTML = `<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ${errors}!`
    }
    return r;
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
