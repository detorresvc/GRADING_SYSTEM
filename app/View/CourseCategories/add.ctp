<div class="courseCategories form">
<?php echo $this->Form->create('CourseCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Course Category'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Course Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
