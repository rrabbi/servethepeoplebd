<!--<h4 class="heading_color" style="font-weight:bold">CONTACT US:</h4>-->
<div class="contact_form_area">
    <form id="contact_form" role="form" method="POST">
    	<div class="row">
        	<div class="col-md-4 col-sm-4">
            	<div class="form-group">
                    <label for="Name">Name *</label>
                    <input type="text" class="form-control" id="visitor_name" name="visitor_name" placeholder="Enter name">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            	<div class="form-group">
                    <label for="Email">Email *</label>
                    <input type="text" class="form-control" id="visitor_email" name="visitor_email" placeholder="Enter email">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            	<div class="form-group">
                    <label for="Subject">Subject *</label>
                    <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Enter subject">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<div class="form-group">
                    <label for="Message">Message *</label>
                    <textarea class="form-control" id="visitor_message" rows="7" name="visitor_message" placeholder="Type Your Message "></textarea>                              
                </div>
            </div>
        </div>       
        
        
        <div class="form-group">
            <label for="Contact">Contact No (Optional)</label>
            <input type="text" class="form-control" id="visitor_contact" name="visitor_contact" placeholder="Enter contact no">
        </div>
        
        
        <input type="submit" class="btn btn-danger" id="contact_form_btn" value="Send" /> &nbsp; <label>* Required Fields</label>
                           
    </form>
</div>