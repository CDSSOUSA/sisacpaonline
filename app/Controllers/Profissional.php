<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Profissional extends BaseController
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
    public function index()
    {
        //
    }

    public function form_cadastrar_profissional()
    {
        //require_once APPPATH . "/third_party/validarConsistencia.php";
        $dados = array(

            'titulo' => 'CADASTRAR PROFISSIONAL',
            'pasta' => 'profissional',
            'modalidades' => $this->modelModalidade->findAll()

        );
        
        return view('profissional/form-cadastrar-profissional', $dados);

    }
}
