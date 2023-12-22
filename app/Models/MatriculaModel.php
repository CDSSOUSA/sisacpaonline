<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class MatriculaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_matricula';
    protected $primaryKey       = 'idMatricula';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getMatriculasUsuario($idUsuario)
    {
        return $this->select('U.nomeUsuario, U.nomeMae,U.nomePai, U.nomeResponsavel, U.idUsuario, U.telefoneResponsavel, 
        tb_matricula.dataMatricula, tb_matricula.idMatricula, U.cpfUsuario, tb_matricula.anoMatricula')
            //->from('tb_matricula M')
            ->join('tb_usuario U', 'tb_matricula.idUsuario = U.idUsuario')
            ->where('tb_matricula.idUsuario', $idUsuario)
            ->where('tb_matricula.ativo', 'S')
            //->where('M.dataDesligamento !=', '0000-00-00')
            ->orderBy('U.nomeUsuario', 'ASC')
            ->countAllResults();
    }
    public function getMatriculaUsuario($idUsuario)
    {
        return $this->select('U.nomeUsuario, U.nomeMae,U.nomePai, U.nomeResponsavel, U.idUsuario, U.telefoneResponsavel, 
        tb_matricula.dataMatricula, tb_matricula.idMatricula, U.cpfUsuario, tb_matricula.anoMatricula')
            //->from('tb_matricula M')
            ->join('tb_usuario U', 'tb_matricula.idUsuario = U.idUsuario')
            ->where('tb_matricula.idUsuario', $idUsuario)
            ->where('tb_matricula.ativo', 'S')
            //->where('M.dataDesligamento !=', '0000-00-00')
            //->orderBy('U.nomeUsuario', 'ASC')
            ->get();
    }

    public function getUsuarioMatriculado($idUsuario, $ano)
    {

        return $this->select('*')
            ->where('idUsuario', $idUsuario)
            ->where('anoMatricula', $ano)
            ->where('ativo', 'S')
            ->get();
    }

    public function getMatriculasDesligadas($idUsuario)
    {
        return $this->select('U.nomeUsuario, U.nomeMae,U.nomePai, U.nomeResponsavel, U.idUsuario, U.telefoneResponsavel, 
                tb_matricula.dataMatricula, tb_matricula.idMatricula, U.cpfUsuario, tb_matricula.anoMatricula')
            ->join('tb_usuario U', 'tb_matricula.idUsuario = U.idUsuario')
            ->where('tb_matricula.idUsuario', $idUsuario)
            ->where('tb_matricula.ativo', 'N')
            //->where('M.dataDesligamento !=', '0000-00-00')
            ->orderBy('U.nomeUsuario', 'ASC')
            ->get();
    }

    public function salvarMatricula($dados)
    {
        try {

            $usuarioMatriculado = $this->getUsuarioMatriculado($dados['idUsuario'], $dados['anoMatricula']);           

            if (!$usuarioMatriculado->getResult()) {               
                
                $this->insert($dados);    
                return true;
            }
            session()->set('erro', 'ERRO, usuário já matriculado em ' . $dados['anoMatricula'] . '.');
            return false;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }
}
