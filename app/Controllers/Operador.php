<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use App\Models\OperadorModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Operador extends BaseController
{

    private $logging;
    private $modelUsuario;
    private $modelAtendimento;
    private $modelProfissional;
    private $modelAlocacao;
    private $modelRegistroAtendimento;
    private $modelModalidade;
    private $modelOperador;
    public function __construct()
    {

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;

        $this->modelOperador = new OperadorModel;
       
    }
    public function form_cadastrar_operador()
    {
        $dados = array(
            'titulo' => 'CADASTRAR OPERADOR',
            'pasta' => 'operador',
            'linkMenu'=> 'form_cadastrar_operador',            
            'atributos' => $this->modelOperador->getAtributos()
        );
        return view('operador/form-cadastrar-operador', $dados);
    }
    public function form_editar_operador()
    {
        $dados = array(
            'titulo' => 'LISTAR OPERADORES',
            'pasta' => 'operador',
            'linkMenu'=> 'form_editar_operador',            
            'atributos' => $this->modelOperador->getAtributos(),
            'dataOperador' => $this->modelOperador->getDataOperador()
        );
        return view('operador/form-editar-operador', $dados);
    }

    public function form_permitir_operador($idOperador)
    {
        $dados = array(
            'titulo' => 'CADASTRAR PERMISSÃO OPERADOR ',
            'pasta' => 'operador',
            'linkMenu'=> 'form_permitir_operador',            
            'atributos' => $this->modelOperador->getAtributos()
        );
        return view('operador/form-permitir-operador', $dados);
    }
}
