<?php
App::uses('AppModel', 'Model');
/**
 * SchoolYear Model
 *
 * @property Setting $Setting
 * @property StudentRecordHeader $StudentRecordHeader
 */
class SchoolYear extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'school_year';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'school_year' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                     'validSchoolYear' => array(
				'rule' => '/^[0-9]{4}\-[0-9]{4}$/',
				'message' => 'Pleas input a valid school year sample 2001-2002',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                       'mustNextShoolYear' => array(
				'rule' => 'nextSchoolYear',
				'message' => 'Pleas input a valid school year sample 2001-2002',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);




	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Setting' => array(
			'className' => 'Setting',
			'foreignKey' => 'school_year_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'StudentRecordHeader' => array(
			'className' => 'StudentRecordHeader',
			'foreignKey' => 'school_year_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

      public function nextSchoolYear($check){

         

          
          $currSY =  $this->find('first',array('order'=>array('id'=>'desc')));
          

          $currSY = explode('-',$currSY['school_year']);
          $tmpCheck = explode('-',$check);


          if(((int)$currSY[1] = $tmpCheck[0]) && ((int)$tmpCheck[1] == ((int)$currSY[1]+1) ) ){
             return true;
          }
          return false;


      } 

}
