<?php

// Funnction to list News articles in Admin side
function update_news() {
		
		global $wpdb;


		 if ( isset ( $_POST['update_news_id'] ) ){

		 

		 	 $news_category             =   $_REQUEST['news_category'];
		 	$news_title      		   =   stripslashes($_REQUEST['news_title1']);
	
       		$prepare_array = array (
            
                            	'news_category'	 => $news_category, 
                            	'news_title'    => $news_title,
                            	
            
                        );     

		 	$update          = $wpdb->update (
                
                                                    $wpdb->prefix."news_ticker",
                                                    $prepare_array,
                                                    array(
                                        					'news_ticker_id' => $_REQUEST['update_news_id']
                                                    )
                                    );

		 	$news_id=$_REQUEST['update_news_id'];

 

		 	$success_message =   EDIT_NEWS_SUCC_MESS;
            $error_message   =   ADD_NEWS_ERROR_MESS;


			$message         = $update ? $success_message : $error_message;

		 }



		
		$news_ticker_id=$_REQUEST['news_ticker_id'];

		if(isset($news_id))
		{
			$news_ticker_id=$news_id;

		}


		$select_query = "SELECT * FROM ".$wpdb->prefix."news_ticker WHERE news_ticker_id=".$news_ticker_id;
		$get_select_query_result = $wpdb->get_row($select_query);


		?>
	

<h3>Home Page News Ticker Management Area[Edit News]</h3>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="add_news_ticker" method="post" id="add_news_ticker">
	<label class="add_news_ticker_label">Category </label>


	<select name="news_category">
	<option value="0" <?php if($get_select_query_result->news_category=="0") { ?> selected="selected" <?php } ?> >Daily Digital Insights </option>
	<option value="1" <?php if($get_select_query_result->news_category=="1") { ?> selected="selected" <?php } ?>>Daily Small Business News</option> </select><br>
	 <br>
	
	
	<label class="add_news_ticker_label"  >Title *</label><input type="text" id="news_title1" name="news_title1" value="<?php echo $get_select_query_result->news_title; ?>" /><span id="error_news_title1" class="error_add_news"></span> <br>
	
	
	<input type="button" value="Submit" name="news_submit" id="news_submit"/><input type="hidden"
							name="update_news_id" id="update_news_id" value="<?php echo $news_ticker_id; ?>" /><br>
</form>

<?php 


if(isset($message))  echo $message;?>


	<script type="text/javascript">


		jQuery(document).ready(function() {
			

			jQuery('#news_submit').click(function()
	   		{

	   			jQuery('#error_news_title1').html('');
	   			var error = '0';


	  			if(jQuery('#news_title1').val() == '') {
				jQuery('#error_news_title1').html('Please enter Title ');
				error = '1';
			
				} 

				if(error=='0'){
    					
					jQuery('#add_news_ticker').submit(); 
    					//return true;      				
    			}
    		});  
		});
	</script>
	
<?php } ?>