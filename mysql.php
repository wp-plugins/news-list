<?php
/**
 * 
 * Function used to create tables during Newsticker plugin activation
 */
function create_news_ticker ( ) {
    
    global $wpdb; // global variable for database connection
  $create_news_ticker_sql                        = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."news_ticker` (
                                                          `news_ticker_id` int(11) NOT NULL AUTO_INCREMENT,
                                                          `news_category` int(11) NOT NULL,
                                                          `news_title` text NOT NULL,
                                                          `news_date` datetime NOT NULL,
                                                          PRIMARY KEY (`news_ticker_id`)
                                                        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
    


    
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta( $create_news_ticker_sql );
    
}

/**
 * 
 * Function used to delete tables from database during plugin deactivation
 */
function drop_news_ticker ( ) {
    
    global $wpdb; // global variable for database connection
    $delete_news_ticker_sql                 = "DROP TABLE IF EXISTS `".$wpdb->prefix."news_ticker`;";
   
   
    $wpdb->query( $delete_news_ticker_sql );
   
}
?>
