<?php
App::uses('AppController', 'Controller');

class EmpresasController extends AppController {

	public $components = array('Paginator', 'RequestHandler','Brainme');
	public $uses = array('Empresa', 'Filtro');


	public function index($filtro = null) {

		$tFiltros = $this->Filtro->findByUser_id($this->Auth->user()['id']);
		$this->set(compact('tFiltros'));

		$this->Empresa->recursive = 1;
		$empresas =  $this->paginate('Empresa',array());;
		$this->set(compact('empresas'));

		$pageCount = $this->params['paging']['Empresa']['pageCount'];
		$this->set(compact('pageCount','filtro'));


	}



	
	

	public function add() {
		if ($this->request->is('post')) {


			$this->Empresa->create();

			if ($this->Empresa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Empresa']['nome'].' cadastrada com sucesso!', 'Flash/sucesso');
				
			} else {
				$this->Session->setFlash('<b>Ops!</b> Empresa não foi cadastrada.', 'Flash/erro');
			}
		}
		
		return $this->redirect(array('action' => 'index'));
	}
	

	public function edit($id = null) {

		if ($this->request->is(array('post', 'put'))) {


			if ($this->Empresa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Empresa']['nome'].' editada com sucesso!', 'Flash/sucesso');
			} else {
				$this->Session->setFlash('<b>Ops!</b> Empresa não foi editada.', 'Flash/erro');
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
