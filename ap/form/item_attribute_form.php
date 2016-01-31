<form method="POST" id="item_attribute_add_edit">
    <div class="form_top">
            <!--Only for allow Log-->            
    		<input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
    		<?php //select_item_attribute($con, @$i_attrib_id); //echo $page_data['allow_log']; //for test ?>
            <input type="hidden" id="i_attrib_id" name="i_attrib_id" value="<?php  if(!empty($i_attrib_id)){ echo $i_attrib_id;} ?>">
            
            <div class="field">
                <label>Attribute name: *</label>
                <div class="data"><input type="text" class="a_text" id="attribute_name" name="attribute_name" value="<?php if(!empty($attribute_name)){ echo $attribute_name; }?>" placeholder="Attribute name"></div>
            </div>
                                                                                                 
    </div><!--End form_top--> 
                 
    <div class="form_bottom">                   
        <div class="form_btn">
            <input type="button" class="a_button" onClick="clearForm();" value="Clear" />
            <input type="submit" class="a_button" id="item_attribute_button" value="Update" title="Update attribute">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span><span><!--Show message using jquery--> 
         
