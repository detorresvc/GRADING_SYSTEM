<?php
App::uses('AppModel', 'Model');


/**
 * User Model
 *
 * @property Course $Course
 */
class StudentRecordHeader extends AppModel {
    
    public $hasMany = array(
        'StudentRecordDetail'=>
                                array(
                                    'className' => 'StudentRecordDetail',
                                    'foreignKey' => 'student_record_header_id',
                                    'order' => 'StudentRecordDetail.created ASC',
                                    'dependent' => true
                                )
        ,'StudentRequest'=>
                                array(
                                    'className' => 'StudentRequest',
                                    'foreignKey' => 'student_record_header_id',
                                    'order' => 'StudentRequest.created ASC',
                                    'dependent' => true
                                ));
    
    public $belongsTo = array('User' =>
                                      array(
                                            'className' => 'User',
                                            'foreignKey' => 'user_id',
                                            'type' => 'inner'
                                      )
                            ,'SchoolYear'=>
                                    array(
                                            'className' => 'SchoolYear',
                                            'foreignKey' => 'school_year_id',
                                            'type' => 'inner'
                                      ));
    
    
    
       
}


?>