<form action="" method="post" id="edit_user_data">
			<!--Hidden type input for pass user_id for updating  > -->
            <input type="hidden" class="user_id" id="user_id" name="user_id" value="<?php  if(!empty($user_id)){ echo $user_id;} ?>">
            
            <!--Only for allow Log-->
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //echo $page_data['allow_log']; //for test ?>
            
    <div class="form_top">
        <div class="form_left">            
           <div class="field">
                <label for="username">Username:</label><?php if(!empty($username)){echo $username;}?>
                
                <!--<input class="a_text" type="text" disabled="disabled" value="<?php //if(!empty($username)){echo $username;}?>" >
                <input class="a_text" type="hidden" name="username" id="username" value="<?php //if(!empty($username)){echo $username;}?>" >-->
           </div>
           <div class="field">
                <label for="email">Email:</label>
                <!--<input class="a_text" type="email" disabled="disabled" value="<?php //if(!empty($email)){echo $email;}?>" >-->
                <input class="a_text" type="email" name="email" id="email" value="<?php if(!empty($email)){echo $email;}?>"
                <?php if(empty($email)){echo 'disabled="disabled"';}?> >
           </div> 
           <div class="field">                
                <?php 
					if(!empty($role)){
						echo '<label for="dob">Role: '.display_role(@$role).'</label>';
						//select_user_role(@$role); 
						//echo display_role(@$role);
					}else{
						echo '<label for="dob">Role: *  No role</label> '; 	
					}
				?>
           </div>         
           <!--<div class="field">
                <label for="name">Name: *</label>
                <input class="a_text" type="text" name="name" id="name" required="required" 
                value="<?php //if(!empty($full_name)){echo $full_name;}?>" <?php //if(empty($full_name)){echo 'disabled="disabled"';}?> >
           </div>-->
           <!--<div class="field">
                <label for="dob">Date Of Birth: *</label>
                <input class="a_text" type="text" name="dob" id="dob" placeholder="dd-mm-yyyy" required="required" 
                value="<?php //if(!empty($dob)){echo $dob;}?>" <?php //if(empty($dob)){echo 'disabled="disabled"';}?> >
           </div>-->
        </div><!--form_left-->
        
        <div class="form_right">                    
           <div class="field">                
               	<input type="checkbox" id="active" name="active" style="float:left;" <?php if(@$active == 1){echo 'checked="checked"';} ?>
                value="<?php if(!empty($active)){echo $active; }else{ echo 0; } ?>" > 
               <label for="active" style="float:left; margin-left:10px;"> Active </label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="user_lock" name="user_lock" style="float:left;" <?php if(@$user_lock == 1){echo 'checked="checked"';} ?>
                value="<?php if(!empty($user_lock)){echo $user_lock; }else{ echo 0; } ?>" <?php //if(empty($user_lock)){echo 'disabled="disabled"';}?> > 
               <label for="user_lock" style="float:left; margin-left:10px;"> Unlock </label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="allow_email" name="allow_email" style="float:left;" <?php if(@$allow_email == 1){echo 'checked="checked"';} ?>
                value="<?php if(!empty($allow_email)){echo $allow_email; }else{ echo 0; } ?>" <?php //if(empty($allow_email)){echo 'disabled="disabled"';}?> > 
               <label for="allow_email" style="float:left; margin-left:10px;"> Allow email</label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="tac" name="tac" style="float:left;" <?php if(@$tac == 1){echo 'checked="checked"';} ?>
                value="<?php if(!empty($tac)){echo $tac; }else{ echo 0; } ?>" <?php //if(empty($tac)){echo 'disabled="disabled"';}?> > 
               <label for="tac" style="float:left; margin-left:10px;"> Accept <a href="#">Terms and Conditions</a></label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="send_email" name="send_email" value="0" style="float:left;" > 
               <label for="send_email" style="float:left; margin-left:10px;"> Send Confirmation </label>
           </div>
        </div><!--form_right-->
    </div><!--form_top-->
    
    <div class="form_bottom">
       <div class="field">
       		<input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input class="a_button" type="submit" id="edit_user_btn" value="Update" required="required" <?php if(empty($user_id)){echo 'disabled="disabled"';}?>>
       </div>
   	</div><!--registration_form_bottom-->
</form>
<span></span><!--Show message-->