<?php
/*
 * Available variables passed from the caller script
 * - $aTweets : the fetched tweet arrays.
 * - $aArgs	: the passed arguments such as item count etc.
 * - $aOptions : the plugin options saved in the database.
 * */
 
// echo "<pre>" . htmlspecialchars( print_r( $aTweets, true ) ) . "</pre>";		 
// var_dump( $aTweets );

// Retrieve the user avatar and the screen name.
$sUserAvatarURL = null;
$sUserScreenName = null;
$sUserName = null;
$sRetweetClassProperty = '';
$sUserLang = null;
$sUserDescription = null;
foreach( $aTweets as $aDetail ) {
	if ( ! isset( $aDetail['user']['profile_image_url'] ) ) continue;
	$sUserAvatarURL = $aDetail['user']['profile_image_url'];
	$sUserScreenName = $aDetail['user']['screen_name'];
	$sUserName = $aDetail['user']['name'];
	$sUserLang = $aDetail['user']['lang'];
	$sDescription = $aDetail['user']['description'];
	break;
}

/* 
 * Set up the options
 */
// Retrieve the default template option values.
if ( ! isset( $aOptions['fetch_tweets_template_sample'] ) ) {	// for the fist time of calling the template.
	$aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_avatar_size'] = 48;
	$aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_width'] = 100;
	$aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_width_unit'] = '%';	
	$aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_height'] = 400;
	$aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_height_unit'] = 'px';
	update_option( FetchTweets_Commons::AdminOptionKey, $aOptions );
}

/*
 * Set up the arguments.
 */ 
$aArgs['avatar_size'] = isset( $aArgs['avatar_size'] ) ? $aArgs['avatar_size'] : $aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_avatar_size'];
$aArgs['width']		= isset( $aArgs['width'] ) ? $aArgs['width'] : $aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_width'];
$aArgs['width_unit']	= isset( $aArgs['width_unit'] ) ? $aArgs['width_unit'] : $aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_width_unit'];
$aArgs['height']		= isset( $aArgs['height'] ) ? $aArgs['height']: $aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_height'];
$aArgs['height_unit']	= isset( $aArgs['height_unit'] ) ? $aArgs['height_unit'] : $aOptions['fetch_tweets_template_sample']['fetch_tweets_template_sample_height_unit'];
$sWidth = $aArgs['width'] . $aArgs['width_unit'];
$sHeight = $aArgs['height'] . $aArgs['height_unit'];

/*
 * Start rendering
 */
?>

<div class='fetch-tweets-sample-container' style='max-width:<?php echo $sWidth; ?>; max-height:<?php echo $sHeight; ?>;'>
	
	<div class='fetch-tweets-sample-heading'>
		<?php if ( $aArgs['avatar_size'] > 0 ) : ?>
		<div class='fetch-tweets-sample-profile-image' style="width:<?php echo $aArgs['avatar_size'];?>px;">
			<a href='https://twitter.com/<?php echo $sUserScreenName; ?>' target='_blank'>
				<img src='<?php echo $sUserAvatarURL; ?>' />
			</a>		
		</div>
		<?php endif; ?>
		<span class='fetch-tweets-sample-user-name'>
			<strong>
				<a href='https://twitter.com/<?php echo $sUserScreenName; ?>' target='_blank'>
					<?php echo $sUserName; ?>
				</a>
			</strong>
		</span>	
		<div class='fetch-tweets-sample-follow-button'>
			<a href="https://twitter.com/<?php echo $sUserScreenName;?>" class="twitter-follow-button" data-show-count="false" data-lang="<?php echo $sUserLang; ?>" target="_blank">Follow @<?php echo $sUserScreenName; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>		
		<p class='fetch-tweets-sample-user-description'>
			<?php echo $sDescription; ?>
		</p>
		
	</div>
	
	<?php foreach ( $aTweets as $aDetail ) : ?>
	<?php 
	
		// If the necessary key is not set, skip.
		if ( ! isset( $aDetail['user'] ) ) continue;
		
		// Check if it's a retweet.
		// if ( isset( $aDetail['retweeted_status']['text'] ) ) continue;
		$aTweet = isset( $aDetail['retweeted_status']['text'] ) ? $aDetail['retweeted_status'] : $aDetail;
		$sRetweetClassProperty = isset( $aDetail['retweeted_status']['text'] ) ? 'fetch-tweets-sample-retweet' : '';
		
	?>
    <div class='fetch-tweets-sample-item <?php echo $sRetweetClassProperty; ?>' >
		<div class='fetch-tweets-sample-body'>
			<p class='fetch-tweets-sample-text'>
				<?php echo trim( $aTweet['text'] ); ?>
				<span class='fetch-tweets-sample-credit'>
					<?php if ( isset( $aDetail['retweeted_status']['text'] ) ) : ?>
					<span class='fetch-tweets-sample-retweet-credit'>
						<?php echo _e( 'Retweeted by', 'fetch-tweets' ) . ' '; ?>
						<a href='https://twitter.com/<?php echo $aDetail['user']['screen_name']; ?>' target='_blank'>
							<?php echo $aDetail['user']['name']; ?>
						</a>
					</span>
					<?php endif; ?>
					<span class='fetch-tweets-sample-tweet-created-at'>
						<a href='https://twitter.com/<?php echo $aTweet['user']['screen_name']; ?>/status/<?php echo $aTweet['id_str'] ;?>' target='_blank'>
							<?php echo FetchTweets_humanTiming( $aTweet['created_at'] ) . ' ' . __( 'ago', 'fetch-tweets' ); ?>
						</a>			
					</span>
				</span>
			</p>
		</div>
    </div>
	<?php endforeach; ?>	
</div>
