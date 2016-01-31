<form method="POST" id="config_page_add_edit">
    <div class="form_top">        
        <!--Hidden type input for pass page_id for updating  > -->
        <input type="hidden" class="page_id" id="page_id" name="page_id" value="<?php  if(!empty($page_id)){ echo $page_id;} ?>">
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>"><!--Only for allow Log-->
                      
        <div class="form_left">
            
           <div class="field">
                <label> Page Code: *</label>
                <div class="data"><input type="text" class="a_text" id="p_code" name="p_code" value="<?php if(!empty($p_code)){ echo $p_code;} ?>" placeholder="Enter Page code">
                </div>                        	
            </div>
            <div class="field">
                <label> Page Name: *</label>
                <div class="data"><input type="text" class="a_text" id="page_name" name="page_name" value="<?php if(!empty($page_name)){ echo $page_name;} ?>" placeholder="Enter page name">
                </div>                        	
            </div>
            <div class="field">
                <label> Title: *</label>
                <div class="data"><input type="text" class="a_text" id="title" name="title" value="<?php if(!empty($title)){ echo $title;} ?>" placeholder="Enter Page title">
                </div>                        	
            </div>
            <div class="field">
                <label>Page Details:</label>
                <div class="data"><textarea class="a_textarea" id="page_desc" name="page_desc" placeholder="Page description here" ><?php if(!empty($page_desc)){ echo $page_desc;} ?></textarea></div>
            </div><br>
                                                                                                                                                                    
        </div><!--End form_left-->
        
        <div class="form_right">             
            <div class="field">
                <label>Page keywords:</label>
                <div class="data"><textarea class="a_textarea" id="keywords" name="keywords" placeholder="Page keywords (keyword, keyword, keyword..... )" ><?php if(!empty($keywords)){ echo $keywords;} ?></textarea></div>
            </div> 
            <div class="field">                
               	<input type="checkbox" id="allow_log_value" name="allow_log_value" style="float:left;" <?php if(@$allow_log_value == 1){echo 'checked="checked"';} ?>
                value="<?php if(!empty($allow_log_value)){echo $allow_log_value; }else{ echo 0; } ?>" > 
               <label for="allow_log_value" style="float:left; margin-left:10px;"> Allow Logs</label>
           </div>
                                                                                                                                                                                   
        </div><!--End form_right--> 
                                                                                           
    </div><!--End form_top>-->
      
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="New Entry" onClick="clearForm();" title="New Entry">
            <input type="submit" class="a_button" id="config_page_add_edit_button" value="Update" title="Update">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
        <span><span><!--Show message using jquery--> 