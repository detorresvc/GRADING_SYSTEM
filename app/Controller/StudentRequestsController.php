<?php
App::uses('AppController', 'Controller');
/**
 * StudentRequests Controller
 *
 * @property StudentRequest $StudentRequest
 * @property PaginatorComponent $Paginator
 */
class StudentRequestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

        
        public function beforeFilter() {
            
            parent::beforeFilter();
            
        }
        
        public function isAuthorized($user) {
            // All registered users can add posts
            if (in_array($this->action,array('add','index','view','edit','delete'))) {
                return true;
            }


            return parent::isAuthorized($user);
        }
        
        function search(){
            
             
            $this->redirect( 
                    array('controller'=>'StudentRequests','action'=>'index',"field"=>$this->request->data['StudentRequest']['field'],"where"=>$this->request->data['StudentRequest']['where'],"value"=>$this->request->data['StudentRequest']['value'] )
            );
        }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->StudentRequest->Behaviors->load('Containable');
                
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
                
                
                $this->StudentRequest->contain(array('StudentRecordHeader'=>array('SchoolYear'),'User'));
                    
		$this->set('studentRequests', $this->Paginator->paginate($conditions));
                
             
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StudentRequest->exists($id)) {
			throw new NotFoundException(__('Invalid student request'));
		}
		$options = array('conditions' => array('StudentRequest.' . $this->StudentRequest->primaryKey => $id));
                
                $this->StudentRequest->Behaviors->load('Containable');
                $this->StudentRequest->contain(array('StudentRecordHeader'=>array('User','SchoolYear')));
                
		$this->set('studentRequest', $this->StudentRequest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
                    
                    $currUser = $this->Auth->user();
                    
                    $this->StudentRequest->StudentRecordHeader->unbindModel(array('hasMany'=>array('StudentRecordDetail')));
                    
                    $headerData = $this->StudentRequest->StudentRecordHeader->find('first',
                            array(
                                'conditions'=>array('StudentRecordHeader.user_id'=>$currUser['id'],
                                                    'StudentRecordHeader.school_year_id'=>$this->request->data['StudentRequest']['school_year_id'],
                                                    'StudentRecordHeader.semester'=>$this->request->data['StudentRequest']['semester'],
                                                    'StudentRecordHeader.status'=>array('H')),
                                'fields'=>array('StudentRecordHeader.id')
                            ));
                      
                    if(sizeof($headerData) == 0){
                        $this->Session->setFlash(__('No record match on your request'));
                    }
                    else{
                      
                        
                        foreach ($headerData['StudentRequest'] as $studentreq){
                            if($studentreq['status'] == 'O'){
                                    $this->Session->setFlash(__('Request already exist'));
                                  return $this->redirect(array('action' => 'index'));
                            }
                            
                            if(strtotime($studentreq['approved_date']) >= strtotime(date('Y-m-d G:i:s',strtotime('-2 Days'))) AND  strtotime($studentreq['approved_date']) <= strtotime(date('Y-m-d G:i:s'))){
                                        $this->Session->setFlash(__('Request already exist'));
                                        return $this->redirect(array('action' => 'index'));
                                }
                            
                        }
                        
                        $this->StudentRequest->create();
                        $this->request->data['StudentRequest']['student_record_header_id'] = $headerData['StudentRecordHeader']['id'];
                        $this->request->data['StudentRequest']['status'] = 'O';
                        $this->request->data['StudentRequest']['user_id'] = $currUser['id'];
			if ($this->StudentRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The student request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student request could not be saved. Please, try again.'));
			}
                    }
                    
			
		}
                
                $this->loadModel('SchoolYear');
                
                $schoolyears = $this->SchoolYear->find('list');
                
                $this->set(compact('schoolyears'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->StudentRequest->exists($id)) {
			throw new NotFoundException(__('Invalid student request'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        
                    $dataSource = $this->StudentRequest->getDataSource();
                        $currUser = $this->Auth->user();
                        if($this->request->data['StudentRequest']['status'] == 'A'){
                            
                            $this->request->data['StudentRequest']['approved_date'] =  date('Y-m-d G:i:s');
                                   
                            $this->request->data['StudentRequest']['approved_by'] = $currUser['id'];
                            
                             $this->StudentRequest->StudentRecordHeader->unbindModel(array('hasMany'=>array('StudentRecordDetail')));
                            
                            //$this->StudentRequest->StudentRecordHeader->updateAll(array('StudentRecordHeader.status'=>"'A'"),array('StudentRecordHeader.id'=>$this->request->data['StudentRequest']['student_record_header_id']));
                            
                        }
                         if($this->request->data['StudentRequest']['status'] == 'O'){
                              $this->request->data['StudentRequest']['reopened_date'] =  date('Y-m-d G:i:s');
                                   
                            $this->request->data['StudentRequest']['reopened_by'] = $currUser['id'];
                            $this->request->data['StudentRequest']['approved_date'] =  '';
                                   
                            $this->request->data['StudentRequest']['approved_by'] = '';
                            
                             $this->StudentRequest->StudentRecordHeader->unbindModel(array('hasMany'=>array('StudentRecordDetail')));
                            
                            //$this->StudentRequest->StudentRecordHeader->updateAll(array('StudentRecordHeader.status'=>"'H'"),array('StudentRecordHeader.id'=>$this->request->data['StudentRequest']['student_record_header_id']));
                         }
                         
			if ($this->StudentRequest->save($this->request->data)) {
                                $dataSource->commit();
				$this->Session->setFlash(__('The student request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
                                $dataSource->rollback();
				$this->Session->setFlash(__('The student request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StudentRequest.' . $this->StudentRequest->primaryKey => $id));
                        
                        $this->StudentRequest->Behaviors->load('Containable');
                        $this->StudentRequest->contain(array('StudentRecordHeader'=>array('User','SchoolYear')));
			$this->request->data = $this->StudentRequest->find('first', $options);
                        
		}
                
              
                
		$studentRecordHeaders = $this->StudentRequest->StudentRecordHeader->find('list');
		$this->set(compact('studentRecordHeaders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->StudentRequest->id = $id;
		if (!$this->StudentRequest->exists()) {
			throw new NotFoundException(__('Invalid student request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StudentRequest->delete()) {
			$this->Session->setFlash(__('The student request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The student request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
