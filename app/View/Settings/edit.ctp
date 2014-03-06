<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Setting'); ?></legend>
	<?php
        
                echo $this->Form->input('old_school_year_id',array('value'=>$this->request->data['Setting']['school_year_id'],'type'=>'hidden'));
                echo $this->Form->input('old_semester',array('value'=>$this->request->data['Setting']['semester'],'type'=>'hidden'));
            
		echo $this->Form->input('id');
                echo $this->Form->input('school_year_id');
		echo $this->Form->input(
			'semester',
			array('options' => array('1'=>'1st Sem',2=>'2nd Sem'), 'default' => 1)
		);
                
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Setting.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Setting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
