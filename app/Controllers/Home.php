<?php

namespace App\Controllers;

use App\Models\AnoModel;
use App\Models\AtendimentoCrudModel;
use App\Models\AtendimentoModel;
use App\Models\CidadeModel;
use App\Models\MatriculaModel;
use App\Models\MenuModel;
use App\Models\PermissaoModel;
use App\Models\RegistroAtendimentoModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    private $idOperadorSistema;
    private $dataHoje;
    private $dataHoraHoje;
    private $pasta;
    private $modelMenu;
    private $menu;
    private $itemMenu;
    private $modelMatricula;
    private $modelPermissao;
    private $modelAtendimento;
    private $modelAtendimentoCrud;
    private $modelUsuario;
    private $modelCidade;
    private $modelRegistroAtendimento;
    private $modelAno;



    public function __construct()
    {
        //dd($this->session->get('idOperador'));
        $this->idOperadorSistema = session()->get('idOperador');
        $this->dataHoje = date('Y-m-d');
        $this->dataHoraHoje = date('Y-m-d H:i:s');
        $this->pasta = 'home';
        $this->modelMatricula = new MatriculaModel();
        $this->modelAtendimento = new AtendimentoModel();
        $this->modelAtendimentoCrud = new AtendimentoCrudModel();
        $this->modelUsuario = new UsuarioModel();
        $this->modelCidade = new CidadeModel();
        $this->modelRegistroAtendimento = new RegistroAtendimentoModel();
        $this->modelMenu = new MenuModel();
        $this->modelPermissao = new PermissaoModel();
        $this->modelAno = new AnoModel();


        $this->menu = $this->modelMenu->getMenu($this->idOperadorSistema);
        $this->itemMenu = $this->modelPermissao->getItem($this->idOperadorSistema);
        //dd($this->idOperadorSistema,$this->menu,$this->itemMenu);       

        session()->set(
            [
                'botaoSalvar' => '<button type="submit" class="main_bt" id="" data-continue="false"><i class="fa fa-save"></i> Salvar</button>',
                'botaoLimpar' => '<button type="reset" class="main_clear_bt"><i class="fa fa-times"></i> Limpar</button>',
                'botaoFecharModal' => '<button type="button" class="main_clear_bt" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>',
                'botaoPesquisar' => '<button class="btn btn-success waves-effect" type="submit"><span class="badge">P</span> ESQUISAR</button> ',
            ]
        );
        session()->set(
            [
                'idOperadorSistema' => $this->idOperadorSistema,
                'dataHoje' => $this->dataHoje,
                'dataHoraHoje' => $this->dataHoraHoje,
                'anoAtivo' => $this->modelAno->getAnoAtivo()->ano,

            ]
        );

        session()->set(
            [
                'menu' => $this->menu,
                'itemMenu' => $this->itemMenu 
            ]
        );
    }
    public function index()
    {
        echo $this->session->get('login');
        //return view('welcome_message');
    }

    public function dashboard($ano)
    {

        $data = [
            'nome' => $this->session->get('nome'),
            'login' => $this->session->get('login'),
            'pagina'=> 'dashboard',
            'pasta' => 'home',
            'menu' => $this->menu,
        ];

        return view('home/dashboard', $data);
        //$this->load->view('principal', $dados);
    }
}
