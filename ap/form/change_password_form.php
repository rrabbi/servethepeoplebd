<form method="POST" id="change_password_form">
    <div class="form_top">
            <!--Only for allow Log-->
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //echo $page_data['allow_log']; //for test ?>
            
            <div class="field">
                <label>Change Password For: <?php if(!empty($user_data['email'])) echo $user_data['email']; ?></label>                        	
            </div>
            <div class="field">
                <label>Current Password: *</label>
                <div class="data"><input type="text" class="input a_text" id="current_password" name="current_password" value="" placeholder="Your Current Password"></div>
            </div>
            <div class="field">
                <label>Password: *</label>
                <div class="data"><input type="text" class="input a_text" id="password" name="password" value="" placeholder="New Password">                        
                </div>                        	
            </div>
            <div class="field">
                <label>Retype Password: *</label>
                <div class="data"><input type="text" class="input a_text" id="retype_password" name="retype_password" value="" placeholder="Retype New password">                        
                </div>                        	
            </div>                                                                                      
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="change_password_button" value="Update" title="Change Password">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
