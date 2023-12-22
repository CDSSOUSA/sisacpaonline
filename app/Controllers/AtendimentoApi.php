<?php

namespace App\Controllers;

use App\Models\AtendimentoModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AtendimentoApi extends ResourceController
{

    private $logging;   

    public function __construct()
    {       

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function listarAtendimentos($dataAtendimento){

        try {
            $modelAtendimento = new AtendimentoModel();

            $data = $modelAtendimento->getAtendimentosDia($dataAtendimento);

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

    public function getDataAtendimento(int $id){

        helper('utils');
        $modelAtendimento = new AtendimentoModel();
        try {

            $data = $modelAtendimento->find($id);

            // var_dump($data);
            // exit;

            $datas = [
                'idUsuario'=>$data->idUsuario,
                'nomeUsuario'=>$data->nomeUsuario,
                'nomeProfissional'=>abrevPalavras($data->nomeProfissional,2),
                'modalidade'=>$data->modalidade,
                'horaInicio'=>$data->horaInicio,
                'diaSemana'=>tratarDiaSemana($data->diaSemana),
                'diaSemanaPuro' => $data->diaSemana,
                'horaConfirmacao' => date('H:i'),
                'frequencia' => $data->frequencia,
                'dataPrevisaoAtendimento' => $data->dataPrevisaoAtendimento

            ];
            //var_dump($datas);
            //exit;
            return $this->response->setJSON($datas);
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function confirmaPresencaUsuarioHorario()
    {
        $modelAtendimento = new AtendimentoModel();
        $idAtendimento = $this->request->getPost('nIdAtendimento');

        $rules = [
            'nHoraAtendimento' => 'required'
        ];

        $val = $this->validate($rules);
        //$idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {

            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => $this->validator->getErrors(),
                'msgs' => $this->validator->getErrors()
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'ATENDIMENTO::' => $idAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return $this->response->setJSON($response);
            //return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $acao = $this->request->getPost('nAcao');
        $dia = $this->request->getPost('nDiaSemana');
        $idAtendimento = $this->request->getPost('nIdAtendimento');
        $dataAtendimento = $this->request->getPost('nDataAtendimento');
        $frequencia = $this->request->getPost('nFrequencia');
        $horaAtendimento = $this->request->getPost('nHoraAtendimento');


        $data = [
            'idAtendimento' => $idAtendimento,
            'dataAtendimento' => $dataAtendimento,
            'frequencia' => $frequencia,
            'horaAtendimento' => $horaAtendimento
        ];


        try {
            //$save = $this->series->save($data);
            $gravar = $modelAtendimento->gravarPresenca($data);

            if ($gravar) {

                //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMETO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);


                $response = [
                    'status' => 'OK',
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
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMENTO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
   
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

    public function atendimentosAnterior() {
        helper('utils');
        $data = converteParaDataMysql($this->request->getPost('nDataAtendimento'));
        session()->set('dataConfirmacao', $data );
        $modelAtendimento = new AtendimentoModel();
        try {

            $datas = $modelAtendimento->getAtendimentosDia($data);


            // var_dump($datas);
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
            return $this->response->setJSON($datas);
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}
