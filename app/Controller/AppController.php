<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'main', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'Access Denied!!!',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'student_no')
                 ),   
             ),
             'authorize' => array('Controller')
        )
    );
    
     public function beforeFilter() {
         $this->Auth->authorize = 'Controller';
        // $this->Auth->allow('index', 'view','edit');
         

         if($this->request->params['action'] == 'login' && $this->request->is('post')){
             if(!is_numeric($this->request->data['User']['username'])){                
                $this->Auth->authenticate['Form']['fields']['username'] = 'username';  
             }
             else{
             	$this->Auth->authenticate['Form']['scope']['User.status'] = 'C'; 
             }
             $this->request->data['User']['student_no'] = $this->request->data['User']['username'];
             
         }
         
         
         
         $currUser = $this->Auth->user();
         
         $this->set('currUser',$currUser);
         
         
         $setting = $this->__getSettings();
         $this->set('setting',$setting);
         
         if($this->Auth->user('role') == 'Admin'){
             $this->loadModel('StudentRequest');
             $pendingRequest  = $this->StudentRequest->find('count',array('conditions'=>array('StudentRequest.status'=>'O')));
             $this->set('pendingRequest',$pendingRequest);
         }
         
    }
    
    public function isAuthorized($user) {
        
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'Admin') {
            return true;
        }

        // Default deny
        return false;
    }
    
    public function __getSettings(){
        $this->loadModel('Setting'); 
        
        $settings = $this->Setting->find('first');
        return $settings;
        
    }
    
    function __addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
          switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
          }
        }
        return $num.'th';
      }
      
      
       function viewuserimage(){
            
            $this->layout = 'image';
            $currUser = $this->Auth->user();
                       
            header('Content-type: '. $currUser['image_type']);
            echo $currUser['image'];
            exit();

        }
    
     
}