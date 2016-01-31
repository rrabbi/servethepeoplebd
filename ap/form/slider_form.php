<form method="POST" id="slider_add_edit">
    <div class="form_top"><!--Start Form_top-->     
        <!--Hidden type input for pass slider_id for updating  > -->
        <input type="hidden" class="slider_id" id="slider_id" name="slider_id" value="<?php  if(!empty($slider_id)){ echo $slider_id;} ?>">
        <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
                                   
        <div class="form_left"> 
        	<div class="field">
                <label>Slider Type: *</label>
                <div class="data">
                    <?php select_slider_type($con, @$slider_type_id); ?>
                </div>                        	
            </div>           	
            <div class="field">
                <label>Title: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="s_title" name="s_title" value="<?php  if(!empty($s_title)){ echo $s_title;} ?>" 
                    placeholder="Enter Title">
                </div>                        	
            </div>
            <div class="field">
                <label>Serial: *</label>
                <div class="data">
                    <input type="text" class="a_text" id="s_serial" name="s_serial" value="<?php  if(!empty($s_serial)){ echo $s_serial;} ?>" 
                    placeholder="Enter Serial">
                </div>                        	
            </div>
            
            <div class="field">
                <label>Status: &nbsp; &nbsp;
                	<input type="checkbox" class="checkbox" <?php if(@$s_status == 1){echo 'checked="checked"';} ?> id="s_status" name="s_status" 
                    value="<?php if(!empty($s_status)){echo $s_status; }else{ echo 0; } ?>"> Show                
                </label>                        	
            </div>
            
            <!--<div class="field">
                <label>Text 1: </label>
                <div class="data">
                    <input type="text" class="a_text" id="s_text1" name="s_text1" value="<?php  //if(!empty($s_text1)){ echo $s_text1;} ?>" 
                    placeholder="Enter Text 1">
                </div>                        	
            </div>
            
            <div class="field">
                <label>Text 2:</label>
                <div class="data">
                    <input type="text" class="a_text" id="s_text2" name="s_text2" value="<?php  //if(!empty($s_text2)){ echo $s_text2;} ?>" 
                    placeholder="Enter Text 2">
                </div>                        	
            </div>-->
                                                                                                                                                               
        </div><!--End form_left-->
        
        <div class="form_right">       
            <div class="field">
                <label>File One:</label>
                <div class="data"><input type="file" class="a_text" id="slider_img" name="slider_img" onchange="readURL(this);"></div>
            </div>
            <div class="display_img">
           		<img id="show_img" src="<?php 
					if(!empty($slider_img)){ echo '../../files/slider/'.$slider_img;}else{ echo NO_IMG;} ?>" style="width:90px; max-height:90px;"> 
           </div>                                                                                                                                                                               
        </div><!--End form_right--> 
                                                                                           
    </div><!--End Form_top-->
          
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="New Entry" onClick="clearForm();" title="New Entry">
            <input type="submit" class="a_button" id="slider_add_edit_button" value="Update" title="Update Slider">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
    <span><span><!--Show message using jquery--> 
