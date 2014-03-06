<h2><?php  echo __('Record Header'); ?></h2>
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
<input type="button" value="Change View" style="height: 15px" onclick='changeView()'>

<script>
        function changeView(){
            if(document.getElementById('view2').style.display == 'none'){
                 document.getElementById('view1').style.display='none';
                 document.getElementById('view2').style.display='';
            }
            else{
                document.getElementById('view1').style.display='';
                document.getElementById('view2').style.display='none';
            }
        }
    </script>
<table cellpadding="0" cellspacing="0"  id="view1">
	<tr>
			<th><?php echo __('Subject');  ?></th>
			<th><?php echo __('Unit');  ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>	
        <?php foreach ($details[0]['StudentRecordDetail'] as $detailRecords): ?>
        
	<tr>
		<td style="color:blue;font-weight:bold;"><?php echo h($detailRecords['Subject']['code'].' - '.$detailRecords['Subject']['description']); ?>&nbsp;</td>
		<td style="color:blue;font-weight:bold;"><?php echo h($detailRecords['Subject']['unit']); ?>&nbsp;</td>
		
		<td class="actions">
			
			<?php echo $this->Html->link(__('Add Grade'), array('controller'=>'Grades','action' => 'add', $detailRecords['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $detailRecords['id'],$this->request['pass'][0]), null, __('Are you sure you want to delete # %s?', $detailRecords['id'])); ?>
		</td>
	</tr>
        <tr>
                <td colspan="3">
                    <table width="60%" border="1" cellpadding="0" cellspacing="0" style="width:60%"> 
                            <tr>
                                <th><?php echo __('ID');  ?></th>
                                <th><?php echo __('Type');  ?></th>
                                <th><?php echo __('Grade');  ?></th>
								<th><?php echo __('Created');  ?></th>
								<th><?php echo __('Modified');  ?></th>
                                <th><?php echo __('Actions');  ?></th>
                            </tr>
                            <?php foreach ($detailRecords['Grade'] as $grade): ?>
                            <tr>
                                <td><?php echo h($grade['id']); ?>&nbsp;</td>
                               <td><?php 
                                         switch($grade['grading_type'])      {
                                             case 1 : echo "Prelim"; break;
                                             case 2 : echo "Midterm"; break;
                                             case 3 : echo "Pre Finals"; break;
                                             case 4 : echo "Finals"; break;
                                         }
                               ?>&nbsp;</td>
                               <td><?php echo h($grade['grade']); ?>&nbsp;</td>
							    <td><?php echo h($grade['created']); ?>&nbsp;</td>
								<td><?php echo h($grade['modified']); ?>&nbsp;</td>
                               <td class="actions"><?php echo $this->Html->link(__('Edit'), array('controller'=>'Grades','action' => 'edit', $grade['id'])); ?>
                               <?php echo $this->Form->postLink(__('Delete'), array('controller'=>'Grades','action' => 'delete', $grade['id'],$this->request['pass'][0]), null, __('Are you sure you want to delete # %s?', $grade['id'])); ?></td>
                               
                            </tr>
                            <?php endforeach; ?>
                    </table>
                </td>
        </tr>
        
<?php endforeach; ?>
	</table>

<table id="view2" style="display:none">
    <tr>
        <th ><?php echo h('Subject');  ?></th>
        <th><?php echo h('Unit');  ?></th>
        <th><?php echo h('Prelim');  ?></th>
        <th><?php echo h('Midterm');  ?></th>
        <th><?php echo h('Pre Finals');  ?></th>
        <th><?php echo h('Finals');  ?></th>
        <th><?php echo h('Gen. Ave.');  ?></th>
        
    </tr>
         <?php $sumD = 0; foreach ($details[0]['StudentRecordDetail'] as $detailRecords): ?>
            <tr>
                <td><?php echo h($detailRecords['Subject']['code'].' - '.$detailRecords['Subject']['description']); ?></td>
                <td style="text-align: right"><?php echo h($detailRecords['Subject']['unit']); ?></td>
                <?php 
                    $accGrade = 0;
                    $i=0;
                    $sumC = 0;
                    $sumD += (float)$detailRecords['Subject']['unit'];
                    
                    foreach ($detailRecords['Grade'] as $grade): 
                         
                       $C =   (float)$grade['grade']*(float)$detailRecords['Subject']['unit'];
                       $sumC += $C;
                      $accGrade +=  (float)$grade['grade'];
                      
                      if((float)$grade['grade'] <> 0){
                          $i++;
                      }
                        
                ?>
                    <td style="text-align: right"><?php echo h($grade['grade']); ?></td>
                <?php 
                    endforeach; 
                    
                    if((int)$i <> 0){
                        $ave = $accGrade/(int)$i;
                    }
                    else{
                        $ave =0;
                    }
                ?>   
                    <td style="text-align: right"><?php echo h(number_format($ave,2)); ?></td>
            </tr>
         <?php endforeach; ?>   
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><div style="size:20px;font-weight:bold;">GWA:</div>    </td>
              <td style="text-align: right"><div style="size:20px;font-weight:bold;"><?php echo h(number_format($sumC/$sumD,2)); ?></div>    </td>
          </tr>    
</table>

    
    