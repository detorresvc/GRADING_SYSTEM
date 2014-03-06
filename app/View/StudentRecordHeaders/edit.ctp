<?php echo $this->Form->create('StudentRecordHeader'); 


echo $this->Form->hidden('StudentRecordHeader.id',array('value'=>$details[0]['StudentRecordHeader']['id']));

?>
<h2><?php echo __('Record Header'); ?></h2>
	<dl>
		
		<dt><?php echo __('Student No'); ?></dt>
		<dd>
			<?php echo h($details[0]['User']['student_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['User']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($details[0]['User']['last_name']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('School Year'); ?></dt>
		<dd>
			<?php echo h($details[0]['SchoolYear']['school_year']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo h($details[0]['StudentRecordHeader']['semester']); ?>
			&nbsp;
		</dd>
		
	</dl>
<h2><?php echo __('Record Detail'); ?></h2>
  <table Style="width: 50%;">
<?php $i=0;?>
 <?php foreach ($details[0]['StudentRecordDetail'] as $detailRecords): ?>
 <tr>
                        <td>Subject <?php echo ($i+1); ?></td><td>
<?php  
    echo $this->Form->hidden('StudentRecordDetail.'.$i.'.id',array('value'=> $detailRecords['id']));
    echo $this->Form->input('StudentRecordDetail.'.$i.'.subject_id',array('label'=>false,'div'=>false,'default' => $detailRecords['subject_id']));
?>
                       </td>
                   </tr>
        <?php $i++;?>
 <?php endforeach; ?>
 <?php
 
    for($x=$i;$x<10;$x++){
        echo "<tr>
                        <td>Subject ".($x+1)."</td><td>";
        echo $this->Form->hidden('StudentRecordDetail.'.$x.'.id',array('value'=> 0));
        echo $this->Form->input('StudentRecordDetail.'.$x.'.subject_id',array('label'=>false,'div'=>false,'default' => 0));
        echo "</td>
                   </tr>";
    }

?>
       </table>
<?php echo $this->Form->end(__('Submit')); ?>
