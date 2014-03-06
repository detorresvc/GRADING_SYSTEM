<fieldset>
		<legend><?php echo __('Upload Grades'); ?></legend>
<?php


echo $this->Form->create('Utilitys', array('type' => 'file','url'=>array('controller'=>'utilitys','action'=>'uploadgrade')));
echo $this->Form->input('file', array('type' => 'file','label'=>false));
echo $this->Form->end('Upload');
?>
 <legend><?php echo __('Upload Students'); ?></legend>
 <?php
                
                
echo $this->Form->create('Utilitys', array('type' => 'file','url'=>array('controller'=>'utilitys','action'=>'uploadstudent')));
echo $this->Form->input('file', array('type' => 'file','label'=>false));
echo $this->Form->end('Upload');
?>
 <legend><?php echo __('Upload Subjects'); ?></legend>
 <?php

echo $this->Form->create('Utilitys', array('type' => 'file','url'=>array('controller'=>'utilitys','action'=>'uploadsubject')));
echo $this->Form->input('file', array('type' => 'file','label'=>false));
echo $this->Form->end('Upload');
?>
</fieldset>
