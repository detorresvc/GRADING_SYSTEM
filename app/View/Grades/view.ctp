
<h2><?php echo __('Grade'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($grade['Grade']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Student Record Detail'); ?></dt>
		<dd>
			<?php echo $this->Html->link($grade['StudentRecordDetail']['id'], array('controller' => 'student_record_details', 'action' => 'view', $grade['StudentRecordDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grading Type'); ?></dt>
		<dd>
			<?php echo h($grade['Grade']['grading_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grade'); ?></dt>
		<dd>
			<?php echo h($grade['Grade']['grade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($grade['Grade']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($grade['Grade']['modified']); ?>
			&nbsp;
		</dd>
	</dl>

