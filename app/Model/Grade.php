<?php
App::uses('AppModel', 'Model');
/**
 * Grade Model
 *
 * @property StudentRecordDetail $StudentRecordDetail
 */
class Grade extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'student_record_detail_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'grading_type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)           
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'StudentRecordDetail' => array(
			'className' => 'StudentRecordDetail',
			'foreignKey' => 'student_record_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
