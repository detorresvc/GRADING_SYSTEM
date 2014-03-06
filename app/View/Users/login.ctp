<center>
    
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<table border="0">
   <tr>
       <td style="text-align:center;width:30%;">
           <div style="background: yellow;border:10px double navy;border-radius:80px 0px 80px 0px;box-shadow: 7px 7px 7px gray;"> 
             <center><h2 style="width:300px;background: yellow;"><?php echo __('LOG IN'); ?></h2><center>
             <?php

             //echo $this->Form->input('role',array('options'=>array('Student'=>'Student','Admin'=>'Admin'),'label'=>'AS','onclick'=>'changerole(this)'));

             echo $this->Form->input('username',array('label'=>array("text"=>'Username','id'=>'UsernameLabel')));

             echo $this->Form->input('password');


             ?>

             <?php echo $this->Form->end(__('Login')); ?>
          </div>   
       </td>
       <td style="text-align:center;width:70%;">
           <table>
               <tr>
                   <th style="text-align: center">
                        ANNOUNCEMENT
                   </th>    
               </tr>
                <tr>
                   <td>
                        1) Feb 22,2013 - special project final defense
                   </th>    
               </tr>
               <tr>
                   <td>
                        2) 
                   </th>    
               </tr>
           </table>    
       </td>
   </tr>    
    
</table>    
    
    
    

<?php

echo $this->Html->link('Yahoo', 'http://www.yahoo.com.ph',array('target'=>'_BLANK'	) ) ;

echo "&nbsp;&nbsp;&nbsp;";
echo $this->Html->link('Google', 'http://www.google.com',array('target'=>'_BLANK'	) ) ;

?>
</center>
<script>
    function changerole(el){
        if(el.value == 'Admin'){
            document.getElementById('UsernameLabel').innerHTML='Username';
        }
        else{
            document.getElementById('UsernameLabel').innerHTML='Student No.';
        }
    }
</script>