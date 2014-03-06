<?php
App::uses('AppController', 'Controller');
/**
 * CourseCategories Controller
 *
 * @property CourseCategory $CourseCategory
 * @property PaginatorComponent $Paginator
 */
class CourseCategoriesController extends AppController {

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
		$this->CourseCategory->recursive = 0;
		$this->set('courseCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CourseCategory->exists($id)) {
			throw new NotFoundException(__('Invalid course category'));
		}
		$options = array('conditions' => array('CourseCategory.' . $this->CourseCategory->primaryKey => $id));
		$this->set('courseCategory', $this->CourseCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CourseCategory->create();
			if ($this->CourseCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The course category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course category could not be saved. Please, try again.'));
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
		if (!$this->CourseCategory->exists($id)) {
			throw new NotFoundException(__('Invalid course category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CourseCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The course category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CourseCategory.' . $this->CourseCategory->primaryKey => $id));
			$this->request->data = $this->CourseCategory->find('first', $options);
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
		$this->CourseCategory->id = $id;
		if (!$this->CourseCategory->exists()) {
			throw new NotFoundException(__('Invalid course category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CourseCategory->delete()) {
			$this->Session->setFlash(__('The course category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The course category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
