<?php
App::uses('AppModel', 'Model');

class Empresa extends AppModel {

	public $order = 'Empresa.nome asc';

	public $displayField = 'nome';

	public $validate = array(
		'nome' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
	);

}