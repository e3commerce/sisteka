<?php
App::uses('AppController', 'Controller');

class DespesasController extends AppController {

	public $components = array('Paginator', 'RequestHandler','Brainme');
	public $uses = array('Despesa', 'Filtro', 'Empresa');


	public function index($ano = 0, $mes = 0) {

		if ($ano == 0) {$ano = date('Y');}
		if ($mes == 0) {$mes = date('m');}

		$tFiltros = $this->Filtro->findByUser_id($this->Auth->user()['id']);
		$this->set(compact('tFiltros'));

		$config = $this->Despesa;

		$this->Despesa->recursive = 1;
		$despesas =  $this->paginate('Despesa',array());;
		$this->set(compact('despesas'));

		$pageCount = $this->params['paging']['Despesa']['pageCount'];
		$this->set(compact('pageCount'));

		$empresas = $this->Empresa->find('list');

		// pr(); exit;

		// pr('CAIO'); exit;

		$this->set(compact('empresas', 'config', 'ano', 'mes'));

		// pr($empresas); exit;


	}



	
	

	public function add() {

		if ($this->request->is('post')) {

			

			$this->Despesa->create();

			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Despesa']['nome'].' cadastrada com sucesso!', 'Flash/sucesso');
				
			} else {
				$this->Session->setFlash('<b>Ops!</b> Despesa não foi cadastrada.', 'Flash/erro');
			}
		}
		
		return $this->redirect(array('action' => 'index'));
	}


	

	public function edit($id = null) {

		if ($this->request->is(array('post', 'put'))) {


			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Despesa']['nome'].' editada com sucesso!', 'Flash/sucesso');
			} else {
				$this->Session->setFlash('<b>Ops!</b> Despesa não foi editada.', 'Flash/erro');
			}

			return $this->redirect(array('action' => 'index'));
		}
	}


	public function delete($id = null) {
		$this->Pedido->id = $id;
		if (!$this->Pedido->exists()) {
			throw new NotFoundException(__('Invalid pedido'));
		}



		$this->request->onlyAllow('post', 'delete');
		if ($this->Pedido->delete()) {
			$this->Session->setFlash('Deletado com sucesso.', 'admin/flash_sucesso');
		} else {
			$this->Session->setFlash('Não foi deletado. Por favor, tente novamente', 'admin/flash_erro');
		}
		return $this->redirect(array('action' => 'index'));

	}}
