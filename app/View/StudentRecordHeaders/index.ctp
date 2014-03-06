<h2><?php  echo __('Record List'); ?></h2>
        <?php 
        if($currUser['role'] == 'Admin'){
            echo $this->Form->create('StudentRecordHeader',array('url'=>array('controller'=>'StudentRecordHeaders','action'=>'search')));
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
            
        }
        ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('StudentRecordHeader.id','id'); ?></th>
			<th><?php echo $this->Paginator->sort('User.student_no','student no'); ?></th>
			<th><?php echo $this->Paginator->sort('User.first_name','first name'); ?></th>
			
			<th><?php echo $this->Paginator->sort('User.last_name','last name'); ?></th>
			
                        <th><?php echo $this->Paginator->sort('SchoolYear.school_year','School Year'); ?></th>
			<th><?php echo $this->Paginator->sort('StudentRecordHeader.semester','semester'); ?></th>
			<th><?php echo $this->Paginator->sort('StudentRecordHeader.created','created'); ?></th>
			<th><?php echo $this->Paginator->sort('StudentRecordHeader.modified','modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>	
        <?php  foreach ($users as $user): 
			//if(($currUser['role'] == 'Student' AND !empty($user['StudentRequest'])) OR $currUser['role'] == 'Admin' ){
		?>
	<tr>
		<td><?php echo h($user['StudentRecordHeader']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['student_no']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		
		<td><?php echo h($user['SchoolYear']['school_year']); ?>&nbsp;</td>
		<td><?php echo h($user['StudentRecordHeader']['semester']); ?>&nbsp;</td>
                
		<td><?php echo h($user['StudentRecordHeader']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['StudentRecordHeader']['modified']); ?>&nbsp;</td>
                
		<td class="actions">
                    <?php
                    if($currUser['role'] == 'Admin'){
                ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['StudentRecordHeader']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['StudentRecordHeader']['id'])); ?>
                        <?php //echo $this->Html->link(__('Send'), array('action' => 'sendtoemail', $user['StudentRecordHeader']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['StudentRecordHeader']['id']), null, __('Are you sure you want to delete # %s?', $user['StudentRecordHeader']['id'])); ?>
                      <?php }else {?>
                            <?php echo  $this->Html->link(__('View Grades'), array('controller'=>'StudentRecordHeaders','action' => 'mycurrentgrades', $user['StudentRecordHeader']['id']));?>
                    <?php echo  $this->Html->link(__('Print'), array('controller'=>'StudentRecordHeaders','action' => 'printgrade', $user['StudentRecordHeader']['id']));?>
                      <?php }?>
		</td>
              
                
	</tr>
<?php //} 
endforeach; ?>
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