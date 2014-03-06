<div class="courseCategories view">
<h2><?php echo __('Course Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($courseCategory['CourseCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($courseCategory['CourseCategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($courseCategory['CourseCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($courseCategory['CourseCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course Category'), array('action' => 'edit', $courseCategory['CourseCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course Category'), array('action' => 'delete', $courseCategory['CourseCategory']['id']), null, __('Are you sure you want to delete # %s?', $courseCategory['CourseCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
