<form method="POST" id="associate_type_form">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php  //select_associate_type($con, @$associate_type_id);//select_associate_type($con, @$associate_type_id); //echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="associate_type_id" name="associate_type_id" value="<?php  if(!empty($associate_type_id)){ echo $associate_type_id;} ?>">
            
            <div class="field">
                <label>Associate type: *</label>
                <div class="data"><input type="text" class="a_text" id="asso_name" name="asso_name" value="<?php if(!empty($asso_name)){ echo $asso_name; }?>" placeholder="Associate type"></div>
            </div>
                                                                                                 
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="associate_type_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!--Show message using jquery--> 
         
