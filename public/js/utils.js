 // Função para construir e adicionar o select ao DOM
 function construirSelect(data, atributo) {   

    // Criar o elemento select
    var selectElement = document.createElement("select");
    selectElement.classList.add('form-control')
    
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
    document.getElementById("modalidades").appendChild(selectElement);
}