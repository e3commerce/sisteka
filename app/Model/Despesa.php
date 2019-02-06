<?php
App::uses('AppModel', 'Model');

class Despesa extends AppModel {

	public $order = 'Despesa.data asc';

	public $displayField = 'Despesa.nome';

	public $tipos = array(
		'Fixos',
		'Pagamentos',
	);

	public $formas = array(
		'Dinheiro a vista',
		'Tranferência Bancária',
		'Cartão de Débito',
		'Cartão de Crédito',
		'Cheque',
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