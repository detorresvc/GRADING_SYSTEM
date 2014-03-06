<div class="petitions view">
<h2><?php echo __('Petition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo $this->Html->link($petition['Subject']['description'], array('controller' => 'subjects', 'action' => 'view', $petition['Subject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($petition['User']['last_name'].", ".$petition['User']['first_name'], array('controller' => 'users', 'action' => 'view', $petition['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Petition'), array('action' => 'edit', $petition['Petition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Petition'), array('action' => 'delete', $petition['Petition']['id']), null, __('Are you sure you want to delete # %s?', $petition['Petition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Petitions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Petition'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
