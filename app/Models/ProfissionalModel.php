<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfissionalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_profissional';
    protected $primaryKey       = 'idProfissional';
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

    public function getProfissionalAtivo()
    {
        return $this->where('ativo','S')
                    ->orderBy('nomeProfissional')
                    ->findAll();
    }

    public function saveProfissional($dados)
    {

        try {
            $this->db->transBegin();

            $dado['nome'] = $dados['nomeProfissional'];        
            $dado['ativo'] = 'S';
            $dado['cpf'] = $dados['cpfProfissional'];
            $dado['idOperadorCadastro'] = session()->get('idOperador');
            $dado['tipo'] = 3;     
            $dado['tipoOperador'] = 'P';       

            $pessoa = new PessoaModel();
            $pessoa->save($dado);


            $ultimaPessoa = $pessoa->getLastPessoa();
            $idProfissional = $ultimaPessoa->idPessoa;
            $dados['idProfissional'] = $idProfissional;
            $this->insert($dados);
            

            if ($this->db->transStatus()) {
                $this->db->transCommit();
                return true;
            }
            $this->db->transRollback();

            return false;
        } catch (\Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            // Fazer o rollback da transação em caso de erro
            $this->db->transRollback();
            return false;
        }

        // $dadosProf['idProfissional'] = $idProfissional;
        // $dadosProf['nomeProfissional'] = $dados['nomeProfissional'];
        // $dadosProf['cpfProfissional'] = $dados['cpfProfissional'];
        // $dadosProf['genero'] = $dados['genero'];
        // $dadosProf['operadorAtivo'] = $dados['operadorAtivo'];
        // $dadosProf['tipoProfissional'] = $dados['tipoProfissional'];
        // $dadosProf['numeralConselhoClasse'] = $dados['numeralConselhoClasse'];
        // $dadosProf['modalidade'] = $dados['modalidade'];

       //$this->db->insert('tb_profissional', $dadosProf);
        

    }
}
