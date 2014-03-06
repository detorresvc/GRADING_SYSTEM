
<?php echo $this->Form->create('Grade'); ?>
	<fieldset>
		<legend><?php echo __('Edit Grade'); ?></legend>
                	<dl>
	<dl>	
		<dt><?php echo __('Student No'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['User']['student_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['User']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['SchoolYear']['school_year']); ?>
			&nbsp;
		</dd>
		
                <dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordDetail']['StudentRecordHeader']['semester']); ?>
			&nbsp;
		</dd>
		
	</dl>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('student_record_detail_id');
                echo $this->Form->hidden('studentRecordHeaders.id',array('value'=>$details[0]['StudentRecordDetail']['StudentRecordHeader']['id']));
                
                
                echo $this->Form->input(
			'grading_type',
			array('options' => array(1=>'Prelim',2=>'Midterm',3=>'Pre Finals',4=>'finals'), 'default' => 1)
		);
                
		
		echo $this->Form->input('grade');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

