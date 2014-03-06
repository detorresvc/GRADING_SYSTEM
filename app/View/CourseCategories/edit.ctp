<div class="courseCategories form">
<?php echo $this->Form->create('CourseCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Course Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CourseCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CourseCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Course Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
