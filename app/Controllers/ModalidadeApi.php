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
    public function cadastrarModalidade()
    {   
        
        helper("utils");

        $rules = [
            'nDescricaoModalidade' => 'required|min_length[3]|is_unique[tb_modalidade.nomeModalidade]',
            'nCbo' => 'required|is_unique[tb_modalidade.cbo]',            
        ];        

        //$modelProfissional = new ProfissionalModel;
        

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
                'msgs' => [
                    'series' => 'Série, turma e turno já cadastrados!'
                ]
            ]);
        }

        //return $this->form_cadastrar_profissional();

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
                    'created_at' => $dataTratada->format('Y-m-d')
                ];

            }
            return $this->response->setJSON($dat);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    
}
