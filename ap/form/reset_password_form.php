<form method="POST" id="reset_password_form">
    <div class="form_top">
    		<!--Only for allow Log-->
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //echo $page_data['allow_log']; //for test ?>
            
            <div class="field">
                <label>Email: *</label>
                <div class="data"><input type="text" class="input a_text" id="email" name="email" value="" placeholder="Enter email"></div>
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
            <div class="field">                
               	<input type="checkbox" id="send_email" name="send_email" value="0" style="float:left;"> 
               <label for="send_email" style="float:left; margin-left:10px;"> Send Confirmation</label>
           </div>  </br>                                                                                   
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="reset_password_button" value="Update" title="Reset Password">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
