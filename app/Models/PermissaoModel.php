<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissaoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_permissao';
    protected $primaryKey       = 'idPermissao';
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

    public function getItem(int $idOperador)
    {
        return $this->join('tb_operador_permissao OP', 'tb_permissao.idPermissao =  OP.idPermissao')
            ->where('OP.idOperador', $idOperador)
            ->where('OP.ativo','S')
            ->where('tb_permissao.ativo','S')
            ->findAll();
    }
}
