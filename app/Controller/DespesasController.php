<?php
App::uses('AppController', 'Controller');

class DespesasController extends AppController {

	public $components = array('Paginator', 'RequestHandler','Brainme');
	public $uses = array('Despesa', 'Filtro', 'Empresa');


	public function index($ano = 0, $mes = 0) {

		if ($ano == 0) {$ano = date('Y');}
		if ($mes == 0) {$mes = round(date('m'));}

		$tFiltros = $this->Filtro->findByUser_id($this->Auth->user()['id']);
		$this->set(compact('tFiltros'));

		$config = $this->Despesa;

		$dados = array();

		foreach ($config->tipos as $key => $value) {
			$dados['lista'][$key] = $this->Despesa->find('all', array('conditions' => array('Despesa.despesatipo_id' => $key, 'Despesa.data >=' => $ano.'-'.$mes.'-01', 'Despesa.data <=' => $ano.'-'.$mes.'-31')));
		}


		$this->Despesa->recursive = -1;
		// $despesas = $this->Despesa->find('all', array('conditions' => array('Despesa.data >=' => $ano.'-'.$mes.'-01', 'Despesa.data <=' => $ano.'-'.$mes.'-31')));
		// $this->set(compact('despesas'));


		$empresas = $this->Empresa->find('list');

		

		$links = array(
     1 =>      array('Janeiro',    '2019', 'nav-link'),
     2 =>      array('Fevereiro',  '2019', 'nav-link'),
     3 =>      array('Março',      '2019', 'nav-link'),
     4 =>      array('Abril',      '2019', 'nav-link'),
     5 =>      array('Maio',       '2019', 'nav-link'),
     6 =>      array('Junho',      '2019', 'nav-link'),
     7 =>      array('Julho',      '2019', 'nav-link'),
     8 =>      array('Agosto',     '2019', 'nav-link'),
     9 =>      array('Setembro',   '2019', 'nav-link'),
     10 =>     array('Outubro',    '2019', 'nav-link'),
     11 =>     array('Novembro',   '2019', 'nav-link'),
     12 =>     array('Dezembro',   '2019', 'nav-link'),
);

foreach ($links as $kLinks => $vLinks) {
     if (($ano == $vLinks[1]) AND $mes == $kLinks) {
          $links[$kLinks][2] = 'nav-link active';
     }
}



	

		// pr($dados); exit;

		$resumo = array();
$resumo['tudo'] = 0;
$resumo['tudo_pago'] = 0;


foreach ($dados['lista'] as $kDados => $vDados){
	$resumo['tipos'][$kDados] = 0;
}

foreach ($dados['lista'] as $kDados => $vDados){

	foreach ($vDados as $key => $value) {
		$resumo['tipos'][$kDados] += $value['Despesa']['valor'];
		$resumo['tudo'] += $value['Despesa']['valor'];
		if ($value['Despesa']['pago'] == 1) {
			$resumo['tudo_pago'] += $value['Despesa']['valor'];
		}
	}
}

	$this->set(compact('despesas', 'empresas', 'config', 'ano', 'mes', 'dados', 'links', 'resumo'));

// pr($resumo); exit;



	}



	
	

	public function add() {

		if ($this->request->is('post')) {

			// pr($this->request->data['Despesa']['data']['month']); exit;

			$this->Despesa->create();

			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Despesa']['nome'].' cadastrada com sucesso!', 'Flash/sucesso');
				
			} else {
				$this->Session->setFlash('<b>Ops!</b> Despesa não foi cadastrada.', 'Flash/erro');
			}
		}
		
		return $this->redirect(array('action' => 'index', $this->request->data['Despesa']['data']['year'], round($this->request->data['Despesa']['data']['month'])));
	}


	

	public function edit($id = null) {

		if ($this->request->is(array('post', 'put'))) {



			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['Despesa']['nome'].' editada com sucesso!', 'Flash/sucesso');
			} else {
				$this->Session->setFlash('<b>Ops!</b> Despesa não foi editada.', 'Flash/erro');
			}

			return $this->redirect(array('action' => 'index', $this->request->data['Despesa']['data']['year'], round($this->request->data['Despesa']['data']['month'])));
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
