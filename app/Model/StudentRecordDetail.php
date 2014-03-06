<?php
App::uses('AppModel', 'Model');
/**
 * StudentRecordDetail Model
 *
 * @property StudentRecordHeader $StudentRecordHeader
 * @property Subject $Subject
 */
class StudentRecordDetail extends AppModel {


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
			'order' => ''
		),
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $hasMany = array('Grade'=>array('dependent' => true,'order'=>'Grade.grading_type'));
}
