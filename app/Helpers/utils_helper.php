<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of funcoes_helper
 *
 * @author cleber
 */


// ------------------------------------------------------------------------
if (!function_exists('hr')) {

    /**
     * Generates HTML HR tags based on number supplied
     *
     * @deprecated	3.0.0	Use str_repeat() instead
     * @param	int	$count	Number of times to repeat the tag
     * @return	string
     */
    function hr($count = 1)
    {
        return str_repeat('<hr />', $count);
    }
}
if (!function_exists('div')) {

    /**
     * Heading
     *
     * Generates an HTML div tag.
     *
     * @param	string	content
     * @param	int	heading level
     * @param	string
     * @return	string
     */
    function div($data = '', $attributes = '')
    {
        return '<div' . _stringify_attributes($attributes) . '>' . $data . '</div>';
    }
}
if (!function_exists('p')) {

    /**
     * Heading
     *
     * Generates an HTML p tag.
     *
     * @param	string	content
     * @param	int	heading level
     * @param	string
     * @return	string
     */
    function p($data = '', $attributes = '')
    {
        return '<p' . _stringify_attributes($attributes) . '>' . $data . '</p>';
    }
}

if (!function_exists('icone')) {

    function icone($data = '')
    {
        return '<h3 class="block-title"><i class="fa fa-desktop fa-1x"></i> ' . $data . '</h3><hr/>';
    }
}
if (!function_exists('negrito')) {

    function negrito($data = '')
    {
        return '<span style="font-weight:bold;">' . $data . '</span>';
    }
}
if (!function_exists('span')) {

    /**
     * Heading
     *
     * Generates an HTML p tag.
     *
     * @param	string	content
     * @param	int	heading level
     * @param	string
     * @return	string
     */
    function span($data = '', $attributes = '')
    {
        return '<span' . _stringify_attributes($attributes) . '>' . $data . '</span>';
    }
}

function nbs($num = 1)
{
    return str_repeat('&nbsp;', $num);
}

/**
 * @param string $campo
 * @return string
 */
if (!function_exists('tratarCamposVazio')) {

    function tratarCamposVazio($campo)
    {
        $texto = '';
        if (empty($campo)) {
            $texto = '--';
        } else {
            $texto = $campo;
        }

        return $texto;
    }
}

function tratarConfirmacaoAtendimento($opcao, $opcao2, $opcao3)
{

    $texto = 'Outra ocor';

    if ($opcao == 'S') {
        $texto = 'Atend';
    } else if ($opcao2 == 'S') {
        $texto = tratarFaltaUsuario($opcao2);
    } else if ($opcao3 == 'S') {
        $texto = tratarFaltaProfissional($opcao3);
    }
    return $texto;
}

function abrevPalavras($palavra, $limit = 100)
{
    $preNomes = ['DA', 'DAS', 'DE', 'DES', 'DI', 'DIS', 'DO', 'DOS', 'DU', 'DUS'];
    $palavraFinal = '';

    if (trim($palavra) === '') {
        return $palavra;
    }

    $palavrasArray = explode(' ', $palavra);
    $i = 0;
    while ($i < $limit) {
        $palavraFinal .= $palavrasArray[$i] . ' ';
        if (in_array($palavrasArray[$i], $preNomes)) {
            $limit++;
        }
        $i++;
    }
    return $palavraFinal;
}

function tratarFaltaUsuario($opcao)
{
    $texto = '';
    if ($opcao == 'S') {
        $texto = 'Ft usuário';
    }
    return $texto;
}

function tratarFaltaProfissional($opcao)
{
    $texto = '';
    if ($opcao == 'S') {
        $texto = 'Ft prof';
    }
    return $texto;
}

function converteParaDataBrasileira($data)
{
    if ($data == null) {
        return '--';
    }
    $data = explode("-", $data);
    return $dataAtendimento = $data[2] . "/" . $data[1] . "/" . $data[0];
}

function converteParaDataHoraBrasileira($data)
{
    if (empty($data) || $data == '0000-00-00') {
        return '--';
    }
    $dataFim = explode("-", $data);
    $dataComeco = explode(" ", $dataFim[2]);
    return $dataAtendimento = $dataComeco[0] . "/" . $dataFim[1] . "/" . $dataFim[0];
}

function converteParaDataHoraCompletaBrasileira($data)
{
    if (empty($data) || $data == '0000-00-00') {
        return '--';
    }
    $dataFim = explode("-", $data);
    $dataComeco = explode(" ", $dataFim[2]);
    return $dataAtendimento = $dataComeco[0] . "/" . $dataFim[1] . "/" . $dataFim[0] . " às " . $dataComeco[1];
}

function tratarDataHoraMysql($data)
{
    $dataFim = explode("-", $data);
    $dataComeco = explode(" ", $dataFim[2]);
    return $dataAtendimento = $dataFim[0] . "-" . $dataFim[1] . "-" . $dataComeco[0];
}

function converteParaDataMysql($data)
{
    if (!empty($data)) {
        $data = explode("/", $data);
        return $dataAtendimento = $data[2] . "-" . $data[1] . "-" . $data[0];
    }
    return NULL;
}

function tratarHora($hora)
{
    if (!empty($hora)) {
        $horaNova = explode(':', $hora);
        return $horaNova[0] . ":" . $horaNova[1];
    }
    return '--';
}

function mascaraCpf($numero)
{
    if (empty($numero)) {
        return '--';
    }
    return substr($numero, 0, 3) . "." . substr($numero, 3, 3) . "." . substr($numero, 6, 3) . "-" . substr($numero, 9, 2);
}

function mascaraCnpj($numero)
{
    return substr($numero, 0, 2) . "." . substr($numero, 2, 3) . "." . substr($numero, 5, 3) . "/" . substr($numero, 8, 4) . "-" . substr($numero, 12, 2);
}
function mascaraNis($numero)
{
    if (empty($numero)) {
        return '--';
    }
    return substr($numero, 0, 3) . "." . substr($numero, 3, 5) . "." . substr($numero, 8, 2) . "-" . substr($numero, 10, 1);
}
function mascaraTelefone($numero)
{

    if (strlen($numero) >= 11) {
        if (substr($numero, 3, 1) == 8) {
            return "(" . substr($numero, 1, 2) . ") 9" . substr($numero, 3, 8);
        } else {
            return "(" . substr($numero, 1, 2) . ") " . substr($numero, 3, 8);
        }
    }
    return "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 9);
}

function mascaraCep($numero)
{
    return substr($numero, 0, 5) . "-" . substr($numero, 5, 3);
}
function mascaraCns($numero)
{
    return substr($numero, 0, 3) . "." . substr($numero, 3, 4) . "." . substr($numero, 7, 4) . "." . substr($numero, 11, 4);
}

function tratarCns($cns)
{
    //return $cns = implode("", explode(".", $cns));
    return preg_replace('/[^0-9]/', '', $cns);
}

/*
  Função para tratar o dia da semana
  Entrada: 0 int;
  Saída: 'Dia da Semana' string';
 */

function tratarDiaSemana($dia, $p = FALSE)
{
    $diaSemana = "";
    switch ($dia) {
        case 2:
            $diaSemana = ($p == TRUE) ? "segunda-feira" : "SEG";
            break;
        case 3:
            $diaSemana = ($p == TRUE) ? "terça-feira" : "TER";
            break;
        case 4:
            $diaSemana = ($p == TRUE) ? "quarta-feira" : "QUA";
            break;
        case 5:
            $diaSemana = ($p == TRUE) ? "quinta-feira" : "QUI";
            break;
        case 6:
            $diaSemana = ($p == TRUE) ? "sexta-feira" : "SEX";
            break;
    }
    return $diaSemana;
}
function tratarDiaSemanaConverte($dia, $p = FALSE)
{
    $diaSemana = "";
    switch ($dia) {
        case 2:
            $diaSemana = ($p == TRUE) ? "monday" : "SEG";
            break;
        case 3:
            $diaSemana = ($p == TRUE) ? "tuesday" : "TER";
            break;
        case 4:
            $diaSemana = ($p == TRUE) ? "wednesday" : "QUA";
            break;
        case 5:
            $diaSemana = ($p == TRUE) ? "thursday" : "QUI";
            break;
        case 6:
            $diaSemana = ($p == TRUE) ? "friday" : "SEX";
            break;
    }
    return $diaSemana;
}

/* Funão para calcular idade do usuario;
 * Entrada dataAtual e dataNascimento Date;
 * Saída Idade Int;
 */

function calcularIdade($dataAtual = null, $dataNascimento)
{
    if ($dataNascimento == null) {

        return '--';
    }

    $dataAgora = explode('-', $dataAtual);

    $dataNasc = explode('-', $dataNascimento);

    $dataAtendimento = mktime(0, 0, 0, $dataAgora[1], $dataAgora[2], $dataAgora[0]);

    $dataAniversario = mktime(0, 0, 0, $dataNasc[1], $dataNasc[2], $dataNasc[0]);

    return floor((((($dataAtendimento - $dataAniversario) / 60) / 60) / 24) / 365.25);
}

function calcAge(string $birthDate): string
{
    if ($birthDate == null)
        return '--';

    $dateNow = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

    $birthDate = explode('-', $birthDate);

    $birthDateFinal = mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]);

    $descriptionBirth = floor((((($dateNow - $birthDateFinal) / 60) / 60) / 24) / 365.25);

    return $descriptionBirth >= 1 ? writeZero($descriptionBirth) . ' anos' : writeZero($descriptionBirth) . ' ano';
}

function writeZero(string $num, int $total = null)
{

    if (strlen($num) > 1) {
        return $num;
    }

    if ($total == null) {
        $total = 1;
    }

    $acumulation = '';

    for ($i = 1; $i <= $total; $i++) {

        $acumulation .= '0';
    }
    return $acumulation . $num;
}

function abbrevationString(string $string = null): string
{


    if (trim($string) === '' || empty($string) || $string === null) {
        return '--';
    }

    $arrayWord = [
        'CRECHE',
        'ESCOLA',
        'ESTADUAL',
        'MUNICIPAL',
        'MUNUCIPAL',
        'CHECHE',
    ];

    $palavrasArray = explode(' ', $string);
    $i = 0;
    $frase = '';
    while ($i < count($palavrasArray)) {
        //$palavraFinal .= $palavrasArray[$i].' ';
        if (in_array($palavrasArray[$i], $arrayWord)) {
            $abrev = substr($palavrasArray[$i], 0, 3) . '.';
            $frase .= $abrev . ' ';
        } else {

            $frase .= $palavrasArray[$i] . ' ';
        }
        $i++;
    }
    return $frase;
}

/*
  Função para remover a mascara do cpf;
  Entrada: 000.000.000-00;
  Saída: 00000000000;
 */

function tratarCpf($cpf)
{
    if (empty($cpf)) {
        return NULL;
    }
    $cpfPrimeiro = implode("", explode(".", $cpf));
    return $cpfSegundo = implode("", explode("-", $cpfPrimeiro));
}

function tratarDocumentoDoador($documento)
{
    $qtdeDocumento = strlen($documento);
    if ($qtdeDocumento == 14) {
        $cpfPrimeiro = implode("", explode(".", $documento));
        return $cpfSegundo = implode("", explode("-", $cpfPrimeiro));
    } else {
        $cnpjPrimeiro = implode("", explode(".", $documento));
        $cnpjSegundo = implode("", explode("/", $cnpjPrimeiro));
        return $cnpjTerceiro = implode("", explode("-", $cnpjSegundo));
    }
}

function tratarMoeda($valor)
{
    $parte1 = implode("", explode(".", $valor));
    return $valorFinal = implode(".", explode(",", $parte1));
}

function converteMoedaReal($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function converteMoeda($valor)
{
    return number_format($valor, 2, ',', '.');
}

function mascaraMoeda($valor)
{
    $parte1 = implode(",", explode(".", $valor));
    return $parte1;
}

function tratarPalavras($string)
{
    return preg_replace(
        array(
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/",
            "/(Ç)/"
        ), explode(" ", "a A e E i I o O u U n N C"), mb_strtoupper($string));
}

function tratarTelefone($telefone)
{
    //return $telefone = implode("", explode(" ", $telefone));
    $n = '--';
    if (!empty($telefone)) {
        $n = '';
        $n .= substr($telefone, 0, -4);
        $n .= '';
        $n .= substr($telefone, -4);
    }
    return $n;
}

function tratarCep($cep)
{
    return $cep = implode("", explode("-", implode("", explode(".", $cep))));
}

function tratarOpcaoSimNao($opcao)
{

    if ($opcao == 'S') {
        return $opcao = 'SIM';
    } else if ($opcao == 'N') {
        return $opcao = 'NÃO';
    } else if ($opcao == 'V') {
        return $opcao = 'ÀS VEZES';
    }
    return $opcao = 'INDEFINIDO';
}

function tratarMarcaX($opcao)
{

    $result = '[   ]';

    if ($opcao == 'S') {
        $result = '[ X ]';
    } else if ($opcao == 'N') {
        $result = '(   )';
    }
    return $result;
}

function tratarBrincadeira($opcao)
{

    $result = 'INDEFENIDO';

    if ($opcao == 'S') {
        $result = 'SOZINHO';
    } else if ($opcao == 'A') {
        $result = 'ACOMPANHADO';
    }
    return $result;
}
/*
  Função para tratar habitação;
  Entrada: String 'C' OU 'A';
  Saída: String 'CASA';
 */

function tratarHabitacao($opcao): string
{
    $result = 'INDEFINIDO';

    if ($opcao == 'C') {
        $result = 'CASA';
    } else if ($opcao == 'A') {
        $result = 'APARTAMENTO';
    }
    return $result;
}
/*
  Função para tratar condição de habitação;
  Entrada: String 'P' OU 'A' OU 'C';
  Saída: String 'PRÓPRIA';
 */

function tratarCondicaoHabitacao($opcao)
{
    $result = 'INDEFINIDO';

    if ($opcao == 'P') {
        $result = 'PRÓPRIA';
    } else if ($opcao == 'A') {

        $result = 'ALUGADA';
    } else if ($opcao == 'C') {

        $result = 'CEDIDA';
    }
    return $result;
}
/*
  Função para tratar comunicação;
  Entrada: String 'V' OU 'N';
  Saída: String 'VERBAL';
 */

function tratarComunicacao($opcao)
{
    $result = 'INDEFINIDO';

    if ($opcao == 'V') {
        $result = 'VERBAL';
    } else if ($opcao == 'N') {

        $result = 'NÃO VERBAL';
    }
    return $result;
}

function tratarTipoPessoa($tipoPessoa)
{
    $tipo = '';
    switch ($tipoPessoa) {
        case 0:
            $tipo = 'ADMINISTRADOR';
            break;
        case 1:
            $tipo = 'OPERADOR';
            break;
        case 2:
            $tipo = 'USUARIO';
            break;
        case 3:
            $tipo = 'FORNECEDOR';
            break;
        case 4:
            $tipo = 'DOADOR';
            break;
        case 5:
            $tipo = 'REQUISITANTE';
            break;
    }
    return $tipo;
}

/* Funçao para tratar o tipo de profissional
 *  @ param Entrada 'V' String
 * @param   Saida 'Voluntario' String
 *
 */

function tratarTipoProfissional($tipo)
{

    switch ($tipo) {
        case 'V';
            return 'VOLUNTARIO';
        case 'F';
            return 'FUNCIONARIO';
        case 'O';
            return 'OUTROS';
    }
}


function tratarGenero($genero)
{
    if ($genero == 'F') {
        return 'FEMININO';
    } else {
        return 'MASCULINO';
    }
}

function tratarTurno($turno)
{
    if ($turno == 'M') {
        return 'MANHÃ';
    } else if ($turno == 'T') {
        return 'TARDE';
    } else if ($turno == 'A') {
        return 'AMBOS';
    } else {
        return 'Ñ DEFINIDO';
    }
}

function tratarMes($mes)
{
    $mesExtenso = 0;
    switch ($mes) {
        case 1;
            $mesExtenso = 'JAN';
            break;
        case 2;
            $mesExtenso = 'FEV';
            break;
        case 3;
            $mesExtenso = 'MAR';
            break;
        case 4;
            $mesExtenso = 'ABR';
            break;
        case 5;
            $mesExtenso = 'MAI';
            break;
        case 6;
            $mesExtenso = 'JUN';
            break;
        case 7;
            $mesExtenso = 'JUL';
            break;
        case 8;
            $mesExtenso = 'AGO';
            break;
        case 9;
            $mesExtenso = 'SET';
            break;
        case 10;
            $mesExtenso = 'OUT';
            break;
        case 11;
            $mesExtenso = 'NOV';
            break;
        case 12;
            $mesExtenso = 'DEZ';
            break;
    }
    return $mesExtenso;
}

function tratarTipoEscola($tipoEscola)
{
    if (empty($tipoEscola)):
        return '--';
    else:
        if ($tipoEscola == '1')
            return 'PÚBLICA';
        return 'PRIVADA';
    endif;
}

function escreveZero($elemento)
{
    $numero = $elemento;
    $quant = strlen($elemento);
    if ($quant <= 1) {
        $numero = '0' . $elemento;
    }

    return $numero;
}

function escreveLinha($elemento)
{
    $linha = '________';
    $quant = strlen($elemento);
    for ($i = 1; $i < $quant; $i++) {
        $linha = $linha . "_";
    }
    return $linha;
}

function bissexto($ano)
{
    $bissexto = false;
    // Divisível por 4 e nAo divisível por 100 ou divisível por 400
    if ((($ano % 4) == 0 && ($ano % 100) != 0) || ($ano % 400) == 0) {
        $bissexto = true;
    }

    return $bissexto;
}

function valorPorExtenso($valor = 0)
{
    $singular = array("centavo", "real", "mil", "milhao", "bilhao", "trilhao", "quatrilhao");
    $plural = array(
        "centavos",
        "reais",
        "mil",
        "milhoes",
        "bilhoes",
        "trilhoes",
        "quatrilhoes"
    );

    $c = array(
        "",
        "cem",
        "duzentos",
        "trezentos",
        "quatrocentos",
        "quinhentos",
        "seiscentos",
        "setecentos",
        "oitocentos",
        "novecentos"
    );
    $d = array(
        "",
        "dez",
        "vinte",
        "trinta",
        "quarenta",
        "cinquenta",
        "sessenta",
        "setenta",
        "oitenta",
        "noventa"
    );
    $d10 = array(
        "dez",
        "onze",
        "doze",
        "treze",
        "quatorze",
        "quinze",
        "dezesseis",
        "dezesete",
        "dezoito",
        "dezenove"
    );
    $u = array(
        "",
        "um",
        "dois",
        "tres",
        "quatro",
        "cinco",
        "seis",
        "sete",
        "oito",
        "nove"
    );

    $z = 0;
    $rt = null;

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    for ($i = 0; $i < count($inteiro); $i++)
        for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
            $inteiro[$i] = "0" . $inteiro[$i];

    $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
    for ($i = 0; $i < count($inteiro); $i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
        $t = count($inteiro) - 1 - $i;
        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
            $r .= (($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : "") . $r;
    }

    return ("(" . $rt . ")" ? "(" . $rt . ")" : "zero");
}


function testarDiaSemana($data)
{
    $dataUtil = '';
    $diaSemana = date("w", strtotime($data));
    if ($diaSemana == 0) {
        $dataUtil = date('Y-m-d', strtotime("+1 days", strtotime($data)));
    } else if ($diaSemana == 6) {
        $dataUtil = date('Y-m-d', strtotime("+2 days", strtotime($data)));
    } else {
        $dataUtil = $data;
    }
    return $dataUtil;
}


function definirUrlBase(): string
{
    $baseUrl = $_SERVER['DOCUMENT_ROOT'];
    $baseUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    return $baseUrl;
}

function gerarLog($data, $idUsuario, $acao, $registro)
{

    /**
     * Gera o log da ação realizada pelo usuario
     * na data e hora da ação gravando no arquivo de texto.
     * Foramto do arquivo: Em [dataHora] o [idUsuario] fez [acao] no [registro]
     *
     * @param	data
     * @param	inteiro
     * @param	string
     * @param	inteiro
     */
    $dataHoje = date('Ymd');

    $caminhoArquivo = definirUrlBase() . 'log/';

    //$caminhoArquivo2 = 'C:/wamp64/www/sistlmkipccan/application/log-back/';

    //$caminhoArquivo = '/var/www/html/sistemaAcpa/log/';
    $filename = '' . $caminhoArquivo . 'log' . $dataHoje . '.txt';
    //$filename2 = '' . $caminhoArquivo2 . 'log-back' . $dataHoje . '.txt';

    if (!file_exists($filename)) {
        unlink($filename);
    }
    //if (!file_exists($filename2))
    //{
    //  unlink($filename2);
    //}

    $arquivo = fopen($filename, 'a');
    //$arquivo2 = fopen($filename2, 'a');
    $linha = 'Em ' . $data . ', o Operador [';
    $linha .= '' . $idUsuario . '], ';
    $linha .= '' . $acao . ' ';
    $linha .= '' . $registro . '';
    $linha .= chr(13) . chr(10);

    fwrite($arquivo, $linha);
    //fwrite($arquivo2, $linha);

    fclose($arquivo);
    //fclose($arquivo2);
}

function tratarTipoOperador($idCategoria)
{
    $texto = '';
    switch ($idCategoria) {
        case 'O':
            $texto = 'SECRETÁRIO (A)';
            break;
        case 'P':
            $texto = 'PROFISSIONAL OPERADOR';
            break;
        case 'A':
            $texto = 'ADMINISTRADOR';
            break;
        case 'S':
            $texto = 'SUPER ADMININISTRADOR';
            break;
    }
    return $texto;
}
function tratarAutorizacao($opcao)
{

    $autorizacao = 'INDEFINIDO';

    if ($opcao == 'S') {
        return $autorizacao = 'SIM';
    } else if ($opcao == 'N') {
        return $autorizacao = 'NÃO';
    }
    return $autorizacao;
}
function tratarStatus($status)
{

    $texto = '';
    return $texto = $status == 'A' ? 'ATIVO' : 'INATIVO';
}
function tratarAtivo($ativo){
    
    return $ativo == 'S' ? 'ATIVO' : 'INATIVO';
}

function escreveAutor()
{
    return 'cleberdossantossousa@gmail.com - 83 98796-9712';
}

function generateUpperCase(): string
{
    return implode("", range('A', 'Z'));
}
function generateLowerCase(): string
{
    return implode("", range('a', 'z'));
}
function generateNumber(): string
{
    return implode('', range('0', '9'));
}
function generateSimbol(): string
{
    return "!@#$%&*()_+=-";
}

function gerar_senha(int $size, bool $upperCase, bool $lowerCase, bool $number, bool $simbol)
{

    $options = [
        generateUpperCase() => $upperCase,
        generateLowerCase() => $lowerCase,
        generateNumber() => $number,
        generateSimbol() => $simbol,
    ];

    $password = '';

    $limitMax = strlen(generateUpperCase()) + strlen(generateLowerCase()) + strlen(generateNumber()) + strlen(generateSimbol());

    $accumulator = 0;

    if ($size <= 0) {
        $size = $limitMax;
    }

    for ($i = 0; $accumulator < $size; $i++) {

        $accumulator = 0;

        foreach ($options as $key => $values) {

            $password .= definePassword($values, $key);
        }

        $accumulator += strlen($password);
    }

    return substr(str_shuffle($password), 0, $size);
}

function definePassword(bool $option, $data): string
{
    if ($option) {
        return str_shuffle($data);
    }
    return '';
}


function gerarbotaoVoltar($metodo)
{

    return anchor($metodo, '<i class="fa fa-arrow-left"></i> Voltar' , ['class' => 'btn main_back_bt']) . '  ';
}

function gerarBotaoImprimir($metodo, $titulo = null)
{
  
    return '  ' . anchor($metodo, '<i class="fa fa-print"></i> Imprimir ' . $titulo, array('class' => 'btn main_print_bt', 'target' => '_blank'));
}

function generateButtonAdd(string $metodo, string $titulo)
{
    return anchor($metodo, '<span class="badge">N</span> OVO  ' . $titulo, array('class' => 'btn bg-teal waves-effect')) . nbs(2);
}

function mod($dividendo, $divisor)
{
    return round($dividendo - (floor($dividendo / $divisor) * $divisor));
}

/**
 * Método para gerar CPF válido, com máscara ou não
 * @example cpfRandom(0)
 *          para retornar CPF sem máscar
 * @param int $mascara
 * @return string
 */
function cpfRandom($mascara = "1")
{
    $n1 = rand(0, 9);
    $n2 = rand(0, 9);
    $n3 = rand(0, 9);
    $n4 = rand(0, 9);
    $n5 = rand(0, 9);
    $n6 = rand(0, 9);
    $n7 = rand(0, 9);
    $n8 = rand(0, 9);
    $n9 = rand(0, 9);
    $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
    $d1 = 11 - (mod($d1, 11));
    if ($d1 >= 10) {
        $d1 = 0;
    }
    $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
    $d2 = 11 - (mod($d2, 11));
    if ($d2 >= 10) {
        $d2 = 0;
    }
    $retorno = '';
    if ($mascara == 1) {
        $retorno = '' . $n1 . $n2 . $n3 . "." . $n4 . $n5 . $n6 . "." . $n7 . $n8 . $n9 . "-" . $d1 . $d2;
    } else {
        $retorno = '' . $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $d1 . $d2;
    }
    return $retorno;
}

/**
 * @param type $dividendo
 * @param type $divisor
 * @return type
 */

function tratarNis($numero)
{
    if (empty($numero)) {
        return NULL;
    }
    $nisPrimeiro = implode("", explode(".", $numero));
    return $nisFinal = implode("", explode("-", $nisPrimeiro));
}

function gerarToken($tamanho = 10)
{
    $t = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($t), 0, $tamanho);
}
function tratarTipoAtendimento($tipoAtendimento)
{
    if ($tipoAtendimento == 'I') {
        return 'INDIVIDUAL';
    }
    return 'GRUPO';
}
function tratarFrequencia($frequencia)
{
    if ($frequencia == 'U') {
        return 'ÚNICO';
    }
    return 'CONTÍNUO';
}
function valid_cns($cns)
{

    $cns = tratarCns($cns);

    if ($cns == '000000000000000') {
        return false;
    }

    if ((strlen(trim($cns))) != 15) {
        return false;
    }
    $pis = substr($cns, 0, 11);
    $soma = (((substr($pis, 0, 1)) * 15) +
        ((substr($pis, 1, 1)) * 14) +
        ((substr($pis, 2, 1)) * 13) +
        ((substr($pis, 3, 1)) * 12) +
        ((substr($pis, 4, 1)) * 11) +
        ((substr($pis, 5, 1)) * 10) +
        ((substr($pis, 6, 1)) * 9) +
        ((substr($pis, 7, 1)) * 8) +
        ((substr($pis, 8, 1)) * 7) +
        ((substr($pis, 9, 1)) * 6) +
        ((substr($pis, 10, 1)) * 5));
    $resto = fmod($soma, 11);
    $dv = 11 - $resto;
    if ($dv == 11) {
        $dv = 0;
    }
    if ($dv == 10) {
        $soma = ((((substr($pis, 0, 1)) * 15) +
            ((substr($pis, 1, 1)) * 14) +
            ((substr($pis, 2, 1)) * 13) +
            ((substr($pis, 3, 1)) * 12) +
            ((substr($pis, 4, 1)) * 11) +
            ((substr($pis, 5, 1)) * 10) +
            ((substr($pis, 6, 1)) * 9) +
            ((substr($pis, 7, 1)) * 8) +
            ((substr($pis, 8, 1)) * 7) +
            ((substr($pis, 9, 1)) * 6) +
            ((substr($pis, 10, 1)) * 5)) + 2);
        $resto = fmod($soma, 11);
        $dv = 11 - $resto;
        $resultado = $pis . "001" . $dv;
    } else {
        $resultado = $pis . "000" . $dv;
    }




    if ($cns != $resultado) {
        $soma2 = (((substr($cns, 0, 1)) * 15) +
            ((substr($cns, 1, 1)) * 14) +
            ((substr($cns, 2, 1)) * 13) +
            ((substr($cns, 3, 1)) * 12) +
            ((substr($cns, 4, 1)) * 11) +
            ((substr($cns, 5, 1)) * 10) +
            ((substr($cns, 6, 1)) * 9) +
            ((substr($cns, 7, 1)) * 8) +
            ((substr($cns, 8, 1)) * 7) +
            ((substr($cns, 9, 1)) * 6) +
            ((substr($cns, 10, 1)) * 5) +
            ((substr($cns, 11, 1)) * 4) +
            ((substr($cns, 12, 1)) * 3) +
            ((substr($cns, 13, 1)) * 2) +
            ((substr($cns, 14, 1)) * 1));
        $resto2 = fmod($soma2, 11);
        if ($resto2 != 0) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
    /**
     * @return string
     *
     * 
     */

    /*function definirUserName(){
        
        if(ENVIRONMENT == 'development'){
            return 'cleber';
        }
        return 'false';
    }*/

}

function encrypt($data)
{


    $inicio = gerar_senha(getenv('QTDE_HASH'), true, true, true, false);
    $fim = gerar_senha(getenv('QTDE_HASH'), true, true, true, false);

    $hash = $inicio . $data . $fim;
    return $hash;
}

function decrypt($data)
{

    $resto = substr($data, getenv('QTDE_HASH'));
    $result = substr($resto, 0, -getenv('QTDE_HASH'));
    return $result;
}

function tratarEvolucao($minhaString, $status = false)
{

    if ($status && substr($minhaString, 0, 2) === '++') {
        $minhaString = 'Editado: ' . substr($minhaString, 2);
    } elseif (!$status && substr($minhaString, 0, 2) === '++') {
        $minhaString = substr($minhaString, 2);
    }
    return $minhaString;

}

function ultimosDozeMeses($data, $dias)
{
    // Obtém a data atual
    $ultimosDozeMeses = array();

    // Converte a data fornecida em um objeto DateTime
    $dataAtual = new DateTime($data);

    // Subtrai a quantidade de dias especificada
    $dataAtual->modify('-' . $dias . ' days');

    // Obtém o mês e o ano da data atual
    $anoAtual = $dataAtual->format('Y');
    $mesAtual = $dataAtual->format('m');

    // Loop para obter os últimos doze meses
    for ($i = 0; $i < 12; $i++) {
        // Adiciona o mês atual ao array no formato 'Y-m'
        $ultimosDozeMeses[] = $anoAtual . '-' . $mesAtual;

        // Subtrai um mês da data atual
        $mesAtual++;

        // Se o mês for menor que 1, ajusta para dezembro e diminui o ano
        //if ($mesAtual < 1) {
        //$mesAtual = 12;
        //$anoAtual--;
        // }
        if ($mesAtual > 12) {
            $anoAtual++;
            $mesAtual = 1;
        }
    }

    // Retorna o array com os últimos doze meses
    return ($ultimosDozeMeses); // Inverte o array para começar com o mês atual
}

function proximas_datas_do_dia_da_semana($dia_semana)
{
    // Obtém a data atual
    $data_atual = date("Y-m-d");
    //$data_atual = '2023-08-04';

    // Obtém o ano atual
    $ano_atual = date("Y");

    // Cria um array para armazenar as datas
    $proximas_datas = array();

    // Loop para verificar as próximas datas até o fim do ano
    while ($ano_atual == date("Y", strtotime($data_atual))) {
        if (date("w", strtotime($data_atual)) == $dia_semana) {
            $proximas_datas[] = $data_atual;
        }
        $data_atual = date("Y-m-d", strtotime($data_atual . " +1 day"));
    }

    return $proximas_datas;
}
