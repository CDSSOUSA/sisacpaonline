<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\ModalidadeModel;
use App\Models\OperadorModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class OperadorApi extends ResourceController
{   
    private $logging;   

    public function __construct()
    {       

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function getDataOperadorId($idOperador)
    {
        helper("utils");
        $id = decrypt($idOperador);
       
        try {
            $modelOperador = new OperadorModel;
            $data = $modelOperador->getDataOperadorId($id);
          
            foreach ($data as $value) {               
                $result[] = [                   
                    'nomeOperador' => $value->nome,
                    'tipoOperador' => $value->tipoOperador,
                    'idOperador' => encrypt($value->idOperador),                                   
                    'id' => encrypt($value->id),                                   
                    'identificador' => $value->login,                                   
                ];
            }            
            return $this->response->setJSON($result);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }
    public function cadastrarOperador()
    {   
        
        helper("utils");

        $rules = [
            'nNomeOperador' => 'required|min_length[3]',
            'nCpfOperador' => 'required|validateCpf|is_unique[tb_pessoa.cpf]',            
            'nTipoOperador' => 'required',            
        ];      

        $val = $this->validate($rules);        
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'OPERADOR::' => null,
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
            
            $dados['nome'] = tratarPalavras($this->request->getPost('nNomeOperador'));
            $dados['tipo'] = 1;
            $dados['ativo'] = 'S';
            $dados['cpf'] = tratarCpf($this->request->getPost('nCpfOperador'));
            $dados['idOperadorCadastro'] = session()->get("idOperadorSistema");
            $dados['tipoOperador'] = $this->request->getPost('nTipoOperador');


        try {
            $modelOperador = new OperadorModel;

            $gravar = $modelOperador->salvarOperador($dados);            

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');              

               
                //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => null, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
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
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => null, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            return $this->response->setJSON([
                'status' => 'ERROR',
                'error' => true,
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'msgs' => $e->getMessage(),
            ]);
        }      
    }

    public function editarOperador()
    {        
        helper("utils");
        
        $idDb = decrypt($this->request->getPost('nId'));
        $idOperadorDb = decrypt($this->request->getPost('nIdOperador'));
        
        $dados['nome'] = tratarPalavras($this->request->getPost('nNomeOperador'));
        $dados['tipoOperador'] = $this->request->getPost('nTipoOperador');
        $dados['id'] = $idDb;
        $dados['idOperador'] = $idOperadorDb;     
        $dados['updated_at'] = date('Y-m-d H:i:s');    
        $dados['cpfProfissional'] =  $this->request->getPost('nIdentificador');    

    try {
        $modelOperador = new OperadorModel;

        $gravar = $modelOperador->editarOperador($dados);            

        if ($gravar) {      
           
            //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
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
        } else {
             $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => 'Operador já é um profissional',
                'msgs' => 'Operador já é um profissional',
            ];
            return $this->response->setJSON($response);  
        }

    } catch (Exception $e) {
        var_dump($e->getCode());
        session()->set('erro', 'ERRO, não foi possível realizar operação.');
        $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        return $this->response->setJSON([
            'status' => 'ERROR',
            'error' => true,
            'code' => $e->getCode(),
            'msg' => $e->getMessage(),
            'msgs' => $e->getMessage(),
        ]);
    }      
    }

    public function listarOperador()
    {
        helper("utils");
        try {
            $dat = [];
            $modelOperador = new OperadorModel();

            $data = $modelOperador->getDataOperador();

            //var_dump($data);

            foreach ($data as $value) {
                $dataTratada = new \DateTime($value->created_at);
                $dat[] = [
                    
                    'nomeOperador' => $value->nome,                                      
                    'created_at' => $dataTratada->format('Y-m-d'),
                    'idOperador' => encrypt($value->idOperador),
                    'tipoOperador' => $value->tipoOperador,
                    'id' => encrypt($value->id)
                ];

            }
            return $this->response->setJSON($dat);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }

    public function getMenuPermissaoOperador($idOperador)
    {

        helper("utils");
        try {
            $dat = [];
            $modelMenu= new MenuModel();

            $id = decrypt($idOperador);
            $data = $modelMenu->getMenuPermissaoOperador($id);  

            $modelOperador = new OperadorModel;
            $nome = $modelOperador->getNomeOperador($id);
            
            $data['NOME'] = $nome->nome;

           /* foreach ($data as $value) {
                $dataTratada = new \DateTime($value->created_at);
                $dat[] = [
                    
                    'nomeOperador' => $value->nome,                                      
                    'created_at' => $dataTratada->format('Y-m-d'),
                    'idOperador' => encrypt($value->idOperador),
                    'tipoOperador' => $value->tipoOperador,
                    'id' => encrypt($value->id)
                ];

            }*/
            return $this->response->setJSON($data);

        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }

    }

    public function desativarOperador()
    {
        helper("utils");        
        $idOperador = $this->request->getPost('nIdOperador');
        $id = $this->request->getPost('nId');
        
        $idOperadorDb = decrypt($idOperador);
        $idDb = decrypt($id);

        $dados = [
            'idOperador' => $idOperadorDb,
            'idPermissao' => $idDb,
            'ativo' => 'N'
        ];

        try {
            $modelOperador = new OperadorModel;

            $gravar = $modelOperador->desativarOperador($dados);            

            if ($gravar) {
                
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                
                $response = [
                    'status' => true,
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',
                    
                ];               
                return $this->response->setJSON($response);
                
            }
        } catch (Exception $e) {
            var_dump($e->getCode());
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            return $this->response->setJSON([
                'status' => 'ERROR',
                'error' => true,
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'msgs' => $e->getMessage(),
            ]);
        }   

    }
    public function removerPermissao(){

        helper("utils");        
        $idOperador = $this->request->getPost('nIdOperador');
        $idPermissao = $this->request->getPost('nIdPermissao');
        
        $idOperadorDb = decrypt($idOperador);
        $idPermissaoDb = decrypt($idPermissao);

        $dados = [
            'idOperador' => $idOperadorDb,
            'idPermissao' => $idPermissaoDb
        ];

        try {
            $modelOperador = new OperadorModel;

            $gravar = $modelOperador->removerPermissaoOperador($dados);            

            if ($gravar) {
                
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                
                $response = [
                    'status' => true,
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',
                    
                ];
               
                return $this->response->setJSON($response);
                
            }
        } catch (Exception $e) {
            var_dump($e->getCode());
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            return $this->response->setJSON([
                'status' => 'ERROR',
                'error' => true,
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'msgs' => $e->getMessage(),
            ]);
        }           

    }
    public function adicionarPermissao(){

        helper("utils");        
        $idOperador = $this->request->getPost('nIdOperador');
        $idPermissao = $this->request->getPost('nIdPermissao');
        
        $idOperadorDb = decrypt($idOperador);
        $idPermissaoDb = decrypt($idPermissao);

        $dados = [
            'idOperador' => $idOperadorDb,
            'idPermissao' => $idPermissaoDb
        ];


        try {
            $modelOperador = new OperadorModel;

            $gravar = $modelOperador->adicionarPermissaoOperador($dados);            

            if ($gravar) {
                
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                
                $response = [
                    'status' => true,
                    'error' => false,
                    'code' => 200,
                    'msg' => '<p>Operação realizada com sucesso!</p>',
                    
                ];
               
                return $this->response->setJSON($response);
                
            }
        } catch (Exception $e) {
            var_dump($e->getCode());
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['OPERADOR::' => $idOperadorDb, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
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
