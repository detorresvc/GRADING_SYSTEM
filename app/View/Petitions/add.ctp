<?php if($currUser['role'] == 'Admin'){ ?>
<div class="petitions form">
<?php echo $this->Form->create('Petition'); ?>
	<fieldset>
		<legend><?php echo __('Add Petition'); ?></legend>
             <table>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Subject
                    </th>
                </tr>
                
                <?php  foreach ($subjects as $index => $subject):?>
                <tr>
                    <td>
                       <?php echo $this->Form->checkbox('.subject_id',array('value'=>$subject['Subject']['id'],'hiddenField'=>false))?>
                    </td>
                    <td>
                        <?php echo h($subject['Subject']['description'])?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>    
	<?php
        
           
	//	echo $this->Form->input('subject_id');
	//	echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Petitions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php }else{?>
<?php echo $this->Form->create('Petition'); ?>
	<fieldset>
		<legend><?php echo __('Add Petition'); ?></legend>
            <table>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Subject
                    </th>
                </tr>
                
                <?php   foreach ($subjects as $index => $subject): ?>
                <tr>
                    <td>
                        <?php echo $this->Form->checkbox('.subject_id',array('value'=>$subject['Subject']['id'],'hiddenField'=>false))?>
                    </td>
                    <td>
                        <?php echo h($subject['Subject']['description'])?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>    
	<?php
		//echo $this->Form->input('subject_id');
		
	?>
	</fieldset>
<?php  echo $this->Form->end(__('Submit')); ?>

<?php }?>
