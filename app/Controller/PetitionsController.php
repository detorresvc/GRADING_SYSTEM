<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('fpdf', 'Vendor/fpdf');
/**
 * Petitions Controller
 *
 * @property Petition $Petition
 * @property PaginatorComponent $Paginator
 */
class PetitionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	
	public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action,array('add','petition_count'))) {
            return true;
        }

       
        return parent::isAuthorized($user);
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Petition->recursive = 0;
		
		
		$this->set('petitions', $this->Paginator->paginate());
                
	}
        
        function print_petition($id){
           $petitions = $this->Petition->find('all',array('conditions'=>array('Petition.subject_id'=>$id)));
           
           $pdf = new fpdf('P','mm','letter');
            $pdf->AddPage();
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(188,5,'SUBJECT : '.$petitions[0]['Subject']['description'],0,1,'L');
            $i=1;
            $pdf->SetFont('Arial','',12);
            foreach ($petitions as $petitions){
                $pdf->Cell(188,5,"                 ".$i.") ".ucwords($petitions['User']['last_name'].", ".$petitions['User']['first_name']),0,1,'L');
                $i++;
            }
//           / pr($petitions);
             $output = $pdf->Output();
             exit();
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
		$this->set('petition', $this->Petition->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    
			if ($this->Petition->saveMany($this->request->data['Petition'])) {
				$this->Session->setFlash(__('The petition has been saved.'));
				if($this->Auth->user('role') == 'Student'){
					return $this->redirect(array('action' => 'petition_count'));
				}
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petition could not be saved. Please, try again.'));
			}
		}
	
                
                $conditionsSubQuery['Petition.user_id'] = $this->Auth->user('id');

                $db = $this->Petition->getDataSource();
                $subQuery = $db->buildStatement(
                    array(
                        'fields'     => array('DISTINCT Petition.subject_id'),
                        'table'      => $db->fullTableName($this->Petition),
                        'alias'      => 'Petition',
                        'limit'      => null,
                        'offset'     => null,
                        'joins'      => array(),
                        'conditions' => $conditionsSubQuery,
                        'order'      => null,
                        'group'      => null
                    ),
                    $this->User
                );
                $subQuery = 'Course.course_category_id = '.$this->Auth->user('Course.course_category_id').' AND Subject.id NOT IN (' . $subQuery . ')   ';
                $subQueryExpression = $db->expression($subQuery);

                $conditions[] = $subQueryExpression;
                
                //$subjects = $this->Petition->Subject->find('list');
                
                $subjects = $this->Petition->Subject->find('all', compact('conditions'));
                
		
                
		$users = $this->Petition->User->find('list');
		
		$this->set(compact('subjects', 'users'));
                
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Petition->save($this->request->data)) {
				$this->Session->setFlash(__('The petition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
			$this->request->data = $this->Petition->find('first', $options);
		}
		$subjects = $this->Petition->Subject->find('list');
		$users = $this->Petition->User->find('list');
		$this->set(compact('subjects', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Petition->id = $id;
		if (!$this->Petition->exists()) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Petition->delete()) {
			$this->Session->setFlash(__('The petition has been deleted.'));
		} else {
			$this->Session->setFlash(__('The petition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	function petition_count(){
		$this->Petition->recursive = 0;
		$this->Paginator->settings = array(
			'Petition' => array(
				'fields' => array(
					'Petition.subject_id','Subject.description','COUNT(Petition.subject_id) as petition_count'
				),
				'group' => array('Petition.subject_id', 'Subject.description')
			)
		);
		
		$this->set('petitions', $this->Paginator->paginate());
	}
        
        function approve_petitions(){
            
            if(!empty($this->request->data['Petition'])){
                foreach ($this->request->data['Petition']['subject_id'] as $index => $subjectid){
                     $petitions =   $this->Petition->find('all',array('conditions'=>array('subject_id'=>$index),'fields'=>array(
                         'Petition' => 'Petition.id',
                         'Subject' => 'Subject.description',
                         'User'=> 'User.email_address'
                     )));
                    
                        foreach ($petitions as $petition){
                            if(!empty($petition['User']['email_address'])){
                                
                              /*  $Email = new CakeEmail();
                                $Email->config('gmail');
                                $Email->to($petition['User']['email_address']);
                                $Email->subject('SUBJECT PETITIONS');

                                $Email->send('The Subject '.$petition['Subject']['description'].' you petitioned is already approved... thank you!!!');*/
                               
                               
                            }
                        }
                     
                }
                
                $this->Session->setFlash(__('Selected Subject Successfully Approved'));
                
            }
            else{
                $this->Session->setFlash(__('No. Selected Subject'));
              
            }
              return $this->redirect(array('action' => 'petition_count'));
        }
	
	}