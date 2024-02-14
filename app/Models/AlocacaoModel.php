<?php

namespace App\Models;

use CodeIgniter\Model;

class AlocacaoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_alocacao';
    protected $primaryKey       = 'idAlocacao';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $colunas = $db->getFieldNames($this->table);

        $this->allowedFields = $colunas;
    }

    public function getAlocacao($idProfissional)
    {
        return $this->select('idAlocacao, diaSemana, horaInicio, horaFim, p.nomeProfissional, p.idProfissional, p.modalidade')
            ->join('tb_profissional p','p.idProfissional = '.$this->table.'.idProfissional')
            ->where($this->table.'.idProfissional', $idProfissional)
            ->where($this->table.'.ativo','S')
            ->get()->getResult();
    }  
    public function getAlocacaoId($idAlocacao)
    {
        return $this->select('idAlocacao, diaSemana, horaInicio, horaFim, '.$this->table.'.idProfissional, p.nomeProfissional')
            ->join('tb_profissional p','p.idProfissional = '.$this->table.'.idProfissional')
            //->where($this->table.'.idProfissional', $idProfissional)
            ->where('idAlocacao',$idAlocacao)
            ->get()->getResult();
    }  

    public function getDuplicidade($idProfissional, $diaSemana, $horaInicio)
    {

        return $this->where('idProfissional', $idProfissional)
                        ->where('diaSemana', $diaSemana)
                        ->where('horaInicio', $horaInicio)
                        ->where('ativo', 'S')                        
                        ->get()->getResult();

    }

    public function removerAlococao($dados)
    {
        try {
            $this->db->transBegin();
            
            //$modelAlocacao = new AlocacaoModel;  
            $dataAlocacao = [
                'ativo' => 'N',                  
                'updated_at' => date('Y-m-d H:i:s')             
            ];
        
            $this->where([
                'idProfissional'=> $dados['idProfissional'],
                'idAlocacao' => $dados['idAlocacao']
            ]);
            $this->builder->update($dataAlocacao); 
   

            $modelAtendimento = new AtendimentoModel;
            $modelAtendimento->where([
                'idProfissional'=> $dados['idProfissional'],
                'idAlocacao' => $dados['idAlocacao']
            ]);

            $modelAtendimento->builder->update($dataAlocacao);            
            


            if ($this->db->transStatus()) {
                $this->db->transCommit();
                return [
                    'status'=> true,                    
                ];
            }
            $this->db->transRollback();

            return false;

        } catch (\Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            
            // Fazer o rollback da transação em caso de erro
            $this->db->transRollback();
            return false;
        }
        
    }

    public function getAlocacaoDia($dia,$idProfissional)
    {
        return $this->select('idAlocacao, diaSemana, horaInicio, horaFim, p.nomeProfissional, p.idProfissional, p.modalidade')    
                        ->join('tb_profissional p','p.idProfissional = '.$this->table.'.idProfissional')
                        ->where($this->table.'.idProfissional', $idProfissional)                                       
						//->where('idProfissional', $idProfissional)                       
						->where($this->table.'.ativo', 'S')                       
						->where($this->table.'.diaSemana', $dia)                       
                        ->get()->getResult();

                       
    }
}
