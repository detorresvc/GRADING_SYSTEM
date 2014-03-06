<?php
App::uses('AppModel', 'Model');
/**
 * StudentRequest Model
 *
 * @property StudentRecordHeader $StudentRecordHeader
 */
class StudentRequest extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'StudentRecordHeader' => array(
			'className' => 'StudentRecordHeader',
			'foreignKey' => 'student_record_header_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                    'type' =>'inner'
		),
            'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                        'type' =>'inner'
		)
	);
}
