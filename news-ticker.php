<?php
/*
 Plugin Name: NewsTicker
 Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 Description: Handle newsTicker functionailty in home page.
 Version: 1.0
 Author: Mahinsha/Sajin Saleem
 */

ob_start();



if ( ! defined( 'NEWS_TICKER_PLUGIN_DIR' ) )

	define( 'NEWS_TICKER_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

require_once NEWS_TICKER_PLUGIN_DIR. '/settings.php';
require_once NEWS_TICKER_PLUGIN_DIR . '/mysql.php';



register_activation_hook(__FILE__,'create_news_ticker');
//register_deactivation_hook(__FILE__,'drop_tables');



/* Hook for Integrating CSS */
function init_news_ticker_style ( ){

    wp_enqueue_style( 'common-style', plugins_url('css/news-ticker-style.css', __FILE__) );
   
}

add_action('init', 'init_news_ticker_style');




/* Hook for adding admin menus*/
add_action('admin_menu', 'News_ticker_add_menu');

function News_ticker_add_menu() {

// Add a new top-level menu (ill-advised):
  	add_menu_page( 'News-Ticker', 'News-Ticker','manage_options','news_ticker','add_news');
   	add_submenu_page ( 'news_ticker', 'News Management', 'Edit/Delete News', 'manage_options', 'list_news','list_news');
    add_submenu_page ( 'news_ticker', 'Edit News', '', 'manage_options', 'update_news','update_news');
}


/**
 *
 * Function used to delete contest from Pinboard
 */
function delete_news ( ){


	global $wpdb;
	$news_ticker_id          = isset( $_POST['news_ticker_id'] ) ? $_POST['news_ticker_id'] : 0;
	$delete_query        = $wpdb->get_var ( "DELETE FROM ".$wpdb->prefix."news_ticker WHERE news_ticker_id =".$news_ticker_id);
	
	$success_message     = '<div class="success_message">
    							You have successfully deleted this News
							</div>';
	$error_message       = '<div class="error_message">
    							Something went wrong! Plese try after sometimes
							</div>';

	$message             = $wpdb->rows_affected ? $success_message : $error_message;

	echo $message;
	die();
}
add_action( 'wp_ajax_delete_news', 'delete_news' );


/* Function for list data in front end*/
function get_news_sticker($atts){
	
	global $wpdb;
	
	$row = 1;
	$get_left_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."news_ticker WHERE news_category = 0 ORDER BY news_ticker_id DESC LIMIT 5");
	
	$build_html = "<div class='left_news_block'>
					<div class='news-block-header'>DAILY DIGITAL INSIGHTS </div>
						<ul class=''>";
						foreach($get_left_results as $result){

							$class = ( $row % 2 ) ? ' class="odd"' : ' class="even"';
							$build_html .= "<li". $class.">".$result->news_title."</li>";

							$row++;
						}
	$build_html .= "</div></ul>";
	
	
	$get_right_results= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."news_ticker WHERE news_category = 1 ORDER BY news_ticker_id DESC LIMIT 5");
	
	$row = 1;
	$build_html .= "<div class='right_news_block'>
						<div class='news-block-header'>DAILY SMALL BUSINESS NEWS</div>
						<ul class=''>";
						foreach($get_right_results as $result){
							$class = ( $row % 2 ) ? ' class="odd"' : ' class="even"';
							$build_html .= "<li". $class.">".$result->news_title."</li>";
							$row++;
						}
	$build_html .= "</div></ul>";
	
	echo $build_html;
	
}

add_shortcode('news_ticker', 'get_news_sticker'); 



class news_list extends WP_Widget {

	// constructor
	function news_list() {
		parent::WP_Widget(false, 'News  Ticker Widget');
	}

	// widget form creation
	function form($instance) {	
	 print "This widget displays latest News topics";
	}

	// widget update
	function update($new_instance, $old_instance) {
		

		 return $new_instance;
	}

	// widget display
	function widget($args, $instance) {
		
		global $wpdb;
		$row = 1;
		$get_left_results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."news_ticker WHERE news_category = 0 ORDER BY news_ticker_id DESC LIMIT 5");

		$build_html = "<div class='news_block_widget'>
					<div class='news-block-header'>DAILY DIGITAL INSIGHTS </div>
						<ul class=''>";
						foreach($get_left_results as $result){

							$class = ( $row % 2 ) ? ' class="odd"' : ' class="even"';
							$build_html .= "<li". $class.">".$result->news_title."</li>";

							$row++;
						}
		$build_html .= "</div></ul>";

		echo $build_html;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("news_list");'));



?>