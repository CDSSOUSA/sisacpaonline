<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ModalidadeApi extends ResourceController
{   
    private $logging;   

    public function __construct()
    {       

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function getDataModalidade()
    {
        try {
            $modelModalidade = new ModalidadeModel;
            $data = $modelModalidade->getDataModalidade();
            return $this->response->setJSON($data);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }
    public function getDataModalidadeId($idModalidade)
    {
        helper("utils");
        $id = decrypt($idModalidade);
        try {
            $modelModalidade = new ModalidadeModel;
            $data = $modelModalidade->getDataModalidadeId($id);
            foreach ($data as $value) {               
                $result[] = [                   
                    'nomeModalidade' => $value->nomeModalidade,
                    'cbo' => $value->cbo,
                    'idModalidade' => encrypt($value->idModalidade),                                   
                ];
            }
            return $this->response->setJSON($result);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }
    public function cadastrarModalidade()
    {   
        
        helper("utils");

        $rules = [
            'nDescricaoModalidade' => 'required|min_length[3]|is_unique[tb_modalidade.nomeModalidade]',
            'nCbo' => 'required|is_unique[tb_modalidade.cbo]',            
        ];      

        $val = $this->validate($rules);
        
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'MODALIDADE::' => null,
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
            $dados['nomeModalidade'] = tratarPalavras($this->request->getPost('nDescricaoModalidade'));
            $dados['cbo'] = $this->request->getPost('nCbo');          


        try {
            $modelModalidade = new ModalidadeModel;

            $gravar = $modelModalidade->save($dados);            

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');              

               
                //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['MODALIDADE::' => null, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
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
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['MODALIDADE::' => null, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            return $this->response->setJSON([
                'status' => 'ERROR',
                'error' => true,
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'msgs' => $e->getMessage(),
            ]);
        }      
    }

    public function listarModalidade()
    {
        helper("utils");
        try {
            $dat = [];
            $modelModalidade = new ModalidadeModel();

            $data = $modelModalidade->getDataModalidade();

            //var_dump($data);

            foreach ($data as $value) {
                $dataTratada = new \DateTime($value->created_at);
                $dat[] = [
                    
                    'nomeModalidade' => $value->nomeModalidade,
                    'cbo' => $value->cbo,                   
                    'created_at' => $dataTratada->format('Y-m-d'),
                    'idModalidade' => encrypt($value->idModalidade)
                ];

            }
            return $this->response->setJSON($dat);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function editaModalidade()
    {
        helper("utils");
        $idModalidade = $this->request->getPost('nIdModalidade');
        $id = decrypt($idModalidade);


        $modelModalidade = new ModalidadeModel;
        $result = $modelModalidade->getDataModalidadeId($id);
        if (!$result) {
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdModalidade' => 'Id inválido'],
                'msgs' => ['nIdModalidade' => 'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'MODALIDADE::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdProfissional' => 'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }       

        $rules = [
            'nDescricaoModalidade' => 'required|min_length[3]',
            'nCbo' => 'required',  
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
                'MODALIDADE::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return $this->response->setJSON($response);
        }

        $idModalidade = $id;
        $nomeModalidade = tratarPalavras($this->request->getPost('nDescricaoModalidade'));
        $cbo = tratarPalavras($this->request->getPost('nCbo'));        

        $modelModalidade = new ModalidadeModel;

        $data = [
            'idModalidade' => $idModalidade,
            'nomeModalidade' => $nomeModalidade,
            'cbo' => $cbo,                     
        ];

        try {
            
            $gravar = $modelModalidade->save($data);

            if ($gravar) {
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['MODALIDADE::' => $idModalidade, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);

                $response = [
                    'status' => true,
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',                   
                ];               
                return $this->response->setJSON($response);
            }
        } catch (Exception $e) {

            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['MODALIDADE::' => $idModalidade, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

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
