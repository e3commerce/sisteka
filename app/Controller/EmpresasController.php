<?php
App::uses('AppController', 'Controller');

class EmpresasController extends AppController {

	public $components = array('Paginator', 'RequestHandler','Brainme');
	public $uses = array('Empresa', 'Filtro');

	

	








	public function index($filtro = null) {


		$tFiltros = $this->Filtro->findByUser_id($this->Auth->user()['id']);

		$this->set(compact('tFiltros'));




		// $filtro = (empty($filtro)) ? 'todos' : $filtro ;
		// $condicoes['todos'] 	= array('Pedido.fornecedor_id'=>$this->Auth->user('fornecedor_id'));
		// $condicoes['nfaturado'] = array('Pedido.fornecedor_id'=>$this->Auth->user('fornecedor_id'),'Pedido.faturado !=' => 1,'Pedido.status' => 3);
		// $condicoes['faturado']  = array('Pedido.fornecedor_id'=>$this->Auth->user('fornecedor_id'),'Pedido.faturado' => 1);
		// $condicoes['ncoletado'] = array('Pedido.fornecedor_id'=>$this->Auth->user('fornecedor_id'),'Pedido.faturado !=' => 1,'Pedido.status !=' => 3);

		$this->Empresa->recursive = 1;
		$empresas =  $this->paginate('Empresa',array());;
		$this->set(compact('empresas'));

		// pr($pedido); exit;

		$pageCount = $this->params['paging']['Empresa']['pageCount'];
		$this->set(compact('pageCount','filtro'));

	}



	public function view($token = null) {

		

		$pedido_busca = $this->Pedido->findByToken($token);

		if (!empty($pedido_busca)) {

			$id = $pedido_busca['Pedido']['id'];
		}else{
			$this->Session->setFlash('Houve um problema. Por favor, nos avise: (16) 3341-7884', 'admin/flash_sucesso');
			return $this->redirect(array('action' => 'index'));
		}

		$this->Pedido->recursive = 1;
		$pedido = $this->Pedido->findById($id);


		$view['Pedido']['id'] = $id;
		$view['Pedido']['view'] = $pedido['Pedido']['view']+1;

		$this->Pedido->save($view);


		

		$produtos_pedido = $this->Produto->find('all', array('conditions' => array('Produto.pedido_id' => $id), 'fields'=>array('DISTINCT Produto.sku','Produto.texto_personalizado')));

		$produtos_agrupados = array();
		$total_pedido = 0;
		$total_ja_recebido = 0;

		foreach ($produtos_pedido as $produtos_pedido)
		{
			$produto = $this->Produto->findBySku($produtos_pedido['Produto']['sku']);
			
			$produto_count = $this->Produto->find('count', array('conditions' => array('Produto.sku' => $produtos_pedido['Produto']['sku'], 'Produto.texto_personalizado' => $produtos_pedido['Produto']['texto_personalizado'], 'Produto.pedido_id' => $id)));
			$produto_count_recebidos = $this->Produto->find('count', array('conditions' => array('Produto.sku' => $produtos_pedido['Produto']['sku'], 'Produto.texto_personalizado' => $produtos_pedido['Produto']['texto_personalizado'], 'Produto.pedido_id' => $id, 'Produto.status' => 3)));
			$total_ja_recebido = $total_ja_recebido + $produto_count_recebidos;

			$percentual = $pedido['Fornecedor']['porcentagem_desconto'] / 100.0; // 15%
  			$produto['Produto']['custo_desconto'] = $produto['Produto']['custo'] - ($percentual * $produto['Produto']['custo']);

			$produto['Produto']['quantidade_agrupada'] = $produto_count;
			$produto['Produto']['quantidade_agrupada_recebidos'] = $produto_count_recebidos;
			$produto['Produto']['total'] = $produto['Produto']['quantidade_agrupada']*$produto['Produto']['custo_desconto'];
			$produto['Produto']['total_geral'] = $produto['Produto']['quantidade_agrupada']*$produto['Produto']['custo'];
			
			if(!empty($produtos_pedido['Produto']['texto_personalizado']))
			{
				$produto['Produto']['texto_personalizado'] = $produtos_pedido['Produto']['texto_personalizado'];
			}
			
			array_push($produtos_agrupados, $produto);
			$total_pedido = $total_pedido+$produto['Produto']['total_geral'];
			// pr($produtos_agrupados); exit;
		}

			// pr($produtos_pedido); exit;





		

		$pedido['Pedido']['total_ja_recebido'] = $total_ja_recebido;


		$this->set(compact('pedido', 'produtos_agrupados', 'total_pedido'));
	}
	

	public function add() {
		if ($this->request->is('post')) {
		$this->Pedido->create();

		//$this->request->data['Pedido']['imagem'] = $this->Upload->imagem($this->request->data['Pedido']['imagem'], 'img/uploads/', 500, 'height_auto', 'thumb_sim', 'img/uploads/01_thumbs/', 100, 100, 'Pedido'); 
//$this->request->data['Pedido']['arquivo'] = $this->Upload->arquivo($this->request->data['Pedido']['arquivo'], 'files/uploads/', 'Pedido');

		if ($this->Pedido->save($this->request->data)) {
				$this->Session->setFlash('Salvo com sucesso.', 'admin/flash_sucesso');
		return $this->redirect(array('action' => 'index'));
		} else {
		$this->Session->setFlash('Não foi salvo. Por favor, tente novamente', 'admin/flash_erro');
				}
	}
		$fornecedores = $this->Pedido->Fornecedor->find('list');
		$this->set(compact('fornecedores'));
	}
	

	public function edit($id = null) {

if ($this->request->is(array('post', 'put'))) {



pr($this->request->data); exit;

if ($this->Pedido->save($this->request->data)) {
	$this->Session->setFlash('Editado com sucesso', 'admin/flash_sucesso');
	return $this->redirect(array('action' => 'index'));
} else {
$this->Session->setFlash('Não foi editado. Por favor, tente novamente', 'admin/flash_erro');
}
} else {
$options = array('conditions' => array('Pedido.' . $this->Pedido->primaryKey => $id));
$this->request->data = $this->Pedido->find('first', $options);
}
		$fornecedores = $this->Pedido->Fornecedor->find('list');
		$this->set(compact('fornecedores'));
	}


	public function delete($id = null) {
	$this->Pedido->id = $id;
	if (!$this->Pedido->exists()) {
	throw new NotFoundException(__('Invalid pedido'));
}

/*
$imagem = $this->Pedido->findById($id);
$this->Upload->deletar_imagem('img/uploads/'.$imagem['Pedido']['imagem']);
$this->Upload->deletar_imagem('img/uploads/01_thumbs/'.$imagem['Pedido']['imagem']);

$arquivo = $this->Pedido->findById($id);
$this->Upload->deletar_arquivo('files/uploads/'.$arquivo['Pedido']['arquivo']);
*/

$this->request->onlyAllow('post', 'delete');
if ($this->Pedido->delete()) {
	$this->Session->setFlash('Deletado com sucesso.', 'admin/flash_sucesso');
} else {
$this->Session->setFlash('Não foi deletado. Por favor, tente novamente', 'admin/flash_erro');
}
return $this->redirect(array('action' => 'index'));

}}
