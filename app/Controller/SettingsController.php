<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController {

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
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                        if($this->Setting->find('count') > 0){
                            $this->Session->setFlash(__('The setting could not be saved. one setting is allowed'));
                        }
                        else{
                            $this->Setting->create();
                            if ($this->Setting->save($this->request->data)) {
                                    $this->Session->setFlash(__('The setting has been saved.'));
                                    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
                            }
                        }
		}
                
                 $schoolYears = $this->Setting->SchoolYear->find('list');
                        $this->set(compact('schoolYears'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
		
                        $dataSourse = $this->Setting->getDataSource();
                        $dataSourse->begin();
                        
                        $this->loadModel('User'); 
                        
                        $this->User->updateAll(array('User.status'=>"'H'"),array('User.status'=>'C'));
                        /*
			$this->loadModel('StudentRecordHeader'); 
			$this->StudentRecordHeader->unbindModel(
				array('hasMany' => array('StudentRecordDetail'),'belongsTo'=>array('User','Course'))
			);
			
			$this->StudentRecordHeader->updateAll(array('status'=>"'H'"),array('status'=>'C','school_year_id'=>$this->request->data['Setting']['old_school_year_id'],'semester'=>$this->request->data['Setting']['old_semester']));
		*/
                       
                     
			if ($this->Setting->save($this->request->data)) {
                            $dataSourse->commit();
				$this->Session->setFlash(__('The setting has been saved.'));
                                 $settings = $this->Setting->find('first');
                     
                                    $this->Session->write($settings);
				return $this->redirect(array('action' => 'index'));
			} else {
                            $dataSourse->rollback();
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
                        
                         $schoolYears = $this->Setting->SchoolYear->find('list');
                        $this->set(compact('schoolYears'));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('The setting has been deleted.'));
		} else {
			$this->Session->setFlash(__('The setting could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}