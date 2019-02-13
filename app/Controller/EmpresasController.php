<?php
App::uses('AppController', 'Controller');

class EmpresasController extends AppController {

	public $components = array('Paginator', 'RequestHandler', 'Brainme');
	public $uses = array('Empresa', 'Filtro', 'Despesa');


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
		$this->render = false;
		if ($this->request->is(array('post', 'put'))) {
			$verificaDespesas = $this->Despesa->find('all', array('conditions' => array('Despesa.empresa_id' => $id)));
			if (count($verificaDespesas) == 0) {
				$this->Empresa->id = $id;
				$this->Empresa->delete();
				echo '
				<div class="alert alert-success" role="alert">
                  Empresa Deletada! <b>Atualize a página.</b>
                </div>
                ';
			}else{
				echo "<h4>Ops! Não pode ser deletado</h4>Despesas:<br>";
				echo "<table class='table' style='width:100%;'>";
				foreach ($verificaDespesas as $key => $value) {
				echo "<tr>";
				echo "<td>".$value['Despesa']['data']."</td>";
				echo "<td>".$value['Despesa']['nome']."</td>";
				echo "</tr>";
				}
				echo "</table>";
			}
		}
		exit;
	}

}
