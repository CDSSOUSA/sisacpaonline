<?php

namespace App\Controllers;

use App\Models\ProfissionalModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ProfissionalApi extends ResourceController
{
    private $logging;   

    public function __construct()
    {       

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function listarProfissional(){

        try {
            $modelProfissional = new ProfissionalModel();

            $data = $modelProfissional->getProfissionalAtivo();

            // var_dump($data);
            // exit;

            /*$datas = [
                'idUsuario'=>$data->idUsuario,
                'nomeUsuario'=>$data->nomeUsuario,
                'nomeProfissional'=>abrevPalavras($data->nomeProfissional,2),
                'modalidade'=>$data->modalidade,
                'horaInicio'=>$data->horaInicio,
                'diaSemana'=>tratarDiaSemana($data->diaSemana),
                'diaSemanaPuro' => $data->diaSemana,
                'horaConfirmacao' => date('H:i'),
                'frequencia' => $data->frequencia

            ];*/
            //var_dump($datas);
            //exit;
            return $this->response->setJSON($data);
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}
