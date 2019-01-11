<?php

App::uses('AppController', 'Controller');


class FiltrosController extends AppController {

	public function alterar($dados){

		if ($this->request->is('post')) {

			pr($dados);
			pr(urldecode($dados));

			$jader = urldecode($dados);

			pr($jader);

			pr($this->request->data); exit;

		}

		$tFiltros = $this->Filtro->findByUser_id($this->Auth->user()['id'])['Filtro'];

		pr('altera filtros');

		pr($dados); exit;
	}

}
