<center>
<table style="width:30%;border:2px solid gray;border-radius:10px;padding: 10px;">
    <tr> 
      <th width="30%" colspan="3" style='text-align:center'>  
           <img src="mains/viewuserimage" style="border:2px solid gray;width:200px;height:200px;">
      </th> 
      
   </tr>   
   <?php
   	if($currUser['role'] == 'Student'){ 
   ?>
   <tr> 
      <th width="30%"> 
           STUDENT NO.
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $currUser['student_no']?>
      </th> 
   </tr>     
   <tr> 
      <th width="30%"> 
           NAME
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $currUser['last_name'].", ".$currUser['first_name']." ".$currUser['middle_name']?>
      </th> 
   </tr>  
   <tr> 
      <th width="30%"> 
           SCHOOL-YEAR
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $currUser['SchoolYear']['school_year'];?>
      </th> 
   </tr>  
   <tr> 
      <th width="30%"> 
           YEAR LEVEL
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $this->Form->addOrdinalNumberSuffix($currUser['year_level'])." Year";?>
      </th> 
   </tr>  
   <tr> 
      <th width="30%"> 
           COURSE
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $currUser['Course']['course'];?>
      </th> 
   </tr>  
   <?php }else{?>
   <tr> 
      <th width="30%"> 
           NAME
      </th> 
      <th width="1"> 
           :
      </th> 
      <th style="text-align:left"> 
           <?php echo $currUser['last_name'].", ".$currUser['first_name']." ".$currUser['middle_name']?>
      </th> 
   </tr> 
   <?php }?>
</table>    
</div>    
</center>