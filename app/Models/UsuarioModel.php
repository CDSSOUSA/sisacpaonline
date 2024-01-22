<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UsuarioModel extends MyModel
{
    protected $DBGroup = 'default';
    protected $table = 'tb_usuario';
    protected $primaryKey = 'idUsuario';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    //protected $allowedFields    = ['nomeUsuario', 'listaEspera', 'nomeResponsavel', 'cnsUsuario', 'nomeMae', 'telefone', 'dataNascimento', 'cpfUsuario', 'ativo', 'telefoneMae', 'telefonePai', 'acompanhante'];
    protected $allowedFields = [];
    // Dates
    protected $useTimestamps = false;
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

    /*public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $colunas = $db->getFieldNames($this->table);

        $this->allowedFields = $colunas;
    }*/


    public function getUsuarioPorNome($nome)
    {
        return $this->select('nomeUsuario, listaEspera, nomeResponsavel, cnsUsuario, idUsuario, nomeMae, telefone, dataNascimento, cpfUsuario, ativo, telefoneMae, telefonePai, acompanhante')
            //->from('tb_usuario U')
            ->like('nomeUsuario', $nome)
            ->findAll();
    }
    public function getUsuarioPorId($id)
    {
        return $this->select('nomeUsuario, listaEspera, nomeResponsavel, cnsUsuario, idUsuario, nomeMae, telefone, dataNascimento, cpfUsuario, ativo, telefoneMae, telefonePai, acompanhante')
            //->from('tb_usuario U')
            ->where('idUsuario', ($id))
            ->findAll();
    }
    public function getAnamneseEtapa07($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.creches,
        A.idadeEscola,
        A.porqueEscola,
        A.quemEscolheuEscola,
        A.comoFoiEscolha,
        A.mudancaEscola,
        A.repetiuAno,
        A.porqueRepetiu,
        A.problemaProfessor,
        A.qualProblemaProf,
        A.atitudeSala,
        A.faltaEscola,
        A.porqueFalta,
        A.refoco,       
        A.gostaRefoco,
        A.opiniaoEscola,
        A.maisGosta,
        A.maioresDificuldades,
        A.orientacaoPais,
        A.observacaoAvaliador,
        A.condutaTerapeutica,
        A.liberaImpressao')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('A.idUsuario', $idUsuario)
            ->get()->getRow();
    }

    public function getAspectosSociais($idUsuario)
    {
        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, AS.*')
            ->join('tb_aspectos_sociais AS', 'AS.idUsuario = tb_usuario.idUsuario')
            ->where('AS.idUsuario', $idUsuario)
            ->get()->getRow();
    }

    public function getComunicacao($idUsuario)
    {
        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, C.*')
            ->join('tb_comunicacao C', 'C.idUsuario = tb_usuario.idUsuario')
            ->where('C.idUsuario', $idUsuario)
            ->get()->getRow();
    }

    public function getComportamento($idUsuario)
    {
        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, C.*')
            ->join('tb_comportamento C', 'C.idUsuario = tb_usuario.idUsuario')
            ->where('C.idUsuario', $idUsuario)
            ->get()->getRow();
    }
    public function getSocializacao($idUsuario)
    {
        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, S.*')
            ->join('tb_socializacao S', 'S.idUsuario = tb_usuario.idUsuario')
            ->where('S.idUsuario', $idUsuario)
            ->get()->getRow();
    }
    public function getFinalizacao($idUsuario)
    {
        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, F.*')
            ->join('tb_finalizacao F', 'F.idUsuario = tb_usuario.idUsuario')
            ->where('F.idUsuario', $idUsuario)
            ->get()->getRow();
    }

    public function saveUsuario($dados)
    {
        try {
            $this->db->transBegin();

            $dado['nome'] = $dados['nomeUsuario'];
            $dado['ativo'] = 'S';
            $dado['cpf'] = $dados['cpfUsuario'];
            $dado['idOperadorCadastro'] = session()->get('idOperador');
            $dado['tipo'] = 2;

            $pessoa = new PessoaModel();
            $pessoa->save($dado);


            $ultimaPessoa = $pessoa->getLastPessoa();
            $idUsuario = $ultimaPessoa->idPessoa;
            $dados['idUsuario'] = $idUsuario;
            $this->insert($dados);

            if ($dados['listaEspera'] == 'N') {
                $dadosMatricula['idUsuario'] = $dados['idUsuario'];
                $dadosMatricula['anoMatricula'] = date('Y');
                $dadosMatricula['dataMatricula'] = date('Y-m-d H:i:s');
                $dadosMatricula['ativo'] = 'S';
                $dadosMatricula['idOperadorMatricula'] = session()->get('idOperador');

                $matricula = new MatriculaModel;
                $matricula->salvarMatricula($dadosMatricula);
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

    public function desligaUsuario($dados)
    {

        try {

            $this->db->transBegin();

            $data = [
                'ativo' => 'N',
                'listaEspera' => 'N'
            ];
            $this->where('idUsuario', $dados['idUsuario']);
            $this->builder->update($data);
            //dd($this->builder->update($data));

            $matricula = new MatriculaModel();
            $dataMatricula = [
                'ativo' => 'N',
                'dataDesligamento' => date('Y-m-d'),
                'id_motivo' => $dados['motivo']
            ];
            $matricula->where('idUsuario', $dados['idUsuario']);
            $matricula->where('idMatricula', $dados['idMatricula']);
            $matricula->builder->update($dataMatricula);
            //dd( $matricula->builder->update($dataMatricula));

            $atentimento = new AtendimentoModel();
            $dataAtendimento = [
                'ativo' => 'N',
            ];
            $atentimento->where('idUsuario', $dados['idUsuario']);
            $atentimento->builder->update($dataAtendimento);


            $pessoa = new PessoaModel();
            $dataPessoa = [
                'ativo' => 'N',
            ];
            $pessoa->where('idPessoa', $dados['idUsuario']);
            $pessoa->builder->update($dataPessoa);

            $listaEspera = new ListaEsperaModel();
            $dataListaEspera = [
                'ativo' => 'N',
            ];
            $listaEspera->where('idUsuario', $dados['idUsuario']);
            $listaEspera->builder->update($dataListaEspera);


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

    public function getAnamnese($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.temApelido,A.qualApelido, A.gosta, A.porqueApelido,
                                A.naturalidade,
                                A.paiEstudouAte,
                                A.paiDificuldade,
                                A.paiFormou,
                                A.maeEstudouAte,
                                A.maeDificuldade,
                                A.maeFormou,
                                A.nomeIrmaos,
                                A.esquemaFamiliar,
                                A.queixaEscola,
                                A.indicadoPor')
            //->from('tb_usuario U')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('A.idUsuario', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese02($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.filhoDesejado,
        A.queriaEngravidar,
        A.foiAcidental,
        A.pertubouCasal,
        A.comoFoiGestacao,
        A.comoFoiParto,
        A.mamouPeito,
        A.mamouIdade,
        A.passagemMamadeira,
        A.passagemPapinha,
        A.horaComer,
        A.comeDepressa,
        A.mastigaBem,
        A.comemJuntos,
        A.comemVendoTv,
        A.idadeParouFraldas,
        A.passagemTroninho,
        A.fezesLiquida,
        A.fezesPastosa,
        A.fezesRessecada,
        A.fezesNormal')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese03($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.ficouCercadinho,
        A.engatinhou,
        A.idadeAndou,
        A.caiaMuito,
        A.quemEnsinouAndar,
        A.comoAprendouAndar,
        A.corajosoEscada,
        A.corajosoEspaco,
        A.eraInseguro,
        A.quemAndavaMelhor,
        A.evolucaoMovimentos,
        A.grandesMusculos,
        A.estabanado,
        A.nada,
        A.agitado,
        A.andaPatins,
        A.andaBicicleta,
        A.andaCavalo,
        A.sobeArvore')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese04($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario,  A.idadeFalou,
        A.comQuemFalava,
        A.falavaRepetir,
        A.primeirasPalavras,
        A.trocavaLetras,
        A.quaisLetras,
        A.falavaErrado,
        A.trocaLetras,
        A.falaMuito,
        A.falaEntende,
        A.exemploFala,
        A.darRecado,
        A.compraSozinho,
        A.contaHistoria,
        A.exemploHistoria,
        A.entendeEleConta,
        A.comecoMeioFim,
        A.eAgitado,
        A.eSonambulo,
        A.temPesadelos,
        A.dorme,
        A.pessoasDorme,
        A.vaiParaCamaPais,
        A.medoDormir,
        A.enureseNoturna')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese05($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario,  A.bronquite,
        A.alergia,
        A.asma,
        A.viroses,
        A.intenacao,
        A.cirurgia,
        A.outroTratamento,
        A.qualTratamento,
        A.problemaVisa,
        A.problemaAudicao,
        A.problemaPsico,
        A.fatosMarcantes,
        A.nascimentoIrmao,
        A.mudancas,
        A.mortes,
        A.quemMorte,
        A.desemprego,
        A.separacao')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese06($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.familia,
        A.disciplina,
        A.atitudePais,
        A.reacaoCrianca,
        A.alguemProtege,
        A.quemProtege,
        A.censurado,
        A.relacaoPai,
        A.relacaoMae,
        A.relacaoIrmao,
        A.paisLeem,
        A.auxiliaLicao,
        A.problemaFamilia,
        A.brincadeiras,
        A.prefereBrincadeira,
        A.relacaoColega,
        A.lider,
        A.choraBrincadeiras,
        A.programaTv,
        A.assuntoLazer')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }

    public function getAnamnese07($idUsuario)
    {

        return $this->select('tb_usuario.nomeUsuario, tb_usuario.idUsuario, tb_usuario.fotoUsuario, A.creches,
        A.idadeEscola,
        A.porqueEscola,
        A.quemEscolheuEscola,
        A.comoFoiEscolha,
        A.mudancaEscola,
        A.repetiuAno,
        A.porqueRepetiu,
        A.problemaProfessor,
        A.qualProblemaProf,
        A.atitudeSala,
        A.faltaEscola,
        A.porqueFalta,
        A.refoco,       
        A.gostaRefoco,
        A.opiniaoEscola,
        A.maisGosta,
        A.maioresDificuldades,
        A.orientacaoPais,
        A.observacaoAvaliador,
        A.condutaTerapeutica,
        A.liberaImpressao')
            ->join('tb_anamnese A', 'A.idUsuario = tb_usuario.idUsuario')
            ->where('(A.idUsuario)', $idUsuario)
            ->get()->getRow();
    }
}
