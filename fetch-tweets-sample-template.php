<?php
/* 
	Plugin Name: Fetch Tweets - Sample Template
	Plugin URI: http://en.michaeluno.jp/fetch-tweets
	Description: Adds a sample template for the Fetche Tweets plugin.
	Author: miunosoft (Michael Uno)
	Author URI: http://michaeluno.jp
	Version: 1.0.0
	Requirements: PHP 5.2.4 or above, WordPress 3.2 or above.
*/ 

add_filter( 'fetch_tweets_filter_template_directories', 'FetchTweets_AddSampleTemplateDirPath' );
function FetchTweets_AddSampleTemplateDirPath( $arrDirPaths ) {
	
	// Add the template directory to the passed array.
	$arrDirPaths[] = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'sample';	// use DIRECTORY_SEPARATOR instead of backslash to support various OSes.
	return $arrDirPaths;
	
}