<div class="serach_option_area" style="margin:0px 3px 3px 0px;">
    <ul>
    <!--<li><input type="text" name="edit_user_s_username" id="edit_user_s_username" value="" autocomplete="on" placeholder="Search by username"></li>--> 
        <li><input type="text" id="user_log_s_email" name="user_log_s_email"  value="" autocomplete="on" placeholder="Search by email..." ></li>
        <li><?php select_log_type($con) //select_user_log_type(); ?></li> 
        <li><input class="s_input" type="date" name="user_log_start_date" id="user_log_start_date" placeholder="yyyy-mm-dd" required="required"></li>
        <li><input class="s_input" type="date" name="user_log_end_date" id="user_log_end_date" placeholder="yyyy-mm-dd" required="required"></li>        
        <li><input type="button" id="user_log_search_button" style="width:auto" value="Search"></li>                                    
    </ul>
</div>