<?php
App::uses('AppController', 'Controller');
/**
 * SchoolYears Controller
 *
 * @property SchoolYear $SchoolYear
 * @property PaginatorComponent $Paginator
 */
class SchoolYearsController extends AppController {

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
		$this->SchoolYear->recursive = 0;
		$this->set('schoolYears', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SchoolYear->exists($id)) {
			throw new NotFoundException(__('Invalid school year'));
		}
		$options = array('conditions' => array('SchoolYear.' . $this->SchoolYear->primaryKey => $id));
		$this->set('schoolYear', $this->SchoolYear->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SchoolYear->create();
			if ($this->SchoolYear->save($this->request->data)) {
				$this->Session->setFlash(__('The school year has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school year could not be saved. Please, try again.'));
			}
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
		if (!$this->SchoolYear->exists($id)) {
			throw new NotFoundException(__('Invalid school year'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SchoolYear->save($this->request->data)) {
				$this->Session->setFlash(__('The school year has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school year could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SchoolYear.' . $this->SchoolYear->primaryKey => $id));
			$this->request->data = $this->SchoolYear->find('first', $options);
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
		$this->SchoolYear->id = $id;
		if (!$this->SchoolYear->exists()) {
			throw new NotFoundException(__('Invalid school year'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SchoolYear->delete()) {
			$this->Session->setFlash(__('The school year has been deleted.'));
		} else {
			$this->Session->setFlash(__('The school year could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
