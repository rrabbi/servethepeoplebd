<form method="POST" id="item_user_type_form">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_user_type($con, @$i_user_type_id);//echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="i_user_type_id" name="i_user_type_id" value="<?php  if(!empty($i_user_type_id)){ echo $i_user_type_id;} ?>">
            
            <div class="field">
                <label>Item user type: *</label>
                <div class="data"><input type="text" class="input a_text" id="i_user_type" name="i_user_type" value="<?php if(!empty($i_user_type)){ echo $i_user_type; }?>" placeholder="Item user type"></div>
            </div>
                                                                                                
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_user_type_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
