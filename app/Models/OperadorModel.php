<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class OperadorModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tb_operador';
    protected $primaryKey = 'idOperador';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $colunas = $db->getFieldNames($this->table);

        $this->allowedFields = $colunas;
    }
    public function getAtributos()
    {
        return [
            'nomeOperador' => [
                'id' => 'iNomeOperador',
                'name' => 'nNomeOperador',
                'label' => 'Nome Completo: *',
                'iError' => 'iErrorNomeOperador'
            ],
            'cpfOperador' => [
                'id' => 'iCpfOperador',
                'name' => 'nCpfOperador',
                'label' => 'Número CPF: *',
                'iError' => 'iErrorCpfOperador'
            ],
            'tipoOperador' => [
                'id' => 'iTipoOperador',
                'name' => 'nTipoOperador',
                'label' => 'Tipo Operador: *',
                'iError' => 'iErrorTipoOperador'
            ],

        ];
    }

    public function getNomeOperador($idOperador)
    {
        return $this->select('nome')
                ->where('idOperador', $idOperador)
                ->get()->getRow();   
    }
    public function getDataOperadorId($idOperador)
    {
        return $this->select('nome, id, idOperador, tipoOperador, login')
                ->where('idOperador', $idOperador)
                ->get()->getResult();   
    }



    public function salvarOperador($dados)
    {
       
        try {

            $pessoa = new PessoaModel();
            $salvarPessoa = $pessoa->save($dados);

            if ($salvarPessoa) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
    public function editarOperador($dados)
    {        
        try {   

            if($dados['tipoOperador'] == 'S'){                
                $modelProfissional = new ProfissionalModel;
                $resultOp = $modelProfissional->getDataProfissional($dados['idOperador']);           

                if(!$resultOp){                    
                   
                    $dado['idProfissional'] = $dados['idOperador'];
                    $dado['cpfProfissional'] =  $dados['cpfProfissional'];                     
                    $this->inserirSuperAdministrador($dado);
                } 
            }
            $salvarOperador = $this->save($dados);

            if ($salvarOperador) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function inserirSuperAdministrador($dados) 
	{
        try{

			$data['idProfissional'] = $dados['idProfissional'];
			$data['nomeProfissional'] = $dados['nome'];
			$data['modalidade']= '';
			$data['cpfProfissional'] = $dados['cpfProfissional'];
			$data['genero'] = '';
			$data['ativo'] = 'S';
			$data['operadorAtivo'] = 'S';
			$data['tipoProfissional'] = 'O';
			$data['numeralConselhoClasse'] = '';

            $modelProfissional = new ProfissionalModel;

            $salvar = $modelProfissional->save($data);

            if ($salvar) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
  
	}

    public function getDataOperador()
    {
        return $this->select('*')
            //->where('ativo', 'S')
            ->orderBy('ativo DESC','nome ASC')
            ->findAll();
    }

    public function removerPermissaoOperador($dados)
    {
        try {
            $modelOperadorPermissao = new OperadorPermissaoModel;
            $deletePermissao = $modelOperadorPermissao->where(
                [
                    'idOperador' => $dados['idOperador'],
                    'idPermissao' => $dados['idPermissao'],
                    'ativo' => 'S'
                ]
            )
                ->delete();

            if ($deletePermissao) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }

    }
    public function desativarOperador($dados)
    {
        try {
           
            $salvarOperador = $this->save($dados);
            if ($salvarOperador) {

                $modelOperadorPermissao = new OperadorPermissaoModel;

                $modelOperadorPermissao->where(
                    [
                        'idOperador' => $dados['idOperador'],                                        
                    ]
                )->delete();

                //$this->db->delete('tb_operador_permissao', array('idOperador' => $dados['idOperador']));
                $modelProfissional = new ProfissionalModel;
                $dataOperador = [
                    'ativo' => 'N',
                    'operadorAtivo' => 'N',
                    'updated_at'=>date('Y-m-d H:i:s')
                ];
                //$modelProfissional->where('idProfissional', $dados['idOperador']);
                //$modelProfissional->builder->update($dataOperador);

                $modelProfissional->where([
                    'idProfissional' => $dados['idOperador']                  
                    
                ]);
                $modelProfissional->builder->update($dataOperador);
            //$this->db->update('tb_profissional', array('operadorAtivo' => $dados['ativo']), array('idProfissional' => $dados['idOperador']));

     
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }

    }
    public function ativarOperador($dados)
    {
        try {
           
            $salvarOperador = $this->save($dados);
            if ($salvarOperador) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }

    }
    public function adicionarPermissaoOperador($dados)
    {
        try {
            $modelOperadorPermissao = new OperadorPermissaoModel;

            $dados = [
                'idOperador' => $dados['idOperador'],
                'idPermissao' => $dados['idPermissao'],
                'ativo' => 'S',
                'created_at' => date('Y-m-d H:i:s')
            ];     

            $salvaPermissao = $modelOperadorPermissao->save($dados);             
          

            if ($salvaPermissao) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }

    }

}
