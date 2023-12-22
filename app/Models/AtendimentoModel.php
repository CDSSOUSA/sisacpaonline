<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AtendimentoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_atendimento';
    protected $primaryKey       = 'idAtendimento';
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

    /*public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $colunas = $db->getFieldNames($this->table);

        $this->allowedFields = $colunas;
    }*/

    public function getAtendimentosRealizadosPorUsuario(int $idUsuario)
    {

        return $this->select('RA.numeroRegistro, RA.dataAtendimento,
              tb_atendimento.nomeProfissional, tb_atendimento.modalidade, tb_atendimento.diaSemana,tb_atendimento.horaInicio')
            //->from('tb_atendimento A')
            ->join('tb_registro_atendimento RA', 'RA.idAtendimento = tb_atendimento.idAtendimento')
            ->where('(tb_atendimento.idUsuario)', $idUsuario)
            ->where('RA.atendido', 'S')
            ->orderBy('RA.dataAtendimento')
            ->orderBy('tb_atendimento.diaSemana')
            ->orderBy('tb_atendimento.horaInicio')
            ->countAllResults();
    }

    public function getAtendimentos($idUsuario)
    {

        return $this->where('(idUsuario)', $idUsuario)
            ->where('ativo', 'S')
            ->orderBy('diaSemana', 'asc')
            ->orderBy('dataPrevisaoAtendimento', 'asc')
            ->orderBy('horaInicio', 'asc')
            ->get()->getResult();
    }

    public function getAlocacaoAtendimento($idAlocacao)
    {
        return $this->where('idAlocacao', $idAlocacao)
            ->where('ativo', 'S')
            ->get()->getResult();
    }
    public function verificarAtendimentoUsuario($idUsuario, $diaSemana, $horaInicio)
    {

        return $this->where('idUsuario', $idUsuario)
            ->where('ativo', 'S')
            ->where('diaSemana', $diaSemana)
            ->where('horaInicio', $horaInicio)
            ->get();
    }

    public function salvarAtendimento($dados)
    {
        try {
            $this->db->transBegin();
            $arrayFeriado = [
                '2023-09-07',
                '2023-10-11',
                '2023-10-12',
                '2023-11-02',
                '2023-11-15',
                '2023-12-08',
                '2023-12-25',
                '2023-12-31',
            ];

            $proximasDatas = proximas_datas_do_dia_da_semana($dados['diaSemana'] - 1);

            foreach ($proximasDatas as $dt) {

                if (!in_array($dt, $arrayFeriado)) {

                    $dados['dataPrevisaoAtendimento'] = $dt;

                    $this->builder->insert($dados);
                }
            }

            if ($this->db->transStatus()) {

                $this->db->transCommit();

                return true;
            }

            $this->db->transRollback();

            return false;
        } catch (Exception $e) {

            echo 'Erro: ' . $e->getMessage();

            // Fazer o rollback da transação em caso de erro
            $this->db->transRollback();
            return false;
        }
    }

    public function desativarAtendimento($idAtendimento)
    {
        try {
            $data = [
                'ativo' => 'N',
            ];
            $this->where('idAtendimento', $idAtendimento);
            $this->builder->update($data);
            return true;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function getAtendimentosDia($dia)
    {

        return $this->select('tb_atendimento.*, U.acompanhante')
            ->join('tb_usuario U', 'U.idUsuario = tb_atendimento.idUsuario')
            ->where('dataPrevisaoAtendimento', $dia)
            ->where('tb_atendimento.ativo', 'S')
            //->where('a.dataRegistro', '1990-01-01')
            //->where('a.dataRegistro !=', date("Y-m-d"))
            ->orderBy('tb_atendimento.horaInicio')
            ->get()->getResult();
    }

    public function gravarPresenca(array $dado)
    {
        helper('utils');
        
        try {
            $registroAtendimento = new RegistroAtendimentoModel;
            $this->db->transBegin();

            $dados['idAtendimento'] = $dado['idAtendimento'];
            $dados['numeroRegistro'] = gerar_senha(6, false, false, true, false);
            $dados['dataAtendimento'] = $dado['dataAtendimento'];
            $dados['atendido'] = 'S';
            $dados['faltaUsuario'] = 'N';
            $dados['faltaProfissional'] = 'N';
            $dados['justificouFaltaUsuario'] = 'N';
            $dados['textoJustificativaFalta'] = NULL;
            $dados['dataRegistroJustificativa'] = NULL;
            $dados['idOperadorRegistro'] = session()->get('idOperador');
            $dados['jaEvoluiu'] = 'N';
            $dados['textoEvolucao'] = NULL;
            $dados['dataRegistroEvolucao'] = NULL;
            $dados['idOperadorRegistroEvolucao'] = session()->get('idOperador');
            $dados['horaAtendimento'] = $dado['horaAtendimento'];
            
            $registroAtendimento->insert($dados);
          

            $data = [
                'ativo' => 'N',                
                'dataUltimoAtendimento' => $dado['dataAtendimento'],
                'dataRegistro' => $dado['dataAtendimento'],


            ];
            $this->where('idAtendimento', $dado['idAtendimento']);
            $this->builder->update($data);

            if ($this->db->transStatus()) {

                $this->db->transCommit();

                return true;
            }

            $this->db->transRollback();

            return false;
        } catch (Exception $e) {

            echo 'Erro: ' . $e->getMessage();

            // Fazer o rollback da transação em caso de erro
            $this->db->transRollback();
            return false;
        }
    }
}
