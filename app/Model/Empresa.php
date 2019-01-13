<?php
App::uses('AppModel', 'Model');

class Empresa extends AppModel {

	public $order = 'Empresa.nome asc';

	public $displayField = 'Empresa.nome';

	public $validate = array(
		'nome' => array(
			'notBlank' => array(
				'rule' => array('notEmpty'),
				'message' => 'Nome não pode ser vazio',
			),
		),
	);

}