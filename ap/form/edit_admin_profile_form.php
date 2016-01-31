<form action="" method="post" id="edit_admin_profile">
    <div class="form_top">
    	<!--Only for allow Log-->            
    	<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    	<!--Hidden Input type-->
    	<input type="hidden" name="user_id" id="user_id" value="<?php if(!empty($user_id)){ echo $user_id;} ?>" >
        
        <div class="form_left">
        	<div class="field">
                <label for="email">email: <?php if(!empty($email)){ echo $email;} ?> </label>                
                <input type="hidden" name="email" id="email" value="<?php if(!empty($email)){ echo $email;} ?>">
           </div> 
           <div class="field">
                <label for="name">Name: *</label>
                <input class="a_text" type="text" name="user_name" id="user_name" value="<?php if(!empty($user_name)){ echo $user_name;} ?>" 
                <?php if(empty($user_id)){echo 'disabled="disabled"';}?> >
           </div>
           
           <div class="field">
                <label for="dob">Date Of Birth: </label>
                <input class="a_text" type="text" name="dob" id="dob" placeholder="dd-mm-yyyy" value="<?php if(!empty($dob)){ echo $dob;}?>" 
                <?php if(empty($user_id)){echo 'disabled="disabled"';}?> >
           </div>
           <div class="field">
                <label for="name">Contact: </label>
                <input class="a_text" type="text" name="user_contact" id="user_contact" value="<?php if(!empty($user_contact)){ echo $user_contact;} ?>" 
                <?php if(empty($user_id)){echo 'disabled="disabled"';}?> >
           </div>         
           
        </div><!--form_left-->
        
        <div class="form_right"> 
        	<div class="field">
                <label for="name">Address: </label>
                <textarea class="a_textarea" rows="1" name="user_address" id="user_address" 
				<?php if(empty($user_id)){echo 'disabled="disabled"';}?> ><?php if(!empty($user_address)){ echo $user_address;} ?></textarea>
           </div>
           <div class="field">
                <label for="name">Details: </label>
                <textarea class="a_textarea" rows="1" name="user_desc" id="user_desc" 
				<?php if(empty($user_id)){echo 'disabled="disabled"';}?> ><?php if(!empty($user_desc)){ echo $user_desc;} ?></textarea>
           </div>
           <div class="field">
                <label for="name">Picture: </label>
                <input class="a_text" type="file" name="user_img" id="user_img" onchange="readURL(this);" 
				<?php if(empty($user_id)){echo 'disabled="disabled"';}?> >
           </div>
           <div class="field">                
               	<input type="checkbox" id="send_email" name="send_email" value="0" style="float:left;"
                 <?php if(empty($user_id)){echo 'disabled="disabled"';}?> > 
               <label for="send_email" style="float:left; margin-left:10px;"> Send Confirmation </label>
           </div>
           <div class="display_img">
           		<img id="show_img" src="<?php 
					if(!empty($user_img)){ echo '../../files/profile/'.$user_img;}else{ echo NO_IMG;} ?>" style="width:90px; max-height:90px;"> 
           </div>
        </div><!--form_right-->
    </div><!--form_top-->
    
    <div class="form_bottom">
       <div class="field">
       		<input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input class="a_button" type="submit" id="edit_admin_profile_btn" value="Update" <?php if(empty($user_id)){echo 'disabled="disabled"';}?> >
       </div>
   	</div><!--registration_form_bottom-->
</form>
<span></span><!--Show message-->