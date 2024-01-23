<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnamneseModal;
use App\Models\AspectosSociaisModel;
use App\Models\AtendimentoCrudModel;
use App\Models\AtendimentoModel;
use App\Models\CidadeModel;
use App\Models\ComportamentoModel;
use App\Models\ComunicacaoModel;
use App\Models\FinalizacaoModel;
use App\Models\MatriculaModel;
use App\Models\MotivoDesligamentoModel;
use App\Models\PessoaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Files\File;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class Usuario extends BaseController
{
    private $erros = [];
    private $modelUsuario;
    private $modelMatricula;
    private $modelAtendimento;
    private $modelAtendimentoCrud;
    private $modelCidade;

    private $logging;

    public function __construct()
    {
        $this->modelUsuario = new UsuarioModel;
        $this->modelMatricula = new MatriculaModel();
        $this->modelAtendimento = new AtendimentoModel();
        $this->modelAtendimentoCrud = new AtendimentoCrudModel();
        $this->modelCidade = new CidadeModel();

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }
    public function index()
    {
        //
    }
    public function form_pesquisar_usuario()
    {
        $msg = [
            'message' => '',
            'alert' => '',
            'status' => ''
        ];

        if (session()->has('erro')) {
            $this->erros = session()->get('erro');
            $msg['message'] = 'Erro(s) no preenchimento do formulário!';
            $msg['alert'] = 'danger';
            $msg['status'] = 404;
        }

        $data = [
            'nome' => $this->session->get('nome'),
            'login' => $this->session->get('login'),

            'pasta' => 'usuario',
            'titulo' => 'PESQUISAR USUÁRIO',
            'erro' => $this->erros,
            'msgs' => $msg,
        ];

        return view('usuario/form-pesquisar-usuario', $data);
    }
    public function form_alterar_dados_pessoais($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS PESSOAIS',
            'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'modelUsuario' => $this->modelUsuario,
            'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-alterar-dados-pessoais', $dados);
    }
    public function form_alterar_dados_responsaveis($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = array(

            'titulo' => 'ALTERAR DADOS RESPONSÁVEIS',
            'pagina' => 'form-alterar-dados-responsaveis',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->find($id),

        );

        return view('usuario/form-alterar-dados-responsaveis', $dados);
    }

    public function form_alterar_dados_aspectos_sociais($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS SOCIAIS',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->getAspectosSociais($id),

        ];
        return view('usuario/form-alterar-dados-sociais', $dados);
    }
    public function form_alterar_dados_comunicacao($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS COMUNICAÇÃO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->getComunicacao($id),

        ];
        return view('usuario/form-alterar-dados-comunicacao', $dados);
    }
    public function form_alterar_dados_comportamento($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS COMPORTAMENTO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->getComportamento($id),

        ];
        return view('usuario/form-alterar-dados-comportamento', $dados);
    }
    public function form_alterar_dados_socializacao($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS SOCIALIZAÇÃO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->getSocializacao($id),

        ];
        return view('usuario/form-alterar-dados-socializacao', $dados);
    }
    public function form_alterar_dados_finalizacao($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS FINALIZAÇÃO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->getFinalizacao($id),

        ];
        return view('usuario/form-alterar-dados-finalizacao', $dados);
    }

    public function form_alterar_dados_foto($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ALTERAR DADOS FOTO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->find($id),

        ];
        return view('usuario/form-alterar-dados-foto', $dados);
    }

    public function form_desligar_usuario($idUsuario)
    {
        $id = decrypt($idUsuario);
        $motivoDesligamentoModel = new MotivoDesligamentoModel();

        $dados = [

            'titulo' => 'DESLIGAR USUÁRIO',
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->find($id),
            'motivos' => $motivoDesligamentoModel->findAll(),
            'matriculaAtivo' => $this->modelMatricula->getMatriculaUsuario($id)->getRow(),
        

        ];       
        return view('usuario/form-desligar-usuario', $dados);       
    }


    public function exibirUsuario()
    {
        $data = [

            'titulo' => 'EXIBIR USUÁRIOS',
            'modelMatricula' => $this->modelMatricula,
            'modelAtendimento' => $this->modelAtendimento,
            'pasta' => 'usuario',

        ];

        return view('usuario/exibir-usuario', $data);
    }
    public function pesquisarUsuario()
    {
        $msg = [
            'message' => '',
            'alert' => '',
            'status' => ''
        ];

        $data = [
            'nome' => $this->session->get('nome'),
            'login' => $this->session->get('login'),
            'pagina' => 'dashboard',
            'pasta' => 'home',
            'titulo' => 'PESQUISAR USUÁRIO',
            'erro' => $this->erros,
            'msgs' => $msg,
        ];
        $dataPost = $this->request->getPost();
        $codigo = $dataPost['nCodigo'];
        $nome = $dataPost['nNome'];
        $n = '';

        $dadosUsuario = '';

        if (empty($codigo) && empty($nome)) {
            $val = $this->validate(
                [
                    'nCodigo' => 'required',
                ],
                [
                    'nCodigo' => [
                        'required' => 'Preenchimento obrigatório!'
                    ],
                ]
            );
            // $rules = [
            //     'nCodigo' => 'required',
            // ];
            // $validated = $this->validate($rules);

        } else if (empty($codigo)) {

            $nomeUsuario = $dataPost['nNome'];

            $val = $this->validate(
                [
                    'nNome' => 'permit_empty|min_length[3]',
                ],
                [
                    'nNome' => [
                        'min_length' => 'Pelo menos 3 caracteres!'
                    ],
                ]
            );



            $dadosUsuario = $this->modelUsuario->getUsuarioPorNome($nomeUsuario);
        } else {
            $val = $this->validate(
                [
                    'nCodigo' => 'required',
                ],
                [
                    'nCodigo' => [
                        'required' => 'Preenchimento obrigatório!'
                    ],
                ]
            );


            $n = $dataPost['nCodigo'];

            $dadosUsuario = $this->modelUsuario->getUsuarioPorId($n);
        }

        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($dadosUsuario != null) {

            session()->set(
                [
                    'dados' => $dadosUsuario
                ]
            );

            return redirect()->to('usuario/exibir_usuario');
        }

        session()->set('erro', 'OPS, nenhum usuário encontrado.');

        return redirect()->to('usuario/form_pesquisar_usuario');
    }
    public function detalharUsuario($idUsuario)
    {
        $id = decrypt($idUsuario);

        $data = [

            'titulo' => 'DETALHAR USUÁRIO',
            'modelMatricula' => $this->modelMatricula,
            'modelAtendimento' => $this->modelAtendimento,
            'modelUsuario' => $this->modelUsuario,
            'pasta' => 'usuario',
            'dadosUsuario' => $this->modelUsuario->find($id),

        ];
        //dd($this->modelUsuario->where('(idUsuario)',$idUsuario)->get()->getResult());
        return view('usuario/detalhar-usuario', $data);
    }

    /* ações para manipular dados*/
    public function alterarDadosPessoais()
    {
        $rules = [
            'nNomeUsuario' => 'required',
            'nDataNascimento' => 'required',
            'nCpfUsuario' => 'permit_empty|validateCpf',
            'nCnsUsuario' => 'required|valid_cns',
            'nNisUsuario' => 'permit_empty|validateNis',
            'nAutorizaImagem' =>  'required',
            'nNomeCuidador' => 'permit_empty|min_length[3]',
            'nProfessorRegular' => 'permit_empty|min_length[3]',
            'nEscola' =>  'permit_empty|min_length[3]',
            'nEnderecoEscola' =>  'permit_empty|min_length[3]',
            'nContatoEscola' => 'permit_empty|min_length[3]',
            'nMoraCom' =>  'permit_empty|min_length[2]|max_length[20]',
        ];
        $message = [
            'nNomeUsuario' => [
                'required' => 'Preenchimento obrigatório',
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nDataNascimento' => [
                'required' => 'Preenchimento obrigatório',

            ],
            'nCpfUsuario' => [
                'validateCpf' => 'Informe um número válido',

            ],
            'nCnsUsuario' => [
                'required' => 'Preenchimento obrigatório',
                'valid_cns' => 'Informe um número válido',
            ],
            'nNisUsuario' => [
                'validateCpf' => 'Informe um número válido',

            ],
            'nAutorizaImagem' => [
                'required' => 'Preenchimento obrigatório'
            ],
            'nNomeCuidador' => [
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nProfessorRegular' => [
                'min_length' => 'Pelo menos 03 caracteres'
            ],
            'nEscola' => [
                'min_length' => 'Pelo menos 03 caracteres'
            ],
            'nEnderecoEscola' => [
                'min_length' => 'Pelo menos 03 caracteres'
            ],
            'nContatoEscola' => [
                'min_length' => 'Pelo menos 03 caracteres'
            ],
            'nMoraCom' => [
                'min_length' => 'Pelo menos 02 caracteres',
                'max_length' => 'Pelo menos 20 caracteres'
            ],

        ];
        $val = $this->validate($rules, $message);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $dados['idUsuario'] = $idUsuario;
        $dados['nomeUsuario'] = tratarPalavras($this->request->getPost('nNomeUsuario'));
        $dados['dataNascimento'] = converteParaDataMysql($this->request->getPost('nDataNascimento'));
        $dados['idadeDiagnostico'] = $this->request->getPost('nIdadeDiagnostico');
        $dados['genero'] = $this->request->getPost('nGenero');
        $dados['telefone'] = $this->request->getPost('nTelefone');
        $dados['cpfUsuario'] = tratarCpf($this->request->getPost('nCpfUsuario'));
        $dados['cnsUsuario'] = tratarCns($this->request->getPost('nCnsUsuario'));
        $dados['nisUsuario'] = tratarNis($this->request->getPost('nNisUsuario'));
        $dados['autorizaImagem'] = $this->request->getPost('nAutorizaImagem');
        $dados['nomeCuidador'] = tratarPalavras($this->request->getPost('nNomeCuidador'));
        $dados['professorSalaRegular'] = tratarPalavras($this->request->getPost('nProfessorRegular'));
        $dados['escolaOrigem'] = tratarPalavras($this->request->getPost('nEscola'));
        $dados['enderecoEscola'] = tratarPalavras($this->request->getPost('nEnderecoEscola'));
        $dados['telefoneEscola'] = $this->request->getPost('nTelefoneEscola');
        $dados['contatoEscola'] = tratarPalavras($this->request->getPost('nContatoEscola'));
        $dados['horario'] = $this->request->getPost('nHorario');
        $dados['tipoEscolaRegular'] = $this->request->getPost('nTipoEscola');

        /* ENDERECO*/
        $dados['logradouro'] = tratarPalavras($this->request->getPost('nLogradouro'));
        $dados['numeroLogradouro'] = $this->request->getPost('nNumeroLogradouro');
        $dados['bairro'] = tratarPalavras($this->request->getPost('nBairro'));
        $dados['complemento'] = tratarPalavras($this->request->getPost('nComplemento'));
        $dados['pontoReferencia'] = tratarPalavras($this->request->getPost('nPontoReferencia'));
        $dados['cidade'] = tratarPalavras($this->request->getPost('nCidade'));
        $dados['cep'] = tratarPalavras($this->request->getPost('nCep'));
        $dados['moraCom'] = ($this->request->getPost('nMoraCom'));

        $gravar = $this->modelUsuario->save($dados);
        $editarNameAtendimento = $this->modelAtendimentoCrud->editNameAtendimento($idUsuario, $dados['nomeUsuario']);
        try {
            if ($gravar == true && $editarNameAtendimento) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_alterar_dados_pessoais(encrypt($idUsuario));
    }
    public function alterarDadosResponsaveis()
    {
        $rules = [
            'nNomeMae' => 'required|min_length[3]',
            'nNomePai' => 'required|min_length[3]',
            'nNomeResp' => 'required|min_length[3]',
            'nCpfMae' => 'permit_empty|validateCpf',
            'nCpfPai' => 'permit_empty|validateCpf',
            'nCpfResp' => 'required|validateCpf',
            'nRgResp' => 'required',
            'nTelefoneMae' => 'required',
            'nTelefonePai' => 'required',
            'nTelefoneResp' => 'required',
            'nGrauParentesco' => 'required',
            'nEmailResp' => 'permit_empty|valid_email',


        ];
        $message = [
            'nNomeMae' => [
                'required' => 'Preenchimento obrigatório',
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nNomePai' => [
                'required' => 'Preenchimento obrigatório',
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nNomeResp' => [
                'required' => 'Preenchimento obrigatório',
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nCpfMae' => [
                'validateCpf' => 'Informe um número válido',
            ],
            'nCpfPai' => [
                'validateCpf' => 'Informe um número válido',
            ],
            'nCpfResp' => [
                'required' => 'Preenchimento obrigatório',
                'validateCpf' => 'Informe um número válido',
            ],
            'nRgResp' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nTelefoneMae' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nTelefonePai' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nGrauParentesco' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nEmailResp' => [
                'required' => 'Preenchimento obrigatório',
                'valid_email' => 'Informe um e-mail válido',
            ],
        ];
        $val = $this->validate($rules, $message);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $idUsuario;

        /* DADOS DA MAE*/
        $dados['nomeMae'] = tratarPalavras($this->request->getPost('nNomeMae'));
        $dados['dataNascimentoMae'] = $this->request->getPost('nDataNascimentoMae') == '--' ? NULL : converteParaDataMysql($this->request->getPost('nDataNascimentoMae'));
        $dados['telefoneMae'] = $this->request->getPost('nTelefoneMae');
        $dados['profissaoMae'] = tratarPalavras($this->request->getPost('nProfissaoMae'));
        $dados['cpfMae'] = tratarCpf($this->request->getPost('nCpfMae'));
        $dados['rgMae'] = tratarPalavras($this->request->getPost('nRgMae'));
        $dados['escolaridadeMae'] = tratarPalavras($this->request->getPost('nEscolaridadeMae'));
        $dados['planoSaudeMae'] = tratarPalavras($this->request->getPost('nPlanoSaudeMae'));

        /* DADOS PAI*/
        $dados['nomePai'] = tratarPalavras($this->request->getPost('nNomePai'));
        $dados['dataNascimentoPai'] = $this->request->getPost('nDataNascimentoPai') == '--' ? NULL : converteParaDataMysql($this->request->getPost('nDataNascimentoPai'));
        $dados['telefonePai'] = $this->request->getPost('nTelefonePai');
        $dados['profissaoPai'] = tratarPalavras($this->request->getPost('nProfissaoPai'));
        $dados['cpfPai'] = tratarCpf($this->request->getPost('nCpfPai'));
        $dados['rgPai'] = tratarPalavras($this->request->getPost('nRgPai'));
        $dados['escolaridadePai'] = tratarPalavras($this->request->getPost('nEscolaridadePai'));
        $dados['planoSaudePai'] = tratarPalavras($this->request->getPost('nPlanoSaudePai'));

        /* DADOS DO RESPONSAVEL*/
        $dados['nomeResponsavel'] = tratarPalavras($this->request->getPost('nNomeResp'));
        $dados['dataNascimentoResponsavel'] = $this->request->getPost('nDataNascimentoResp') == '--' ? NULL : converteParaDataMysql($this->request->getPost('nDataNascimentoResp'));
        $dados['telefoneResponsavel'] = $this->request->getPost('nTelefoneResp');
        $dados['profissaoResponsavel'] = tratarPalavras($this->request->getPost('nProfissaoResp'));
        $dados['cpfResponsavel'] = tratarCpf($this->request->getPost('nCpfResp'));
        $dados['rgResponsavel'] = tratarPalavras($this->request->getPost('nRgResp'));
        $dados['escolaridadeResponsavel'] = tratarPalavras($this->request->getPost('nEscolaridadeResp'));
        $dados['planoSaudeResponsavel'] = tratarPalavras($this->request->getPost('nPlanoSaudeResp'));
        $dados['grauParentesco'] = tratarPalavras($this->request->getPost('nGrauParentesco'));
        $dados['emailResponsavel'] = mb_strtolower($this->request->getPost('nEmailResp'));

        $gravar = $this->modelUsuario->save($dados);
        try {
            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_alterar_dados_responsaveis(encrypt($idUsuario));
    }
    public function alterarDadosSociais()
    {


        $rules = [
            'nRendaFamiliar' => 'required',
            'nPessoasEndereco' => 'required',
            'nTipoHabitacao' => 'required',
            'nCondicaoHabitacao' => 'required',
            'nDiagnosticoIrmaoAutismo' => 'required',
            'nReacaoFamilia' => 'required|min_length[3]',
            'nDificuldadeMotora' => 'required',
            'nUsoMedicacao' => 'required',
            'nMedicacao' => 'permit_empty|min_length[3]',
            'nPossuiAlergia' => 'required',
            'nAlergia' => 'permit_empty|min_length[3]',
            'nDependenciaFamiliar' => 'required',
            'nDependente' => 'permit_empty|min_length[3]',
            'nAtividadesFamilia' => 'required',
            'nMedicoDiagnostico' => 'permit_empty|min_length[3]',
        ];

        $message = [
            'nRendaFamiliar' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nPessoasEndereco' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nTipoHabitacao' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nCondicaoHabitacao' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nDiagnosticoIrmaoAutismo' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nReacaoFamilia' => [
                'required' => 'Preenchimento obrigatório',
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nDificuldadeMotora' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nUsoMedicacao' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nMedicacao' => [
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nPossuiAlergia' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nAlergia' => [
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nDependenciaFamiliar' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nDependente' => [
                'min_length' => 'Pelo menos 03 caracteres',
            ],
            'nAtividadesFamilia' => [
                'required' => 'Preenchimento obrigatório',
            ],
            'nMedicoDiagnostico' => [
                'min_length' => 'Pelo menos 03 caracteres',
            ],

        ];
        $val = $this->validate($rules, $message);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {
            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $idUsuario;
        /* DADOS SOCIAIS*/
        $dados['rendaFamiliar'] = $this->request->getPost('nRendaFamiliar');
        $dados['numeroPessoasEndereco'] = $this->request->getPost('nPessoasEndereco');
        $dados['tipoHabitacao'] = $this->request->getPost('nTipoHabitacao');
        $dados['condicaoHabitacao'] = $this->request->getPost('nCondicaoHabitacao');
        $dados['possuiOutrosIrmaos'] = $this->request->getPost('nDiagnosticoIrmaoAutismo');
        $dados['reacaoFamiliaDiagnostico'] = tratarPalavras($this->request->getPost('nReacaoFamilia'));
        $dados['dificuldadesMotoras'] = $this->request->getPost('nDificuldadeMotora');
        $dados['usoMedicacao'] = $this->request->getPost('nUsoMedicacao');
        $dados['qualMedicacao'] = tratarPalavras($this->request->getPost('nMedicacao'));
        $dados['possuiAlergia'] = $this->request->getPost('nPossuiAlergia');
        $dados['qualAlergia'] = tratarPalavras($this->request->getPost('nAlergia'));
        $dados['dependenciaFamiliar'] = $this->request->getPost('nDependenciaFamiliar');
        $dados['dependenteFamiliar'] = tratarPalavras($this->request->getPost('nDependente'));
        $dados['atividadesFamilia'] = $this->request->getPost('nAtividadesFamilia');
        $dados['medicoDiagnostico'] = tratarPalavras($this->request->getPost('nMedicoDiagnostico'));


        $modelAspectosSociais = new AspectosSociaisModel();
        $gravar = $modelAspectosSociais->save($dados);

        try {
            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_alterar_dados_aspectos_sociais(encrypt($idUsuario));


        //$gravar = $this->Usuario_model->editarDados($dados, $idUsuario, 'tb_aspectos_sociais');


        // if ($gravar == true) {
        //     $this->session->set_flashdata('sucesso', 'Parabéns, ação realizada com sucesso.');
        //     redirect('detalhar_usuario/' . encrypt($idUsuario));
        // } else {
        //     $this->session->set_flashdata('error', 'ERRO, não foi possível realizar operação.');
        // }
        //}

        // $dados = array(
        //     'titulo' => 'ALTERAR DADOS SOCIAIS',
        //     'pagina' => 'form-alterar-dados-sociais',
        //     'dadosUsuario' => $this->Usuario_model->getAspectosSociais(encrypt($idUsuario))->row(),
        //     //'cidades' => $this->Cidade_model->getCidades(),
        // );
        // $this->load->view('principal', $dados);
    }
    public function alterarDadosComunicacao()
    {


        $rules = [
            'nTipoComunicacao' => 'required',
            'nPossuiEcolalias' => 'required',
            'nPedeAjuda' => 'required',
            'nFormaAjuda' => 'permit_empty|min_length[3]',
            'nSolicita' => 'required',
            'nFazPerguntas' => 'required',
            'nRespondeChamando' => 'required',
            'nCompreensaoFala' => 'required',
        ];

        $message = [
            'nTipoComunicacao' => ['required' => 'Preenchimento obrigatório'],
            'nPossuiEcolalias' => ['required' => 'Preenchimento obrigatório'],
            'nPedeAjuda' => ['required' => 'Preenchimento obrigatório'],
            'nFormaAjuda' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nSolicita' => ['required' => 'Preenchimento obrigatório'],
            'nFazPerguntas' => ['required' => 'Preenchimento obrigatório'],
            'nRespondeChamando' => ['required' => 'Preenchimento obrigatório'],
            'nCompreensaoFala' => ['required' => 'Preenchimento obrigatório'],

        ];

        $val = $this->validate($rules, $message);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $idUsuario;

        /* DADOS COMUNICACAO*/
        $dados['tipoComunicacao'] = $this->request->getPost('nTipoComunicacao');

        $dados['expressaoOral'] = $this->request->getPost('nOral');
        $dados['expressaoGestos'] = $this->request->getPost('nGestos');
        $dados['expressaoAponta'] = $this->request->getPost('nAponta');
        $dados['expressaoGritos'] = $this->request->getPost('nGritos');
        $dados['expressaoGrunidos'] = $this->request->getPost('nGrunidos');
        $dados['expressaoFiguras'] = $this->request->getPost('nFiguras');


        $dados['possuiEcolalias'] = $this->request->getPost('nPossuiEcolalias');
        $dados['pedeAjuda'] = $this->request->getPost('nPedeAjuda');
        $dados['formaAjuda'] = tratarPalavras($this->request->getPost('nFormaAjuda'));
        $dados['solicita'] = $this->request->getPost('nSolicita');
        $dados['fazPergunta'] = $this->request->getPost('nFazPerguntas');
        $dados['respondeChamado'] = $this->request->getPost('nRespondeChamando');
        $dados['compreensaoFala'] = $this->request->getPost('nCompreensaoFala');

        try {
            $modelComunicacao = new ComunicacaoModel();
            $gravar = $modelComunicacao->save($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }


        return $this->form_alterar_dados_comunicacao(encrypt($idUsuario));
    }

    public function alterarDadosComportamento()
    {
        $rules = [
            'nAutoAgressao' => 'required',
            'nTipoAutoAgressao' => 'permit_empty|min_length[3]',
            'nHeteroagressao' => 'required',
            'nTipoHeteroagressao' => 'permit_empty|min_length[3]',
            'nMovimentoEsteriotipado' => 'required',
            'nTipoMovimento' => 'permit_empty|min_length[3]',
            'nObedeceOrdem' => 'required',
            'nEsperaVez' => 'required',

            'nOrdemFaz' => 'permit_empty|min_length[3]',
            'nTempoSentado' => 'permit_empty|min_length[1]',
            'nFormaNecessidade' => 'permit_empty|min_length[3]',
            'nPossuiObjeto' => 'required',
            'nObjetoApego' => 'permit_empty|min_length[3]',
            'nImita' => 'required',
            'nAponta' => 'required',
            'nControleXixi' => 'required',
            'nControleCoco' => 'required',
            'nInterageCrianca' => 'required',
            'nSeletividadeAlimentar' => 'required',
            'nQualAlimento' => 'permit_empty|min_length[3]',
        ];

        $message = [
            'nAutoAgressao' => ['required' => 'Preenchimento obrigatório', 'mas' => 'blo'],
            'nTipoAutoAgressao' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nHeteroagressao' => ['required' => 'Preenchimento obrigatório'],
            'nTipoHeteroagressao' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nMovimentoEsteriotipado' => ['required' => 'Preenchimento obrigatório'],
            'nTipoMovimento' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nObedeceOrdem' => ['required' => 'Preenchimento obrigatório'],
            'nEsperaVez' => ['required' => 'Preenchimento obrigatório'],

            'nOrdemFaz' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nTempoSentado' => ['min_length' => 'Pelo menos 01 caracter'],
            'nFormaNecessidade' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nPossuiObjeto' => ['required' => 'Preenchimento obrigatório'],
            'nObjetoApego' => ['min_length' => 'Pelo menos 03 caracteres'],
            'nImita' => ['required' => 'Preenchimento obrigatório'],
            'nAponta' => ['required' => 'Preenchimento obrigatório'],
            'nControleXixi' => ['required' => 'Preenchimento obrigatório'],
            'nControleCoco' => ['required' => 'Preenchimento obrigatório'],
            'nInterageCrianca' => ['required' => 'Preenchimento obrigatório'],
            'nSeletividadeAlimentar' => ['required' => 'Preenchimento obrigatório'],
            'nQualAlimento' => ['min_length' => 'Pelo menos 03 caracteres'],
        ];
        
        $val = $this->validate($rules, $message);
        $idUsuario = $this->request->getPost('nIdUsuario');
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados['idUsuario'] = $idUsuario;
        /* DADOS COMPORTAMENTO*/
        $dados['possuiEcolalias'] = $this->request->getPost('nEcolalias');
        $dados['possuiDestrutividade'] = $this->request->getPost('nDestrutividade');
        $dados['possuiFuga'] = $this->request->getPost('nFuga');
        $dados['possuiChoro'] = $this->request->getPost('nChoro');
        $dados['possuiRisos'] = $this->request->getPost('nRisos');

        $dados['autoAgressao'] = $this->request->getPost('nAutoAgressao');
        $dados['tipoAgressao'] = tratarPalavras($this->request->getPost('nTipoAutoAgressao'));
        $dados['heteroAgressao'] = $this->request->getPost('nHeteroagressao');
        $dados['tipoHetero'] = tratarPalavras($this->request->getPost('nTipoHeteroagressao'));
        $dados['movimentoEsteriotipado'] = $this->request->getPost('nMovimentoEsteriotipado');
        $dados['tipoMovimento'] = tratarPalavras($this->request->getPost('nTipoMovimento'));
        $dados['obedeceOrdem'] = $this->request->getPost('nObedeceOrdem');
        $dados['esperaVez'] = $this->request->getPost('nEsperaVez');
        $dados['ordemFaz'] = tratarPalavras($this->request->getPost('nOrdemFaz'));
        $dados['tempoToleranciaSentado'] = $this->request->getPost('nTempoSentado');

        $dados['necessidadeBanheiro'] = $this->request->getPost('nNecessidadeBanheiro');
        $dados['necessidadeAgua'] = $this->request->getPost('nNecessidadeAgua');
        $dados['necessidadeDor'] = $this->request->getPost('nNecessidadeDor');
        $dados['necessidadeCansaco'] = $this->request->getPost('nNecessidadeCansaco');

        $dados['formaNecessidade'] = tratarPalavras($this->request->getPost('nFormaNecessidade'));
        $dados['possuiObjetoApego'] = $this->request->getPost('nPossuiObjeto');
        $dados['objetoApego'] = tratarPalavras($this->request->getPost('nObjetoApego'));
        $dados['imita'] = $this->request->getPost('nImita');
        $dados['aponta'] = $this->request->getPost('nAponta');
        $dados['controleXixi'] = $this->request->getPost('nControleXixi');
        $dados['controleCoco'] = $this->request->getPost('nControleCoco');
        $dados['interageCrianca'] = $this->request->getPost('nInterageCrianca');
        $dados['seletividadeAlimentar'] = $this->request->getPost('nSeletividadeAlimentar');
        $dados['qualAlimentacao'] = tratarPalavras($this->request->getPost('nQualAlimento'));

        try {
            $modelComportamento = new ComportamentoModel();
            $gravar = $modelComportamento->save($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }


        return $this->form_alterar_dados_comportamento(encrypt($idUsuario));
    }

    public function alterarDadosSocializacao()
    {
        $rules = [
            'nPossuiAmigos' => 'required',
            'nBrinca' => 'required',
            'nTipoBrincadeira' => 'permit_empty|min_length[3]|max_length[3]',
            'nBrincaFazConta' => 'required',
            'nImitaAnimal' => 'required',
            'nImitaPessoa' => 'required',
            'nResponsavelAtividade' => 'required',
            'nTipoAtividade' => 'permit_empty|min_length[3]',
            'nComportamentoFuga' => 'required',
            'nOutroAtendimento' => 'permit_empty|min_length[3]',
            'nOnde' => 'permit_empty|min_length[3]',
            'nNumeroAtendimento' => 'permit_empty|min_length[1]',
            'nEstimulacao' => 'required|min_length[1]',
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

        $dados['idUsuario'] = $idUsuario;
        /* DADOS SOCIALIZACAO*/
        $dados['possuiAmigos'] = $this->request->getPost('nPossuiAmigos');
        $dados['brinca'] = $this->request->getPost('nBrinca');
        $dados['tipoBrincadeira'] = tratarPalavras($this->request->getPost('nTipoBrincadeira'));
        $dados['brincaFazConta'] = $this->request->getPost('nBrincaFazConta');
        $dados['imitaAnimal'] = $this->request->getPost('nImitaAnimal');
        $dados['imitaPessoa'] = $this->request->getPost('nImitaPessoa');
        $dados['responsavelAtividade'] = $this->request->getPost('nResponsavelAtividade');
        $dados['qualAtividade'] = tratarPalavras($this->request->getPost('nTipoAtividade'));
        $dados['comportamentoFuga'] = $this->request->getPost('nComportamentoFuga');

        $dados['tipoAtendimentoForaFono'] = $this->request->getPost('nTipoFono');
        $dados['tipoAtendimentoForaTO'] = $this->request->getPost('nTipoTO');
        $dados['tipoAtendimentoFisio'] = $this->request->getPost('nTipoFisio');
        $dados['tipoAtendimentoPsico'] = $this->request->getPost('nTipoPsico');
        $dados['tipoAtendimentoEquo'] = $this->request->getPost('nTipoEquo');
        $dados['tipoAtendimentoPsTerapia'] = $this->request->getPost('nTipoPsTerapia');

        $dados['tipoAtendimentoOutro'] = tratarPalavras($this->request->getPost('nOutroAtendimento'));
        $dados['localAtendimentoFora'] = tratarPalavras($this->request->getPost('nOnde'));
        $dados['numeroAtendimento'] = $this->request->getPost('nNumeroAtendimento');
        $dados['estimulacao'] = $this->request->getPost('nEstimulacao');

        $dados['brinquedoPedagogico'] = $this->request->getPost('nBrinquedo');
        $dados['jogos'] = $this->request->getPost('nJogos');
        $dados['revistaLivro'] = $this->request->getPost('nRevistaLivro');
        $dados['brinquedoEletronico'] = $this->request->getPost('nBriquedoEletronico');
        $dados['participaMusica'] = $this->request->getPost('nMusica');
        $dados['participaEsporte'] = $this->request->getPost('nEsportes');
        $dados['participaDanca'] = $this->request->getPost('nDanca');

        try {
            $modelComportamento = new ComportamentoModel();
            $gravar = $modelComportamento->save($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }
        return $this->form_alterar_dados_socializacao(encrypt($idUsuario));
    }

    public function alterarDadosFinalizacao()
    {
        $rules = [
            'nMaisGosta' => 'required|min_length[10]',
            'nDificuldades' => 'required|min_length[10]',
            'nOrientacaoPais' => 'required|min_length[10]',
            'nOrientacaoAvaliador' => 'required|min_length[10]',
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

        $dados['idUsuario'] = $idUsuario;
        /* DADOS FINALIZAÇÃO*/

        $dados['maisGosta'] = $this->request->getPost('nMaisGosta');
        $dados['maioresDificuldades'] = $this->request->getPost('nDificuldades');
        $dados['orientacaoPais'] = $this->request->getPost('nOrientacaoPais');
        $dados['observacaoAvaliador'] = $this->request->getPost('nOrientacaoAvaliador');


        try {
            $modelFinalizacao = new FinalizacaoModel();
            $gravar = $modelFinalizacao->save($dados);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }
    }

    public function alterarDadosFoto()
    {

        $idUsuario = $this->request->getPost('nIdUsuario');
        $fotoAtual = $this->request->getPost('nFotoUsuario');

        $val = $this->validate([
            'nNovaFoto' => [
                'uploaded[nNovaFoto]',
                'max_size[nNovaFoto,5000]',
                'mime_in[nNovaFoto,image/png,image/jpeg]',
                'ext_in[nNovaFoto,png,jpg,gif]',
                'max_dims[nNovaFoto,200,200]',
            ],
        ]);

        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('nNovaFoto');

        try {

            if (!$img->hasMoved()) {
                //$filepath = WRITEPATH . 'uploads/' . $img->store();
                $nameFoto = encrypt($idUsuario) . '.' . $img->getExtension();

                if ($img->move(definirUrlBase() . 'img/fotos/', $nameFoto)) {

                    $dados['idUsuario'] = $idUsuario;
                    $dados['fotoUsuario'] = $nameFoto;
                    //$this->move(WRITEPATH . 'uploads/' . $folderName, $fileName);

                    if($fotoAtual != 'foto-perfil.png') {
                        unlink(definirUrlBase().'img/fotos/'.$fotoAtual);
                    }

                    $gravar = $this->modelUsuario->save($dados);

                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                }


                //return view('upload_success', $data);
            }
        } catch (Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_alterar_dados_foto(encrypt($idUsuario));
    }

    public function desligarUsuario()
    {
        $idUsuario = $this->request->getPost('nIdUsuario');

        $rules = [
            'nMotivoDesligamento' => 'required',
        ];

        $val = $this->validate($rules);

        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'USUARIO::' => $idUsuario,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }       

            $dados['idUsuario'] = $idUsuario;
            $dados['motivo'] = $this->request->getPost('nMotivoDesligamento');            
            $dados['idMatricula'] = $this->request->getPost('nIdMatricula');

            try {
                //$modelComportamento = new ComportamentoModel();
                $gravar =$this->modelUsuario->desligaUsuario($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                } else {

                    session()->set('erro', 'ERRO, não foi possível realizar operação.');
                    return $this->detalharUsuario(encrypt($idUsuario));
           
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }
            //return $this->form_alterar_dados_socializacao(encrypt($idUsuario));
            return $this->form_desligar_usuario(encrypt($idUsuario));
       
    }

    public function form_escrever_anamnese($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 01',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese', $dados);
    }
    public function form_escrever_anamnese02($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 02',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese02($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese02', $dados);
    }
    public function form_escrever_anamnese03($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 03',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese03($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese03', $dados);
    }
    public function form_escrever_anamnese04($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 04',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese04($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese04', $dados);
    }
    public function form_escrever_anamnese05($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 05',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese05($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese05', $dados);
    }
    public function form_escrever_anamnese06($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 06',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese06($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese06', $dados);
    }
    public function form_escrever_anamnese07($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'ESCREVER ANAMNESE ETAPA 07',
            //'pagina' => 'form-alterar-dados-pessoais',
            'dadosUsuario' => $this->modelUsuario->getAnamnese07($id),
            //'modelUsuario' => $this->modelUsuario,
            //'modelCidade' => $this->modelCidade,
            'pasta' => 'usuario',
        ];

        return view('usuario/form-escrever-anamnese07', $dados);
    }

    public function form_escolha_cadastrar_usuario()
    {        
        $dados = array(

            'titulo' => 'ESCOLHA TIPO DE USUÁRIO',            
            'pasta' => 'usuario',
            
        );   
        return view('usuario/form-escolha-cadastrar-usuario', $dados);
    
    }

    public function form_cadastrar_usuario()
    {       
        $dados = array(

            'titulo' => 'CADASTRAR USUÁRIO - SIMPLIFICADO',            
            'pasta' => 'usuario',
            'modelCidade' => $this->modelCidade,
            
        );       

        return view('usuario/form-cadastrar-usuario', $dados);

    }
    public function form_cadastrar_usuario_acompanhante()
    {
        $dados = array(

            'titulo' => 'CADASTRAR USUÁRIO <span style="color:orange;font-weight:bold">ACOMPANHANTE</span>', 
            'pasta' => 'usuario',
            'modelCidade' => $this->modelCidade,
            
        );       

        return view('usuario/form-cadastrar-usuario-acompanhante', $dados);
    }


    public function escreverAnamneseEp01()
    {
        $rules = [
            'nTemApelido'=>'required',   
            'nApelido'=>'permit_empty|min_length[3]' ,     
            'nGosta'=>'required',     
            'nPorqueApelido' => 'permit_empty|min_length[3]',      
            'nPaiEstudou' => 'permit_empty|min_length[1]',      
            'nPaiDificuldade'=>'required',      
            'nPaiFormou'=>'required',      
            'nMaeEstudou' => 'permit_empty|min_length[1]',      
            'nMaeDificuldade'=>'required',      
            'nMaeFormou'=>'required',      
            'nIrmaos'=>'permit_empty|min_length[1]',      
            'nEsquemaFamiliar'=>'required|min_length[10]',      
            'nQueixaEscola'=> 'required|min_length[10]',      
            'nIndicadoPor'=>'permit_empty|min_length[10]',   
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

            /* DADOS ANAMNESE EP01*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['temApelido'] = $this->request->getPost('nTemApelido');           
            $dados['qualApelido'] = $this->request->getPost('nApelido');           
            $dados['gosta'] = $this->request->getPost('nGosta');           
            $dados['porqueApelido'] = $this->request->getPost('nPorqueApelido');           
            $dados['paiEstudouAte'] = $this->request->getPost('nPaiEstudou');           
            $dados['paiDificuldade'] = $this->request->getPost('nPaiDificuldade');           
            $dados['paiFormou'] = $this->request->getPost('nPaiFormou');           
            $dados['maeEstudouAte'] = $this->request->getPost('nMaeEstudou');           
            $dados['maeDificuldade'] = $this->request->getPost('nMaeDificuldade');           
            $dados['maeFormou'] = $this->request->getPost('nMaeFormou');           
            $dados['nomeIrmaos'] = $this->request->getPost('nIrmaos');           
            $dados['esquemaFamiliar'] = $this->request->getPost('nEsquemaFamiliar');           
            $dados['queixaEscola'] = $this->request->getPost('nQueixaEscola');           
            $dados['indicadoPor'] = $this->request->getPost('nIndicadoPor'); 
            
            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese02/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
       
       
    }

    public function escreverAnamneseEp02()
    {

        $rules = [
        'nFilhoDesejado'=>'required',      
        'nQueriaEngravidar'=>'required',      
        'nFoiAcidental'=>'required',      
        'nPertubouCasal'=>'required',      
        'nGestacao' =>'required|min_length[10]',      
        'nParto'=>'required|min_length[10]',      
        'nMamouPeito'=>'required',           
        'nIdadeMamou'=>'required',           
        'nPassagemMamadeira'=>'required|min_length[10]', 
        'nPassagemPapinha'=>'required|min_length[10]', 
        'nHoraComer'=>'required',   
        'nComeDepressa'=>'required',   
        'nMastigaBem'=>'required',          
        'nComemJuntos'=>'required',          
        'nComeTv'=>'required',   
        'nIdadeFraldas'=>'required|min_length[1]',  
        'nPassagemTroninho'=>'required|min_length[10]',    
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

            /* DADOS ANAMNESE EP02*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['filhoDesejado'] = $this->request->getPost('nFilhoDesejado');           
            $dados['queriaEngravidar'] = $this->request->getPost('nQueriaEngravidar');           
            $dados['foiAcidental'] = $this->request->getPost('nFoiAcidental');           
            $dados['pertubouCasal'] = $this->request->getPost('nPertubouCasal');           
            $dados['comoFoiGestacao'] = $this->request->getPost('nGestacao');           
            $dados['comoFoiParto'] = $this->request->getPost('nParto');           
            $dados['mamouPeito'] = $this->request->getPost('nMamouPeito');           
            $dados['mamouIdade'] = $this->request->getPost('nIdadeMamou');           
            $dados['passagemMamadeira'] = $this->request->getPost('nPassagemMamadeira');           
            $dados['passagemPapinha'] = $this->request->getPost('nPassagemPapinha');           
            $dados['horaComer'] = $this->request->getPost('nHoraComer');           
            $dados['comeDepressa'] = $this->request->getPost('nComeDepressa');           
            $dados['mastigaBem'] = $this->request->getPost('nMastigaBem');           
            $dados['comemJuntos'] = $this->request->getPost('nComemJuntos');           
            $dados['comemVendoTv'] = $this->request->getPost('nComeTv');           
            $dados['idadeParouFraldas'] = $this->request->getPost('nIdadeFraldas');           
            $dados['passagemTroninho'] = $this->request->getPost('nPassagemTroninho');           
            $dados['fezesLiquida'] = $this->request->getPost('nLiquida');           
            $dados['fezesPastosa'] = $this->request->getPost('nPastosa');           
            $dados['fezesRessecada'] = $this->request->getPost('nRessecada');           
            $dados['fezesNormal'] = $this->request->getPost('nNormal');  

            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese03/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
       
       
    }

    public function escreverAnamneseEp03()
    {
        $rules = [
        'nCercadinho'=>'required',      
        'nEngatinhou'=>'required',      
        'nIdadeAndou'=>'required',      
        'nCaiaMuito'=>'required',      
        'nQuemEnsinouAndar'=>'required|min_length[3]',      
        'nComoAprendeu'=>'required|min_length[3]',      
        'nCorajoso'=>'required',      
        'nCorajosoEspaco'=>'required',      
        'nEraInseguro'=>'required',      
        'nQuemAndavaMelhor'=>'required|min_length[3]',      
        'nEvolucaoMovimento'=>'required|min_length[3]',      
        'nGrandeMusculos'=>'required|min_length[3]',      
        'nEstabanado'=>'required',      
        'nNada'=>'required',      
        'nAgitado'=>'required',      
        'nAndaPatins'=>'required',      
        'nAndaBicicleta'=>'required',      
        'nAndaCavalo'=>'required',      
        'nSobeArvores'=>'required',      
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

        

            /* DADOS ANAMNESE EP03*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['ficouCercadinho'] = $this->request->getPost('nCercadinho');           
            $dados['engatinhou'] = $this->request->getPost('nEngatinhou');           
            $dados['idadeAndou'] = $this->request->getPost('nIdadeAndou');           
            $dados['caiaMuito'] = $this->request->getPost('nCaiaMuito');           
            $dados['quemEnsinouAndar'] = $this->request->getPost('nQuemEnsinouAndar');           
            $dados['comoAprendouAndar'] = $this->request->getPost('nComoAprendeu');           
            $dados['corajosoEscada'] = $this->request->getPost('nCorajoso');           
            $dados['corajosoEspaco'] = $this->request->getPost('nCorajosoEspaco');           
            $dados['eraInseguro'] = $this->request->getPost('nEraInseguro');           
            $dados['quemAndavaMelhor'] = $this->request->getPost('nQuemAndavaMelhor');           
            $dados['evolucaoMovimentos'] = $this->request->getPost('nEvolucaoMovimento');           
            $dados['grandesMusculos'] = $this->request->getPost('nGrandeMusculos');           
            $dados['estabanado'] = $this->request->getPost('nEstabanado');           
            $dados['nada'] = $this->request->getPost('nNada');           
            $dados['agitado'] = $this->request->getPost('nAgitado');           
            $dados['andaPatins'] = $this->request->getPost('nAndaPatins');           
            $dados['andaBicicleta'] = $this->request->getPost('nAndaBicicleta');           
            $dados['andaCavalo'] = $this->request->getPost('nAndaCavalo');           
            $dados['sobeArvore'] = $this->request->getPost('nSobeArvores');           
          
                    
            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese04/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
    }

    public function escreverAnamneseEp04()
    {
        $rules = [
        'nIdadeFala'=>'required',      
        'nFalavaMais'=> 'required|min_length[3]',      
        'nFalavaRepetir'=>'required',      
        'nPalavras'=>'required|min_length[1]',      
        'nTrocavaLetras'=>'required',      
        'nQuaisLetras'=>'permit_empty|min_length[1]',      
        'nFalavaErrado'=>'required',      
        'nTrocaLetras'=>'required',      
        'nFalaMuito'=>'required',      
        'nFalaEntende'=>'required',      
        'nExemploFala'=> 'required|min_length[1]',      
        'nDarRecado'=>'required',      
        'nCompraSozinho'=>'required',      
        'nContaHistoria'=>'required',      
        'nExemploHistoria'=> 'permit_empty|min_length[1]',      
        'nEntendeConta'=>'required',      
        'nComecoMeioFim'=>'required',      
        'nSonoAgitado'=>'required',      
        'nSonambulo'=>'required',      
        'nTemPesadelos'=>'required',      
        'nDorme'=>'required',      
        'nQuantasPessoas'=>'permit_empty|min_length[1]',      
        'nCamaPais'=>'required',      
        'nMedoDormir'=>'required',      
        'nEnureseNoturna'=>'required',      
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

      

            /* DADOS ANAMNESE EP04*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['idadeFalou'] = $this->request->getPost('nIdadeFala');           
            $dados['comQuemFalava'] = $this->request->getPost('nFalavaMais');           
            $dados['falavaRepetir'] = $this->request->getPost('nFalavaRepetir');           
            $dados['primeirasPalavras'] = $this->request->getPost('nPalavras');           
            $dados['trocavaLetras'] = $this->request->getPost('nTrocavaLetras');           
            $dados['quaisLetras'] = tratarPalavras($this->request->getPost('nQuaisLetras'));           
            $dados['falavaErrado'] = $this->request->getPost('nFalavaErrado');           
            $dados['trocaLetras'] = $this->request->getPost('nTrocaLetras');           
            $dados['falaMuito'] = $this->request->getPost('nFalaMuito');           
            $dados['falaEntende'] = $this->request->getPost('nFalaEntende');           
            $dados['exemploFala'] = $this->request->getPost('nExemploFala');           
            $dados['darRecado'] = $this->request->getPost('nDarRecado');           
            $dados['compraSozinho'] = $this->request->getPost('nCompraSozinho');           
            $dados['contaHistoria'] = $this->request->getPost('nContaHistoria');           
            $dados['exemploHistoria'] = $this->request->getPost('nExemploHistoria');           
            $dados['entendeEleConta'] = $this->request->getPost('nEntendeConta');           
            $dados['comecoMeioFim'] = $this->request->getPost('nComecoMeioFim');           
            $dados['eAgitado'] = $this->request->getPost('nSonoAgitado');           
            $dados['eSonambulo'] = $this->request->getPost('nSonambulo');           
            $dados['temPesadelos'] = $this->request->getPost('nTemPesadelos');           
            $dados['dorme'] = $this->request->getPost('nDorme');           
            $dados['pessoasDorme'] = $this->request->getPost('nQuantasPessoas');           
            $dados['vaiParaCamaPais'] = $this->request->getPost('nCamaPais');           
            $dados['medoDormir'] = $this->request->getPost('nMedoDormir');           
            $dados['enureseNoturna'] = $this->request->getPost('nEnureseNoturna');  
                    
            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese05/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
    }

    public function escreverAnamneseEp05()
    {
        $rules = [
        'nBronquite'=>'required',
        'nAlergia'=>'required',
        'nAsma'=>'required',
        'nVirose'=>'required',
        'nInternacoes'=>'required',
        'nCirurgia'=>'required',
        'nOutroTratamento'=>'required',
        'nQual'=>'permit_empty|min_length[3]',
        'nProblemaVisao'=>'required',
        'nProblemaAudicao'=>'required',
        'nProblemaPsico'=> 'permit_empty|min_length[10]',
        'nFatosMarcantes'=>'permit_empty|min_length[10]',
        'nNascimentoIrmao'=>'required',
        'nMudancas'=>'required',
        'nMorte'=>'required',
        'nMorteQuem'=>'permit_empty|min_length[3]',
        'nDesemprego'=>'required',
        'nSeparacao'=>'required',
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

        

            /* DADOS ANAMNESE EP05*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['bronquite'] = $this->request->getPost('nBronquite');
            $dados['alergia'] = $this->request->getPost('nAlergia');
            $dados['asma'] = $this->request->getPost('nAsma');
            $dados['viroses'] = $this->request->getPost('nVirose');
            $dados['intenacao'] = $this->request->getPost('nInternacoes');
            $dados['cirurgia'] = $this->request->getPost('nCirurgia');
            $dados['outroTratamento'] = $this->request->getPost('nOutroTratamento');
            $dados['qualTratamento '] = $this->request->getPost('nQual');
            $dados['problemaVisa'] = $this->request->getPost('nProblemaVisao');
            $dados['problemaAudicao'] = $this->request->getPost('nProblemaAudicao');
            $dados['problemaPsico'] = $this->request->getPost('nProblemaPsico');
            $dados['fatosMarcantes'] = $this->request->getPost('nFatosMarcantes');
            $dados['nascimentoIrmao'] = $this->request->getPost('nNascimentoIrmao');
            $dados['mudancas'] = $this->request->getPost('nMudancas');
            $dados['mortes'] = $this->request->getPost('nMorte');
            $dados['quemMorte'] = $this->request->getPost('nMorteQuem');
            $dados['desemprego'] = $this->request->getPost('nDesemprego');
            $dados['separacao'] = $this->request->getPost('nSeparacao');
                    
               

            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese06/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
    }

    public function escreverAnamneseEp06()
    {
        $rules = [
        'nFamilia'=>'permit_empty|min_length[10]',
        'nDisciplina'=>'permit_empty|min_length[10]',
        'nAtitudePais'=>'permit_empty|min_length[10]',
        'nReacaoCrianca'=> 'permit_empty|min_length[10]',
        'nAlguemProtege'=>'required',
        'nQuemProtege'=>'permit_empty|min_length[3]',
        'nCensurado'=>'required',
        'nRelacaoPai'=>'required',
        'nRelacaoMae'=>'required',
        'nRelacaoIrmao'=>'required',
        'nPaisLer'=>'required',
        'nAuxiliaLicao'=> 'permit_empty|min_length[3]',
        'nProblemaFamilia'=> 'permit_empty|min_length[10]',
        'nBrincadeiras'=> 'permit_empty|min_length[3]',
        'nPrefereBrincadeira'=> 'permit_empty|min_length[3]',
        'nRelacaoColega'=>'permit_empty|min_length[3]',
        'nLider'=>'required',
        'nChoraBrincadeiras'=>'required',
        'nProgramaTv'=>'permit_empty|min_length[3]',
        'nAssunto'=> 'permit_empty|min_length[10]',          
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

       
            /* DADOS ANAMNESE EP06*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['familia'] = $this->request->getPost('nFamilia');
            $dados['disciplina'] = $this->request->getPost('nDisciplina');
            $dados['atitudePais'] = $this->request->getPost('nAtitudePais');
            $dados['reacaoCrianca'] = $this->request->getPost('nReacaoCrianca');
            $dados['alguemProtege'] = $this->request->getPost('nAlguemProtege');
            $dados['quemProtege'] = $this->request->getPost('nQuemProtege');
            $dados['censurado'] = $this->request->getPost('nCensurado');
            $dados['relacaoPai'] = $this->request->getPost('nRelacaoPai');
            $dados['relacaoMae'] = $this->request->getPost('nRelacaoMae');
            $dados['relacaoIrmao'] = $this->request->getPost('nRelacaoIrmao');
            $dados['paisLeem'] = $this->request->getPost('nPaisLer');
            $dados['auxiliaLicao'] = $this->request->getPost('nAuxiliaLicao');
            $dados['problemaFamilia'] = $this->request->getPost('nProblemaFamilia');
            $dados['brincadeiras'] = $this->request->getPost('nBrincadeiras');
            $dados['prefereBrincadeira'] = $this->request->getPost('nPrefereBrincadeira');
            $dados['relacaoColega'] = $this->request->getPost('nRelacaoColega');
            $dados['lider'] = $this->request->getPost('nLider');
            $dados['choraBrincadeiras'] = $this->request->getPost('nChoraBrincadeiras');
            $dados['programaTv'] = $this->request->getPost('nProgramaTv');
            $dados['assuntoLazer'] = $this->request->getPost('nAssunto');
                    
            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/form_escrever_anamnese07/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
    }

    public function escreverAnamneseEp07()
    {
        $rules = [
             'nCreche'=>'required',
             'nIdadeEscola'=>'required',
             'nPorqueEscola'=> 'required|min_length[3]',
             'nEscolheuEscola'=> 'required|min_length[3]',
             'nComoFoiEscolha'=> 'required|min_length[3]',
             'nMudancaEscola'=>'permit_empty|min_length[3]',
             'nRepetiuAno'=> 'required',
             'nPorqueRepetiu'=> 'permit_empty|min_length[3]',
             'nProblemaProf'=>'required',
             'nQualProblema'=>'permit_empty|min_length[3]',
             'nAtitudeSala'=>'required|min_length[3]',
             'nFaltaEscola'=>'required',
             'nProqueFaltaEscola'=>'permit_empty|min_length[3]',
             'nReforco'=>'required',    
             'nGostaReforco'=>'required',
             'nOpiniaoEscola'=> 'required|min_length[3]', 
             'nEncamOutro'=>'permit_empty|min_length[3]',

        'nMaisGosta'=>'required|min_length[10]',
        'nDificuldades'=>'required|min_length[10]',
        'nOrientacaoPais'=>'permit_empty|min_length[10]',
        'nOrientacaoAvaliador'=> 'permit_empty|min_length[10]',
        'nConduta'=> 'permit_empty|min_length[10]',
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

       

            /* DADOS ANAMNESE EP07*/          
            $dados['idUsuario'] = $idUsuario;
            $dados['creches'] = $this->request->getPost('nCreche');
            $dados['idadeEscola'] = $this->request->getPost('nIdadeEscola');
            $dados['porqueEscola'] = $this->request->getPost('nPorqueEscola');
            $dados['quemEscolheuEscola'] = $this->request->getPost('nEscolheuEscola');
            $dados['comoFoiEscolha'] = $this->request->getPost('nComoFoiEscolha');
            $dados['mudancaEscola'] = $this->request->getPost('nMudancaEscola');
            $dados['repetiuAno'] = $this->request->getPost('nRepetiuAno');
            $dados['porqueRepetiu'] = $this->request->getPost('nPorqueRepetiu');
            $dados['problemaProfessor'] = $this->request->getPost('nProblemaProf');
            $dados['qualProblemaProf'] = $this->request->getPost('nQualProblema');
            $dados['atitudeSala'] = $this->request->getPost('nAtitudeSala');
            $dados['faltaEscola'] = $this->request->getPost('nFaltaEscola');
            $dados['porqueFalta'] = $this->request->getPost('nProqueFaltaEscola');
            $dados['refoco'] = $this->request->getPost('nReforco');    
            $dados['gostaRefoco'] = $this->request->getPost('nGostaReforco');
            $dados['opiniaoEscola'] = $this->request->getPost('nOpiniaoEscola');
            
            $dados['maisGosta'] = $this->request->getPost('nMaisGosta');           
            $dados['maioresDificuldades'] = $this->request->getPost('nDificuldades');           
            $dados['orientacaoPais'] = $this->request->getPost('nOrientacaoPais');           
            $dados['observacaoAvaliador'] = $this->request->getPost('nOrientacaoAvaliador'); 
            $dados['condutaTerapeutica'] = $this->request->getPost('nConduta'); 
            $dados['liberaImpressao'] = 'S';
            
            try {
                $modelAnamnese = new AnamneseModal();

                $gravar = $modelAnamnese->save($dados);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_escrever_anamnese(encrypt($idUsuario));  
    }
    public function cadastrarUsuarioSimplificado()
    {
            $dados['nomeUsuario'] = tratarPalavras($this->request->getPost('nNomeUsuario'));
            $dados['dataNascimento'] = converteParaDataMysql($this->request->getPost('nDataNascimento'));
            $dados['idadeDiagnostico'] = $this->request->getPost('nIdadeDiagnostico');
            $dados['genero'] = $this->request->getPost('nGenero');
            $dados['telefone'] = $this->request->getPost('nTelefone');
            $dados['teste'] = $this->request->getPost('teste');
            $dados['cpfUsuario'] = tratarCpf($this->request->getPost('nCpfUsuario'));
            $dados['cnsUsuario'] = tratarCns($this->request->getPost('nCnsUsuario'));           
            $dados['nisUsuario'] = tratarNis($this->request->getPost('nNisUsuario'));
            $dados['frequentaEscolaRegular'] = $this->request->getPost('nFrequentaEscola');
            $dados['frequentaEscolaEspecial'] = $this->request->getPost('nFrequentaEscolaEspecial');
            $dados['escolaOrigem'] = tratarPalavras($this->request->getPost('nNomeEscola'));
            $dados['tipoEscolaRegular'] = $this->request->getPost('nTipoEscola');
            $dados['serieAno'] = $this->request->getPost('nSerieAno');
            $dados['possuiCuidador'] = $this->request->getPost('nCuidador');
            $dados['medicoAcompanhante'] = tratarPalavras($this->request->getPost('nMedico'));
            $dados['telefoneMedicoAcompanhante'] = $this->request->getPost('nTelefoneMedicoAcompanhante');
            $dados['fezAtendimento'] = $this->request->getPost('nFezAtendimento');
            $dados['fazAtendimento'] = $this->request->getPost('nFazAtendimento');
            $dados['nomePai'] = tratarPalavras($this->request->getPost('nNomePai'));
            $dados['telefonePai'] = $this->request->getPost('nTelefonePai');
            $dados['nomeMae'] = tratarPalavras($this->request->getPost('nNomeMae'));
            $dados['telefoneMae'] = $this->request->getPost('nTelefoneMae');
            $dados['moraCom'] = $this->request->getPost('nMoraCom');
            $dados['cep'] = $this->request->getPost('nCep');
            $dados['logradouro'] = tratarPalavras($this->request->getPost('nLogradouro'));
            $dados['numeroLogradouro'] = $this->request->getPost('nNumeroLogradouro');
            $dados['bairro'] = tratarPalavras($this->request->getPost('nBairro'));
            $dados['complemento'] = tratarPalavras($this->request->getPost('nComplemento'));
            $dados['pontoReferencia'] = tratarPalavras($this->request->getPost('nPontoReferencia'));
            $dados['cidade'] = tratarPalavras($this->request->getPost('nCidade'));
            $dados['listaEspera'] = $this->request->getPost('nListaEspera');    
            
      
            
            $rules = [
                'nNomeUsuario' => 'required|min_length[3]',
                'nDataNascimento' => 'required',
                'nGenero' => 'required',
                'nFrequentaEscola' => 'required',
                'nFrequentaEscolaEspecial' => 'required',
                'nNomeEscola' => 'permit_empty|min_length[3]',
                'nCuidador' => 'required',
                'nMedico'=> 'permit_empty|min_length[3]',
                'nNomePai' => 'required|min_length[3]',
                'nTelefonePai' => 'required', 
                'nNomeMae' => 'required|min_length[3]',
                'nTelefoneMae' => 'required',
                'nMoraCom' => 'permit_empty|min_length[2]|max_length[20]',
                'nLogradouro' => 'required',
                'nNumeroLogradouro' => 'required',
                'nBairro' => 'required',
                'nCidade' => 'required',
                'nPontoReferencia' => 'permit_empty|min_length[3]',
                'nListaEspera' => 'required',
                'nCpfUsuario' => 'permit_empty|validateCpf|is_unique[tb_pessoa.cpf]',
                'nCnsUsuario' => 'required|valid_cns|is_unique[tb_usuario.cnsUsuario, idUsuario, {".$idUsuario."}]',
                'nNisUsuario' => 'permit_empty|valid_nis|is_unique[tb_usuario.nisUsuario]',            
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
            
            try {
                $modelUsuario = new UsuarioModel;

                $gravar = $modelUsuario->saveUsuario($dados);

                //dd($gravar);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');

                    $modelPessoa = new PessoaModel;
                    $ultimaPessoa = $modelPessoa->getLastPessoa();

                    $idUsuario = $ultimaPessoa->idPessoa;    
                    //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_cadastrar_usuario();  
    }
    public function cadastrarUsuarioUcompanhante()
    {
            $dados['nomeUsuario'] = tratarPalavras($this->request->getPost('nNomeUsuario'));
            $dados['dataNascimento'] = converteParaDataMysql($this->request->getPost('nDataNascimento'));
            $dados['idadeDiagnostico'] = $this->request->getPost('nIdadeDiagnostico');
            $dados['genero'] = $this->request->getPost('nGenero');
            $dados['telefone'] = $this->request->getPost('nTelefone');
            $dados['teste'] = $this->request->getPost('teste');
            $dados['cpfUsuario'] = tratarCpf($this->request->getPost('nCpfUsuario'));
            $dados['cnsUsuario'] = tratarCns($this->request->getPost('nCnsUsuario'));           
            $dados['nisUsuario'] = tratarNis($this->request->getPost('nNisUsuario'));
            $dados['nomeResponsavel'] = 'NAO INFORMADO';
            $dados['cep'] = $this->request->getPost('nCep');
            $dados['logradouro'] = tratarPalavras($this->request->getPost('nLogradouro'));
            $dados['numeroLogradouro'] = $this->request->getPost('nNumeroLogradouro');
            $dados['bairro'] = tratarPalavras($this->request->getPost('nBairro'));
            $dados['complemento'] = tratarPalavras($this->request->getPost('nComplemento'));
            $dados['pontoReferencia'] = tratarPalavras($this->request->getPost('nPontoReferencia'));
            $dados['cidade'] = tratarPalavras($this->request->getPost('nCidade'));
            $dados['listaEspera'] = 'N';
            $dados['acompanhante'] = 'S';      
            
            $rules = [
                'nNomeUsuario' => 'required|min_length[3]',
                'nDataNascimento' => 'required',
                'nGenero' => 'required',
                'nLogradouro' => 'required',
                'nNumeroLogradouro' => 'required',
                'nBairro' => 'required',
                'nCidade' => 'required',
                'nPontoReferencia' => 'permit_empty|min_length[3]',
                'nCpfUsuario' => 'permit_empty|validateCpf|is_unique[tb_pessoa.cpf]',
                'nCnsUsuario' => 'required|valid_cns|is_unique[tb_usuario.cnsUsuario, idUsuario, {".$idUsuario."}]',
                'nNisUsuario' => 'permit_empty|valid_nis|is_unique[tb_usuario.nisUsuario]', 
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
            
            try {
                $modelUsuario = new UsuarioModel;

                $gravar = $modelUsuario->saveUsuario($dados);

                //dd($gravar);
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');

                    $modelPessoa = new PessoaModel;
                    $ultimaPessoa = $modelPessoa->getLastPessoa();

                    $idUsuario = $ultimaPessoa->idPessoa;    
                    //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }    
    
            return $this->form_cadastrar_usuario_acompanhante();  
    }
}
