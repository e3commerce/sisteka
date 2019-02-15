<?php

App::uses('AppController', 'Controller');


class PagesController extends AppController {


	public $uses = array('Pedido', 'Produto', 'Catalogoproduto', 'Pagamento', 'Fechamento', 'Despesa', 'Empresa');


	public function acesso_negado() {

		$this->Session->setFlash('<b>Ops!</b> Você não tem acesso a esta página.', 'Flash/erro');

	}



	public function index() {

		$config['Despesa'] =  $this->Despesa;


		$despesas['emAtraso'] = 	$this->Despesa->find('all', array('conditions' => array('Despesa.pago' => 0, 'Despesa.data <' => date('Y-m-d'))));
		$despesas['paraHoje'] = 	$this->Despesa->find('all', array('conditions' => array('Despesa.pago' => 0, 'Despesa.data' => date('Y-m-d'))));
		$despesas['Futuras'] = 		$this->Despesa->find('all', array('conditions' => array('Despesa.pago' => 0, 'Despesa.data >' => date('Y-m-d'), 'Despesa.data <=' => date('Y-m-d', strtotime('+10 days')))));


		$empresas = $this->Empresa->find('list');

		





		$this->set(compact('despesas', 'empresas', 'config'));

	}



	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
