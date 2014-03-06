<?php
App::uses('AppController', 'Controller');
App::uses('fpdf', 'Vendor/fpdf');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class StudentRecordHeadersController extends AppController {

    public $components = array('Paginator');
    
    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action,array('mycurrentgrades','printgrade','index','updatechecklist'))) {
            return true;
        }

       
        return parent::isAuthorized($user);
    }
	
	
    
    function sendtoemail($id=null){
       /*  $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->from(array('stiwebgradingsystem@gmail.com' => 'STI System Web Administrator'));
        $Email->to('detorresvc@ymail.com');
        $Email->subject('STUDENT GRADE');
      
        $Email->send('Please see attached file... thank you!!!');
      exit();*/
            
        
        $this->StudentRecordHeader->Behaviors->load('Containable');
         $details = $this->StudentRecordHeader->find('all',
		    
                        
						array('contain'=> 
							  array('StudentRecordDetail'=>array('Subject','Grade'),
                               'SchoolYear',
                               'User'=>array('Course'),
							   'StudentRequest'
							   ),
							'conditions'=>array('StudentRecordHeader.id'=>$id)
		
                                                    ));
        
        
        $pdf = new fpdf('P','mm','grade');
        $pdf->AddPage();
        $pdf->SetFont('Arial','I',6);
        $pdf->Cell(120,3,date('F d, Y'),0,1,'R');
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(120,3,'TO','LTR',1);
        $pdf->Cell(120,3,'     NAME OF THE PARENT/GUARDIAN','LR',1);
        $pdf->Cell(120,3,'     ADDRESS','LR',1);
        $pdf->Cell(120,3,'','LR',1);
        $pdf->Cell(120,3,'','LRB',1);
        
        $pdf->Cell(30,3,'FROM NAME OF SCHOOL ',0,0);
        
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(90,3,'STI COLLEGE CALOOCAN',0,1);
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'ADDRESS',0,0,'R');
        
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(90,3,'10th Ave., Caloocan City',0,1);
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'STUDENT NUMBER',0,0,'C');
        $pdf->Cell(60,3,'STUDENT NAME',0,0,'C');
        $pdf->Cell(30,3,'YEAR/PROGRAM',0,1,'C');
        
        $pdf->SetFont('Arial','',6);
        $user = $this->Auth->user();
        $pdf->Cell(30,3,$details[0]['User']['student_no'],0,0,'C');
        $pdf->Cell(60,3,  ucwords($details[0]['User']['last_name'].", ".$details[0]['User']['first_name']),0,0,'C');
        $pdf->Cell(30,3,$details[0]['User']['year_level']."/".$details[0]['User']['Course']['course'],0,1,'C');
        
        $pdf->Ln();
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(120,3,'COPY OF GRADES FOR THE PERIOD :  '.$this->__addOrdinalNumberSuffix($details[0]['StudentRecordHeader']['semester'])." Term, ".$details[0]['SchoolYear']['school_year'],0,1);
        
        $pdf->Ln(5);
        
        $pdf->Cell(15,3,'Code',1,0,'C');
        $pdf->Cell(40,3,'Course',1,0,'C');
        $pdf->Cell(15,3,'Units',1,0,'C');
        $pdf->Cell(15,3,'Grade',1,0,'C');
        
        $pdf->Cell(5,3,'',0,0,'C');
        
        $pdf->Cell(30,3,'Remarks',1,1,'C');
        
        $i=0;
        $c =0;
        foreach ($details[0]['StudentRecordDetail'] as $detail){
           
            $pdf->Cell(15,3,$detail['Subject']['code'],'L',0,'L');
            $pdf->SetFont('Arial','',5);
            $pdf->Cell(40,3,$detail['Subject']['description'],0,0,'L');
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(15,3,$detail['Subject']['unit'],0,0,'R');
            
            $c += (float)$detail['Subject']['unit'];
            
//            if(isset($detail['Grade'][0]['grade'])){
//                $grade = $detail['Grade'][0]['grade'];
//            }
//            else{
//                $grade = 0;
//            }
            
            $i=0;
            $a =0;
            $b=0;
            foreach ($detail['Grade'] as $grade){
                $a += (float)$grade['grade']*(float)$detail['Subject']['unit'];
                $b += (float)$grade['grade'];
                
                if((float)$grade['grade'] <> 0){
                    $i++;
                }
            }
            
            if($i <> 0){
                $ave = $b/$i;
            }
            else{
                $ave =0;
            }
            $pdf->Cell(15,3,  number_format($ave,2),'R',0,'R');
            
            $pdf->Cell(5,3,'',0,0,'C');
            $pdf->Cell(30,3,'','LR',1,'C');
            
            $i++;
        }
        
        
        
        
        
        for($x=$i;$x<20;$x++){
            
            
            $pdf->Cell(85,3,'','LR',0);
            $pdf->Cell(5,3,'',0,0,'C');
            $pdf->Cell(30,3,'','LR',1,'C');
            
        }
        
        
        
        $pdf->Cell(85,3,'','LBR',0);
        $pdf->Cell(5,3,'','',0);
        $pdf->Cell(30,3,'','LBR',1);
        
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->SetFont('Arial','',4);
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
         $pdf->SetFont('Arial','',6);
        $pdf->Cell(120,3,'I certify to the veracity of the above records of '. strtoupper($user['last_name'].", ".$user['first_name']." ".$user['middle_name'] ),0,1,'L');
		
		$pdf->Cell(120,3,'PRINTED VIA ONLINE STUDENT PORTAL '.date('m/d/Y G:i:s'),0,1,'L');
        
        
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Text(103,57,'GWA:');
        $pdf->Text(103,70,'STATUS:');
        $pdf->Text(103,85,'Cumulative GWA:');
        $pdf->Text(103,105,'Registration Date:');
        
        
        if($c <> 0){ $GWA  = $a/$c; }else { $GWA = 0;}
        
        $pdf->SetFont('Arial','',6);
        $pdf->Text(103,60,'          '.number_format($GWA,2));
        $pdf->Text(103,73,'          STATUS:');
        $pdf->Text(103,88,'          Cumulative GWA:');
        $pdf->Text(103,108,'          Registration Date:');
        
        $output = $pdf->Output("","S");

        if(!empty($details[0]['User']['email_address'])){

        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->to($details[0]['User']['email_address']);
        $Email->subject('STUDENT GRADE');
        $Email->attachments(
                 array('grade.pdf' => array( 'data' => $output, 'mimetype' => 'application/pdf', 'contentId' => 'abc123', 'contentDisposition' => false ))
        );
        $Email->send('Please see attached file... thank you!!!');
              if($Email->messageId()){
                $this->Session->setFlash(__('Message Sent...'));
                $this->redirect(array('action'=>'index'));
            }
            else{
                $this->Session->setFlash(__('Sending Failed...'));
                $this->redirect(array('action'=>'index'));
            }
        }
        else{
             $this->Session->setFlash(__('Sending Failed...'));
        }
        
        $this->redirect(array('action'=>'index'));
        
         
    }
    
    function printgrade($id=null){

       
        $this->StudentRecordHeader->Behaviors->load('Containable');
        
        if($this->Auth->user('role') == 'Student'){
					$conditions  = array('StudentRecordHeader.id'=>$id,'StudentRecordHeader.status'=>array('C','H'));
//					$Studentrequestconditions = array('conditions'=>array('status'=>'A',
//					'approved_date BETWEEN DATE_ADD(NOW(), INTERVAL -2 DAY) AND  NOW()'));
		   }	   
			
		   $details = $this->StudentRecordHeader->find('all',
		    
                        
						array('contain'=> 
							  array('StudentRecordDetail'=>array('Subject','Grade'),
                               'SchoolYear',
                               'User'=>array('Course'),
							   'StudentRequest'
							   ),
							'conditions'=>$conditions
						)
		   );
//		   pr($details);
//                  exit();
//                   if($details[0]['StudentRecordHeader']['status'] != 'C'){
//                       
//                        if(empty($details[0]['StudentRecordDetail'])  ){
//                            
//                           $this->Session->setFlash(__('Record Not Found'));
//                           $this->redirect(array('controller'=>'StudentRequests','action'=>'index'));
//                        }
//                        if($details[0]['StudentRequest'][0]['status'] != 'A'){
//                            $this->Session->setFlash(__('Record Not Found'));
//                           $this->redirect(array('controller'=>'StudentRequests','action'=>'index'));
//                        }
//                    
//                   }
		  
			
		  
        //pr($details);
//        exit();
//        
//        if($this->Auth->user('id') != $details[0]['StudentRecordHeader']['user_id']){
//                $this->Session->setFlash(__('Record Not Found'));
//                $this->redirect(array('controller'=>'StudentRequests','action'=>'index'));
//            }
        //pr($details);
        
        $pdf = new fpdf('P','mm','grade');
        $pdf->AddPage();
        $pdf->SetFont('Arial','I',6);
        $pdf->Cell(120,3,date('F d, Y'),0,1,'R');
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(120,3,'TO','LTR',1);
        $pdf->Cell(120,3,'     NAME OF THE PARENT/GUARDIAN','LR',1);
        $pdf->Cell(120,3,'     ADDRESS','LR',1);
        $pdf->Cell(120,3,'','LR',1);
        $pdf->Cell(120,3,'','LRB',1);
        
        $pdf->Cell(30,3,'FROM NAME OF SCHOOL ',0,0);
        
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(90,3,'STI COLLEGE CALOOCAN',0,1);
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'ADDRESS',0,0,'R');
        
        $pdf->SetFont('Arial','',6);
        $pdf->Cell(90,3,'10th Ave., Caloocan City',0,1);
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'STUDENT NUMBER',0,0,'C');
        $pdf->Cell(60,3,'STUDENT NAME',0,0,'C');
        $pdf->Cell(30,3,'YEAR/PROGRAM',0,1,'C');
        
        $pdf->SetFont('Arial','',6);
        $user = $this->Auth->user();
        $pdf->Cell(30,3,$details[0]['User']['student_no'],0,0,'C');
        $pdf->Cell(60,3,  ucwords($details[0]['User']['last_name'].", ".$details[0]['User']['first_name']),0,0,'C');
        $pdf->Cell(30,3,$details[0]['User']['year_level']."/".$details[0]['User']['Course']['course'],0,1,'C');
        
        $pdf->Ln();
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(120,3,'COPY OF GRADES FOR THE PERIOD :  '.$this->__addOrdinalNumberSuffix($details[0]['StudentRecordHeader']['semester'])." Term, ".$details[0]['SchoolYear']['school_year'],0,1);
        
        $pdf->Ln(5);
        
        $pdf->Cell(15,3,'Code',1,0,'C');
        $pdf->Cell(40,3,'Course',1,0,'C');
        $pdf->Cell(15,3,'Units',1,0,'C');
        $pdf->Cell(15,3,'Grade',1,0,'C');
        
        $pdf->Cell(5,3,'',0,0,'C');
        
        $pdf->Cell(30,3,'Remarks',1,1,'C');
        
        $i=0;
        $c =0;
        foreach ($details[0]['StudentRecordDetail'] as $detail){
           
            $pdf->Cell(15,3,$detail['Subject']['code'],'L',0,'L');
            $pdf->SetFont('Arial','',5);
            $pdf->Cell(40,3,$detail['Subject']['description'],0,0,'L');
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(15,3,$detail['Subject']['unit'],0,0,'R');
            
            $c += (float)$detail['Subject']['unit'];
            
//            if(isset($detail['Grade'][0]['grade'])){
//                $grade = $detail['Grade'][0]['grade'];
//            }
//            else{
//                $grade = 0;
//            }
            
            $i=0;
            $a =0;
            $b=0;
            foreach ($detail['Grade'] as $grade){
                $a += (float)$grade['grade']*(float)$detail['Subject']['unit'];
                $b += (float)$grade['grade'];
                
                if((float)$grade['grade'] <> 0){
                    $i++;
                }
            }
            
            if($i <> 0){
                $ave = $b/$i;
            }
            else{
                $ave =0;
            }
            $pdf->Cell(15,3,  number_format($ave,2),'R',0,'R');
            
            $pdf->Cell(5,3,'',0,0,'C');
            $pdf->Cell(30,3,'','LR',1,'C');
            
            $i++;
        }
        
        
        
        
        
        for($x=$i;$x<20;$x++){
            
            
            $pdf->Cell(85,3,'','LR',0);
            $pdf->Cell(5,3,'',0,0,'C');
            $pdf->Cell(30,3,'','LR',1,'C');
            
        }
        
        
        
        $pdf->Cell(85,3,'','LBR',0);
        $pdf->Cell(5,3,'','',0);
        $pdf->Cell(30,3,'','LBR',1);
        
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->SetFont('Arial','',4);
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,0,'L');
        $pdf->Cell(30,3,'GRADING SYSTEM',0,1,'L');
        
         $pdf->SetFont('Arial','',6);
        $pdf->Cell(120,3,'I certify to the veracity of the above records of '. strtoupper($user['last_name'].", ".$user['first_name']." ".$user['middle_name'] ),0,1,'L');
		
		$pdf->Cell(120,3,'PRINTED VIA ONLINE STUDENT PORTAL '.date('m/d/Y G:i:s'),0,1,'L');
        
        
        
        $pdf->SetFont('Arial','B',6);
        $pdf->Text(103,57,'GWA:');
        $pdf->Text(103,70,'STATUS:');
        $pdf->Text(103,85,'Cumulative GWA:');
        $pdf->Text(103,105,'Registration Date:');
        
        
        if($c <> 0){ $GWA  = $a/$c; }else { $GWA = 0;}
        
        $pdf->SetFont('Arial','',6);
        $pdf->Text(103,60,'          '.number_format($GWA,2));
        $pdf->Text(103,73,'          STATUS:');
        $pdf->Text(103,88,'          Cumulative GWA:');
        $pdf->Text(103,108,'          Registration Date:');
        
        $pdf->Output();
        exit();
    }
    
    function search(){
        $this->redirect( array('controller'=>'StudentRecordHeaders','action'=>'index',"field"=>$this->request->data['StudentRecordHeader']['field'],"where"=>$this->request->data['StudentRecordHeader']['where'],"value"=>$this->request->data['StudentRecordHeader']['value'] ));
    }
    
    function index(){
        $conditions = array();
        if(isset($this->request->params['named']['field'])){
                
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
                
              $conditions = array($this->request->params['named']['field']." ".$cond=>$this->request->params['named']['value'].$wildcard);  
        }

        if($this->Auth->user('role') == 'Student'){
        
       	    	$this->loadModel('User');
            $this->User->unbindModel(array('belongsTo'=>array('Course')),false);	
            
            $a = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id')),'fields'=>'User.student_no')); 
            
             $b = $this->User->find('list',array('conditions'=>array('User.student_no'=> $a['User']['student_no']),'fields'=>'User.id')); 
        		
        
        
            $conditions[] = array('StudentRecordHeader.user_id'=>$b);
        }
        
        $this->Paginator->settings = array(
            'conditions'=>$conditions
       );
     

       $this->set('users', $this->Paginator->paginate());
       
    }
    
    public function view($id) {
        
        $this->StudentRecordHeader->Behaviors->load('Containable');
        
        $details = $this->StudentRecordHeader->find('all',
                    array('conditions'=>array('StudentRecordHeader.id'=>$id),'contain'=> 
                         
                         array('StudentRecordDetail'=>array('Subject','Grade'),
                               'User','SchoolYear'),
                        
                    )
       );
        
        $this->set('details', $details);
        
    }
    
    function delete($id){
        
         if (!$this->StudentRecordHeader->exists($id)) {
                throw new NotFoundException(__('Invalid Header'));
        }
        else{
            if($this->StudentRecordHeader->delete($id,true)){
                 $this->Session->setFlash(__('Record Deleted'));
                 $this->redirect(array('action'=>'index'));
            }
            else{
                $this->Session->setFlash(__('Deleting Failed'));
            }
        }
    }
    
    public function edit($id) {
        
        if (!$this->StudentRecordHeader->exists($id)) {
                throw new NotFoundException(__('Invalid Header'));
        }
        
         if ($this->request->is('post')) {
             $dataSource = $this->StudentRecordHeader->StudentRecordDetail->getDataSource();
             $dataSource->begin();
             $trans = true;
             
             foreach ($this->request->data['StudentRecordDetail'] as $dtl){
                 
                 $this->StudentRecordHeader->StudentRecordDetail->create();
                 if( $this->StudentRecordHeader->StudentRecordDetail->exists($dtl['id']) ){
                     if($dtl['subject_id'] <> 0){
                        $this->StudentRecordHeader->StudentRecordDetail->read(null,$dtl['id']);
                        $this->StudentRecordHeader->StudentRecordDetail->set('subject_id',$dtl['subject_id']);
                        $this->StudentRecordHeader->StudentRecordDetail->save();
                     }
                 }
                 else{
                     if($dtl['subject_id'] <> 0){
                         $dtlCount = $this->StudentRecordHeader->StudentRecordDetail->find('count',array('conditions'=>array('student_record_header_id'=>$this->request->data['StudentRecordHeader']['id'],
                             'subject_id'=>$dtl['subject_id'])));
                            if($dtlCount == 0){
                                
                                if(!$this->StudentRecordHeader->StudentRecordDetail->save(array('student_record_header_id'=>$this->request->data['StudentRecordHeader']['id']
                                        ,'subject_id'=>$dtl['subject_id']))){
                                    $trans = false;
                                }
                               
                            }
                     }
                 }
             }
             if($trans === false){
                 $dataSource->rollback();
                 $this->Session->setFlash(__('Saving Failed.'));
             }
             else{
                $dataSource->commit();
                $this->Session->setFlash(__('Sucessfully Updated.'));
                return $this->redirect(array('action' => 'edit',$id));
             }
         }
        
        
        $this->StudentRecordHeader->Behaviors->load('Containable');
        
        $details = $this->StudentRecordHeader->find('all',
                    array('conditions'=>array('StudentRecordHeader.id'=>$id),'contain'=> 
                         
                         array('StudentRecordDetail'=>array('Subject'),
                               'SchoolYear',
                               'User'),
                        
                    )
       );
        
        $this->set('details', $details);
        
        
        $this->loadModel('Subject');   
        $this->Subject->recursive = -1;
        $subjects = $this->Subject->find('list',array('fields'=>array('id','description')));
        $subjects[0] = '';
        ksort($subjects);
       
        $this->set(compact('subjects'));
        
        
    }
    
    
    function add(){
        
        
        if ($this->request->is('post')) {
            
                $this->request->data['StudentRecordHeader']['school_year_id'] = $this->Session->read('Setting.school_year_id');
                $this->request->data['StudentRecordHeader']['semester'] = $this->Session->read('Setting.semester');
                $this->request->data['StudentRecordHeader']['status'] = 'C';
                if ($this->StudentRecordHeader->saveAssociated(array('StudentRecordHeader'=>$this->request->data['StudentRecordHeader'],'StudentRecordDetail'=>$this->__filterDetail()),array('deep'=>true))) {
                        $this->Session->setFlash(__('Sucessfully Saved.'));
                        return $this->redirect(array('action' => 'index'));
                } else {
                        $this->Session->setFlash(__('Saving Failed.'));
                }
        }
        $this->StudentRecordHeader->User->recursive = -1;
        $users = $this->StudentRecordHeader->User->find('list',array('fields'=>array('id','first_name')));       
        $this->set(compact('users'));
        
        
                
                
       $this->loadModel('Subject');   
       $this->Subject->recursive = -1;
      
       $subjects = $this->Subject->find('list',array('fields'=>array('id','description')));
        $subjects[0] = '';
        ksort($subjects);
       
       $this->set(compact('subjects'));
    }
    
    
    function __filterDetail(){
        $arr = array();
        $arrChk = array();
        if ($this->request->is('post')) {
            foreach ($this->request->data['StudentRecordDetail'] as $detail){
                if($detail['subject_id'] != 0){
                    if(!in_array($detail['subject_id'], $arrChk))
                    $arr[] = array('subject_id'=>$detail['subject_id']);
                }
                
                $arrChk[] =  $detail['subject_id'];
            }
            
        }
        return $arr;
    }
    
    function mycurrentgrades($id=null){
        
       
        $this->StudentRecordHeader->Behaviors->load('Containable');
        
        if(!is_null($id)){
		
			if($this->Auth->user('role') == 'Student'){
					$conditions  = array('StudentRecordHeader.id'=>$id,'StudentRecordHeader.status'=>array('C','H'));
//					$Studentrequestconditions = array('conditions'=>array('status'=>'A',
//					'approved_date BETWEEN DATE_ADD(NOW(), INTERVAL -2 DAY) AND  NOW()'));
		   }	   
			
		   $details = $this->StudentRecordHeader->find('all',
		    
                        
						array('contain'=> 
							  array('StudentRecordDetail'=>array('Subject','Grade'),
                               'SchoolYear',
                               'User',
							   'StudentRequest'
							   ),
							'conditions'=>$conditions
						)
		   );
                  
			
//            $currUser = $this->Auth->user();
//            
//             if(empty($details[0]['StudentRequest'])){
//				$this->Session->setFlash(__('Record Not Found'));
//                                if($this->Auth->user('role') == 'Student'){
//                                       $this->redirect(array('controller'=>'StudentRequest','action'=>'index'));
//                                }
//
//                                 $this->redirect(array('controller'=>'StudentRecordHeaders','action'=>'index'));
//			 }
//			 
//            if($currUser['id'] != $details[0]['StudentRecordHeader']['user_id']){
//                $this->Session->setFlash(__('Record Not Found'));
//                 if($this->Auth->user('role') == 'Student'){
//                        $this->redirect(array('controller'=>'StudentRequest','action'=>'index'));
//                 }
//                $this->redirect(array('controller'=>'StudentRecordHeaders','action'=>'index'));
//            }
        }
        else{
        
            $details = $this->StudentRecordHeader->find('all',
                        array('conditions'=>array('StudentRecordHeader.user_id'=>$this->Auth->user('id'),
                            'StudentRecordHeader.school_year_id'=>$this->Session->read('SchoolYear.id'),
                            'StudentRecordHeader.semester'=>$this->Session->read('Setting.semester'),
                            'StudentRecordHeader.status'=>'C'),'contain'=> 

                             array('StudentRecordDetail'=>array('Subject','Grade'),
                                 'SchoolYear',
                                   'User'),

                        )
           );
            
            if(empty($details)){
                $this->Session->setFlash(__('Record Not Found'));
                 if($this->Auth->user('role') == 'Student'){
                        $this->redirect(array('controller'=>'studentrecords','action'=>'index'));
                 }
                $this->redirect(array('controller'=>'studentrecords','action'=>'index'));
            }
        }
        
        $this->set('details', $details);
    }
    
    function updatechecklist(){
        if($this->StudentRecordHeader->updateAll(array('StudentRecordHeader.status'=>"'H'"),array('StudentRecordHeader.user_id'=>$this->Auth->user('id'),'StudentRecordHeader.status'=>'C'))){
            $this->Session->setFlash(__('Checklist successfully updated'));
            
        }
        else{
            $this->Session->setFlash(__('Checklist updated failed'));
        }
        $this->redirect(array('controller'=>'StudentRecordHeaders','action'=>'index'));
    
    }
}




?>