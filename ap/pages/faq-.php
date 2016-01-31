<?php
	require_once 'core/init.php';
	$page_code = 110; //Fixed Page Code
	require_once 'core/page_setup.php';	
	require_once 'includes/all_header.php';
?>        
    <div class="container">   
        <div class="row">
            <div class="col-md-12">  
                <div class="row"><?php require_once 'includes/breadcrumbs.php'; ?></div>
            </div>
        </div>
    </div> 
    
    <div class="container">
    	<div class="row">
        	<div class="col-md-9">
            	<div class="row">
                	<!--<div class="panel panel-info">
                      <div class="panel-heading"> FAQ</div>
                      <div class="panel-body"> 
                      
                          
                      </div>
                    </div>--><!--end Pannel-->
                    
                    <h5 class="heading_color"><strong>FAQ</strong></h5>
                    <div class="gradient_border" style="width:100%"></div>
                    <br />
                    <div class="panel-group" id="accordion">
							<?php
                                $query_faq = $con->prepare("SELECT * FROM faq_mst WHERE faq_type=:faq_type AND faq_status=:faq_status ");
                                $query_faq->execute(array(':faq_type'=>1, ':faq_status'=>1)); //3 for job seeker 
                                while($row = $query_faq->fetch(PDO::FETCH_ASSOC)){
                                    echo '
                                        <div class="panel panel-default" style="background:#E7395B">
                                            <div class="panel-heading">
                                              <div class="panel-title">
                                                <a href="#collapse-'.$row['faq_id'].'" data-toggle="collapse" data-parent="#accordion">
                                                  '.$row['faq_question'].'
                                                </a>
                                              </div><!-- End panel title -->
                                              <div id="collapse-'.$row['faq_id'].'" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                  '.$row['faq_answer'].'
                                                </div>
                                              </div><!-- End Panel collapse -->
                                            </div>
                                        </div>';				
                                }								
                            ?>                                 
                     </div><!-- End panel group -->
                    
            	</div>    
            </div>
            
            <div class="col-md-3" >
            	<div class="row" style="margin-left:3px;">
					<?php require_once 'newsbox_vticker.php'; ?>
                </div>
            </div>
                        
        </div><!--End row-->       
    </div><!--end container-->
        

<?php require_once 'includes/all_footer.php'; ?>

        
    
    
    
       
