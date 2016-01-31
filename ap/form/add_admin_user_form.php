<form action="" method="post" id="add_admin_user">
	
    	<!--Only for allow Log-->            
    	<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    
    <div class="form_top">
        <div class="form_left"> 
           <div class="field">
                <label for="name">Name: *</label>
                <input class="a_text" type="text" name="user_name" id="user_name">
           </div>           
           <div class="field">
                <label for="email">Username: *</label>
                <input class="a_text" type="text" name="username" id="username">
           </div>         
           <div class="field">
                <label for="password">Password: *</label>
                <input class="a_text" type="password" name="password" id="password">
           </div>
           <div class="field">
                <label for="password_again">Password again: *</label>
                <input class="a_text" type="password" name="password_again" id="password_again">
           </div>
           <div class="field">
                <label for="email">Email: *</label>
                <input class="a_text" type="email" name="email" id="email">
           </div>           
           <div class="field">
                <label for="dob">Date Of Birth: </label>
                <input class="a_text" type="text" name="dob" id="dob" placeholder="dd-mm-yyyy" >
           </div>
           <div class="field">
                <label for="name">Contact: </label>
                <input class="a_text" type="text" name="user_contact" id="user_contact">
           </div>         
           
        </div><!--form_left-->
        
        <div class="form_right"> 
        	<div class="field">
                <label for="name">Address: </label>
                <textarea class="a_textarea" rows="1" name="user_address" id="user_address"></textarea>
           </div>
           <div class="field">
                <label for="name">Details: </label>
                <textarea class="a_textarea" rows="1" name="user_desc" id="user_desc"></textarea>
           </div>
           <div class="field">
                <label for="name">Picture: </label>
                <input class="a_text" type="file" name="user_img" id="user_img" onchange="readURL(this);">
           </div>
        	
           <!--<div class="field">
                <label for="dob">Role: *</label>
                <?php //select_user_role(@$role); ?>
           </div>-->          
           <div class="field">                
               	<input type="checkbox" id="active" name="active" value="0" style="float:left;"> 
               <label for="active" style="float:left; margin-left:10px;"> Active </label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="user_lock" name="user_lock" value="0" style="float:left;"> 
               <label for="user_lock" style="float:left; margin-left:10px;"> Unlock </label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="allow_email" name="allow_email" value="0" style="float:left;"> 
               <label for="allow_email" style="float:left; margin-left:10px;"> Allow email</label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="tac" name="tac" value="0" style="float:left;"> 
               <label for="tac" style="float:left; margin-left:10px;"> Accept <a href="#">Terms and Conditions</a></label>
           </div>
           <div class="field">                
               	<input type="checkbox" id="send_email" name="send_email" value="0" style="float:left;"> 
               <label for="send_email" style="float:left; margin-left:10px;"> Send Confirmation </label>
           </div>
           <div class="display_img">
           		<img id="show_img" src="<?php echo NO_IMG;?>" style="width:90px; max-height:90px;"> 
           </div>
        </div><!--form_right-->
    </div><!--form_top-->
    
    <div class="form_bottom">
       <div class="field">
       		<input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input class="a_button" type="submit" id="add_admin_user_btn" value="Update" required="required">
       </div>
   	</div><!--registration_form_bottom-->
</form>
<span></span><!--Show message-->