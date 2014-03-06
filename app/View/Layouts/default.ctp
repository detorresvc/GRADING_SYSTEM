<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'GRADING SYSTEM :: VER 1.0');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
                echo $this->Html->css('menu');
                echo $this->Html->script('jquery');
                echo $this->Html->script('menu');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    
	<div id="container">
            <div id="header" style="background:black ;padding:0;box-shadow: 7px 7px 7px #888888;border-radius:15px 0px 0px 0px;">
			
                    <div id="copyright" ><a href="http://apycom.com/">Apycom jQuery Menus</a></div>
          <?php
          if(!empty($currUser)){
		  
          ?>          
                    <div style='background:yellow;color:#003d4c;font-weight:bold;margin:0px;font-size:15px;border-radius:15px 0px 0px 0px;'>
						<table border='0' cellpadding='0' cellspacing='0' style='background:yellow;border-radius:15px 0px 0px 0px;'>
							<tr >
								<td rowspan='4' width='1'>
								<?php echo $this->Html->image('Sti_logo.JPG', array('alt' => 'STI'));?>
								</td>
								
							</tr>
							<tr>
							<td style='background:yellow;'>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WELCOME : <?php echo $currUser['role'].", ".$currUser['first_name']." ".$currUser['last_name']?>  <br> 
								</td>
								</tr>
							<tr>
								<td style='background:yellow;'>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Year <?php echo $this->Session->read('SchoolYear.school_year'); ?><br> 
								</td>
								</tr>
							<tr>
								<td style='background:yellow;'>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Form->addOrdinalNumberSuffix($this->Session->read('Setting.semester'))." Semester"?><br> 
								</td>
							</tr>
						</table>
					
                          
                          
                          
                    </div>
                    <br>
                    
			<div id="menu">
         <?php if($currUser['role'] == 'Admin'){?>                   
                <ul class="menu" >
                        <li class="last">
                                <?php echo $this->Html->link($this->Html->tag('span','Home'),array('controller'=>'main','action'=>'index'),array('class'=>'parent','escape'=>false));?>
                            </a>
                            <div>
                                <ul>

                                    <li>
                                        <?php echo $this->Html->link($this->Html->tag('span','Settings'),array('controller'=>'settings','action'=>'index'),array('escape'=>false));?>
                                        
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link($this->Html->tag('span','Upload'),array('controller'=>'utility','action'=>'upload'),array('escape'=>false));?>
                                        
                                    <li>
                                           <?php echo $this->Html->link($this->Html->tag('span','School Year'),array('controller'=>'schoolYears','action'=>'index'),array('escape'=>false));?>
                                        </li>
										 <li>
                                           <?php echo $this->Html->link($this->Html->tag('span','Form Templates'),array('controller'=>'utilitys','action'=>'formtemplate'),array('escape'=>false));?>
                                        </li>
                                </ul>
                            </div>
                        </li>
                         <li class="last"> <?php echo $this->Html->link($this->Html->tag('span','Maintenance'),'#',array('class'=>'parent','escape'=>false));?></a>
                            <div>
                                <ul>

                                     <li><a href="#" class="parent"><span>Users</span></a>
                                        <div><ul>

                                            <li> <?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'users','action'=>'userlist'),array('escape'=>false));?></li>
                                            <li> <?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'users','action'=>'add_user'),array('escape'=>false));?></li>
                                        </ul></div>
                                    </li>
                                    <li><a href="#" class="parent"><span>Students</span></a>
                                        <div><ul>

                                            <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'users','action'=>'index'),array('escape'=>false));?></li>
                                            <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'users','action'=>'add'),array('escape'=>false));?></li>
                                        </ul></div>
                                    </li>
                                     <li><a href="#" class="parent"><span>Courses</span></a>
                                        <div><ul>

                                            <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'courses','action'=>'index'),array('escape'=>false));?></li>
                                            <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'courses','action'=>'add'),array('escape'=>false));?></a></li>
                                        </ul></div>
                                    </li>
                                    <li><a href="#" class="parent"><span>Subjects</span></a>
                                        <div><ul>

                                            <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'subjects','action'=>'index'),array('escape'=>false));?></li>
                                            <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'subjects','action'=>'add'),array('escape'=>false));?></li>
                                        </ul></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li><a href="#" class="parent"><span>Student Records</span></a>
                            <div><ul>

                                <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'StudentRecordHeaders','action'=>'index'),array('escape'=>false));?></li>
                                <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'StudentRecordHeaders','action'=>'add'),array('escape'=>false));?></li>
                            </ul></div>
                        </li>
<!--                        <li><a href="#" class="parent"><span>Student Requests <?php  if((int)$pendingRequest <> 0){ ?><font style='background:red;border-radius:2px 2px 2px 2px;'>&nbsp;&nbsp;<blink><?php echo (int)$pendingRequest?>&nbsp;&nbsp;</blink></font><?php }?></span></a>
                            <div><ul>

                                <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'studentrequests','action'=>'index'),array('escape'=>false));?></li>
                                <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'studentrequests','action'=>'add'),array('escape'=>false));?></li>
                            </ul></div>
                        </li>-->
						 <li><a href="#" class="parent"><span>Petitions </span></a>
                            <div><ul>
						<li>
                                                    <?php echo $this->Html->link($this->Html->tag('span','Count'),array('controller'=>'petitions','action'=>'petition_count'),array('escape'=>false));?></li>
                                <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'petitions','action'=>'index'),array('escape'=>false));?></li>
                                <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'petitions','action'=>'add'),array('escape'=>false));?></li>
                            </ul></div>
                        </li>
                        <li class="last"><?php echo $this->Html->link($this->Html->tag('span','Log Out'),array('controller'=>'users','action'=>'logout'),array('escape'=>false));?></li>
                    </ul>
                </div>
        <?php }else{?>
                     <ul class="menu">
                        <li class="last"> <?php echo $this->Html->link($this->Html->tag('span','Home'),array('controller'=>'main','action'=>'index'),array('class'=>'parent','escape'=>false));?>
						  <div><ul><li>
                                           <?php echo $this->Html->link($this->Html->tag('span','Form Templates'),array('controller'=>'utilitys','action'=>'formtemplate'),array('escape'=>false));?>
                                        </li></ul></div>
						</li>
                        <li><a href="#" class="parent"><span>Student Records</span></a>
                            <div><ul>
				<li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'StudentRecordHeaders','action'=>'index'),array('escape'=>false));?></li>				
                                <li>
                                    
                                    <?php echo $this->Html->link($this->Html->tag('span','My Current Grades'),array('controller'=>'StudentRecordHeaders','action'=>'mycurrentgrades'),array('escape'=>false));?>
                                    </li>
                                
                            </ul></div>
<!--                            <li><a href="#" class="parent"><span>Student Requests</span></a>
                            <div><ul>
							
                               <li><?php echo $this->Html->link($this->Html->tag('span','List'),array('controller'=>'studentrequests','action'=>'index'),array('escape'=>false));?></li>
                                <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'studentrequests','action'=>'add'),array('escape'=>false));?></li>
                            </ul></div>
							
                        </li>-->
                        </li>
						<li><a href="#" class="parent"><span>Petitions </span></a>
                            <div><ul>

                              <li>
                                                    <?php echo $this->Html->link($this->Html->tag('span','Count'),array('controller'=>'petitions','action'=>'petition_count'),array('escape'=>false));?></li>
                                
                                <li><?php echo $this->Html->link($this->Html->tag('span','New'),array('controller'=>'petitions','action'=>'add'),array('escape'=>false));?></li>
                            </ul></div>
                        </li>
                        <li class="last"><?php echo $this->Html->link($this->Html->tag('span','Log Out'),array('controller'=>'users','action'=>'logout'),array('escape'=>false));?></li>
                    </ul>
                </div>
            <?php }?>
        <?php }else{?>
            
		<div style='background:yellow;color:#003d4c;font-weight:bold;margin:0px;font-size:15px;border-radius:15px 0px 0px 0px;box-shadow: 7px 7px 7px #888888;'>
						<table border='0' cellpadding='0' cellspacing='0' style='background:yellow;border:none;border-radius:15px 0px 0px 0px;'>
							<tr >
								<td rowspan='4' width='1'>
								<?php echo $this->Html->image('Sti_logo.JPG', array('alt' => 'STI'));?>
								</td>
								
							</tr>
							</table>
			</div>
		<?php }?>
		</div>
        <div id="content" style="box-shadow: 7px 7px 7px #888888;height:500px;overflow: auto">

			<?php echo $this->Session->flash(); ?>
                        <?php echo  $this->Session->flash('auth');?>
			<?php echo $this->fetch('content'); ?>
		</div>
        <div id="footer" style="border-radius:0px 0px 15px 15px;box-shadow: 7px 7px 7px #888888;background:silver;color:black;">
			Copyright (c) 2014 STI Caloocan All rights reserved.
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>