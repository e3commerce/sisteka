<?php
App::uses('AppModel', 'Model');

class Catalogoproduto extends AppModel {

public $useDbConfig = 'centralLocal';
	

			public $displayField = 'nome';
				

						
	public $belongsTo = array(
		'Fornecedor' => array(
			'className' => 'Fornecedor',
			'foreignKey' => 'fornecedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fornecedorcatalogo' => array(
			'className' => 'Fornecedorcatalogo',
			'foreignKey' => 'fornecedorcatalogo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function beforeSave($options = array()) {

		if (isset($this->data['Catalogoproduto']['nome'])) {
			$this->data[$this->alias]['slug'] = $this->_generateSlug('nome'); return parent::beforeSave($options); // DESCOMENTE PARA SLUG
		}
		
	}

	protected function _findCountBySlug($slug) {
		return $this->find('count', array('conditions' => array("{$this->alias}.slug" => $slug, "{$this->alias}.id !=" => $this->id)));
	}
	protected function _generateSlug($coluna) {
		$titulo = $this->data[$this->alias][$coluna];
		$slug = strtolower(substr($titulo, 0, 1));
		$baseSlug = $slug;
		
			return $slug;
	}

}
