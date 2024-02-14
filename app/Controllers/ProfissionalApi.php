<?php

namespace App\Controllers;

use App\Models\AlocacaoModel;
use App\Models\ModalidadeModel;
use App\Models\PessoaModel;
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
                $dataTratada = new \DateTime($value->created_at);
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
                    'created_at' => $dataTratada->format('Y-m-d')
                ];

            }
            return $this->response->setJSON($dat);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getDataProfissional($idProfissional)
    {
        //print_r($idProfissional);
        helper('utils');
        $id = decrypt($idProfissional);
        //print_r($id);
        try {
            //buscar qtde de alocacao
            $modelProfissional = new ProfissionalModel();
            $data = $modelProfissional->getDataProfissional($id);
            //print_r($data);

            $modelAlocacao = new AlocacaoModel;
            $result = $modelAlocacao->getAlocacao($id);    
            //print_r($result);        
            
            $data['totalAlocacao'] = count($result);

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
        $result = $modelProfissional->getDataProfissional($id);
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

        // //$rules = $modelProfissional->validationRules;

        // $regrasTemporarias = $modelProfissional->validationRules;
        // //var_dump($modelProfissional->validationRules);

        // $regrasTemporarias['nCpfProfissional'] = str_replace('|is_unique[tb_profissional.cpfProfissional, idProfissional,{idProfissional}]', '', $regrasTemporarias['nCpfProfissional']);
        // $regrasTemporarias['nCnsProfissional'] = str_replace('|is_unique[tb_profissional.cnsProfissional, idProfissional,{idProfissional}]', '', $regrasTemporarias['nCnsProfissional']);


        // $rules = $regrasTemporarias;

        $rules = [
            'nNomeProfissional' => 'required|min_length[3]',
            'nGenero' => 'required',
            'nCpfProfissional' => 'required|validateCpf',
            'nCnsProfissional' => 'required|valid_cns',
            'nTipoProfissional' => 'required',
            'nModalidade' => 'required'
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
        $nomeProfissional = $this->request->getPost('nNomeProfissional');
        $genero = $this->request->getPost('nGenero');
        $cpfProfissional = $this->request->getPost('nCpfProfissional');
        $cnsProfissional = $this->request->getPost('nCnsProfissional');
        $conselhoClasse = $this->request->getPost('nConselhoClasse');
        $tipoProfissional = $this->request->getPost('nTipoProfissional');
        $modalidade = $this->request->getPost('nModalidade');
        $id = $this->request->getPost('nId');

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
            'modalidade' => $resultModalidade->nomeModalidade, 
            'id' => $id          
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
        $result = $modelProfissional->getDataProfissional($id);
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
        $id = $this->request->getPost('nId');

        $data = [
            'id' => $id,
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
        $result = $modelProfissional->getDataProfissional($id);
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

    public function cadastrarProfissional()
    {   
        
        helper("utils");

        $rules = [
            'nNomeProfissional' => 'required|min_length[3]',
            'nGenero' => 'required',
            'nCpfProfissional' => 'required|validateCpf|is_unique[tb_profissional.cpfProfissional]',
            'nCnsProfissional' => 'required|valid_cns|is_unique[tb_profissional.cnsProfissional]',
            'nTipoProfissional' => 'required',
            'nModalidade' => 'required'
        ];        

        //$modelProfissional = new ProfissionalModel;
        

        $val = $this->validate($rules);
        
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => null,
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
            //return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

            $dados['nomeProfissional'] = tratarPalavras($this->request->getPost('nNomeProfissional'));
            $dados['cpfProfissional'] = ($this->request->getPost('nCpfProfissional'));
            $dados['cnsProfissional'] = ($this->request->getPost('nCnsProfissional'));
            $dados['genero'] = $this->request->getPost('nGenero');
            $dados['operadorAtivo'] = 'S';
            $dados['tipoProfissional'] = $this->request->getPost('nTipoProfissional');
            $dados['ativo'] = 'S';
            $dados['numeralConselhoClasse'] = tratarPalavras($this->request->getPost('nConselhoClasse'));
            $dados['modalidade'] = $this->request->getPost('nModalidade');



        try {
            $modelProfissional = new ProfissionalModel;

            $gravar = $modelProfissional->saveProfissional($dados);
            

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');

                $modelPessoa = new PessoaModel;
                $ultimaPessoa = $modelPessoa->getLastPessoa();

                $idProfissional = $ultimaPessoa->idPessoa;
                //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissional, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                //return redirect()->to('profissional/form_alocar_profissional/' . encrypt($idProfissional));
                //return redirect()->to('profissional/form_alocar_profissional/');
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

            var_dump($e->getCode());
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissional, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
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

        //return $this->form_cadastrar_profissional();

    }

    public function getAlocacaoDia($dia, $idProfissional)
    {
        helper('utils');
        $id = decrypt($idProfissional);
        try {
            $modelAlocacao = new AlocacaoModel;

            //$modelProfissional = new ProfissionalModel();
            
            $data = $modelAlocacao->getAlocacaoDia($dia,$id);
            $newdata = [];           

            foreach ($data as $value) {
                $newdata[] = [
                    'idAlocacao' => encrypt($value->idAlocacao),
                    'diaSemana' => $value->diaSemana,
                    'horaInicio' => $value->horaInicio,                    
                    //'idProfissional' => encrypt($value->idProfissional),                                       
                    //'nomeProfissional' => $value->nomeProfissional,             
                    //'modalidade' => $value->modalidade, 
                ];              

            }
            return $this->response->setJSON($newdata);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }


}
