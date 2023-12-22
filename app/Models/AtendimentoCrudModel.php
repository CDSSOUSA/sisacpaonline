<?php

namespace App\Models;

use CodeIgniter\Model;

class AtendimentoCrudModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_atendimento';
    protected $primaryKey       = 'idAtendimento';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nomeUsuario','idUsuario'];

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

    public function editNameAtendimento($idUsuario, $name): bool
    {

        $data = [
            'nomeUsuario' => $name,
            
        ];       
        $this->where('idUsuario', $idUsuario);       
        if ($this->builder->update($data)) {
            return true;
        }
        return false;
    }
}
