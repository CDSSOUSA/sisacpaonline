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
        helper("utils");
        try {
            $dat =[];
            $modelProfissional = new ProfissionalModel();
            
            $data = $modelProfissional->getProfissionalAtivo();

            //var_dump($data);

            foreach ($data as $value) {
                $dat [] = [
                    'ativo' => $value->ativo,
                    'cnsProfissional'=> $value->cnsProfissional,
                    'cpfProfissional'=> $value->cpfProfissional,
                    'genero'=> $value->genero,
                    'idProfissional'=> encrypt($value->idProfissional),
                    'modalidade'=> $value->modalidade,
                    'nomeProfissional'=> $value->nomeProfissional, 
                    'numeralConselhoClasse'=> $value->numeralConselhoClasse, 
                    'operadorAtivo'=> $value->operadorAtivo, 
                    'tipoProfissional'=> $value->tipoProfissional, 
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
            $modelProfissional = new ProfissionalModel();
            $data = $modelProfissional->find($id);
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
        if($result){
            $response = [
                'status' => 'ERROR',
                'error' => true,
                'code' => 400,
                'msg' => ['nIdProfissional'=>'Id inválido'],
                'msgs' => ['nIdProfissional'=>'Id inválido']
            ];

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $id,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => ['nIdProfissional'=>'Id inválido']
            ]);
            return $this->response->setJSON($response);
        }
        
        $rules = [
            'nNomeProfissional' => 'required|min_length[3]',
            'nGenero' => 'required',
            'nCpfProfissional' => 'required|validateCpf|is_unique[tb_pessoa.cpf, idPessoa, {$id}]',
            'nCnsProfissional' => 'required|valid_cns|is_unique[tb_profissional.cnsProfissional, idProfissional,{$id}]',
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
    }
}
