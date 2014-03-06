<div class="studentRequests form">
<?php echo $this->Form->create('StudentRequest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Student Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_record_header_id',array('type'=>'hidden'));
         ?>
                
              <dl>
             
                <dt><?php echo __('Student'); ?></dt>
		<dd>
			<?php echo h($this->request->data['StudentRecordHeader']['User']['last_name'].", ".$this->request->data['StudentRecordHeader']['User']['first_name']." ".$this->request->data['StudentRecordHeader']['User']['middle_name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($this->request->data['StudentRecordHeader']['SchoolYear']['school_year']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo h($this->request->data['StudentRecordHeader']['semester']); ?>
			&nbsp;
		</dd>
                </dl>
                
        <?php
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StudentRequest.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StudentRequest.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Student Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Record'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo ($currUser['role'] == 'Admin') ? $this->Html->link(__('New Student Record'), array('controller' => 'student_record_headers', 'action' => 'add')) : ''; ?> </li>
	</ul>
</div>
