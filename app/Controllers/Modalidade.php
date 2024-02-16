<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Modalidade extends BaseController
{
   
    private $logging;
    private $modelUsuario;
    private $modelAtendimento;
    private $modelProfissional;
    private $modelAlocacao;
    private $modelRegistroAtendimento;
    private $modelModalidade;
    public function __construct()
    {

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;

        $this->modelModalidade = new ModalidadeModel;
       
    }
    public function form_cadastrar_modalidade()
    {
        $dados = array(
            'titulo' => 'Cadastrar Modalidade',
            'pasta' => 'modalidade',
            'linkMenu'=> 'form_cadastrar_modalidade',
            //'modalidades' => $this->modelModalidade->findAll(),
            'atributos' => $this->modelModalidade->getAtributos()
        );
        return view('modalidade/form-cadastrar-modalidade', $dados);

    }
    public function form_editar_modalidade()
    {

        {          
            $dados = [
                'titulo' => 'LISTAR MODALIDADES',
                'pasta' => 'modalidade',                 
                'linkMenu'=> 'form_cadastrar_modalidade',
                //'modalidades' => $this->modelModalidade->findAll(),
                'atributos' => $this->modelModalidade->getAtributos()           
            ];
            return view('modalidade/form-editar-modalidade', $dados);
        }
    }
}
