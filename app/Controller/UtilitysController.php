<?php
App::uses('AppController', 'Controller');
App::uses('FPDF', 'Vendor/fpdf');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UtilitysController extends AppController {

 public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action,array('viewdoc','formtemplate'))) {
            return true;
        }

       
        return parent::isAuthorized($user);
    }
	

    function upload(){
        
    }
	
	function viewdoc($img=null){
	
		$pdf = new FPDF('P','mm','grade');
        $pdf->AddPage();
        $pdf->SetFont('Arial','I',6);
		$pdf->Image(WWW_ROOT.DS.'img/'.$img, 0,0, 140,161);
		
		
		 $pdf->Output();
		exit();
	}
	
	function formtemplate(){
	}
	
	function uploadsubject(){
	
		if($this->request->is('post')){
		
			$this->loadModel('Subject');
            $this->Subject->unbindModel(array('belongsTo'=>array('Course')),false);
            
            
            $this->loadModel('Course');
            $this->Course->unbindModel(array('hasMany'=>array('User')),false);
		
				if(in_array($this->request->data['Utilitys']['file']['type'],array('text/comma-separated-values','text/plain','application/vnd.ms-excel','application/csv') )){
					$handle = fopen($this->request->data['Utilitys']['file']['tmp_name'],'r');
                    
					if($handle){
                     $dataSource = $this->Subject->getDataSource();
                    $dataSource->begin();
                    
                     while (($buffer = fgets($handle, filesize($this->request->data['Utilitys']['file']['tmp_name']))) !== false) {
						
						$bufferx = explode(',', $buffer);
						
                                                $course = $this->Course->findByCode(trim($bufferx[0]));
                                                
                                                if(!empty($course)){
                                                
                                                    $subject = $this->Subject->findByCourseIdAndCode(trim($bufferx[0]),trim($bufferx[1]));




                                                    if(!empty($subject)){
                                                            $this->Subject->create();
                                                            $this->Subject->save(array(
                                                                    'id'=>$subject['Subject']['id'],
                                                                    'course_id'=>$course['Course']['id'],
                                                                    'code'=>trim($bufferx[1]),
                                                                    'description'=>trim($bufferx[2]),
                                                                    'unit'=>(float)$bufferx[3]

                                                            ));
                                                    }
                                                    else{
                                                            $this->Subject->create();
                                                            $this->Subject->save(array(
                                                                    'course_id'=>$course['Course']['id'],
                                                                    'code'=>trim($bufferx[1]),
                                                                    'description'=>trim($bufferx[2]),
                                                                    'unit'=>(float)$bufferx[3]

                                                            ));
                                                    }
                                                }
						
					 
					}
						$this->loadModel('FileUploadedAudit');
						
						if($this->FileUploadedAudit->save(array('file_name'=>$this->request->data['Utilitys']['file']['name']))){
							$dataSource->commit();
							$this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Sucessfully Uploaded..."));
						}
						else{
							$dataSource->rollback();
							$this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Uploading failed..."));
						}
					}
					 if (!feof($handle)) {
						 $this->Session->setFlash(__('Error: unexpected fgets() fail'));
					}
					fclose($handle);					
				}
				else{
					 $this->Session->setFlash(__('Invalid file type'));
				}				
					
		}	
		$this->redirect(array('action'=>'upload'));
	
	}
    
    function uploadstudent(){
         if($this->request->is('post')){
            
            $this->loadModel('User');
            $this->User->unbindModel(array('belongsTo'=>array('Course','SchoolYear')),false);
            
            $this->loadModel('Course');
            $this->Course->unbindModel(array('hasMany'=>array('User')),false);
            
            $this->loadModel('SchoolYear');
            $this->SchoolYear->unbindModel(array('hasMany'=>array('StudentRecordHeader','Setting')),false);
            
            
            
              if(in_array($this->request->data['Utilitys']['file']['type'],array('text/comma-separated-values','text/plain','application/vnd.ms-excel','application/csv') )){
                $handle = fopen($this->request->data['Utilitys']['file']['tmp_name'],'r');
                    
                if($handle){
                     $dataSource = $this->User->getDataSource();
                    $dataSource->begin();
                    
                     while (($buffer = fgets($handle, filesize($this->request->data['Utilitys']['file']['tmp_name']))) !== false) {
                        $bufferx = explode(',', $buffer);
                        
                        $course = $this->Course->findByCode($bufferx[4]);
                        
                        $shoolyear = $this->SchoolYear->findBySchoolYear(trim($bufferx[5]));
                        pr($shoolyear);
                        $user = $this->User->find('first',array(
                            'conditions'=>array('student_no'=>$bufferx[0])
                        ));
                        if(!empty($user)){
                             $this->User->create();
                            
                            $this->User->save(
                                        array(
                                               'id'=>$user['User']['id'],
                                            'student_no'=>$bufferx[0],
                                            'first_name'=>$bufferx[2],
                                            'middle_name'=>$bufferx[3],
                                            'last_name'=>$bufferx[1],
                                            'school_year_id'=>(int)$shoolyear['SchoolYear']['id'],
                                            'course_id'=>(int)$course['Course']['id'],
                                            'role'=>'Student'
                                        )
                                    );
                            
                            
                        }
                        else{
                            $this->User->create();
                            
                            $this->User->save(
                                        array(
                                            'student_no'=>$bufferx[0],
                                            'first_name'=>$bufferx[2],
                                            'middle_name'=>$bufferx[3],
                                            'last_name'=>$bufferx[1],
                                            'school_year_id'=>(int)$shoolyear['SchoolYear']['id'],
                                            'course_id'=>(int)$course['Course']['id'],
                                            'role'=>'Student'
                                        )
                                    );
                        }
                        
                     }
                     $this->loadModel('FileUploadedAudit');
                    
                        if($this->FileUploadedAudit->save(array('file_name'=>$this->request->data['Utilitys']['file']['name']))){
                            $dataSource->commit();
                            $this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Sucessfully Uploaded..."));
                        }
                        else{
                            $dataSource->rollback();
                            $this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Uploading failed..."));
                        }
                }
                if (!feof($handle)) {
                     $this->Session->setFlash(__('Error: unexpected fgets() fail'));
                }
                fclose($handle);
              }
               else{
                 $this->Session->setFlash(__('Invalid file type'));
            }
            
         }
          $this->redirect(array('action'=>'upload'));
    }
    
    function uploadgrade(){
        
        if($this->request->is('post')){
            
            $this->loadModel('User');
            $this->User->unbindModel(array('belongsTo'=>array('Course')),false);
            
            $this->loadModel('StudentRecordHeader');
            $this->StudentRecordHeader->unbindModel(array('belongsTo'=>array('User','SchoolYear')),false);
            
            $this->StudentRecordHeader->StudentRecordDetail->unbindModel(array('belongsTo'=>array('Subject','StudentRecordHeader'),'hasMany'=>array('Grade')),false);
            
            $this->loadModel('Subject');
            $this->Subject->unbindModel(array('belongsTo'=>array('Course')),false);
            
            $this->loadModel('Grade');
            $this->Grade->unbindModel(array('belongsTo'=>array('StudentRecordDetail')));
            
            $this->loadModel('SchoolYear');
            $this->SchoolYear->unbindModel(array('hasMany'=>array('StudentRecordHeader','Setting')),false);
            
            
            if(in_array($this->request->data['Utilitys']['file']['type'],array('text/comma-separated-values','text/plain','application/vnd.ms-excel','application/csv') )){
                $handle = fopen($this->request->data['Utilitys']['file']['tmp_name'],'r');
                    
                if($handle){
                    
                    $dataSource = $this->StudentRecordHeader->getDataSource();
                    $dataSource->begin();
                    while (($buffer = fgets($handle, filesize($this->request->data['Utilitys']['file']['tmp_name']))) !== false) {
                        $bufferx = explode(',', $buffer);
                        
                        $subject = $this->Subject->findByCode(trim($bufferx[4]));
                        
                        $user = $this->User->findByStudentNoAndStatus(trim($bufferx[0]),'C');
                        
                        $shoolyear = $this->SchoolYear->findBySchoolYear(trim($bufferx[1]));
                        
                        $header = $this->StudentRecordHeader->find('first',array(
                            'conditions'=>array(
                                                'user_id'=>$user['User']['id'],
                                                'school_year_id'=>$shoolyear['SchoolYear']['id'],
                                                'semester'=>(int)trim($bufferx[2])
                                )
                        ));
                        //pr($header);
                        if(!empty($header)){
                            $this->StudentRecordHeader->create();
                            $this->StudentRecordHeader->save(
                                    array(
                                        'id'=>$header['StudentRecordHeader']['id'],
                                        'user_id'=>$user['User']['id'],
                                        'school_year_id'=>$shoolyear['SchoolYear']['id'],
                                        'semester'=>(int)trim($bufferx[2])
                                    )
                             );
                            
                            
                            $detail = $this->StudentRecordHeader->StudentRecordDetail->find('first',array(
                                            'conditions'=>array('StudentRecordDetail.subject_id'=>(int)$subject['Subject']['id'],
                                                                'StudentRecordDetail.student_record_header_id'=>$header['StudentRecordHeader']['id'],
                                        )
                                    )
                                );
                            
                        //pr($detail);
                                if(!empty($detail)){
                                    $this->StudentRecordHeader->StudentRecordDetail->create();
                                    $this->StudentRecordHeader->StudentRecordDetail->save(
                                            array(
                                                'id'=>$detail['StudentRecordDetail']['id'],
                                                'student_record_header_id'=>$header['StudentRecordHeader']['id'],
                                                'subject_id'=>(int)$subject['Subject']['id']
                                            )
                                    );
                                    
                                    
                                    for($j=1;$j<=4;$j++){
                                        
                                        $grade = $this->Grade->find('first',array(
                                            'conditions'=>array(
                                                'student_record_detail_id'=>$detail['StudentRecordDetail']['id'],
                                                'grading_type' => $j
                                            )
                                        ));
                                        if(!empty($grade)){
                                            $this->Grade->create();
                                            $this->Grade->save(array(
                                                'id'=>$grade['Grade']['id'],
                                                'grade'=>$bufferx[(5+$j)]
                                            ));
                                        }
                                        else{
                                            $this->Grade->create();
                                            $this->Grade->save(array(
                                                'student_record_detail_id'=>$detail['StudentRecordDetail']['id'],
                                                'grading_type'=>$j,
                                                'grade'=>$bufferx[(5+$j)]
                                            ));
                                        }
                                        
                                    }
                                    
                                   
                                }
                                else{
                                    $this->StudentRecordHeader->StudentRecordDetail->create();
                                    $this->StudentRecordHeader->StudentRecordDetail->save(
                                            array(
                                                'student_record_header_id'=>$header['StudentRecordHeader']['id'],
                                                'subject_id'=>(int)$subject['Subject']['id']
                                            )
                                    );
                                    
                                     for($a=1;$a<=4;$a++){
                                        
                                            $this->Grade->create();
                                            $this->Grade->save(array(
                                              'student_record_detail_id'=>$this->StudentRecordHeader->StudentRecordDetail->id,
                                                  
                                                'grading_type'=>$a,
                                                'grade'=>$bufferx[(5+$a)]
                                            )); 
                                    }
                                    
                                    
                                    
                                }
                        }
                        else{
                            $this->StudentRecordHeader->create();
                            $this->StudentRecordHeader->save(
                                    array(
                                        'user_id'=>$user['User']['id'],
                                        'school_year_id'=>$shoolyear['SchoolYear']['id'],
                                        'semester'=>(int)trim($bufferx[2]),
                                        'status'=>'C'
                                    )
                             );
                            
                                    $this->StudentRecordHeader->StudentRecordDetail->create();
                                    $this->StudentRecordHeader->StudentRecordDetail->save(
                                            array(
                                              
                                                'student_record_header_id'=>$this->StudentRecordHeader->id,
                                                'subject_id'=>(int)$subject['Subject']['id']
                                            )
                                    );
                                    
                                    
                                     for($x=1;$x<=4;$x++){
                                        
                                            $this->Grade->create();
                                            $this->Grade->save(array(
                                              'student_record_detail_id'=>$this->StudentRecordHeader->StudentRecordDetail->id,
                                                  
                                                'grading_type'=>$x,
                                                'grade'=>$bufferx[(5+$x)]
                                            )); 
                                    }
                        }

                    }
                    $this->loadModel('FileUploadedAudit');
                    
                    if($this->FileUploadedAudit->save(array('file_name'=>$this->request->data['Utilitys']['file']['name']))){
                        $dataSource->commit();
                        $this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Sucessfully Uploaded..."));
                    }
                    else{
                        $dataSource->rollback();
                        $this->Session->setFlash(__($this->request->data['Utilitys']['file']['name']." Uploading failed..."));
                    }
                }
                 if (!feof($handle)) {
                     $this->Session->setFlash(__('Error: unexpected fgets() fail'));
                }
                fclose($handle);
                
                
            }
            else{
                 $this->Session->setFlash(__('Invalid file type'));
            }
            
        }
        $this->redirect(array('action'=>'upload'));
    }
}


?>