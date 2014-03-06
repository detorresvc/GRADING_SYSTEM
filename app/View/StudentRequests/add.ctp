<div class="studentRequests form">
<?php echo $this->Form->create('StudentRequest'); ?>
	<fieldset>
		<legend><?php echo __('Add Student Request'); ?></legend>
	<?php
		
              echo $this->Form->input(
			'schoolyears',array('label'=>'School Year','name'=>'data[StudentRequest][school_year_id]')
			
		);
                 echo $this->Form->input(
			'semester',
			array('options' => array('1'=>'1st Sem',2=>'2nd Sem'), 'default' => 1));
		echo $this->Form->input('reason');	
                
                if($currUser['role'] == 'Admin'){
                
                    echo $this->Form->input(
                            'status',
                            array('options' => array('O'=>'Open','A'=>'Approved'), 'default' => 'O')
                    );
                }
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Student Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Record'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo ($currUser['role'] == 'Admin') ? $this->Html->link(__('New Student Record'), array('controller' => 'student_record_headers', 'action' => 'add')) : ''; ?> </li>
	</ul>
</div>
