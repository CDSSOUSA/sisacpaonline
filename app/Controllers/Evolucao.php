<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlocacaoModel;
use App\Models\AtendimentoModel;
use App\Models\ProfissionalModel;
use App\Models\RegistroAtendimentoModel;
use App\Models\UsuarioModel;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Evolucao extends BaseController
{
    private $logging;
    private $modelUsuario;
    private $modelAtendimento;
    private $modelProfissional;
    private $modelAlocacao;
    private $modelRegistroAtendimento;
    private $textoPadraoEvolucao = [];
    public function __construct()
    {
        $this->modelUsuario = new UsuarioModel;
        $this->modelAtendimento = new AtendimentoModel;
        $this->modelProfissional = new ProfissionalModel;
        $this->modelAlocacao = new AlocacaoModel;
        $this->modelRegistroAtendimento = new RegistroAtendimentoModel;

        $this->textoPadraoEvolucao = [
            'naoRespondeuAosEstimulos' => 'NÃO RESPONDEU AS ESTÍMULOS;',
            'concluiuATerapia' => 'CONCLUIU A TERAPIA;'
        ];

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function listar_historico_evolucao($idUsuario)
    {
        $id = decrypt($idUsuario);
        $idProfissional = session()->get('idOperadorSistema');
        $idProfissional = 324; // remover no futuro

        $dados = [

            'titulo' => 'HISTÓRICO EVOLUÇÃO',
            'dadosUsuario' => $this->modelUsuario->find($id),
            //'modelUsuario' => $this->modelUsuario,
            'dadosEvolucao' => $this->modelRegistroAtendimento->getEvolucao($id, $idProfissional),
            //'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'pasta' => 'evolucao',
        ];


        return view('evolucao/historico-evolucao', $dados);
    }
    public function listar_dados_estatistica_evolucao()
    {
        $dados = array(
            'titulo' => 'EVOLUÇÃO - DADOS ESTATÍSTICOS',
            //'pagina' => 'listar-dados-estatistica-evolucao',
            'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'pasta' => 'evolucao',
        );        

        return view('evolucao/listar-dados-estatistica-evolucao', $dados);
    }
    public function detalhar_estatistica_evolucao($idProfissional)
    {
        $dados = array(
            'titulo' => 'EVOLUÇÕES PENDENTES',
            //'pagina' => 'detalhar-estatistica-evolucao',
            'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'atendimentosPendentes' => $this->modelRegistroAtendimento->getAtendimentoStatusEvoluiu($idProfissional),
            'pasta' => 'evolucao',
        ); 

        return view('evolucao/detalhar-estatistica-evolucao', $dados);
    }

    public function form_editar_evolucao($idEvolucao)
    {
        $id = decrypt($idEvolucao);

        $dados = [

            'titulo' => 'EDITAR EVOLUÇÃO',
            'pasta' => 'evolucao',
            'dadosEvolucao' => $this->modelRegistroAtendimento->getRegistro($id),

        ];
        return view('evolucao/form-editar-evolucao', $dados);
    }

    public function form_escrever_evolucao_data_atendimento()
    {
        $registroEvolucao = $this->modelRegistroAtendimento->getAtendimentosDataAtendimento();

        if (!$registroEvolucao) {
            $dados = [

                'titulo' => 'EVOLUÇÃO - DATA DE ATENDIMENTO',
                'pasta' => 'evolucao',
            ];

            //session()->set('erro', 'OPS! Nenhum registro de evolução.');

            return view('layout/noregistro', $dados);
        }

        $dados = [

            'titulo' => 'EVOLUÇÃO - DATA DE ATENDIMENTO',
            'pasta' => 'evolucao',
            'atendimentos' => $registroEvolucao,

        ];
        return view('evolucao/form-escrever-evolucao-data-atendimento', $dados);
    }

    public function editarEvolucao()
    {
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $rules = [
            'nTextoEvolucao' => 'required|min_length[10]|max_length[500]'
        ];

        $val = $this->validate($rules);
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idUsuario = $this->request->getPost('nIdUsuario');
        $dados['textoEvolucao'] = $this->request->getPost('nTextoEvolucao');
        $dados['idRegistroAtendimento'] = $idRegistroAtendimento;


        try {
            $gravar = $this->modelRegistroAtendimento->gravarEdicaoEvolucao($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('evolucao/listar_historico_evolucao/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->listar_historico_evolucao(encrypt($idUsuario));
    }

    public function form_evoluir_atendimento($numeroRegistro)
    {

        $id = decrypt($numeroRegistro);
        //$pesquisar = $this->RegistroAtendimento_model->getRegistroAtendimento($numeroRegistro);
        $registroEvolucao = $this->modelRegistroAtendimento->getRegistroAtendimento($id);

        // var_dump($registroEvolucao);
        // exit;


        /*$registroSessao = array(
            'dataAtendimento' => $pesquisar->row()->dataAtendimento,
            'nomeUsuario' => $pesquisar->row()->nomeUsuario,
            'idRegistroAtendimento' => $pesquisar->row()->idRegistroAtendimento,
            'idUsuario' => $pesquisar->row()->idUsuario,
            'nomeProfissional' => $pesquisar->row()->nomeProfissional,
            'numeroRegistro' => $pesquisar->row()->numeroRegistro,
            'diaSemana' => $pesquisar->row()->diaSemana,
            'horaInicio' => $pesquisar->row()->horaInicio
        );*/

        //$this->session->set_userdata($registroSessao);

        //redirect('form_evoluir_atendimento/' . $numeroRegistro);


        $dados = [

            'titulo' => 'ESCREVER EVOLUÇÃO',
            'pasta' => 'evolucao',
            'atendimento' => $registroEvolucao,
            'textoPadraoEvolucao' => $this->textoPadraoEvolucao,
            'dadosEvolucao' => $this->modelRegistroAtendimento->getEvolucao($registroEvolucao->idUsuario, $registroEvolucao->idProfissional),


        ];
        return view('evolucao/form-evoluir-registro-atendimento', $dados);
    }

    public function evoluirRegistroAtendimento()
    {

        $textoPadraoEvolucao = $this->textoPadraoEvolucao;
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $textoFinal = '';

        foreach ($textoPadraoEvolucao as $key => $item) {
            $textoFinal .= $this->request->getPost($key) . ' ';
        }

        $result = TRUE;


        if (trim($textoFinal) == '') {

            $rules = [
                'nTextoEvolucao' => 'required|min_length[10]|max_length[500]'
            ];


            $val = $this->validate($rules);

            if (!$val) {
                $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                    'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                    'FEITO POR::' => session()->get("nome"),
                    'ERROR' => $this->validator->getErrors()
                ]);
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }


        //if ($result === TRUE) {


            $textoFinal .= $this->request->getPost('nTextoEvolucao') . ' ';

            $dados['idRegistroAtendimento'] = $this->request->getPost('nIdRegistroAtendimento');
            $dados['textoEvolucao'] = trim($textoFinal);

            try {
                $gravar = $this->modelRegistroAtendimento->gravarEvolucao($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('evolucao/form_escrever_evolucao_data_atendimento');
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }
    
            return $this->form_evoluir_atendimento(encrypt($idRegistroAtendimento));
           
    }
}
