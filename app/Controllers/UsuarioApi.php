<?php

namespace App\Controllers;

use App\Models\AlocacaoModel;
use App\Models\ModalidadeModel;
use App\Models\PessoaModel;
use App\Models\ProfissionalModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UsuarioApi extends ResourceController
{
    private $logging;

    public function __construct()
    {

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function cadastrarUsuarioSimplificado()
    {
        helper("utils");

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

                $response = [
                    'status' => 'ERROR',
                    'error' => true,
                    'code' => 400,
                    'msg' => $this->validator->getErrors(),
                    'msgs' => $this->validator->getErrors()
                ];
                return $this->response->setJSON($response);
    
    
                //return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            try {
                $modelUsuario = new UsuarioModel;

                $gravar = $modelUsuario->saveUsuario($dados);

                //dd($gravar);
    
                if ($gravar) {
                    //session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');

                    $modelPessoa = new PessoaModel;
                    $ultimaPessoa = $modelPessoa->getLastPessoa();

                    $idUsuario = $ultimaPessoa->idPessoa;    
                    //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                    $response = [
                        'status' => true,
                        'error' => false,
                        'code' => 200,
                        'msg' => '<p>Operação realizada com sucesso!</p>',
                        //'id' =>  $this->series->getInsertID()
                        //'data' => $this->list()
                    ];
                    //return redirect()->to('atendimento/listar_atendimento');
                    return $this->response->setJSON($response);
                    
                }
            } catch (Exception $e) {
                //session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);

                return $this->response->setJSON([
                    'status' => 'ERROR',
                    'error' => true,
                    'code' => $e->getCode(),
                    'msg' => $e->getMessage(),
                    'msgs' => $e->getMessage(),
                ]);
            }    
    
            //return $this->form_cadastrar_usuario();  
    }
}
