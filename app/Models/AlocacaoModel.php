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

    public function getAlocacao($idProfissional)
    {
        return $this->select('idAlocacao, diaSemana, horaInicio, horaFim, p.nomeProfissional')
            ->join('tb_profissional p','p.idProfissional = '.$this->table.'.idProfissional')
            ->where($this->table.'.idProfissional', $idProfissional)
            ->where($this->table.'.ativo','S')
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
}
