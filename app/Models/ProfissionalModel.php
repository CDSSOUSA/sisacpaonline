<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ProfissionalModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tb_profissional';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = true;
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
            'nome' => [
                'id' => 'iProfissional',
                'name' => 'nNomeProfissional',
                'label' => 'Nome Completo: *',
                'iError' => 'nNomeProfissional'
            ],
            'cpfProfissional' => [
                'id' => 'iCpfProfissional',
                'name' => 'nCpfProfissional',
                'label' => 'Cpf Profissional: *',
                'iError' => 'nCpfProfissional'
            ],
            'genero' => [
                'id' => 'iGenero',
                'name' => 'nGenero',
                'label' => 'Gênero: *',
                'iError' => 'nGenero'
            ],
            'cnsProfissional' => [
                'id' => 'iCnsProfissional',
                'name' => 'nCnsProfissional',
                'label' => 'Cns Profissional: *',
                'iError' => 'nCnsProfissional'
            ],
            'tipoProfissional' => [
                'id' => 'iTipoProfissional',
                'name' => 'nTipoProfissional',
                'label' => 'Tipo profissional: *',
                'iError' => 'nTipoProfissional'
            ],
            'modalidade' => [
                'id' => 'iModalidade',
                'name' => 'nModalidade',
                'label' => 'Modalidade: *',
                'iError' => 'nModalidade'
            ],
            'numClasse' => [
                'id' => 'iNumConselho',
                'name' => 'nConselhoClasse',
                'label' => 'Núm. Cons. Classe',
                'iError' => 'nConselhoClasse'
            ]
        ];
    }

    public function getProfissionalAtivo()
    {
        return $this->orderBy('ativo desc, nomeProfissional asc')
            ->get()->getResult();
    }

    public function savePessoa($dados)
    {
        var_dump('entrei para salvar');
        try {
            $dado['nome'] = $dados['nomeProfissional'];
            $dado['ativo'] = 'S';
            $dado['cpf'] = $dados['cpfProfissional'];
            $dado['idOperadorCadastro'] = session()->get('idOperador');
            $dado['tipo'] = 3;
            $dado['tipoOperador'] = 'P';

            $pessoa = new PessoaModel();
            $salvarPessoa = $pessoa->save($dado);
            $salvarPessoa = true;

            if ($salvarPessoa) {
                return true;
            }

        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function saveProfissional($dados)
    {

        try {
           
            $result = $this->savePessoa($dados);

            if ($result) {
                $modelPessoa = new PessoaModel;
                $ultimaPessoa = $modelPessoa->getLastPessoa();
                $idProfissional = $ultimaPessoa->idPessoa;

                $dadosProf['idProfissional'] = $idProfissional;                
                $dadosProf['nomeProfissional'] = $dados['nomeProfissional'];
                $dadosProf['cpfProfissional'] = $dados['cpfProfissional'];
                $dadosProf['cnsProfissional'] = $dados['cnsProfissional'];
                $dadosProf['genero'] = $dados['genero'];
                $dadosProf['operadorAtivo'] = $dados['operadorAtivo'];
                $dadosProf['tipoProfissional'] = $dados['tipoProfissional'];
                $dadosProf['numeralConselhoClasse'] = $dados['numeralConselhoClasse'];
                $dadosProf['modalidade'] = $dados['modalidade'];
                //$dados['idProfissional'] = $idProfissional;
                $salvarProfissional = $this->save($dadosProf);

                if($salvarProfissional){
                    return true;
                }               
            }
            return false;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            // Fazer o rollback da transação em caso de erro
            $this->db->transRollback();
            return false;
        }

    }

    public function ativaDesativaProfissional($dados)
    {
        try {
            $this->db->transBegin();

            var_dump($dados);

            $dado['idProfissional'] = $dados['idProfissional'];
            $dado['id'] = $dados['id'];
            $dado['ativo'] = $dados['ativo'];
            $dado['operadorAtivo'] = $dados['operadorAtivo'];
            $dado['updated_at'] = date('Y-m-d H:i:s');
            $this->save($dado);



            $pessoa = new PessoaModel;
            $dadoPessoa['idPessoa'] = $dados['idProfissional'];
            $dadoPessoa['ativo'] = $dados['ativo'];
            $pessoa->save($dadoPessoa);

            //$this->db->update('tb_pessoa', array('ativo' => $dados['ativo']), array('idPessoa' => $dados['idProfissional']));
            if ($dados['ativo'] == 'N') {
                $modelAlocacao = new AlocacaoModel;

                $dataAlocacao = [
                    'ativo' => $dados['ativo'],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $modelAlocacao->where([
                    'idProfissional' => $dados['idProfissional'],
                    'ativo' => 'S'
                ]);
                $modelAlocacao->builder->update($dataAlocacao);
            }

            if ($dados['operadorAtivo'] == 'S') {
                $modelOperador = new OperadorModel;
                $dataOperador = [
                    'ativo' => $dados['ativo']
                ];
                $modelOperador->where('idOperador', $dados['idProfissional']);
                $modelOperador->builder->update($dataOperador);

                $modelOperadorPermissao = new OperadorPermissaoModel;
                // $dataOperadorPermissao = [
                //     'ativo' => $dados['ativo']
                // ];
                //$modelOperadorPermissao->where('idOperador', $dados['idProfissional']);           
                $modelOperadorPermissao->delete($dados['idProfissional']);
            }
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

    }



    public function verificaDuplicidade($idProfissional, $diaSemana, $horaInicio)
    {
        $modelAlocacao = new AlocacaoModel;
        $duplicidade = $modelAlocacao->getDuplicidade($idProfissional, $diaSemana, $horaInicio);


        if ($duplicidade) {
            return true;
        }
        return false;

    }


    public function gravarAlocacao($dados)
    {
        $qtdeInsert = 0;
        $qtdeUpdate = 0;
        try {
            $this->db->transBegin();

            $diaSemana = $dados['diaSemana'];
            $horarios = $dados['horarios'];

            foreach ($diaSemana as $d) {
                $dadoAlocacao['diaSemana'] = $d;
                $dadoAlocacao['idProfissional'] = $dados['idProfissional'];

                foreach ($horarios as $hmt) {

                    $horario = explode('-', $hmt);

                    $dadoAlocacao['horaInicio'] = $horario[0];
                    $dadoAlocacao['horaFim'] = $horario[1];

                    $duplicidade = $this->verificaDuplicidade(
                        $dados['idProfissional'],
                        $dadoAlocacao['diaSemana'],
                        $dadoAlocacao['horaInicio']
                    );

                    $qtdeUpdate++;

                    if (!$duplicidade) {
                        //$this->session->set_flashdata('erro', 'ERRO, horário duplicado.');

                        $modelAlocacao = new AlocacaoModel;
                        $modelAlocacao->save($dadoAlocacao);
                        $qtdeInsert++;
                        $qtdeUpdate--;
                    }
                }

            }



            if ($this->db->transStatus()) {
                $this->db->transCommit();
                return [
                    'status' => true,
                    'insert' => $qtdeInsert,
                    'update' => $qtdeUpdate
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




        /*foreach ($dia AS $dias)
        {

            $dadoAlocacao['diaSemana'] = $dias;
            $dadoAlocacao['idProfissional'] = $dados['idProfissional'];
            $dadoAlocacao['horaInicio'] = $dados['horaInicio'];
            $dadoAlocacao['horaFim'] = $dados['horaFim'];

            $duplicidade = $this->verificaDuplicidade($dados['idProfissional'], $dadoAlocacao['diaSemana'], $dados['horaInicio'],$dados['horaFim']);

            if($duplicidade === TRUE){
                //$this->session->set_flashdata('erro', 'ERRO, horário duplicado.');

            } else {
                $this->db->insert('tb_alocacao', $dadoAlocacao);
                gerarLog($this->dataLog, $this->session->userdata('idOperador'), 'ALOCOU HORARIO PARA', $dados['idProfissional']);

            }           

        }
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {

            return FALSE;

        } 
        else
        {

            return TRUE;

        }*/

    }

    public function getDataProfissional($id)
    {
        return $this->where('idProfissional',$id) 
          ->get()->getResult();
    }

}
