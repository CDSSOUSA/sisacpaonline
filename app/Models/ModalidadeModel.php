<?php

namespace App\Models;

use CodeIgniter\Model;

class ModalidadeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_modalidade';
    protected $primaryKey       = 'idModalidade';
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

    public function getDataModalidade()
    {
        return $this->select('*')
            ->where('ativo','S')
            ->findAll();
    }

    public function getAtributos()
    {
        return [
            'descricao' => [
                'id' => 'iDescricao',
                'name' => 'nDescricaoModalidade',
                'label' => 'Descrição: *',
                'iError' => 'iErrorDescricao'
            ],
            'cbo' => [
                'id' => 'iCbo',
                'name' => 'nCbo',
                'label' => 'CBO: *',
                'iError' => 'iErrorCbo'
            ],
            
        ];
    }
}
