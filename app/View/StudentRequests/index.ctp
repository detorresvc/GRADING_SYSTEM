<div class="studentRequests index">
	<h2><?php   echo __('Student Requests'); ?></h2>
        <?php 
            echo $this->Form->create('StudentRequest',array('url'=>array('controller'=>'StudentRequests','action'=>'search')));
            echo "Field : ". $this->Form->input('field',
                    array(
                          'options'=>array(
                                            'User.student_no'=>'Student No.',
                                            'User.last_name'=>'Last Name',
                                            'StudentRequest.status'=>'Status'
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
			<th><?php echo $this->Paginator->sort('User.student_no','Student No.'); ?></th>
			
                        <th><?php echo $this->Paginator->sort('User.last_name','Student Name'); ?></th>
                        <th><?php echo $this->Paginator->sort('StudentRecordHeader.school_year_id','School Year'); ?></th>
                        <th><?php echo $this->Paginator->sort('StudentRecordHeader.semester','Semester'); ?></th>
			<th><?php echo $this->Paginator->sort('reason'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php  foreach ($studentRequests as $studentRequest): 
            
                
            ?>
	<tr>
		<td><?php echo h($studentRequest['User']['student_no']); ?>&nbsp;</td>
                <td><?php echo h($studentRequest['User']['last_name'].", ".$studentRequest['User']['first_name']." ".$studentRequest['User']['middle_name']); ?>&nbsp;</td>
                <td><?php echo h($studentRequest['StudentRecordHeader']['SchoolYear']['school_year']); ?>&nbsp;</td>
                <td><?php echo h($studentRequest['StudentRecordHeader']['semester']); ?>&nbsp;</td>
		<td><?php echo h($studentRequest['StudentRequest']['reason']); ?>&nbsp;</td>
		<td><?php echo ($studentRequest['StudentRequest']['status'] == 'O') ? h('Open') : h('Approved');  h($studentRequest['StudentRequest']['status']); ?>&nbsp;</td>
		<td><?php echo h($studentRequest['StudentRequest']['created']); ?>&nbsp;</td>
		<td><?php echo h($studentRequest['StudentRequest']['modified']) ?>&nbsp;</td>
                <td class="actions">
                <?php 
                if($studentRequest['StudentRequest']['status'] == 'A' AND strtotime($studentRequest['StudentRequest']['approved_date']) < strtotime(date('Y-m-d G:i:s',strtotime('-2 Days')))){
                   echo h('Expired');
                }
                 else{
                ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $studentRequest['StudentRequest']['id'])); ?>
			<?php 
                            if($currUser['role'] == 'Admin')
                                echo $this->Html->link(__('Edit'), array('action' => 'edit', $studentRequest['StudentRequest']['id']));
                            else
                                echo ($studentRequest['StudentRequest']['status'] == 'O') ? $this->Html->link(__('Edit'), array('action' => 'edit', $studentRequest['StudentRequest']['id'])) : ''; 
                            
                        ?>
			<?php echo ($studentRequest['StudentRequest']['status'] == 'O') ? $this->Form->postLink(__('Delete'), array('action' => 'delete', $studentRequest['StudentRequest']['id']), null, __('Are you sure you want to delete # %s?', $studentRequest['StudentRequest']['id'])) : ''; ?>
                    <?php echo ($currUser['role'] == 'Student' && $studentRequest['StudentRequest']['status'] == 'A') ?  $this->Html->link(__('View Grades'), array('controller'=>'StudentRecordHeaders','action' => 'mycurrentgrades', $studentRequest['StudentRequest']['student_record_header_id'])) : '';?>
                    <?php  echo ($studentRequest['StudentRequest']['status'] == 'A' && $currUser['role'] == 'Student') ?   $this->Html->link(__('Print'), array('controller'=>'StudentRecordHeaders','action' => 'printgrade', $studentRequest['StudentRequest']['student_record_header_id'])) : '';?>
		
                <?php }?>
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
		<li><?php echo $this->Html->link(__('New Student Request'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Student Record'), array('controller' => 'student_record_headers', 'action' => 'index')); ?> </li>
		<li><?php echo ($currUser['role'] == 'Admin') ? $this->Html->link(__('New Student Record'), array('controller' => 'student_record_headers', 'action' => 'add')) : ''; ?> </li>
	</ul>
</div>
