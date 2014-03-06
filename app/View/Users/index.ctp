 <div class="users index">
	<h2><?php  echo __('Student List'); ?></h2>
         <?php 
            echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'search')));
            echo "Field : ". $this->Form->input('field',
                    array(
                          'options'=>array(
                                            'User.student_no'=>'Student No.',
                                            'User.last_name'=>'Last Name'
                              )
                        ,'div'=>false,'label'=>false,'value'=>@$this->request->params['named']['field']
                        ));
            echo " Where : ". $this->Form->input('where',array(
                'options'=>array(
                                            'eq'=>'equal',
                                            'lk'=>'like'
                              )
                        ,'div'=>false,'label'=>false,'value'=>@$this->request->params['named']['where']
            ));
            echo " Value : ". $this->Form->input('value',array('value'=>@$this->request->params['named']['value'],'div'=>false,'label'=>false));
            echo $this->Form->end(array('Value'=>'Search','div'=>false));
            
        
        ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('student_no'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
                        <th><?php echo $this->Paginator->sort('SchoolYear.id','School Year'); ?></th>
			<th><?php echo $this->Paginator->sort('year_level'); ?></th>
			<th><?php echo $this->Paginator->sort('Course.id','Course'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['student_no']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
                <td><?php echo h($user['SchoolYear']['school_year']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['year_level']); ?>&nbsp;</td>
                
		<td>
			<?php echo $this->Html->link($user['Course']['course'], array('controller' => 'courses', 'action' => 'view', $user['Course']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Student'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
