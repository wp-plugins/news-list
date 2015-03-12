<?php


require_once NEWS_TICKER_PLUGIN_DIR . '/language.php';


if ( is_admin() ){
	require_once NEWS_TICKER_PLUGIN_DIR . '/list-news.php';
	require_once NEWS_TICKER_PLUGIN_DIR . '/add-news.php';
	require_once NEWS_TICKER_PLUGIN_DIR . '/update-news.php';
	
}


?>