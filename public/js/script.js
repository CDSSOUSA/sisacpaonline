/*DESATIVA OS CAMPOS DE PESQUISA DO USUARIO   */

/*$('#iFrequentaSim').onLoad(function() {        
    checkedSim = document.querySelector("#iFrequentaSim");
    alert(checkedSim);
    div = document.querySelector("#iTipoEscola");
    if (checkedSim === 'S') {     
        div.style.display = "block";            

    } 

    $("#_1234").prop("checked", true);

});*/


$("#iCodigo").focus(function() {
    $('#iNome').val('');
    $('#iDataAtendimento').val('');
    $('#iProfissional').val('').selectpicker('refresh');
});

$("#iNome").focus(function() {
    $('#iCodigo').val('');
});

$("#iDataAtendimento").focus(function() {
    $('#iCodigo').val('');
    $('#iProfissional').val('').selectpicker('refresh');
});

$("#iProfissional").focus(function() {
    $('#iCodigo').val('');
    $('#iDataAtendimento').val('');
});


/* MASCARAS*/

$('.cns').mask('999.9999.9999.9999');
$('.cpf').mask('000.000.000-00');
$('.nis').mask('000.00000.00-0');
$('.cep').mask('00000000');
$('.apenasNumero').mask('99999');
$('.numeroRegistro').mask('999999');
$('.numeroMaxDois').mask('99');
$('.data').mask('99/99/9999');
//$('.hora').mask('99:99:00');
$('.minutos').mask('999');
//$('.moeda').maskMoney({showSymbol: true, thousands: '.', decimal: ',', symbolStay: true});
var mask = function(val) {
    val = val.split(":");
    return (parseInt(val[0]) > 19) ? "HZ:M0" : "H0:M0";
}

pattern = {
    onKeyPress: function(val, e, field, options) {
        field.mask(mask.apply({}, arguments), options);
    },
    translation: {
        'H': {pattern: /[0-2]/, optional: false},
        'Z': {pattern: /[0-3]/, optional: false},
        'M': {pattern: /[0-5]/, optional: false}
    },
    // placeholder: 'hh:mm'
};

$(".hora").mask(mask, pattern);


var SPMaskBehavior = function(val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

$('.telefone').mask(SPMaskBehavior, spOptions);

/* ALERT*/
$(".alert-show").show();
setTimeout(function() {
    $(".alert-show").fadeOut();
}, 6000);
$(".alert-show-60000").show();
setTimeout(function() {
    $(".alert-show").fadeOut();
}, 60000);

/* DATAS*/
$('.data').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    // startDate: "<?php echo date("d - m - Y"); ?>",
    endDate: "<?php echo date('d-m-Y');?>",
    //todayHighlight: true,
    orientation: 'auto bottom',
    autoclose: true,
    darktheme: true
            //daysOfWeekDisabled: '0,6',
            //orientation: 'bottom'
});

/* BUSCA CEP*/
$('#iCep').blur(function() {
    $.getJSON("https://viacep.com.br/ws/" + $('#iCep').val() + "/json",
            function(dados) {
                if (!("erro" in dados)) {
                    $("#iLogradouro").val(dados.logradouro);
                    $("#iBairro").val(dados.bairro);
                    //$("#iCodigoIbge").val(dados.ibge);
                    $("#iNumeroLogradouro").focus();
                } else {
                    alert("CEP não encontrado.");
                    $("#iLogradouro").val("").focus();
                    //$("#iBairro").val("");
                    //$("#iCodigoIbge").val("");
                    //$("#iNumeroLogradouro");
                }
            });
});

/* AJUSTAR OS CAMPOS DE RESPONSAVEL*/
$(document).ready(function() {
    $('#iMaeResp').click(function() {
        checkedOpcao = $("input[name='nMaeResp']:checked").val();       
        if (checkedOpcao === 'S') {
            //$('#iGrauParentesco'). val('MAE');            
            $('#iNomeResp').val($('#iNomeMae').val());
            $('#iDataNascimentoResp').val($('#iDataNascimentoMae').val());
            $('#iTelefoneResp').val($('#iTelefoneMae').val());
            $('#iProfissaoResp').val($('#iProfissaoMae').val());
            $('#iRgResp').val($('#iRgMae').val());
            $('#iCpfResp').val($('#iCpfMae').val());
            $('#iEscolaridadeResp').val($('#iEscolaridadeMae').val());
            $('#iPlanoSaudeResp').val($('#iPlanoSaudeMae').val());
            $("#iPaiResp").prop("checked", false);
           
        }  else {
            $('#iGrauParentesco'). val('');            
            $('#iNomeResp').val('');
            $('#iDataNascimentoResp').val('');
            $('#iTelefoneResp').val('');
            $('#iProfissaoResp').val('');
            $('#iRgResp').val('');
            $('#iCpfResp').val('');
            $('#iEscolaridadeResp').val('');
            $('#iPlanoSaudeResp').val('');
        }

    });
});
$(document).ready(function() {
    $('#iPaiResp').click(function() {        
        checkedPai = $("input[name='nPaiResp']:checked").val();
        if (checkedPai === 'S') {
            //$('#iGrauParentesco'). val('PAI');            
            $('#iNomeResp').val($('#iNomePai').val());
            $('#iDataNascimentoResp').val($('#iDataNascimentoPai').val());
            $('#iTelefoneResp').val($('#iTelefonePai').val());
            $('#iProfissaoResp').val($('#iProfissaoPai').val());
            $('#iRgResp').val($('#iRgPai').val());
            $('#iCpfResp').val($('#iCpfPai').val());
            $('#iEscolaridadeResp').val($('#iEscolaridadePai').val());
            $('#iPlanoSaudeResp').val($('#iPlanoSaudePai').val());
            $("#iMaeResp").prop("checked", false);
           
        }  else {
            $('#iGrauParentesco'). val('');            
            $('#iNomeResp').val('');
            $('#iDataNascimentoResp').val('');
            $('#iTelefoneResp').val('');
            $('#iProfissaoResp').val('');
            $('#iRgResp').val('');
            $('#iCpfResp').val('');
            $('#iEscolaridadeResp').val('');
            $('#iPlanoSaudeResp').val('');
        }

    });

    
    
});

    

$(document).ready(function() {
    $('#iPossuiAlergiaNao').click(function() {        
        checkedNao = $("input[name='nPossuiAlergia']:checked").val();
        if (checkedNao === 'N') {
            $('#iAlergia'). val('').attr('readonly',true).attr('disabled',true);
        }  

    });
    $('#iPossuiAlergiaSim').click(function() {        
        checkedSim = $("input[name='nPossuiAlergia']:checked").val();
        if (checkedSim === 'S') {
            $('#iAlergia'). attr('readonly',false).attr('disabled',false);
        }  

    });

    $('#iUsoMedicacaoNao').click(function() {        
        checkedNao = $("input[name='nUsoMedicacao']:checked").val();
        if (checkedNao === 'N') {
            $('#iMedicacao'). val('').attr('readonly',true).attr('disabled',true);
        }  

    });

    $('#iUsoMedicacaoSim').click(function() {        
        checkedSim = $("input[name='nUsoMedicacao']:checked").val();
        if (checkedSim === 'S') {
            $('#iMedicacao'). attr('readonly',false).attr('disabled',false);
        }  

    });

    $('#iDependenciaFamiliarNao').click(function() {        
        checkedNao = $("input[name='nDependenciaFamiliar']:checked").val();
        if (checkedNao === 'N') {
            $('#iDependente'). val('').attr('readonly',true).attr('disabled',true);
        }  

    });

    $('#iDependenciaFamiliarSim').click(function() {        
        checkedSim = $("input[name='nDependenciaFamiliar']:checked").val();
        if (checkedSim === 'S') {
            $('#iDependente'). attr('readonly',false).attr('disabled',false);
        }  

    });

        
    $('#iFrequentaNao').click(function() {        
        checkedSim = $('#iFrequentaNao').val();

        if (checkedSim === 'N') {  
            $("input[name='nTipoEscola']:checked").attr('checked',false);
        }

    });   
});



$("#iNomeMae").blur(function() {
    var valor = $('#iNomeMae').val();
    	    
    if (valor === '') {
        $("#basic_checkbox_1").attr('disabled', true);
        //alert('campo vazio');
        console.log(valor);
    } else {
        //$("#basic_checkbox_1").attr('disabled',false);
        console.log(valor);
        $("#basic_checkbox_1").attr('disabled', false);
        checkedOpcao = $("input[name='nOpcaoResponsavel']:checked").val();
        if (checkedOpcao === 'S') {
            $('#iNomeResponsavel').val($('#iNomeMae').val());
        }

    }
});

/* SOBRE TABELAS DATETABLE*/
$('.tables').DataTable({
    "language": {
        "decimal": "",
        "emptyTable": "Nenhum registro encontrado.",
        "info": "Exibindo _START_ de _END_ dos _TOTAL_ encontrados!",
        "infoEmpty": "Exibindo 0 de 0 dos 0 encontrados!",
        "infoFiltered": "(Filtrado de _MAX_ dos encontrados!)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Exibindo _MENU_ encontrados!",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Buscar:",
        "zeroRecords": "Nenhum registro encontrado!",
        "paginate": {
            "first": "Primerio",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }
    },
    "aaSorting": [[0, "asc"]],
    "paging": true,
    "lengthChange": false,
    "pageLength": 25,
    "bSort": false,
    dom: 'lBfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bDestroy": true,
    "scrollX": true,
    "scrollY": 200
});
$('#iTabelaHorario').DataTable({
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    'scrollY': '42vh',
    'scrollCollapse': true,
    'paging': true,
    'scrollX': true,
    //'aaSorting': [[0, "asc"], [1, 'asc']],
    'pageLength': 10,
    "language": {
        "decimal": "",
        "emptyTable": "Nenhum registro encontrado.",
        "info": "De _START_ a _END_ - Total _TOTAL_ ",
        "infoEmpty": "Exibindo 0 de 0 dos 0 encontrados!",
        "infoFiltered": "(Filtrado de _MAX_ dos encontrados!)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Exibindo _MENU_ encontrados!",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Buscar:",
        "zeroRecords": "Nenhum registro encontrado!",
        "paginate": {
            "first": "Primerio",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }
    }
});
$('#iTabelaAtendimento').DataTable({
    'lengthChange': false,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    'scrollY': '42vh',
    'scrollCollapse': true,
    'paging': true,
    'scrollX': true,
    'aaSorting': [[3, "asc"], [0, 'asc']],
    "language": {
        "decimal": "",
        "emptyTable": "Nenhum registro encontrado.",
        "info": "De _START_ a _END_ - Total _TOTAL_ ",
        "infoEmpty": "Exibindo 0 de 0 dos 0 encontrados!",
        "infoFiltered": "(Filtrado de _MAX_ dos encontrados!)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Exibindo _MENU_ encontrados!",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Buscar:",
        "zeroRecords": "Nenhum registro encontrado!",
        "paginate": {
            "first": "Primerio",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }
    }
});
$('#iTabelaEvolucao').DataTable({
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': false,
    'autoWidth': true,
    'scrollY': '42vh',
    'scrollCollapse': false,
    'paging': true,
    'scrollX': true,
    'aaSorting': [[0, 'desc']],
    'pageLength': 10,
    "language": {
        "decimal": "",
        "emptyTable": "Nenhum registro encontrado.",
        "info": "Exibindo _START_ de _END_ dos _TOTAL_ encontrados!",
        "infoEmpty": "Exibindo 0 de 0 dos 0 encontrados!",
        "infoFiltered": "(Filtrado de _MAX_ dos encontrados!)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Exibindo _MENU_ encontrados!",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Buscar:",
        "zeroRecords": "Nenhum registro encontrado!",
        "paginate": {
            "first": "Primerio",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }
    }
});
$('#iTabelaFaixaEtaria').DataTable({
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    'scrollY': '42vh',
    'scrollCollapse': true,
    'paging': true,
    'scrollX': true,
    'aaSorting': [[3, "desc"], [0, 'asc']],
    "language": {
        "decimal": "",
        "emptyTable": "Nenhum registro encontrado.",
        "info": "De _START_ a _END_ - Total _TOTAL_ ",
        "infoEmpty": "Exibindo 0 de 0 dos 0 encontrados!",
        "infoFiltered": "(Filtrado de _MAX_ dos encontrados!)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Exibindo _MENU_ encontrados!",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Buscar:",
        "zeroRecords": "Nenhum registro encontrado!",
        "paginate": {
            "first": "Primerio",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }
    }
});
$('.modalAlert').modal('show');

/* PREPARA O CONTROLE DO TEXTAREA*/
$(document).ready(function() {
    $('.textarea').maxlength({
        events: [], // Array of events to be triggered
        maxCharacters: 1000, // Characters limit
        status: true, // True to show status indicator below the element
        statusClass: "status", // The class on the status div
        statusText: "caracteres", // The status text
        notificationClass: "notification", // Will be added when maxlength is reached
        showAlert: true, // True to show a regular alert message
        alertText: "Limite de caracteres atingido.", // Text in alert message
        slider: true // True Use counter slider
    });
});

$(document).ready(function() {
    $('.textareaLimite1').maxlength({
        events: [], // Array of events to be triggered
        maxCharacters: 300, // Characters limit
        status: true, // True to show status indicator below the element
        statusClass: "status", // The class on the status div
        statusText: "caracteres", // The status text
        notificationClass: "notification", // Will be added when maxlength is reached
        showAlert: true, // True to show a regular alert message
        alertText: "Limite de caracteres atingido.", // Text in alert message
        slider: true // True Use counter slider
    });
});
$(document).ready(function() {
    $('.textareaLimite2').maxlength({
        events: [], // Array of events to be triggered
        maxCharacters: 500, // Characters limit
        status: true, // True to show status indicator below the element
        statusClass: "status", // The class on the status div
        statusText: "caracteres", // The status text
        notificationClass: "notification", // Will be added when maxlength is reached
        showAlert: true, // True to show a regular alert message
        alertText: "Limite de caracteres atingido.", // Text in alert message
        slider: true // True Use counter slider
    });
});

function marcardesmarcar() {
    marcartodos();
}

function marcarRadioButton(){
    $("#iFrequentaSim").prop('checked', true);
}

function marcartodos() {
    clearMessageError(['iDiasAtendimento','iMensagem'])    
    $('.marcarTodos').each(
            function() {
                if ($(this).prop("checked")) {
                    $(this).prop("checked", false);
                } else
                    $(this).prop("checked", true);
            }
    );
}


