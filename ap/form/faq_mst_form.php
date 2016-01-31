<form method="POST" id="faq_add_edit" style="height:320px; margin-top:5px; overflow:auto">
    <div class="form_top"><!--Start Form_top--> 
    
        <!--Hidden type input for pass office_id for updating  > -->
        <input type="hidden" class="faq_id" id="faq_id" name="faq_id" value="<?php  if(!empty($faq_id)){ echo $faq_id;} ?>">
        <!--Only for allow Log-->
        <input type="hidden" id="allow_log" name="allow_log" value="<?php  if(!empty($page_data['allow_log'])){ echo $page_data['allow_log'];} ?>">
                                   
        
        	<div class="field">
                <label>Status: 
                    <input type="checkbox" class="checkbox" <?php if(@$faq_status == 1){echo 'checked="checked"';} ?> id="faq_status" name="faq_status" 
                    value="<?php if(!empty($faq_status)){echo $faq_status; }else{ echo 0; } ?>"> Show
                </label>                        	
            </div>
            <div class="field">
                <label> FAQ Tyee: *</label>
                <div class="data">
                    <?php
						//Select option for login attempt		
						echo '<select class="input_option" name="faq_type" id="faq_type">';
						echo '<option value="0" hidden="hidden">--Select FAQ Type-- </option>';
							echo '<option ';
								if(@$faq_type == 1){ echo 'selected="selected"';} 
							echo 'value="1">User</option> ';										
							echo '<option ';
								if(@$faq_type == 2){ echo 'selected="selected"';}
							echo 'value="2">Visitor</option> ';							
						echo '</select>';
					 ?>
                </div>                        	
            </div>            
           <div class="field">
                <label> Question: *</label>
                <div class="data">
                    <textarea class="textarea" id="faq_question" name="faq_question" placeholder="Your Question"><?php if(!empty($faq_question)){ echo $faq_question;} ?></textarea>
                </div>                        	
            </div> 
            <div class="field">
                <label> Answer: *</label>
                <div class="data">
                    <textarea class="textarea" id="faq_answer" name="faq_answer" placeholder="Answer your question"><?php  if(!empty($faq_answer)){ echo $faq_answer;} ?></textarea>
                </div>                        	
            </div>    

	</div><!--End Form_top-->  
       
    <div class="form_bottom">
        <div class="field">
            <input type="button" class="a_button" value="New Entry" onClick="clearForm();" title="New Entry">
            <input type="submit" class="a_button" id="faq_add_edit_button" value="Update" title="Update FAQ">                     
        </div>                                            
    </div> <!--End form_bottom --> 
</form>
<span></span><!--Show message using jquery--> 
