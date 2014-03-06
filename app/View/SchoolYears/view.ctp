<div class="schoolYears view">
<h2><?php echo __('School Year'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schoolYear['SchoolYear']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($schoolYear['SchoolYear']['school_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($schoolYear['SchoolYear']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($schoolYear['SchoolYear']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School Year'), array('action' => 'edit', $schoolYear['SchoolYear']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete School Year'), array('action' => 'delete', $schoolYear['SchoolYear']['id']), null, __('Are you sure you want to delete # %s?', $schoolYear['SchoolYear']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List School Years'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Year'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Settings'), array('controller' => 'settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setting'), array('controller' => 'settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Record Headers'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Record Header'), array('controller' => 'student_record_headers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Settings'); ?></h3>
	<?php if (!empty($schoolYear['Setting'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('School Year Id'); ?></th>
		<th><?php echo __('Semester'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolYear['Setting'] as $setting): ?>
		<tr>
			<td><?php echo $setting['id']; ?></td>
			<td><?php echo $setting['school_year_id']; ?></td>
			<td><?php echo $setting['semester']; ?></td>
			<td><?php echo $setting['created']; ?></td>
			<td><?php echo $setting['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'settings', 'action' => 'view', $setting['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'settings', 'action' => 'edit', $setting['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'settings', 'action' => 'delete', $setting['id']), null, __('Are you sure you want to delete # %s?', $setting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setting'), array('controller' => 'settings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Student Record Headers'); ?></h3>
	<?php if (!empty($schoolYear['StudentRecordHeader'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('School Year Id'); ?></th>
		<th><?php echo __('Year Level'); ?></th>
		<th><?php echo __('Semester'); ?></th>
		<th><?php echo __('Course Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schoolYear['StudentRecordHeader'] as $studentRecordHeader): ?>
		<tr>
			<td><?php echo $studentRecordHeader['id']; ?></td>
			<td><?php echo $studentRecordHeader['user_id']; ?></td>
			<td><?php echo $studentRecordHeader['school_year_id']; ?></td>
			<td><?php echo $studentRecordHeader['year_level']; ?></td>
			<td><?php echo $studentRecordHeader['semester']; ?></td>
			<td><?php echo $studentRecordHeader['course_id']; ?></td>
			<td><?php echo $studentRecordHeader['status']; ?></td>
			<td><?php echo $studentRecordHeader['created']; ?></td>
			<td><?php echo $studentRecordHeader['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'student_record_headers', 'action' => 'view', $studentRecordHeader['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'student_record_headers', 'action' => 'edit', $studentRecordHeader['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'student_record_headers', 'action' => 'delete', $studentRecordHeader['id']), null, __('Are you sure you want to delete # %s?', $studentRecordHeader['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Student Record Header'), array('controller' => 'student_record_headers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
