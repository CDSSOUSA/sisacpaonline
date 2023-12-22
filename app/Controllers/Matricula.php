<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatriculaModel;
use App\Models\UsuarioModel;
use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Matricula extends BaseController
{
    private $modelUsuario;
    private $modelMatricula;
    private $logging;
    public function __construct()
    {
        $this->modelUsuario = new UsuarioModel;
        $this->modelMatricula = new MatriculaModel;

        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }

    public function form_matricular_usuario($idUsuario)
    {
        $id = decrypt($idUsuario);

        $dados = [

            'titulo' => 'EDITAR EVOLUÇÃO',
            'pasta' => 'matricula',
            'dadosUsuario' => $this->modelUsuario->find($id),

        ];
        return view('matricula/form-matricular-usuario', $dados);      

    }

    public function matricularUsuario()
    {
        $idUsuario = $this->request->getPost('nIdUsuario');

        $rules = [
            'nAnoMatricula' => 'required'
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
            $dados['anoMatricula'] = $this->request->getPost('nAnoMatricula');
            $dados['idOperadorMatricula'] = session()->get('idOperador');

            
            try {
                //$modelComportamento = new ComportamentoModel();
                $gravar = $this->modelMatricula->salvarMatricula($dados);               
    
                if ($gravar) {
                    session()->set('sucesso', 'Parabéns, ação realizada com sucesso.');
                    $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'SUCCESS::' => $gravar]);
                    return redirect()->to('usuario/detalhar_usuario/' . encrypt($idUsuario));
                } else {

                    //session()->set('erro', 'ERRO, não foi possível realizar operação.');
                    return redirect()->to('matricula/form_matricular_usuario/'.encrypt($idUsuario));
           
                }
            } catch (Exception $e) {
                session()->set('erro', 'ERRO, não foi possível realizar operação.');
                $this->logging->critical(__CLASS__ . "\\" . __FUNCTION__, ['USUARIO::' => $idUsuario, 'FEITO POR::' => session()->get("nome"), 'ERROR' => $e->getMessage()]);
            }
            //return $this->form_alterar_dados_socializacao(encrypt($idUsuario));
            return $this->form_matricular_usuario(encrypt($idUsuario));
            

    }
}
