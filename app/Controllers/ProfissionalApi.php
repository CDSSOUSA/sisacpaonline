<?php

namespace App\Controllers;

use App\Models\AlocacaoModel;
use App\Models\ModalidadeModel;
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

    public function listarProfissional()
    {
        helper("utils");
        try {
            $dat = [];
            $modelProfissional = new ProfissionalModel();

            $data = $modelProfissional->getProfissionalAtivo();

            //var_dump($data);

            foreach ($data as $value) {
                $dat[] = [
                    'ativo' => tratarAtivo($value->ativo),
                    'cnsProfissional' => $value->cnsProfissional,
                    'cpfProfissional' => $value->cpfProfissional,
                    'genero' => $value->genero,
                    'idProfissional' => encrypt($value->idProfissional),
                    'modalidade' => $value->modalidade,
                    'nomeProfissional' => $value->nomeProfissional,
                    'numeralConselhoClasse' => $value->numeralConselhoClasse,
                    'operadorAtivo' => $value->operadorAtivo,
                    'tipoProfissional' => $value->tipoProfissional,
                ];

            }
            return $this->response->setJSON($dat);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getDataProfissional($idProfissional)
    {
        helper('utils');
        $id = decrypt($idProfissional);
        try {
            //buscar qtde de alocacao
            $modelProfissional = new ProfissionalModel();
            $data = $modelProfissional->find($id);

            $modelAlocacao = new AlocacaoModel;
            $result = $modelAlocacao->getAlocacao($id);            

            $data->totalAlocacao = count($result);

            return $this->response->setJSON($data);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }

    public function editaProfissional()
    {
        helper("utils");
        $idProfissinal = $this->request->getPost('nIdProfissional');
        $id = decrypt($idProfissinal);

        $modelProfissional = new ProfissionalModel;
        $result = $modelProfissional->find($id);
        if (!$result) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdProfissional' => 'Id inválido'],
                'msgs' => ['nIdProfissional' => 'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdProfissional' => 'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }

        //$rules = $modelProfissional->validationRules;

        $regrasTemporarias = $modelProfissional->validationRules;
        //var_dump($modelProfissional->validationRules);

        $regrasTemporarias['nCpfProfissional'] = str_replace('|is_unique[tb_profissional.cpfProfissional, idProfissional,{idProfissional}]', '', $regrasTemporarias['nCpfProfissional']);
        $regrasTemporarias['nCnsProfissional'] = str_replace('|is_unique[tb_profissional.cnsProfissional, idProfissional,{idProfissional}]', '', $regrasTemporarias['nCnsProfissional']);


        $rules = $regrasTemporarias;
        $val = $this->validate($rules);

        if (!$val) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => $this->validator->getErrors(),
                'msgs' => $this->validator->getErrors()
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return $this->response->setJSON($response);
        }

        $idProfissional = $id;
        $nomeProfissional = $this->request->getPost('nNomeProfissional');
        $genero = $this->request->getPost('nGenero');
        $cpfProfissional = $this->request->getPost('nCpfProfissional');
        $cnsProfissional = $this->request->getPost('nCnsProfissional');
        $conselhoClasse = $this->request->getPost('nConselhoClasse');
        $tipoProfissional = $this->request->getPost('nTipoProfissional');
        $modalidade = $this->request->getPost('nModalidade');

        $modelModalidade = new ModalidadeModel;

        $resultModalidade = $modelModalidade->select('nomeModalidade')->where('idModalidade', $modalidade)->get()->getRow();



        $data = [
            'idProfissional' => $idProfissional,
            'nomeProfissional' => $nomeProfissional,
            'genero' => $genero,
            'cpfProfissional' => $cpfProfissional,
            'cnsProfissional' => $cnsProfissional,
            'numeralConselhoClasse' => $conselhoClasse,
            'tipoProfissional' => $tipoProfissional,
            'modalidade' => $resultModalidade->nomeModalidade           
        ];


        try {
            //$save = $this->series->save($data);
            $gravar = $modelProfissional->save($data);

            if ($gravar) {
                //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                //session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                //session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissinal, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);


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
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissinal, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

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

    public function ativaDesativaProfissional()
    {

        helper("utils");
        $idProfissinal = $this->request->getPost('nIdProfissional');
        $id = decrypt($idProfissinal);

        $modelProfissional = new ProfissionalModel;
        $result = $modelProfissional->find($id);
        if (!$result) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdProfissional' => 'Id inválido'],
                'msgs' => ['nIdProfissional' => 'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdProfissional' => 'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }

        $rules = [
            'nIdProfissional' => 'required',
        ];

        $val = $this->validate($rules);

        if (!$val) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => $this->validator->getErrors(),
                'msgs' => $this->validator->getErrors()
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return $this->response->setJSON($response);
        }



        $idProfissional = $id;
        $ativo = $this->request->getPost('nAtivaDesativa');
        $operadorAtivo = $this->request->getPost('nAtivaDesativa');

        $data = [
            'idProfissional' => $idProfissional,
            'ativo' => $ativo,
            'operadorAtivo' => $operadorAtivo,
        ];

        try {
            //$save = $this->series->save($data);
            $gravar = $modelProfissional->ativaDesativaProfissional($data);


            if ($gravar) {
                //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                //session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                //session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissinal, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);


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
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissinal, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

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

    public function getAlocacaoProfissional($idProfissional)
    {
        helper('utils');
        $id = decrypt($idProfissional);
        try {
            $modelAlocacao = new AlocacaoModel;

            //$modelProfissional = new ProfissionalModel();
            
            $data = $modelAlocacao->getAlocacao($id);
            $newdata = [];           

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

    public function alocaProfissional()
    {
        helper("utils");
        $horarioManha = [];
        $horarioTarde = [];

        $idProfissinal = $this->request->getPost('nIdProfissional');
        $id = decrypt($idProfissinal);

        $idProfissional = $id;
        $dia = $this->request->getPost('nDia');
        $horarioManha = $this->request->getPost('nHorarioManha');
        $horarioTarde = $this->request->getPost('nHorarioTarde');

        $modelProfissional = new ProfissionalModel;
        $result = $modelProfissional->find($id);
        if (!$result) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdProfissional' => 'Id inválido'],
                'msgs' => ['nIdProfissional' => 'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdProfissional' => 'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }

        $rules = [
            'nIdProfissional' => 'required',
            'nDia' => 'required',
            

        ];    

        $message = [];

        
        if(is_null($this->request->getPost('nHorarioManha')) &&
            (is_null($this->request->getPost('nHorarioTarde')))){              
                 
                $rules['nMensagem'] = 'required';                 
                $message =[
                    'nMensagem' => [
                        'required' => 'Pelo menos um horário deve ser escolhido!'
                    ]
                ];
           
        }
      

        $val = $this->validate($rules, $message);

        if (!$val) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => $this->validator->getErrors(),
                'msgs' => $this->validator->getErrors()
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return $this->response->setJSON($response);
        }

        $horarios = $horarioManha;

        if ($horarioManha !== null && $horarioTarde !== null) {
            $horarios = array_merge ($horarioManha, $horarioTarde);
        } else if($horarioManha === null){
            $horarios = $horarioTarde;
        } 

        $data = [
            'idProfissional' => $idProfissional,
            'diaSemana' => $dia,
            'horarios' => $horarios,
            //'horarioTarde' => $horarioTarde,
        ];   
        
        try {
            //$save = $this->series->save($data);
            //$gravar = $modelProfissional->save($data);
            $modelProfissional = new ProfissionalModel;
            $gravar = $modelProfissional->gravarAlocacao($data);

            if ($gravar['status']) {
                //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                //session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                //session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $id, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);


                $response = [
                    'status' => $gravar['status'],
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',
                    'insert' => $gravar['insert'],
                    'update'=> $gravar['update']
                    //'id' =>  $this->series->getInsertID()
                    //'data' => $this->list()
                ];
                //return redirect()->to('atendimento/listar_atendimento');
                return $this->response->setJSON($response);
                
            }
        } catch (Exception $e) {

            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $id, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

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
