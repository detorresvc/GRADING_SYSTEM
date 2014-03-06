<div class="users form">
<?php echo $this->Form->create('User',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
                echo $this->Form->hidden('MAX_FILE_SIZE',array('value'=>'10000','name'=>'MAX_FILE_SIZE'));
                
				echo $this->Form->hidden('role',array('value'=>'Admin'));
				/*
                 echo $this->Form->input(
			'role',
			array('options' => array('Admin'=>'Admin','Student'=>'Student'), 'default' => 'Student','onchange'=>'changerole(this)')
		);*/
echo $this->Form->input('username',array('div'=>array('id'=>'usernameDiv'),'css'=>array('display'=>'none')));
                
		
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('last_name');
                
		
                
                 echo $this->Form->input('image',array('type'=>'file','label'=>'Image ( jpg|png|gif ) 10kb'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'userlist')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script>
    function changerole(el){
        if(el.value == 'Admin'){
            document.getElementById('UserStudentNo').removeAttribute('required');
document.getElementById('studentNoDiv').style.display='none';

document.getElementById('usernameDiv').style.display='';
        


        }
        else{
            document.getElementById('UserStudentNo').setAttribute('required', 'required');
document.getElementById('studentNoDiv').style.display='';

document.getElementById('usernameDiv').style.display='none';
       


        }
    }
</script>    
