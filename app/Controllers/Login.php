<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Login extends BaseController
{
    private $logging;
    public function __construct()
    {
        $logger = new Logger('log');
        $logger->pushHandler(new StreamHandler(WRITEPATH . 'logs/app/log-app-' . date("Y-m-d") . '.log', Logger::DEBUG));
        $this->logging = $logger;
    }
    public function index()
    {
        $data['msg'] = '';
        if($this->request->is('post')) {
            $userModel = new UserModel();
            $userCheck = $userModel->checkLogin(
                tratarCpf($this->request->getPost('nLogin')),  
                  $this->request->getPost('nSenha'),  
            );
            

            if(!$userCheck){

                $data['msg'] = 'Login e senha não confere';
                $this->logging->error(__CLASS__ . "\\" . __FUNCTION__, ['FEITO POR::'=> $this->request->getPost('nLogin'), 'ERROR' => $data['msg']]);
 

            } else {
                $this->session->set('login', $userCheck->login);
                $this->session->set('nome', $userCheck->nome);
                $this->session->set('idOperador', $userCheck->idOperador);
                $this->session->set('tipoOperador', $userCheck->tipoOperador);

                $this->logging->info(__CLASS__ . "\\" . __FUNCTION__, ['FEITO POR::' => session()->get("nome"), 'SUCCESS::' => true]);
                
                return redirect()->to('dashboard/'.date('Y'));
                //redirect('dashboard/'.date('Y'));
            }
        }
        return view('login', $data);
    }
}
