<?php


function add_news()
		{



 if ( isset ( $_POST['add_news'] ) ){
        
    	 global $wpdb;
    	
        $news_category             =   stripslashes($_POST['news_category']);
        $news_title1      		   =   stripslashes($_POST['news_title1']);
        $news_title2      		   =   stripslashes($_POST['news_title2']);
        $news_title3      		   =   stripslashes($_POST['news_title3']);
        $news_title4      		   =   stripslashes($_POST['news_title4']);
        $news_title5      		   =   stripslashes($_POST['news_title5']);
        $news_date				   =   date("Y-m-d H:i:s");  
       //$success_message          = CONTEST_CREATED_SUCC_MESS;
        

        // Prepare array for insertion/updation
        	$prepare_array1 = array (
            
                            	'news_category'			 => $news_category, 
                            	'news_title'    => $news_title1,
                            	'news_date'    => $news_date,
                            	
            
                        );   

        	$prepare_array2 = array (
            
                            	'news_category'			 => $news_category, 
                            	'news_title'    => $news_title2,
                            	'news_date'    => $news_date,
                            	
            
                        );

         	$prepare_array3 = array (
            
                            	'news_category'			 => $news_category, 
                            	'news_title'    => $news_title3,
                            	'news_date'    => $news_date,
                            	
            
                        );

         	 $prepare_array4 = array (
            
                            	'news_category'			 => $news_category, 
                            	'news_title'    => $news_title4,
                            	'news_date'    => $news_date,
                            	
            
                        );
         	 $prepare_array5 = array (
            
                            	'news_category'			 => $news_category, 
                            	'news_title'    => $news_title5,
                            	'news_date'    => $news_date,
                            	
            
                        );                            
       
       		$insert = $wpdb->insert (
                                        $wpdb->prefix."news_ticker",
                                        $prepare_array1,
                                        array(
                                        		'%d', 
                                        		'%s',
                                        		'%s',
                                        		
                                        )
                                    );
           

           	$insert = $wpdb->insert (
                                        $wpdb->prefix."news_ticker",
                                        $prepare_array2,
                                        array(
                                        		'%d', 
                                        		'%s',
                                        		'%s',
                                        		
                                        )
                                    );
                                    

            $insert = $wpdb->insert (
                                        $wpdb->prefix."news_ticker",
                                        $prepare_array3,
                                        array(
                                        		'%d', 
                                        		'%s',
                                        		'%s',
                                        		
                                        )
                                    );

            $insert = $wpdb->insert (
                                        $wpdb->prefix."news_ticker",
                                        $prepare_array4,
                                        array(
                                        		'%d', 
                                        		'%s',
                                        		'%s',
                                        		
                                        )
                                    );

            $insert= $wpdb->insert (
                                        $wpdb->prefix."news_ticker",
                                        $prepare_array5,
                                        array(
                                        		'%d', 
                                        		'%s',
                                        		'%s',
                                        		
                                        )
                                    );	
            $success_message =   ADD_NEWS_SUCC_MESS;
            $error_message   =   ADD_NEWS_ERROR_MESS;

            $message  = $insert ? $success_message : $error_message;                
      
       
        
    }

	?>
			


<h3>News Ticker- Add New News</h3>

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="add_news_ticker" method="post" id="add_news_ticker">
	<label class="add_news_ticker_label">Category </label><select name="news_category">
	<option value="0">Daily Digital Insights </option>
	<option value="1">Daily Small Business News</option> </select><br>
	
	
	<label class="add_news_ticker_label"  >Title 1 *</label><input type="text" id="news_title1" name="news_title1" value="" /><span id="error_news_title1" class="error_add_news"></span> <br>
	<label class="add_news_ticker_label" >Title 2 *</label><input type="text" id="news_title2" name="news_title2" value="" /><span id="error_news_title2" class="error_add_news"></span> <br>
	<label class="add_news_ticker_label" >Title 3 *</label><input type="text" id="news_title3" name="news_title3" value="" /><span id="error_news_title3" class="error_add_news"></span> <br>
	<label class="add_news_ticker_label" >Title 4 *</label><input type="text" id="news_title4" name="news_title4" value="" /><span id="error_news_title4" class="error_add_news"></span> <br>
	<label class="add_news_ticker_label" >Title 5 *</label><input type="text" id="news_title5" name="news_title5" value="" /><span id="error_news_title5" class="error_add_news"></span> <br>
	<input type="button" value="Submit" name="news_submit" id="news_submit"/><input type="hidden"
							name="add_news" id="add_news" value="A" /><br>
</form>

		<?php 

		if(isset($message))  echo $message;?>


		<script type="text/javascript">
	jQuery(document).ready(function() {

	jQuery('#news_submit').click(function()
	   {

	   	jQuery('#error_news_title1').html('');
	   	jQuery('#error_news_title2').html('');
	   	jQuery('#error_news_title3').html('');
	   	jQuery('#error_news_title4').html('');
	   	jQuery('#error_news_title5').html('');
	   	var error = '0';


	   

	   	if(jQuery('#news_title1').val() == '') {
			jQuery('#error_news_title1').html('Please enter Title 1');
			error = '1';
			
		} 

		if(jQuery('#news_title2').val() == '') {
			jQuery('#error_news_title2').html('Please enter Title 2');
			error = '1';
			
		}


		if(jQuery('#news_title3').val() == '') {
			jQuery('#error_news_title3').html('Please enter Title 3');
			error = '1';
			
		}


		if(jQuery('#news_title4').val() == '') {
			jQuery('#error_news_title4').html('Please enter Title 4');
			error = '1';
			
		}


		if(jQuery('#news_title5').val() == '') {
			jQuery('#error_news_title5').html('Please enter Title 5');
			error = '1';
			
		}

		if(error=='0')

					{
    					

    					jQuery('#add_news_ticker').submit(); 
    					//return true;      				
    				}
    });  
});
</script>
	
	<?php 

}
?>
