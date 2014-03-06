<?php
App::uses('AppController', 'Controller');
/**
 * Grades Controller
 *
 * @property Grade $Grade
 * @property PaginatorComponent $Paginator
 */
class GradesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Grade->recursive = 0;
		$this->set('grades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grade->exists($id)) {
			throw new NotFoundException(__('Invalid grade'));
		}
		$options = array('conditions' => array('Grade.' . $this->Grade->primaryKey => $id));
		$this->set('grade', $this->Grade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
		if ($this->request->is('post')) {
                    
                    $checkGrade = $this->Grade->find('count',array('conditions'=>array('student_record_detail_id'=>$this->request->data['Grade']['student_record_detail_id'],'grading_type'=>$this->request->data['Grade']['grading_type']) ));
                    if($checkGrade > 0){
                        $this->Session->setFlash(__('Record Already exist'));
                    }
                    else{
			$this->Grade->create();
                        
                        
                        
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved.'));
				return $this->redirect(array('controller'=>'studentRecordHeaders','action' => 'view',$this->request->data['studentRecordHeaders']['id']));
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
                    }
		}

                if($this->Grade->StudentRecordDetail->exists($id)){
                
                
                    $this->Grade->StudentRecordDetail->Behaviors->load('Containable');
                    $detail = $this->Grade->StudentRecordDetail->find('first',array(
                            'contain'=>array(
                                           
                                                   'StudentRecordHeader'=>array('User','SchoolYear'),
                                                   'Subject',
                                                   
                                                 
                                            
                                      ),
                                    'conditions'=>array('StudentRecordDetail.id'=>$id)
                                )
                            );
                
                
                    
                    $this->set('details',$detail);

                    $studentRecordDetails = $this->Grade->StudentRecordDetail->find('list');

                    $this->set(compact('studentRecordDetails'));
                }
                else{
                    $this->Session->setFlash(__('No Record Found'));
                    return $this->redirect(array('controller'=>'StudentRecordHeaders','action' => 'index'));
                }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            
		if (!$this->Grade->exists($id)) {
			throw new NotFoundException(__('Invalid grade'));
		}
		if ($this->request->is(array('post', 'put'))) {
                      /*$checkGrade = $this->Grade->find('count',array('conditions'=>array('student_record_detail_id'=>$this->request->data['Grade']['student_record_detail_id'],'grading_type'=>$this->request->data['Grade']['grading_type']) ));
                    if($checkGrade > 0){
                        $this->Session->setFlash(__('Record Already exist'));
                    }
                    else{*/
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved.'));
				return $this->redirect(array('controller'=>'StudentRecordHeaders','action' => 'view',$this->request->data['studentRecordHeaders']['id']));
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
                    //}
		} else {
			$options = array('conditions' => array('Grade.' . $this->Grade->primaryKey => $id));
			$this->request->data = $this->Grade->find('first', $options);
		}
                
                $this->Grade->Behaviors->load('Containable');
                $detail = $this->Grade->find('all',array('conditions'=>array('Grade.id'=>$id),
                        'contain'=>array('StudentRecordDetail'=>array('StudentRecordHeader'=>array('User','SchoolYear'),'Subject'))));
                $this->set('details',$detail);
                
                
		$studentRecordDetails = $this->Grade->StudentRecordDetail->find('list');
		$this->set(compact('studentRecordDetails'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$dtlid=null) {
		$this->Grade->id = $id;
		if (!$this->Grade->exists()) {
			throw new NotFoundException(__('Invalid grade'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Grade->delete()) {
			$this->Session->setFlash(__('The grade has been deleted.'));
		} else {
			$this->Session->setFlash(__('The grade could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'StudentRecordHeaders','action' => 'view',$dtlid));
	}}