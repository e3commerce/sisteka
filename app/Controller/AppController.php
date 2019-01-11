<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {

    public $uses = array('Filtro');

    public $components = array(
        'Flash',
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            )
        );


        

    function beforeFilter() {
        // $this->Auth->allow('index', 'view');

    }

    public function beforeRender()
    {
        $userData = $this->Auth->user();
        $this->set(compact('userData'));

         // pr($userData); 
         // pr($filtros); 
         // exit;
    }

}