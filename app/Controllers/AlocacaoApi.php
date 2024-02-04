<?php

namespace App\Controllers;

use App\Models\AlocacaoModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AlocacaoApi extends ResourceController
{
    private $logging;

    public function __construct()
    {

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function getDataAlocacao($idAlocacao)
    {
        helper('utils');
        $newdata = [];
        $id = decrypt($idAlocacao);
        try {
            //buscar qtde de alocacao
            $modelAlocacao = new AlocacaoModel;
            $data = $modelAlocacao->getAlocacaoId($id);

            foreach ($data as $value) {
                $newdata[] = [
                    'idAlocacao' => encrypt($value->idAlocacao),
                    'diaSemana' => $value->diaSemana,
                    'horaInicio' => $value->horaInicio,
                    'horaFim' => $value->horaFim,
                    'idProfissional' => encrypt($value->idProfissional), 
                    'nomeProfissional' => $value->nomeProfissional        
                ];

            }

            return $this->response->setJSON($newdata);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }

    public function removerAlocacao()
    {
        helper("utils");

        $idAlocacao = $this->request->getPost('nIdAlocacao');
        $idProfissional = $this->request->getPost('nIdProfissional');
        $id = decrypt($idAlocacao);        
        $newIdProfissional = decrypt($idProfissional);        

        $modelAlocacao = new AlocacaoModel;
        $result = $modelAlocacao->find($id);
        if (!$result) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdAlocacao' => 'Id inválido'],
                'msgs' => ['nIdAlocacao' => 'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'ALOCACAO::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdAlocacao' => 'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }

        $data = [
            'idAlocacao' => $id,     
            'idProfissional' => $newIdProfissional       
        ];   
        
        try {
            //$save = $this->series->save($data);
            //$gravar = $modelProfissional->save($data);
            
            $gravar = $modelAlocacao->removerAlococao($data);

            if ($gravar['status']) {
                //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                //session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                //session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['ALOCACAO::' => $id, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);


                $response = [
                    'status' => $gravar['status'],
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',       
                ];
                //return redirect()->to('atendimento/listar_atendimento');
                return $this->response->setJSON($response);
                
            }
        } catch (Exception $e) {

            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['ALOCACAO::' => $id, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

            return $this->response->setJSON([
                'status' => 'ERROR',
                'error' => true,
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'msgs' => [
                    'series' => 'Série, turma e turno já cadastrados!'
                ]
            ]);
        }

    }

}
