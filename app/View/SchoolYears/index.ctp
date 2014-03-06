<div class="schoolYears index">
	<h2><?php echo __('School Years'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('school_year'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolYears as $schoolYear): ?>
	<tr>
		<td><?php echo h($schoolYear['SchoolYear']['id']); ?>&nbsp;</td>
		<td><?php echo h($schoolYear['SchoolYear']['school_year']); ?>&nbsp;</td>
		<td><?php echo h($schoolYear['SchoolYear']['created']); ?>&nbsp;</td>
		<td><?php echo h($schoolYear['SchoolYear']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $schoolYear['SchoolYear']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $schoolYear['SchoolYear']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $schoolYear['SchoolYear']['id']), null, __('Are you sure you want to delete # %s?', $schoolYear['SchoolYear']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New School Year'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Settings'), array('controller' => 'settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting'), array('controller' => 'settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Record Headers'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Record Header'), array('controller' => 'student_record_headers', 'action' => 'add')); ?> </li>
	</ul>
</div>
