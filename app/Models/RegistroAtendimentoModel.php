<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class RegistroAtendimentoModel extends MyModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_registro_atendimento';
    protected $primaryKey       = 'idRegistroAtendimento';
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

    public function getAtendimentosRegistradosFaltaUsuario($idUsuario, $opcao = 'N')
    {

        return $this->select('tb_registro_atendimento.textoJustificativaFalta, 
                tb_registro_atendimento.justificouFaltaUsuario, 
                tb_registro_atendimento.numeroRegistro, 
                tb_registro_atendimento.idRegistroAtendimento,
                A.nomeUsuario, A.idProfissional, A.modalidade, A.diaSemana, A.horaInicio, tb_registro_atendimento.dataAtendimento,
                A.nomeProfissional, A.idUsuario, A.ativo 
            ')->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
            ->where('tb_registro_atendimento.faltaUsuario', 'S')
            ->where('YEAR(tb_registro_atendimento.dataAtendimento)', session()->get('anoAtivo'))
            ->where('tb_registro_atendimento.justificouFaltaUsuario !=', $opcao)
            ->where('A.idUsuario', $idUsuario)
            ->orderBy('tb_registro_atendimento.dataAtendimento', 'ASC')
            //->group_by('A.nomeProfissional')
            ->get()->getResult();
    }

    public function getAtendimentosRegistradosFaltaProfissional($idProfissional, $opcao = 'N')
    {

        return $this->select('A.nomeProfissional, A.idUsuario, A.nomeUsuario, A.idProfissional, A.modalidade, A.diaSemana, A.horaInicio, tb_registro_atendimento.dataAtendimento, tb_registro_atendimento.numeroRegistro, tb_registro_atendimento.idRegistroAtendimento')
            ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
            ->where('tb_registro_atendimento.faltaProfissional', 'S')
            ->where('tb_registro_atendimento.justificouFaltaProfissional !=', $opcao)
            ->where('A.idProfissional', $idProfissional)
            ->orderBy('tb_registro_atendimento.dataAtendimento', 'ASC')            
            ->get()->getResult();
    }

    public function getAtendimentosRegistradosFaltaUsuarioProfissional($idUsuario, $opcao = 'N') {

        return $this->select('A.nomeProfissional, tb_registro_atendimento.justificouFaltaProfissional, 
                            A.idUsuario, A.nomeUsuario, A.idProfissional, A.modalidade, A.diaSemana, 
                            A.horaInicio, tb_registro_atendimento.dataAtendimento, tb_registro_atendimento.numeroRegistro, tb_registro_atendimento.idRegistroAtendimento')
                        ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
                        ->where('tb_registro_atendimento.faltaProfissional', 'S')
                        ->where('tb_registro_atendimento.justificouFaltaProfissional !=', $opcao)
                        ->where('YEAR(tb_registro_atendimento.dataAtendimento)', session()->get('anoAtivo'))
                        ->where('A.idUsuario', $idUsuario)
                        ->orderBy('tb_registro_atendimento.dataAtendimento', 'ASC')                        
                        ->get()->getResult();
    }

    public function getDocumentoJustificativa($idRegistroAtendimento)
    {
        $documento = new DocumentoJustificativaModel;
        return $documento->getDocumentoJustificativa($idRegistroAtendimento);
    }

    public function getRegistro($idRegistroAtendimento)
    {

        return $this->select('A.nomeUsuario, A.nomeProfissional, 
                              tb_registro_atendimento.dataRegistroEvolucao, tb_registro_atendimento.textoEvolucao,tb_registro_atendimento.dataAtendimento, 
                              tb_registro_atendimento.idRegistroAtendimento, tb_registro_atendimento.textoJustificativaFalta,
                              tb_registro_atendimento.numeroRegistro,
                              A.idProfissional, A.idAtendimento, 
                              A.idUsuario, A.horaInicio, A.diaSemana, A.modalidade')
            ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
            ->where('tb_registro_atendimento.idRegistroAtendimento', $idRegistroAtendimento)
            ->get()->getRow();
    }

    public function gravarJustificativaFaltaUsuario($dados)
    {

        try {
            $this->db->transBegin();

            if ($dados['repeteTodos'] == 'S') {

                $atendimentos = $this->getAtendimentosRegistradosFaltaUsuario($dados['idUsuario'], 'S');

                foreach ($atendimentos as $atendimento) {

                    $data = [
                        'justificouFaltaUsuario' => 'S',
                        'textoJustificativaFalta' => $dados['textoJustificativaFalta'],
                        'dataRegistroJustificativa' => date('Y-m-d H:i:s')

                    ];
                    $this->where('idRegistroAtendimento', $atendimento->idRegistroAtendimento);
                    $this->builder->update($data);
                }
            } else if ($dados['repeteDatas'] == 'S') {

                $atendimentos = $this->getAtendimentosRegistradosFaltaUsuario($dados['idUsuario'], 'S');

                foreach ($atendimentos as $atendimento) {

                    $data = [
                        'justificouFaltaUsuario' => 'S',
                        'textoJustificativaFalta' => $dados['textoJustificativaFalta'],
                        'dataRegistroJustificativa' => date('Y-m-d H:i:s')

                    ];
                    $this->where('idRegistroAtendimento', $atendimento->idRegistroAtendimento);
                    $this->where('dataAtendimento', $dados['dataAtendimento']);
                    $this->where('faltaUsuario', 'S');
                    $this->builder->update($data);
                }
            } else {

                $data = [
                    'justificouFaltaUsuario' => 'S',
                    'textoJustificativaFalta' => $dados['textoJustificativaFalta'],
                    'dataRegistroJustificativa' => date('Y-m-d H:i:s')

                ];
                $this->where('idRegistroAtendimento', $dados['idRegistroAtendimento']);
                $this->builder->update($data);
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

    public function gravarJustificativaFaltaProfissional($dados)
    {
        try {
            $this->db->transBegin();

            if ($dados['repeteDatas'] == 'S') {

                $atendimentos = $this->getAtendimentosRegistradosFaltaProfissional($dados['idUsuario'], 'S');

                foreach ($atendimentos as $atendimento) {

                    $data = [
                        'justificouFaltaProfissional' => 'S',
                        'textoJustificativaFaltaProfissional' => $dados['textoJustificativaFaltaProfissional'],
                        'dataRegistroJustificativaProfissional' => date('Y-m-d H:i:s')

                    ];
                    $this->where('idRegistroAtendimento', $atendimento->idRegistroAtendimento);
                    $this->where('dataAtendimento', $dados['dataAtendimento']);
                    $this->where('faltaProfissional', 'S');
                    $this->builder->update($data);
                }
            } else {

                $data = [
                    'justificouFaltaProfissional' => 'S',
                    'textoJustificativaFaltaProfissional' => $dados['textoJustificativaFaltaProfissional'],
                    'dataRegistroJustificativaProfissional' => date('Y-m-d H:i:s')

                ];
                $this->where('idRegistroAtendimento', $dados['idRegistroAtendimento']);
                $this->builder->update($data);
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
            return false;        }

        
    }

    // public function getAtendimentosRegistradosFaltaUsuario($idUsuario, $opcao = 'N')
    // {

    //     return $this->select('A.nomeProfissional, A.idUsuario, 
    //                         tb_registro_atendimento.textoJustificativaFalta, tb_registro_atendimento.justificouFaltaUsuario, 
    //                         A.nomeUsuario, A.idProfissional, A.modalidade, A.diaSemana, 
    //                         A.horaInicio, tb_registro_atendimento.dataAtendimento, tb_registro_atendimento.numeroRegistro, 
    //                         tb_registro_atendimento.idRegistroAtendimento')
    //         ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
    //         ->where('tb_registro_atendimento.faltaUsuario', 'S')
    //         ->where('YEAR(tb_registro_atendimento.dataAtendimento)', session()->get('anoAtivo'))
    //         ->where('tb_registro_atendimento.justificouFaltaUsuario !=', $opcao)
    //         ->where('A.idUsuario', $idUsuario)
    //         ->order_by('tb_registro_atendimento.dataAtendimento', 'ASC')
    //         ->get();
    // }

    public function desfazRegistroAtendimento($idRegistroAtendimento) {

        try {

            $this->where('idRegistroAtendimento', $idRegistroAtendimento);

            if($this->builder->delete()){
                return true;
            }            
            return false;
           
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            
            return false;
        }
        
    }

    public function getEvolucao($idUsuario, $idProfissional) {
        

        return $this->select('A.nomeProfissional, A.nomeUsuario, tb_registro_atendimento.idRegistroAtendimento, 
                            A.idUsuario, tb_registro_atendimento.textoEvolucao, tb_registro_atendimento.dataAtendimento, 
                            tb_registro_atendimento.dataRegistroEvolucao, tb_registro_atendimento.numeroRegistro, 
                            A.modalidade,  A.diaSemana, A.horaInicio')                        
                        ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
                        ->where('tb_registro_atendimento.atendido', 'S')
                        ->where('A.idUsuario', $idUsuario)
                        ->where('A.idProfissional', $idProfissional)
                        ->where('tb_registro_atendimento.jaEvoluiu', 'S')
                        ->limit(10)
                        ->orderBy('tb_registro_atendimento.dataRegistroEvolucao','DESC')
                        ->get()->getResult();
    }

    public function gravarEdicaoEvolucao($dados)
    {

        try {

            $data = [
                'textoEvolucao' => base64_encode('++'.$dados['textoEvolucao']),
                'dataRegistroEvolucao' => date('Y-m-d H:i:s'),
                'idOperadorRegistroEvolucao' => session()->get('idOperadorSistema')

            ];
            //  var_dump($data);
            //  exit;
            $this->where('idRegistroAtendimento', $dados['idRegistroAtendimento']);         

            if($this->builder->update($data)){
                return true;
            }            
            return false;
           
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            
            return false;
        }
        
    }

    public function gravarEvolucao($dados)
    {
        try {

            $data = [
                'jaEvoluiu' => 'S',
                'textoEvolucao' => base64_encode($dados['textoEvolucao']),
                'dataRegistroEvolucao' => date('Y-m-d H:i:s'),
                'idOperadorRegistroEvolucao' => session()->get('idOperadorSistema')

            ];
            $this->where('idRegistroAtendimento', $dados['idRegistroAtendimento']);         

            if($this->builder->update($data)){
                return true;
            }            
            return false;
           
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            
            return false;
        }
        
    }

    public function getAtendimentosDataAtendimento() {
        $idProfissional = session()->get('idOperadorSistema');
        $idProfissional = 324;
        return $this->select('tb_registro_atendimento.dataAtendimento, tb_registro_atendimento.numeroRegistro, A.nomeUsuario, 
                        A.nomeProfissional, A.diaSemana, A.idUsuario, A.horaInicio, tb_registro_atendimento.atendido')
                        //->from('tb_atendimento A')
                        ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
                        ->where('tb_registro_atendimento.atendido', 'S')
                        ->where('A.idProfissional', $idProfissional)
                        ->where('tb_registro_atendimento.jaEvoluiu', 'N')
                        ->limit(30)
                        ->get()->getResult();
    }

    public function getRegistroAtendimento($numeroRegistro)
    {

        $idProfissional = session()->get('idOperadorSistema');
        $idProfissional = 324; //atenção

        return $this->select('A.nomeUsuario, A.nomeProfissional, A.diaSemana, 
                                tb_registro_atendimento.numeroRegistro, tb_registro_atendimento.dataAtendimento, 
                                A.horaInicio,A.idUsuario, tb_registro_atendimento.idRegistroAtendimento, 
                                tb_registro_atendimento.jaEvoluiu,A.idProfissional')                        
                        ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
                        ->where('tb_registro_atendimento.atendido', 'S')
                        ->where('tb_registro_atendimento.jaEvoluiu', 'N')
                        ->where('A.idProfissional', $idProfissional)
                        ->where('tb_registro_atendimento.numeroRegistro', $numeroRegistro)
                        ->get()->getRow();


    }

    public function verifyRegisterAtendimento($idAtendimento, $dataAtendimento)
	{
		return $this->where('idAtendimento',$idAtendimento)
		         ->where('dataAtendimento', $dataAtendimento)
		         ->get()->getResult();
		
	}

    public function getRegistroAtendimentoIdAtenDtAtend($idAtendimento, $dataAtendimento)
    {

        return $this->select('tb_registro_atendimento.idRegistroAtendimento, A.horaInicio,
                            tb_registro_atendimento.dataAtendimento, 
                            A.idUsuario, A.nomeProfissional, A.modalidade, 
                            A.diaSemana, tb_registro_atendimento.numeroRegistro,
                            A.nomeUsuario,
                            tb_registro_atendimento.horaAtendimento')
            //->from('tb_atendimento A')
            ->join('tb_atendimento A', 'tb_registro_atendimento.idAtendimento = A.idAtendimento')
            ->where('tb_registro_atendimento.idAtendimento', $idAtendimento)
            ->where('tb_registro_atendimento.dataAtendimento', $dataAtendimento)
            ->get()->getRow();
    }


}
