<div class="users form">
<?php echo $this->Form->create('User',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
              echo $this->Form->hidden('MAX_FILE_SIZE',array('value'=>'10000','name'=>'MAX_FILE_SIZE'));
		
		echo $this->Form->input('username');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
                
	
                 echo $this->Form->input('image',array('type'=>'file','label'=>'Image ( jpg|png|gif ) 10kb'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_user', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'userlist')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
