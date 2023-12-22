<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_menu';
    protected $primaryKey       = 'idMenu';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['descricao', 'ativo', 'link', 'icone'];

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

    public function getMenu(int $idOperador)
    {
        return $this->select('*')
            //->from('tb_menu M')
            //->join('tb_permissao P', 'P.idMenu = M.idMenu')
            //->join('tb_operador_permissao OP', 'OP.idPermissao = P.idPermissao')
            ->where('ativo', 'S')
            //->where('OP.idOperador', $idOperador)
            //->groupBy("M.idMenu")
            ->orderBy("idMenu")
            ->findAll();
    } 
}
