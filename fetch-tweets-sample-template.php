<?php
/* 
	Plugin Name: Fetch Tweets - Sample Template
	Plugin URI: http://en.michaeluno.jp/fetch-tweets
	Description: Adds a sample template for the Fetch Tweets plugin.
	Author: miunosoft (Michael Uno)
	Author URI: http://michaeluno.jp
	Version: 1.1.0
	Requirements: PHP 5.2.4 or above, WordPress 3.3 or above.
*/ 


/**
 * Adds the template directory to the passed array.
 * 
 * @remark			use DIRECTORY_SEPARATOR instead of backslash to support various OSes.
 * @since			1.0.0
 */
function FetchTweets_AddSampleTemplateDirPath( $aDirPaths ) {
	
	$aDirPaths[] = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'sample';
	return $aDirPaths;
	
}
add_filter( 'fetch_tweets_filter_template_directories', 'FetchTweets_AddSampleTemplateDirPath' );