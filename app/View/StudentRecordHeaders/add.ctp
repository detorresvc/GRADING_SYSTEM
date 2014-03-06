
<?php echo $this->Form->create('StudentRecordHeader'); ?>
	<fieldset>
		<legend><?php echo __('Header'); ?></legend>
	<?php
       
		echo $this->Form->input('user_id');
              
                
//                echo $this->Form->input(
//			'year_level',
//			array('options' => array('1'=>'1st Year',2=>'2nd Year',3=>'3rd Year',4=>'4th Year'), 'default' => 1)
//		);
                /*echo $this->Form->input(
			'semester',
			array('options' => array('1'=>'1st Sem',2=>'2nd Sem'), 'default' => 1)
		);*/
//		echo $this->Form->input('semester',array('value'=>$setting['Setting']['semester'],'readonly'=>'readonly'));
//                echo $this->Form->input('course_id');
//                 echo $this->Form->input(
//			'status',
//			array('options' => array('C'=>'Current'), 'default' => 'C')
//		);
         ?>
                    
                <dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($this->Session->read('SchoolYear.school_year')); ?>
			&nbsp;
		</dd>
                <br>
                <dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo h($this->Session->read('Setting.semester')); ?>
			&nbsp;
		</dd>
                <br>
           <legend><?php echo __('Detail'); ?></legend>  
           <table Style="width: 50%;">
               
         <?
            
            for($i=0;$i<10;$i++){
                echo "<tr>
                        <td>Subject ".($i+1)."</td><td>";
                echo $this->Form->input('StudentRecordDetail.'.$i.'.subject_id',array('label'=>false,'div'=>false,'default' => 0));
                echo "</td>
                   </tr>";
            }
               
	?>
                        
               </table>
           <div id="subject_content"></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>



