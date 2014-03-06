<div class="schoolYears form">
<?php echo $this->Form->create('SchoolYear'); ?>
	<fieldset>
		<legend><?php echo __('Add School Year'); ?></legend>
	<?php
		echo $this->Form->input('school_year');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List School Years'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Settings'), array('controller' => 'settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting'), array('controller' => 'settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Record Headers'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Record Header'), array('controller' => 'student_record_headers', 'action' => 'add')); ?> </li>
	</ul>
</div>
