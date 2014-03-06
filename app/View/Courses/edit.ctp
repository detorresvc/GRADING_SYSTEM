<div class="courses form">
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Edit Course'); ?></legend>
	<?php
		echo $this->Form->input('id');
                echo $this->Form->input('course_category_id');
		echo $this->Form->input(
			'year_level',
			array('options' => array('1'=>'1st Year',2=>'2nd Year',3=>'3rd Year',4=>'4th Year'), 'default' => 1)
		);
		
		echo $this->Form->input(
			'semester',
			array('options' => array('1'=>'1st Sem',2=>'2nd Sem'), 'default' => 1)
		);
                echo $this->Form->input('code');
		echo $this->Form->input('course');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Course.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Course.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
