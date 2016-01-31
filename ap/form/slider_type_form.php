<form method="POST" id="slider_type_add_edit">
    <div class="form_top"><!--Start Form-->
    
        <!--Hidden type input for pass award_id for updating  > -->
        <input type="hidden" id="slider_type_id" name="slider_type_id" value="<?php  if(!empty($slider_type_id)){ echo $slider_type_id;} ?>">
         <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>"> 
        <?php //select_slider_type($con, @$slider_type_id); ?>
        
        <div class="field">
            <label> Type name: *</label>
            <div class="data">
                <input type="text" class="a_text" id="st_name" name="st_name" value="<?php  if(!empty($st_name)){ echo $st_name;} ?>" 
                placeholder="Enter Name">
            </div>                        	
        </div>
        <div class="field">
            <label>Code: *</label>
            <div class="data">
                <input type="text" class="a_text" id="st_code" name="st_code" value="<?php  if(!empty($st_code)){ echo $st_code;} ?>" 
                placeholder="Enter code">
            </div>                        	
        </div>
                                                                                           
    </div><!--End form_top--> 
             
     
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="Clear" onClick="clearForm();" title="Clear form ">
            <input type="submit" class="a_button" id="slider_type_add_edit_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!-- display notification using jquery -->
