<form method="POST" id="item_type_form">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_type($con, @$item_type_id);//echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="item_type_id" name="item_type_id" value="<?php  if(!empty($item_type_id)){ echo $item_type_id;} ?>">
            
            <div class="field">
                <label>Item type: *</label>
                <div class="data"><input type="text" class="input a_text" id="item_type" name="item_type" value="<?php if(!empty($item_type)){ echo $item_type; }?>" placeholder="Item type"></div>
            </div>
                                                                                                
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_type_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
