<?php 
$button = null;

if($currUser['role'] == 'Admin'){ ?>
<div class="petitions index">
<?php }?>
	<h2><?php echo __('Petitions'); ?></h2>
        <?php
        echo $this->Form->create('Petition',array('url'=>array('action'=>'approve_petitions')));
        ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<?php if($currUser['role'] == 'Admin'){?><th>#</th><?php } ?>
			<th><?php echo $this->Paginator->sort('subject_id'); ?></th>
			<th><?php echo h('Count'); ?></th>
                        <?php if($currUser['role'] == 'Admin'){ ?>
                        <th><?php echo h('Action'); ?></th>
                        <?php }?>
			
	</tr>
	<?php foreach ($petitions as $petition): ?>
	<tr>
		<?php if($currUser['role'] == 'Admin'){   $button = 'Approve';?>
                <td>
                        <?php echo $this->Form->checkbox('Petition.subject_id.'.$petition['Petition']['subject_id'],array('hiddenField'=>false))?>
                </td>   
                <?php } ?>
		<td>
			<?php echo $this->Html->link($petition['Subject']['description'], array('controller' => 'subjects', 'action' => 'view', $petition['Petition']['subject_id'])); ?>
                   
		</td>
		
		<td><?php echo h($petition[0]['petition_count']); ?>&nbsp;</td>
                
                <?php if($currUser['role'] == 'Admin'){ ?>
                <td class="actions"><?php echo $this->Html->link(__('Print'), array('action' => 'print_petition', $petition['Petition']['subject_id'])); ?>&nbsp;</td>
                <?php }?>
		
	</tr>
<?php endforeach; ?>
	</table>
        <?php echo $this->Form->end($button);?>
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
<?php if($currUser['role'] == 'Admin'){ ?>	
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Petition'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php }?>
