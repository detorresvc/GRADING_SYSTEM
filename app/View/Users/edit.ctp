<div class="users form">
<?php echo $this->Form->create('User',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Student'); ?></legend>
	<?php
              echo $this->Form->hidden('MAX_FILE_SIZE',array('value'=>'10000','name'=>'MAX_FILE_SIZE'));
		echo $this->Form->input('id');
		echo $this->Form->input('student_no');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
                  echo $this->Form->input(
			'year_level',
			array('options' => array('1'=>'1st Year','2'=>'2nd Year','3'=>'3rd Year','4'=>'4th Year'), 'default' => '1')
		);
		//echo $this->Form->input('year_level');
		echo $this->Form->input('course_id');
                echo $this->Form->input('email_address');
//                 echo $this->Form->input(
//			'role',
//			array('options' => array('Admin'=>'Admin','Student'=>'Student'), 'default' => 'Student')
//		);
                 echo $this->Form->input('image',array('type'=>'file','label'=>'Image ( jpg|png|gif ) 10kb'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
