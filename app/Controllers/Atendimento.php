<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlocacaoModel;
use App\Models\AtendimentoModel;
use App\Models\DocumentoJustificativaModel;
use App\Models\ProfisionalModel;
use App\Models\RegistroAtendimentoModel;
use App\Models\UsuarioModel;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Atendimento extends BaseController
{
    private $logging;
    private $modelUsuario;
    private $modelAtendimento;
    private $modelProfissional;
    private $modelAlocacao;
    private $modelRegistroAtendimento;
    public function __construct()
    {
        $this->modelUsuario = new UsuarioModel;
        $this->modelAtendimento = new AtendimentoModel;
        $this->modelProfissional = new ProfisionalModel;
        $this->modelAlocacao = new AlocacaoModel;
        $this->modelRegistroAtendimento = new RegistroAtendimentoModel;

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }
    public function listar_atendimento()
    {
        //$dia = date('w') +1 ;
        $dia = date('Y-m-d');
        //$dia = '3';
        $dia = '2023-09-30';
        session()->set('dataConfirmacao',$dia);
        $dados = [

            'titulo' => 'LISTAR ATENDIMENTOS',
            //'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            //'atendimentosUsuario' => $this->modelAtendimento->getAtendimentos($id),
            //'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'dia' => date("w", strtotime($dia)) + 1,
            'atendimentos' => $this->modelAtendimento->getAtendimentosDia($dia),
            'data' => $dia,
            'modelRegistroAtendimento' => $this->modelRegistroAtendimento,
            'pasta' => 'atendimento',
        ];

        return view('atendimento/listar-atendimento', $dados);
    }

    public function listar_atendimento_anterior()
    {
       
       

        $dados = array(
            'titulo' => 'LISTAR ATENDIMENTOS',
            'pasta' => 'atendimento',
            //'atendimentos' => $this->Atendimento_model->getAtendimentosDia($dia)->result(),
            //'dia' => $dia
        );

        return view('atendimento/listar-definir-data', $dados);
    }


    public function confirmar_presenca_usuario_horario($idAtendimento, $dataAtendimento, $dia, $acao, $frequencia)
    {
        $dados = array(
            'titulo' => 'CONFIRMAR HORÁRIO ATENDIMENTO',
            'pagina' => 'form-confirmar-horario-atendimento',
            //'atendimentos' => $this->Atendimento_model->getAtendimentosDia($dia)->result(),
            'idAtendimento' => $idAtendimento,
            'dataAtendimento' => $dataAtendimento,
            'dia' => $dia,
            'acao' => $acao,
            'frequencia' => $frequencia,
            'dadosAtendimento' =>  $this->modelAtendimento->find($idAtendimento),
            'pasta' => 'atendimento',
            //$this->Atendimento_model->getById(md5($idAtendimento))->row()
        );
        //$this->load->view('principal', $dados);
        return view('atendimento/form-confirmar-horario-atendimento', $dados);

        /*$gravar = $this->AtendimentoCrud_model->gravarPresenca($idAtendimento, $dataAtendimento, $frequencia);
        if ($gravar === TRUE)
        {
            $this->session->set_flashdata('confirmadoAtendimento', $idAtendimento);
            $this->session->set_flashdata('confirmadoAtendimentoData', $dataAtendimento);
        }
        if($acao == 'A'){
         redirect('listarAnteriorAtendimento/'.$dataAtendimento.'/'.$dia);
		}
        redirect('listar_atendimento');*/
    }
    public function confirmaPresencaUsuarioHorario()
    {
        $idAtendimento = $this->request->getPost('nIdAtendimento');

        $rules = [
            'nHoraAtendimento' => 'required'
        ];

        $val = $this->validate($rules);
        //$idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'ATENDIMENTO::' => $idAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $acao = $this->request->getPost('nAcao');
        $dia = $this->request->getPost('nDiaSemana');
        $idAtendimento = $this->request->getPost('nIdAtendimento');
        $dataAtendimento = $this->request->getPost('nDataAtendimento');
        $frequencia = $this->request->getPost('nFrequencia');
        $horaAtendimento = $this->request->getPost('nHoraAtendimento');


        $data = [
            'idAtendimento' => $idAtendimento,
            'dataAtendimento' => $dataAtendimento,
            'frequencia' => $frequencia,
            'horaAtendimento' => $horaAtendimento
        ];

        try {

            $gravar = $this->modelAtendimento->gravarPresenca($data);

            //$gravar = true;
            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                session()->setFlashdata('confirmadoAtendimento', $idAtendimento);
                session()->setFlashdata('confirmadoAtendimentoData', $dataAtendimento);
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMETO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);

                if ($acao == 'A') {
                    redirect('atendimento/listarAnteriorAtendimento/' . $dataAtendimento . '/' . $dia);
                }
                //redirect('listar_atendimento');

                return $this->listar_atendimento();
            }
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMENTO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->listar_atendimento();
        //return $this->confirmar_presenca_usuario_horario($idAtendimento, $dataAtendimento, $dia, $acao, $frequencia);

    }

    public function form_cadastrar_atendimento($idUsuario)
    {

        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'CADASTRAR ATENDIMENTO',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            'atendimentosUsuario' => $this->modelAtendimento->getAtendimentos($id),
            'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'pasta' => 'atendimento',
        ];

        return view('atendimento/form-cadastrar-atendimento00', $dados);
    }
    public function form_cadastrar_atendimento02($idUsuario, $idProfissional)
    {

        $id = decrypt($idUsuario);
        $idProfissional = decrypt($idProfissional);

        $dados = [

            'titulo' => 'CADASTRAR ATENDIMENTO',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            'modelAtendimento' => $this->modelAtendimento,
            'atendimentosUsuario' => $this->modelAtendimento->getAtendimentos($id),
            //'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'alocacoesProfissional' => $this->modelAlocacao->getAlocacao($idProfissional),
            'dadosProfissional' => $this->modelProfissional->find($idProfissional),
            'pasta' => 'atendimento',
        ];

        return view('atendimento/form-cadastrar-atendimento02', $dados);

        /*$dados = array(
            'titulo' => 'CADASTRAR ATENDIMENTO',
            'pagina' => 'form-cadastrar-atendimento-ep02',
            //'atendimentosUsuario' => $this->Atendimento_model->getAtendimentos($idUsuario),
            'alocacoesProfissional' => $this->Alocacao_model->getAlocacao($idProfissional),
            'dadosProfissional' => $this->Profissional_model->getById(($idProfissional))->row(),
            'idUsuario' => $idUsuario,
        );

        $this->load->view('principal', $dados);*/
    }

    public function cadastrarAtendimento01()
    {
        $rules = [
            'nIdProfissional' => 'required',
            'nTriagem' => 'required',
            'nOpcaoAtendimento' => 'required',

        ];

        $idProfissional = $this->request->getPost('nIdProfissional');
        $idUsuario = $this->request->getPost('nIdUsuario');
        $triagem = $this->request->getPost('nTriagem');
        $opcaoAtendimento = $this->request->getPost('nOpcaoAtendimento');

        session()->set(
            [
                'triagem' => $triagem,
                'opcaoAtendimento' => $opcaoAtendimento
            ]
        );

        $val = $this->validate($rules);

        if ($val) {

            return redirect()->to('atendimento/form_cadastrar_atendimento02/' . encrypt($idUsuario) . '/' . encrypt($idProfissional));
        }

        $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
            'USUARIO::' => $idUsuario,
            'FEITO POR::' => session()->get("nome"),
            'ERROR' => $this->validator->getErrors()
        ]);

        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    public function cadastraAtendimentoEp02()
    {
        $rules = [
            'nHorario' => 'required',
            'nFrequencia' => 'required'
        ];

        $val = $this->validate($rules);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idProfissional'] = $this->request->getPost('nIdProfissional');
        $dados['idUsuario'] = $this->request->getPost('nIdUsuario');

        $idAlocacao = $this->request->getPost('nHorario');

        $dadosHorario = $this->modelAlocacao->find($idAlocacao);

        $dados['nomeProfissional'] = $this->request->getPost('nNomeProfissional');
        $dados['nomeUsuario'] = $this->request->getPost('nNomeUsuario');
        $dados['idAlocacao'] = $idAlocacao;
        $dados['diaSemana'] = $dadosHorario->diaSemana;
        $dados['horaInicio'] = $dadosHorario->horaInicio;
        $dados['horaFim'] = $dadosHorario->horaFim;
        $dados['modalidade'] = $this->request->getPost('modalidade');
        $dados['ativo'] = 'S';
        $dados['frequencia'] = $this->request->getPost('nFrequencia');

        $verificar = $this->modelAtendimento->verificarAtendimentoUsuario($dados['idUsuario'], $dados['diaSemana'], $dados['horaInicio']);

        if (session()->get('opcaoAtendimento') == 'I') {

            if ($verificar->resultID->num_rows >= 1) {

                session()->set('erro', 'OPS! Já existe um atendimento marcado para esse usuário, nesse dia e horário.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => session()->get("erro")]);
                return redirect()->to('atendimento/form_cadastrar_atendimento02/' . encrypt($dados['idUsuario']) . '/' . encrypt($dados['idProfissional']));
                //return $this->form_cadastrar_atendimento02(encrypt($dados['idUsuario']), encrypt($dados['idProfissional']) );
            }
        }
        try {

            $gravar = $this->modelAtendimento->salvarAtendimento($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('atendimento/form_cadastrar_atendimento02/' . encrypt($dados['idUsuario']) . '/' . encrypt($dados['idProfissional']));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return redirect()->to('atendimento/form_cadastrar_atendimento02/' . encrypt($dados['idUsuario']) . '/' . encrypt($dados['idProfissional']));
    }

    public function desativarAtendimento()
    {
        $idAtendimento = $this->request->getPost('nIdAtendimento');

        try {
            //$modelComportamento = new ComportamentoModel();
            //$gravar = $modelComportamento->save($dados);

            $gravar = $this->modelAtendimento->desativarAtendimento($idAtendimento);

            $dadosAtendimento = $this->modelAtendimento->find($idAtendimento);

            $Etapa = $this->request->getPost('nEtapa');
            $redirect = $Etapa == 2 ?
                redirect()->to('atendimento/form_cadastrar_atendimento02/' . encrypt($dadosAtendimento->idUsuario) . '/' . encrypt($dadosAtendimento->idProfissional)) :
                redirect()->to('atendimento/form_cadastrar_atendimento/' . encrypt($dadosAtendimento->idUsuario));

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMETO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return $redirect;
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['ATENDIMENTO::' => $idAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $redirect;
    }

    public function listar_faltas_usuario($idUsuario)
    {

        $id = decrypt($idUsuario);

        $registrosFaltaUsuario = $this->modelRegistroAtendimento->getAtendimentosRegistradosFaltaUsuario($id, 'W');

        if (!$registrosFaltaUsuario) {

            session()->set('erro', 'OPS! Nenhum registro de faltas deste usuário no ano.');

            return redirect()->to('usuario/detalhar_usuario/' . $idUsuario);
        }

        $dados = [

            'titulo' => 'LISTAR FALTAS DO USUÁRIO',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            'atendimentosUsuario' => $this->modelAtendimento->getAtendimentos($id),
            'dadosAtendimento' => $registrosFaltaUsuario,
            'modelRegistroAtendimento' => $this->modelRegistroAtendimento,
            'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'pasta' => 'atendimento',
        ];

        return view('atendimento/lista-faltas-usuario', $dados);
    }
    public function listar_faltas_profissional($idUsuario)
    {

        $id = decrypt($idUsuario);

        $registrosFaltaProfissional = $this->modelRegistroAtendimento->getAtendimentosRegistradosFaltaUsuarioProfissional($id, 'W');


        if (!$registrosFaltaProfissional) {

            session()->set('erro', 'OPS! Nenhum registro de faltas de profissional no ano.');

            return redirect()->to('usuario/detalhar_usuario/' . $idUsuario);
        }

        $dados = [

            'titulo' => 'LISTAR FALTAS DO PROFISSIONAL',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            'atendimentosUsuario' => $this->modelAtendimento->getAtendimentos($id),
            'dadosAtendimento' => $registrosFaltaProfissional,
            'modelRegistroAtendimento' => $this->modelRegistroAtendimento,
            'profissionais' => $this->modelProfissional->getProfissionalAtivo(),
            'pasta' => 'atendimento',
        ];

        return view('atendimento/lista-faltas-profissional', $dados);
    }

    public function form_justificar_falta_usuario($idRegistroAtendimento)
    {
        $id = decrypt($idRegistroAtendimento);

        $dados = array(
            'titulo' => 'JUSTIFICAR FALTA USUÁRIO',
            'dadosAtendimento' => $this->modelRegistroAtendimento->getRegistro($id),
            'pasta' => 'atendimento',
        );
        return view('atendimento/form-justificar-falta-usuario', $dados);
    }
    public function form_justificar_falta_profissional($idRegistroAtendimento)
    {
        $id = decrypt($idRegistroAtendimento);

        $dados = array(
            'titulo' => 'JUSTIFICAR FALTA PROFISSIONAL',
            'dadosAtendimento' => $this->modelRegistroAtendimento->getRegistro($id),
            'pasta' => 'atendimento',
        );
        return view('atendimento/form-justificar-falta-profissional', $dados);
    }

    public function form_enviar_documento_justificativa($idRegistroAtendimento, $idUsuario)
    {
        $id = decrypt($idRegistroAtendimento);
        $usuarioId = decrypt($idUsuario);

        $dados = array(
            'titulo' => 'ENVIAR DOCUMENTO JUSTIFICATIVA FALTA',
            'pagina' => 'form-enviar-documento-justificativa',
            'dadosAtendimento' => $this->modelRegistroAtendimento->getRegistro($id),
            'dadosUsuario' => $this->modelUsuario->find($usuarioId),
            'pasta' => 'atendimento',
        );

        return view('atendimento/form-enviar-documento-justificativa', $dados);
    }

    public function justificarFaltaUsuario()
    {
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $rules = [
            'nTextoJustificativa' => 'required|min_length[10]|max_length[500]'
        ];

        $val = $this->validate($rules);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $this->request->getPost('nIdUsuario');
        $dados['idRegistroAtendimento'] = $this->request->getPost('nIdRegistroAtendimento');
        $dados['justificouFaltaUsuario'] = 'S';
        $dados['textoJustificativaFalta'] = $this->request->getPost('nTextoJustificativa');
        $dados['dataRegistroJustificativa'] = date('Y-m-d H:i:s');
        $dados['repeteTodos'] = $this->request->getPost('nRepeteTodas');
        $dados['repeteDatas'] = $this->request->getPost('nRepeteDatas');
        $dados['dataAtendimento'] = $this->request->getPost('nDataAtendimento');


        try {
            $gravar = $this->modelRegistroAtendimento->gravarJustificativaFaltaUsuario($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('atendimento/listar_faltas_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_justificar_falta_usuario(encrypt($idUsuario));
    }

    public function justificarFaltaProfissional()
    {

        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $rules = [
            'nTextoJustificativa' => 'required|min_length[10]|max_length[500]'
        ];

        $val = $this->validate($rules);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $this->request->getPost('nIdUsuario');
        $dados['idRegistroAtendimento'] = $this->request->getPost('nIdRegistroAtendimento');
        $dados['justificouFaltaProfissional'] = 'S';
        $dados['textoJustificativaFaltaProfissional'] = $this->request->getPost('nTextoJustificativa');
        $dados['dataRegistroJustificativaProfissional'] = date('Y-m-d H:i:s');
        $dados['repeteTodos'] = $this->request->getPost('nRepeteTodas');
        $dados['repeteDatas'] = $this->request->getPost('nRepeteDatas');
        $dados['dataAtendimento'] = $this->request->getPost('nDataAtendimento');
        $dados['idProfissional'] = $this->request->getPost('nIdProfissional');

        try {
            $gravar = $this->modelRegistroAtendimento->gravarJustificativaFaltaProfissional($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('atendimento/listar_faltas_profissional/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_justificar_falta_profissional(encrypt($idUsuario));
    }

    public function desfazRegistroAtendimento()
    {
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');
        $idUsuario = $this->request->getPost('nIdUsuario');
        $opcao = $this->request->getPost('nOpcao');

        $redirect = $opcao == 'U' ?
            redirect()->to('atendimento/listar_faltas_usuario/' . encrypt($idUsuario)) :
            redirect()->to('atendimento/listar_faltas_profissional/' . encrypt($idUsuario));

        try {

            //$gravar = $this->modelAtendimento->salvarAtendimento($dados);
            $gravar = $this->modelRegistroAtendimento->desfazRegistroAtendimento($idRegistroAtendimento);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return $redirect;
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $redirect;
    }

    function alterarDocumento()
    {
        $idUsuario = $this->request->getPost('nIdUsuario');
        //$fotoAtual = $this->request->getPost('nFotoUsuario');
        $idRegistroAtendimento = $this->request->getPost('nIdRegistroAtendimento');

        $val = $this->validate([
            'nNovaFoto' => [
                'uploaded[nNovaFoto]',
                'max_size[nNovaFoto,1024]',
                'mime_in[nNovaFoto,image/png,image/jpeg]',
                'ext_in[nNovaFoto,png,jpg,gif]',
                //'max_dims[nNovaFoto,1000,1000]',
            ],
        ]);

        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'REGISTRO ATENDIMENTO::' => $idRegistroAtendimento,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $img = $this->request->getFile('nNovaFoto');

        try {

            if (!$img->hasMoved()) {
                //$filepath = WRITEPATH . 'uploads/' . $img->store();
                $nameFoto = encrypt($idRegistroAtendimento) . '.' . $img->getExtension();

                if ($img->move(definirUrlBase() . 'img/documentos-justificativa/', $nameFoto)) {

                    $dados['idUsuario'] = $idUsuario;
                    $dados['documento'] = $nameFoto;
                    $dados['idRegistroAtendimento'] = $idRegistroAtendimento;
                    $dados['idOperador'] = session()->get('idOperadorSistema');

                    $documento = new DocumentoJustificativaModel;

                    $gravar = $documento->save($dados);

                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('atendimento/listar_faltas_usuario/' . encrypt($idUsuario));
                }


                //return view('upload_success', $data);
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['REGISTRO ATENDIMENTO::' => $idRegistroAtendimento, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_enviar_documento_justificativa(encrypt($idRegistroAtendimento), encrypt($idUsuario));
    }

    
}
