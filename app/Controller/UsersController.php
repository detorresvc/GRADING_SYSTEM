<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/** 	
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');

/**
 * index method
 *
 * @return void
 */
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('logout');
        }
        
        
        function add_user(){
		 $iamgeErr = '';
		if ($this->request->is('post')) {
			$this->User->create();
                        
                       if(in_array(strtolower($this->request->data['User']['image']['type']),array('image/jpg','image/gif','image/png')) ){ 
                        
                        if($this->request->data['User']['image']["error"] != UPLOAD_ERR_FORM_SIZE){
                       
                      if($this->request->data['User']['image']["error"] == UPLOAD_ERR_OK){
                       
                        if(isset($this->request->data['User']['image']) && $this->request->data['User']['image']['size'] > 0){
                            
                            $tmpName = $this->request->data['User']['image']['tmp_name'];
                            $fp = fopen($tmpName, 'rb');
                            $data = fread($fp, filesize($tmpName));
                            
                            fclose($fp);
                            $this->request->data['User']['image_type'] = $this->request->data['User']['image']['type'];
                            $this->request->data['User']['image'] = $data;
                            
                        }
                        else{
                            unset($this->request->data['User']['image']);
                            $iamgeErr = 'but no image uploaded';
                        }
                      }
                      else{
                          unset($this->request->data['User']['image']);
                          $iamgeErr = 'but image upload error';
                      }
                    }
                    else{
                        unset($this->request->data['User']['image']);
                        $iamgeErr = 'but The uploaded file exceeds the MAX_FILE_SIZE';
                    }
                       }else{
                           unset($this->request->data['User']['image']);
                        $iamgeErr = 'but Invalid image type';
                       }
                        
                        
                        $this->request->data['User']['school_year_id'] = $this->Session->write('SchoolYear.id');
                        
                 
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved. '.$iamgeErr));
				return $this->redirect(array('action' => 'userlist'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		}
        
        function search(){
             $referer = explode("/",$this->referer('action'));
             
             $action = ($referer[5] == 'userlist') ? 'userlist' : 'index';
             
            $this->redirect( 
                    array('controller'=>'users','action'=>$action,"field"=>$this->request->data['User']['field'],"where"=>$this->request->data['User']['where'],"value"=>$this->request->data['User']['value'] )
            );
        }
    
	public function index() {
            
		$this->User->recursive = 0;
                
                $conditions = array('User.role'=>'Student');
                if(isset($this->request->params['named']['field']) AND $this->request->params['named']['value'] != ''){

                        switch($this->request->params['named']['where']){
                            case 'lk' :
                                $wildcard = "%";
                                $cond = 'LIKE';
                            break;
                            case 'eq' :
                                $wildcard = "";
                                $cond = '=';
                            break;
                        }

                      $conditions[$this->request->params['named']['field']." ".$cond] = $this->request->params['named']['value'].$wildcard;  
                }
                
                
		$this->set('users', $this->Paginator->paginate($conditions));
	}

        
        
        function userlist(){
            $this->User->recursive = 0;
             $conditions = array();
                if(isset($this->request->params['named']['field']) AND $this->request->params['named']['value'] != ''){

                        switch($this->request->params['named']['where']){
                            case 'lk' :
                                $wildcard = "%";
                                $cond = 'LIKE';
                            break;
                            case 'eq' :
                                $wildcard = "";
                                $cond = '=';
                            break;
                        }

                      $conditions[$this->request->params['named']['field']." ".$cond] = $this->request->params['named']['value'].$wildcard;  
                }
		$this->set('users', $this->Paginator->paginate($conditions));
                 $this->set('_serialize', array('users'));
        }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
        
        

/**
 * add method
 *
 * @return void
 */
	public function add() {
	
            $iamgeErr = '';
		if ($this->request->is('post')) {
			$this->User->create();
                        
                       if(in_array(strtolower($this->request->data['User']['image']['type']),array('image/jpg','image/gif','image/png')) ){ 
                        
                        if($this->request->data['User']['image']["error"] != UPLOAD_ERR_FORM_SIZE){
                       
                      if($this->request->data['User']['image']["error"] == UPLOAD_ERR_OK){
                       
                        if(isset($this->request->data['User']['image']) && $this->request->data['User']['image']['size'] > 0){
                            
                            $tmpName = $this->request->data['User']['image']['tmp_name'];
                            $fp = fopen($tmpName, 'rb');
                            $data = fread($fp, filesize($tmpName));
                            
                            fclose($fp);
                            $this->request->data['User']['image_type'] = $this->request->data['User']['image']['type'];
                            $this->request->data['User']['image'] = $data;
                            
                        }
                        else{
                            unset($this->request->data['User']['image']);
                            $iamgeErr = 'but no image uploaded';
                        }
                      }
                      else{
                          unset($this->request->data['User']['image']);
                          $iamgeErr = 'but image upload error';
                      }
                    }
                    else{
                        unset($this->request->data['User']['image']);
                        $iamgeErr = 'but The uploaded file exceeds the MAX_FILE_SIZE';
                    }
                       }else{
                           unset($this->request->data['User']['image']);
                        $iamgeErr = 'but Invalid image type';
                       }
                        
                        
                        $this->request->data['User']['school_year_id'] = $this->Session->read('Setting.school_year_id');
                        $this->request->data['User']['status'] = 'C';
                      
                        
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved. '.$iamgeErr));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
                
                 $schoolYears = $this->User->SchoolYear->find('list');
		$this->set(compact('schoolYears'));
                
		$courses = $this->User->Course->find('list');
		$this->set(compact('courses'));
	}
	
	function edit_user($id=null	){
			if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
                  $iamgeErr = '';
		if ($this->request->is(array('post', 'put'))) {
                  if(in_array(strtolower($this->request->data['User']['image']['type']),array('image/jpg','image/gif','image/png')) ){ 
                    if($this->request->data['User']['image']["error"] != UPLOAD_ERR_FORM_SIZE){
                       
                      if($this->request->data['User']['image']["error"] == UPLOAD_ERR_OK){
                       
                        if(isset($this->request->data['User']['image']) && $this->request->data['User']['image']['size'] > 0){
                            
                            $tmpName = $this->request->data['User']['image']['tmp_name'];
                            $fp = fopen($tmpName, 'rb');
                            $data = fread($fp, filesize($tmpName));
                            
                            fclose($fp);
                            $this->request->data['User']['image_type'] = $this->request->data['User']['image']['type'];
                            $this->request->data['User']['image'] = $data;
                            
                        }
                        else{
                            unset($this->request->data['User']['image']);
                            $iamgeErr = 'but no image uploaded';
                        }
                      }
                      else{
                          unset($this->request->data['User']['image']);
                          $iamgeErr = 'but image upload error';
                      }
                    }
                    else{
                        unset($this->request->data['User']['image']);
                        $iamgeErr = 'but The uploaded file exceeds the MAX_FILE_SIZE';
                    }
                  }else{
                           unset($this->request->data['User']['image']);
                        $iamgeErr = 'but Invalid image type';
                       }

                   
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved. '.$iamgeErr));
				return $this->redirect(array('action' => 'userlist'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
                
                $schoolYears = $this->User->SchoolYear->find('list');
		$this->set(compact('schoolYears'));
                
		$courses = $this->User->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
                  $iamgeErr = '';
		if ($this->request->is(array('post', 'put'))) {
                  if(in_array(strtolower($this->request->data['User']['image']['type']),array('image/jpg','image/gif','image/png')) ){ 
                    if($this->request->data['User']['image']["error"] != UPLOAD_ERR_FORM_SIZE){
                       
                      if($this->request->data['User']['image']["error"] == UPLOAD_ERR_OK){
                       
                        if(isset($this->request->data['User']['image']) && $this->request->data['User']['image']['size'] > 0){
                            
                            $tmpName = $this->request->data['User']['image']['tmp_name'];
                            $fp = fopen($tmpName, 'rb');
                            $data = fread($fp, filesize($tmpName));
                            
                            fclose($fp);
                            $this->request->data['User']['image_type'] = $this->request->data['User']['image']['type'];
                            $this->request->data['User']['image'] = $data;
                            
                        }
                        else{
                            unset($this->request->data['User']['image']);
                            $iamgeErr = 'but no image uploaded';
                        }
                      }
                      else{
                          unset($this->request->data['User']['image']);
                          $iamgeErr = 'but image upload error';
                      }
                    }
                    else{
                        unset($this->request->data['User']['image']);
                        $iamgeErr = 'but The uploaded file exceeds the MAX_FILE_SIZE';
                    }
                  }else{
                           unset($this->request->data['User']['image']);
                        $iamgeErr = 'but Invalid image type';
                       }

                   
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved. '.$iamgeErr));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
                
                $schoolYears = $this->User->SchoolYear->find('list');
		$this->set(compact('schoolYears'));
                
		$courses = $this->User->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function delete_user($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'userlist'));
	}
        
        function login(){
             
            if($this->request->is('post')){
                 if ($this->Auth->login()) {
                     $this->Session->write('Auth.timeout', strtotime('+3 days'));
                     
                     $this->loadModel('Setting');
                     
                     $settings = $this->Setting->find('first');
                     
                     $this->Session->write($settings);
                     
                    $this->redirect(array('controller'=>'main','action'=>'index'));
                } else {
                    $this->Session->setFlash(__('Invalid username or password, try again'));
                }
            }
            
            if($this->Auth->user()){
                $this->redirect(array('controller'=>'mains','action'=>'index'));
                }
            
            
        }
        
        public function logout() {
            $this->Session->destroy();
            $this->redirect($this->Auth->logout());
        }
        
       
}