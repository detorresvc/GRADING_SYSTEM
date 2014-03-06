<div class="studentRequests view">
<h2><?php  echo __('Student Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Student Record Header'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studentRequest['StudentRecordHeader']['id'], array('controller' => 'student_record_headers', 'action' => 'view', $studentRequest['StudentRecordHeader']['id'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Student'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRecordHeader']['User']['last_name'].", ".$studentRequest['StudentRecordHeader']['User']['first_name']." ".$studentRequest['StudentRecordHeader']['User']['middle_name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRecordHeader']['SchoolYear']['school_year']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRecordHeader']['semester']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRequest']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRequest']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRequest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($studentRequest['StudentRequest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Student Request'), array('action' => 'edit', $studentRequest['StudentRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Student Request'), array('action' => 'delete', $studentRequest['StudentRequest']['id']), null, __('Are you sure you want to delete # %s?', $studentRequest['StudentRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Student Record'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo ($currUser['role'] == 'Admin') ? $this->Html->link(__('New Student Record'), array('controller' => 'student_record_headers', 'action' => 'add')) : ''; ?> </li>
	</ul>
</div>
