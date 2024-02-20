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

    public function getMenuAll()
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

    public function getPermissaoPorMenu($idMenu, $idOperador) {
        
        return $this->select('P.nomeMenu, P.idPermissao, OP.ativo, OP.idOperador')
                        ->from('tb_permissao P')
                        ->join('tb_operador_permissao OP', 'P.idPermissao = OP.idPermissao AND (OP.idOperador) =' . $idOperador, 'LEFT')
                        ->where('P.idMenu', $idMenu)
                        ->where('P.ativo', 'S')
                        ->groupBy('P.idPermissao')
                        ->get()->getResult();
    }

    public function getMenuPermissaoOperador($idOperador) {

        helper("utils");
        $dataMenu = $this->getMenuAll();
        $resultado = [];
    
        foreach($dataMenu as $menu) {
            $dataPermissao = $this->getPermissaoPorMenu($menu->idMenu, $idOperador);
    
            foreach($dataPermissao as $permissao) {
                $operador = $menu->descricao; // Nome do operador ou alguma outra identificação
    
                // Adiciona a permissão ao operador no array resultado
                $resultado[$operador][] = [
                    'nomeMenu' => $permissao->nomeMenu,
                    'idPermissao' => encrypt($permissao->idPermissao),
                    'ativo' => $permissao->ativo
                ];
            }
        }
    
        return $resultado;
    }
}
