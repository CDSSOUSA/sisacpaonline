<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index', ['filter' => 'throttle']);
$routes->get('/dashboard/(:any)', 'Home::dashboard/$1', ['filter' => 'authFilter']);
$routes->get('/logout', 'Logout::index');

$routes->group('/usuario', ['namespace'=>'App\Controllers','filter'=>'authFilter'], function ($routes) {
    $routes->get('form_pesquisar_usuario','Usuario::form_pesquisar_usuario');
    $routes->get('form_alterar_dados_pessoais/(:any)','Usuario::form_alterar_dados_pessoais/$1');
    $routes->get('form_alterar_dados_responsaveis/(:any)','Usuario::form_alterar_dados_responsaveis/$1');
    $routes->get('form_alterar_dados_aspectos_sociais/(:any)','Usuario::form_alterar_dados_aspectos_sociais/$1');
    $routes->get('form_alterar_dados_comunicacao/(:any)','Usuario::form_alterar_dados_comunicacao/$1');
    $routes->get('form_alterar_dados_comportamento/(:any)','Usuario::form_alterar_dados_comportamento/$1');
    $routes->get('form_alterar_dados_socializacao/(:any)','Usuario::form_alterar_dados_socializacao/$1');
    $routes->get('form_alterar_dados_finalizacao/(:any)','Usuario::form_alterar_dados_finalizacao/$1');
    $routes->get('form_alterar_dados_foto/(:any)','Usuario::form_alterar_dados_foto/$1');
    $routes->get('form_desligar_usuario/(:any)','Usuario::form_desligar_usuario/$1');
        
    $routes->post('pesquisar_usuario','Usuario::pesquisarUsuario');
    $routes->post('alterar_dados_pessoais','Usuario::alterarDadosPessoais');    
    $routes->post('alterar_dados_responsaveis','Usuario::alterarDadosResponsaveis');    
    $routes->post('alterar_dados_sociais','Usuario::alterarDadosSociais');    
    $routes->post('alterar_dados_comunicacao','Usuario::alterarDadosComunicacao');  
    $routes->post('alterar_dados_comportamento','Usuario::alterarDadosComportamento');  
    $routes->post('alterar_dados_socializacao','Usuario::alterarDadosSocializacao');  
    $routes->post('alterar_dados_finalizacao','Usuario::alterarDadosFinalizacao');  
    $routes->post('alterar_dados_foto','Usuario::alterarDadosFoto');  
    $routes->post('desligar_usuario','Usuario::desligarUsuario');  
    
    $routes->get('exibir_usuario','Usuario::exibirUsuario');
    $routes->get('detalhar_usuario/(:any)','Usuario::detalharUsuario/$1');
    
    $routes->get('form_escrever_anamnese/(:any)','Usuario::form_escrever_anamnese/$1');
    $routes->get('form_escrever_anamnese02/(:any)','Usuario::form_escrever_anamnese02/$1');
    $routes->get('form_escrever_anamnese03/(:any)','Usuario::form_escrever_anamnese03/$1');
    $routes->get('form_escrever_anamnese04/(:any)','Usuario::form_escrever_anamnese04/$1');
    $routes->get('form_escrever_anamnese05/(:any)','Usuario::form_escrever_anamnese05/$1');
    $routes->get('form_escrever_anamnese06/(:any)','Usuario::form_escrever_anamnese06/$1');
    $routes->get('form_escrever_anamnese07/(:any)','Usuario::form_escrever_anamnese07/$1');
    
    $routes->post('escrever_anamnese_ep01','Usuario::escreverAnamneseEp01');  
    $routes->post('escrever_anamnese_ep02','Usuario::escreverAnamneseEp02');  
    $routes->post('escrever_anamnese_ep03','Usuario::escreverAnamneseEp03');  
    $routes->post('escrever_anamnese_ep04','Usuario::escreverAnamneseEp04');  
    $routes->post('escrever_anamnese_ep05','Usuario::escreverAnamneseEp05');  
    $routes->post('escrever_anamnese_ep06','Usuario::escreverAnamneseEp06');  
    $routes->post('escrever_anamnese_ep07','Usuario::escreverAnamneseEp07');
    
   
});
$routes->group('/api/atendimento', ['namespace'=>'App\Controllers','filter'=>'authFilter'], function ($routes) {
    $routes->get('getDataAtendimento/(:any)','AtendimentoApi::getDataAtendimento/$1');
    $routes->get('listarAtendimentos/(:any)','AtendimentoApi::listarAtendimentos/$1');
    
    $routes->post('confirmaPresencaUsuarioHorario','AtendimentoApi::confirmaPresencaUsuarioHorario');

    $routes->post('atendimentosAnterior','AtendimentoApi::atendimentosAnterior');


});

$routes->group('/atendimento', ['namespace'=>'App\Controllers','filter'=>'authFilter'], function ($routes) {    

   

    $routes->get('form_cadastrar_atendimento/(:any)','Atendimento::form_cadastrar_atendimento/$1');
    $routes->get('form_cadastrar_atendimento02/(:any)/(:any)','Atendimento::form_cadastrar_atendimento02/$1/$2');
    $routes->get('listar_faltas_usuario/(:any)','Atendimento::listar_faltas_usuario/$1');
    $routes->get('listar_faltas_profissional/(:any)','Atendimento::listar_faltas_profissional/$1');
    
    $routes->post('cadastrar_atendimento01/(:any)','Atendimento::cadastrarAtendimento01/$1');
    $routes->post('cadastrar_atendimento02/(:any)','Atendimento::cadastraAtendimentoEp02');
    $routes->post('desativar_atendimento','Atendimento::desativarAtendimento');
    
    $routes->get('form_justificar_falta_usuario/(:any)','Atendimento::form_justificar_falta_usuario/$1');
    $routes->get('form_justificar_falta_profissional/(:any)','Atendimento::form_justificar_falta_profissional/$1');
    $routes->get('form_enviar_documento_justificativa/(:any)','Atendimento::form_enviar_documento_justificativa/$1');
    
    
    $routes->post('justificar_falta_usuario','Atendimento::justificarFaltaUsuario');
    $routes->post('justificar_falta_profissional','Atendimento::justificarFaltaProfissional');
    $routes->post('desfaz_registro_atendimento','Atendimento::desfazRegistroAtendimento');
    $routes->post('alterar_documento','Atendimento::alterarDocumento');
    
    $routes->get('listar_atendimento','Atendimento::listar_atendimento');
    $routes->get('confirmar_presenca_usuario_horario/(:any)/(:any)/(:any)/(:any)/(:any)','Atendimento::confirmar_presenca_usuario_horario/$1/$2/$3/$4/$5');
    
    $routes->post('confirma_presenca_usuario_horario','Atendimento::confirmaPresencaUsuarioHorario');
    
    
    $routes->get('listar_atendimento_anterior','Atendimento::listar_atendimento_anterior');
    
    
    //$route['listar_atendimento_anterior'] = $caminho . 'listarAtendimentoAnterior';

    //$route['confirma_presenca_usuario_horario/(:any)/(:any)/(:any)/(:any)/(:any)'] = $caminho . 'confirmaPresencaUsuarioHorario/$1/$2/$3/$4/$5';
    //$route['listar_atendimento'] = $caminho . 'listarAtendimento';
    //$route['confirmar_presenca_usuario_horario/(:any)/(:any)/(:any)/(:any)/(:any)'] = $caminho . 'confirmarPresencaUsuarioHorario/$1/$2/$3/$4/$5';
  
});
$routes->group('/evolucao', ['namespace'=>'App\Controllers','filter'=>'authFilter'], function ($routes) {

    $routes->get('listar_historico_evolucao/(:any)','Evolucao::listar_historico_evolucao/$1');
    $routes->get('form_editar_evolucao/(:any)','Evolucao::form_editar_evolucao/$1');
    $routes->get('form_escrever_evolucao_data_atendimento','Evolucao::form_escrever_evolucao_data_atendimento');
    $routes->get('form_evoluir_atendimento/(:any)','Evolucao::form_evoluir_atendimento/$1');

    $routes->post('editar_evolucao','Evolucao::editarEvolucao');
    $routes->post('evoluir_registro_atendimento','Evolucao::evoluirRegistroAtendimento');

});

$routes->group('/matricula', ['namespace'=>'App\Controllers','filter'=>'authFilter'], function ($routes) {

    $routes->get('form_matricular_usuario/(:any)','Matricula::form_matricular_usuario/$1');
    $routes->post('matricular_usuario','Matricula::matricularUsuario');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
