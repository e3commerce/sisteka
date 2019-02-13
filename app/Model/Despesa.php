<?php
App::uses('AppModel', 'Model');

class Despesa extends AppModel {

	public $order = 'Despesa.data asc';

	public $displayField = 'Despesa.nome';

	public $tipos = array(
		1 => 'Fixos',
		2 => 'Pontuais',
		3 => 'Fornecedores',
	);

	public $formas = array(
		1 => 'Dinheiro a vista',
		2 => 'Tranferência Bancária',
		3 => 'Cartão de Débito',
		4 => 'Cartão de Crédito',
		5 => 'Cheque Próprio',
		6 => 'Repasse de Cheque',
	);

	public $validate = array(
		'nome' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
		'valor' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
		'empresa_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
		'formapagamento_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
		'despesatipo_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo não pode ser vazio',
			),
		),
		'data' => array(
			'rule' => 'date',
			'message' => 'Este campo não pode ser vazio',
		)
	);

}