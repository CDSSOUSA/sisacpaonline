<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use App\Models\RegistroAtendimentoModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EvolucaoApi extends ResourceController
{   
    private $logging;   
    private $textoPadraoEvolucao = [];

    public function __construct()
    {       

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;

        $this->textoPadraoEvolucao = [
            'naoRespondeuAosEstimulos' => 'NÃO RESPONDEU AS ESTÍMULOS;',
            'concluiuATerapia' => 'CONCLUIU A TERAPIA;'
        ];
    }

    public function escreverEvolucao()
    {
        helper('utils');
        $textoPadraoEvolucao = $this->textoPadraoEvolucao;
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $textoFinal = '';

        foreach ($textoPadraoEvolucao as $key => $item) {
            $textoFinal .= $this->request->getPost($key) . ' ';
        }

        $result = TRUE;


        if (trim($textoFinal) == '') {

            $rules = [
                'nTextoEvolucao' => 'required|min_length[10]|max_length[500]'
            ];


            $val = $this->validate($rules);

            if (!$val) {
                $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                    'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                    'FEITO POR::' => session()->get("nome"),
                    'ERROR' => $this->validator->getErrors()
                ]);
                $response = [
                    'status' => 'ERROR',
                    'error' => true,
                    'code' => 400,
                    'msg' => $this->validator->getErrors(),
                    'msgs' => $this->validator->getErrors()
                ];
                return $this->response->setJSON($response);
            }
        }


        //if ($result === TRUE) {


            $textoFinal .= $this->request->getPost('nTextoEvolucao') . ' ';
            
            $id = decrypt($this->request->getPost('nIdRegistroAtendimento'));
            var_dump($id);
            $dados['idRegistroAtendimento'] = $id;
            $dados['textoEvolucao'] = trim($textoFinal);

            try {
                $modelRegistroAtendimento = new RegistroAtendimentoModel;
                $gravar = $modelRegistroAtendimento->gravarEvolucao($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO' => $id, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    $response = [
                        'status' => true,
                        'error' => false,
                        'code' => 200,
                        'msg' => '<p>Operação realizada com sucesso!</p>',
                        //'id' =>  $this->series->getInsertID()
                        //'data' => $this->list()
                    ];
                    //return redirect()->to('atendimento/listar_atendimento');
                    return $this->response->setJSON($response);
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO' => $id, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
                return $this->response->setJSON([
                    'status' => 'ERROR',
                    'error' => true,
                    'code' => $e->getCode(),
                    'msg' => $e->getMessage(),
                    'msgs' => $e->getMessage(),
                ]);
            }
    }
}
