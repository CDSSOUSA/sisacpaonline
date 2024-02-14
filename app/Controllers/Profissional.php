<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModalidadeModel;
use App\Models\PessoaModel;
use App\Models\ProfissionalModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Profissional extends BaseController
{
    private $logging;
    private $modelUsuario;
    private $modelAtendimento;
    private $modelProfissional;
    private $modelAlocacao;
    private $modelRegistroAtendimento;
    private $modelModalidade;
    public function __construct()
    {

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;

        $this->modelModalidade = new ModalidadeModel;
        $this->modelProfissional = new ProfissionalModel;
    }
    public function index()
    {
        //
    }

    public function form_cadastrar_profissional()
    {
        $dados = array(
            'titulo' => 'CADASTRAR PROFISSIONAL',
            'pasta' => 'profissional',
            'linkMenu'=> 'form_cadastrar_profissional',
            'modalidades' => $this->modelModalidade->findAll(),
            'atributos' => $this->modelProfissional->getAtributos()
        );
        return view('profissional/form-cadastrar-profissional', $dados);
    }

    public function form_alocar_profissional()
    {
        $dados = array(
            
            'titulo' => 'Alocar Horários',
            'pasta' => 'profissional',
            //'modalidades' => $this->modelModalidade->findAll()           
            'metodo' => 'profissional/alocar_profissional',
            'profissionais'=> $this->modelProfissional ->getProfissionalAtivo()
        );
        return view('profissional/form-pesquisar-profissional', $dados);
    }
    public function form_editar_profissional()
    {
        $dados = [
            'titulo' => 'LISTAR PROFISSIONAIS',
            'pasta' => 'profissional', 
            'linkMenu'=> 'form_editar_profissional',
            'profissionais'=> $this->modelProfissional ->getProfissionalAtivo(),
            'exibirForm' => 0,
            'atributos' => $this->modelProfissional->getAtributos()
        ];
        return view('profissional/form-editar-profissional', $dados);
    }

    public function alocar_profissional()
    {
        $rules = [
            'nIdProfissional' => 'required'            
        ];        

        $val = $this->validate($rules);

        $idProfissional = $this->request->getPost('nIdProfissional');
        
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => $idProfissional,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        //redirect('profissional/form_alocar_horarios/' . ($idProfissional));
        return redirect()->to('profissional/form_alocar_horarios/'.$idProfissional);
        

        // $dados = array(

        //     'titulo' => 'ALOCAR HORÁRIOS DO PROFISSIONAL',
        //     'pagina' => 'form-pesquisar-profissional',
        //     'metodo' => 'alocar_profissional',
        //     'profissionais'=> $this->profissionaisAtivo

        // );

        // $this->load->view('principal', $dados);
    }

    public function cadastrarProfissional()
    {       

        $rules = [
            'nNomeProfissional' => 'required|min_length[3]',
            'nGenero' => 'required',
            'nCpfProfissional' => 'required|validateCpf|is_unique[tb_pessoa.cpf]',
            'nCnsProfissional' => 'required|valid_cns|is_unique[tb_profissional.cnsProfissional]',
            'nTipoProfissional' => 'required',
            'nModalidade' => 'required'
        ];        

        $val = $this->validate($rules);
        
        if (!$val) {

            $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, [
                'PROFISSIONAL::' => null,
                'FEITO POR::' => session()->get("nome"),
                'ERROR' => $this->validator->getErrors()
            ]);

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

            $dados['nomeProfissional'] = tratarPalavras($this->request->getPost('nNomeProfissional'));
            $dados['cpfProfissional'] = tratarCpf($this->request->getPost('nCpfProfissional'));
            $dados['cnsProfissional'] = tratarCns($this->request->getPost('nCnsProfissional'));
            $dados['genero'] = $this->request->getPost('nGenero');
            $dados['operadorAtivo'] = 'S';
            $dados['tipoProfissional'] = $this->request->getPost('nTipoProfissional');
            $dados['ativo'] = 'S';
            $dados['numeralConselhoClasse'] = tratarPalavras($this->request->getPost('nConselhoClasse'));
            $dados['modalidade'] = $this->request->getPost('nModalidade');



        try {
            $modelProfissional = new ProfissionalModel;

            $gravar = $modelProfissional->saveProfissional($dados);

            //dd($gravar);

            if ($gravar) {
                session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');

                $modelPessoa = new PessoaModel;
                $ultimaPessoa = $modelPessoa->getLastPessoa();

                $idProfissional = $ultimaPessoa->idPessoa;
                //return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissional, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                //return redirect()->to('profissional/form_alocar_profissional/' . encrypt($idProfissional));
                return redirect()->to('profissional/form_alocar_profissional/');
                
            }
        } catch (\Exception $e) {
            session()->set('erro', 'ERRO, não foi possível realizar operação.');
            $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['PROFISSIONAL::' => $idProfissional, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
        }

        return $this->form_cadastrar_profissional();

    }
}
