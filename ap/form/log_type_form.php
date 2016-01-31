<form method="POST" id="log_type_form">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="log_type_id" name="log_type_id" value="<?php  if(!empty($log_type_id)){ echo $log_type_id;} ?>">
            
            <div class="field">
                <label>Log type: *</label>
                <div class="data"><input type="text" class="input a_text" id="log_type_name" name="log_type_name" value="<?php if(!empty($log_type_name)){ echo $log_type_name; }?>" placeholder="Log type name"></div>
            </div>                                                                                    
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="log_type_button" value="Update" title="Update Log type">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
