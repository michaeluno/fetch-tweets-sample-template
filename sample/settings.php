<?php
/*
 * Modify this extended class.
 * */
class FetchTweets_Template_Settings_Sample extends FetchTweets_Template_Settings {

	/*
	 * Modify these properties.
	 * */
	protected $sParentPageSlug = 'fetch_tweets_templates';	// in the url, the ... part of ?page=... 
	protected $sParentTabSlug = 'sample';	// in the url, the ... part of &tab=...
	protected $sTemplateName = 'Sample';	// the template name
	protected $sSectionID = 'fetch_tweets_template_sample';	// the template name
	
	/*
	 * Modify these methods. 
	 * This defines form sections. Set the section ID and the description here.
	 * The array structure follows the rule of Admin Page Framework. ( https://github.com/michaeluno/admin-page-framework )
	 * */
	public function addSettingSections( $aSections ) {
			
		$aSections[ $this->sSectionID ] = array(
			'section_id'	=> $this->sSectionID,
			'page_slug'		=> $this->sParentPageSlug,
			'tab_slug'		=> $this->sParentTabSlug,
			'title'			=> $this->sTemplateName,
			'description'	=> sprintf( 'Options for the %1$s template.', $this->sTemplateName ) . ' ' 
				. __( 'These will be the default values and be overridden by the arguments passed directly by the widgets, the shortcode, or the PHP function.', 'fetch-tweets' ),
		);
		return $aSections;
	
	}
	/*
	 * This defines form fields. Return the field arrays. 
	 * The array structure follows the rule of Admin Page Framework. ( https://github.com/michaeluno/admin-page-framework )
	 * */
	public function addSettingFields( $aFields ) {
		
		if ( ! class_exists( 'FetchTweets_Commons' ) ) return $aFields;	// if the main class does not exist, do nothing.
		
		$aOptions = get_option( FetchTweets_Commons::AdminOptionKey );

		$iWidth = isset( $aOptions[ $this->sSectionID ]['fetch_tweets_template_sample_width'] )
			? $aOptions[ $this->sSectionID ]['fetch_tweets_template_sample_width']
			: 100;	// default
		$iHeight = isset( $aOptions[ $this->sSectionID ]['fetch_tweets_template_sample_height'] )
			? $aOptions[ $this->sSectionID ]['fetch_tweets_template_sample_height']
			: 800;	// default
		
		$aFields[ $this->sSectionID ] = array();
		$aFields[ $this->sSectionID ][ 'fetch_tweets_template_sample_avatar_size' ] = array(
			'field_id' => 'fetch_tweets_template_sample_avatar_size',
			'section_id' => $this->sSectionID,
			'title' => __( 'Profile Image Size', 'fetch-tweets' ),
			'description' => __( 'The avatar size in pixel.', 'fetch-tweets' ) . ' ' . __( 'Default', 'fetch-tweets' ) . ': 48',
			'type' => 'number',
			'default' => 48, 
			'attributes'	=>	array(
				'size'	=>	10,
			),
		);				
		$aFields[ $this->sSectionID ][ 'fetch_tweets_template_sample_width_unit' ] = array(
			'field_id' => 'fetch_tweets_template_sample_width_unit',
			'section_id' => $this->sSectionID,
			'title' => __( 'Width', 'fetch-tweets' ),
			'description' => __( 'The width of the output.', 'fetch-tweets' ) . ' ' . __( 'Default', 'fetch-tweets' ) . ': 100%',
			'type' => 'select',
			'label' => array(
				'%' => '%',
				'px' => 'px',
				'em' => 'em',
			),
			'default' => '%',
			'before_input' => '<span id="fetch_tweets_template_sample_fetch_tweets_template_sample_width"><input id="fetch_tweets_template_sample_fetch_tweets_template_sample_width_0" class="" size="30" type="number" name="fetch_tweets_admin[fetch_tweets_templates][fetch_tweets_template_sample][fetch_tweets_template_sample_width]" value="' .  $iWidth . '" min="" max="" step="" maxlength=""></span>',
		);
		$aFields[ $this->sSectionID ][ 'fetch_tweets_template_sample_height_unit' ] = array(
			'field_id' => 'fetch_tweets_template_sample_height_unit',
			'section_id' => $this->sSectionID,
			'title' => __( 'Height', 'fetch-tweets' ),
			'description' => __( 'The height of the output.', 'fetch-tweets' ) . ' ' . __( 'Default', 'fetch-tweets' ) . ': 400px',
			'type' => 'select',
			'label' => array(
				'%' => '%',
				'px' => 'px',
				'em' => 'em',
			),
			'default' => 'px',
			'before_input' => '<span id="fetch_tweets_template_sample_fetch_tweets_template_sample_height"><input id="fetch_tweets_template_sample_fetch_tweets_template_sample_height_0" class="" size="30" type="number" name="fetch_tweets_admin[fetch_tweets_templates][fetch_tweets_template_sample][fetch_tweets_template_sample_height]" value="' .  $iHeight . '" min="" max="" step="" maxlength=""></span>',
		);
		$aFields[ $this->sSectionID ][ 'fetch_tweets_template_sample_submit' ] = array(  // single button
			'field_id' => 'fetch_tweets_template_sample_submit',
			'section_id' => $this->sSectionID,
			'type' => 'submit',
			'before_field' => "<div class='right-button'>",
			'after_field' => "</div>",
			'label_min_width' => 0,
			'label' => __( 'Save Changes', 'fetch-tweets' ),
			'attributes'	=>	array(
				'class' => 'button button-primary',
			),			
		);
		return $aFields;		
	}
	
	public function validateSettings( $aInput, $aOriginal ) {
		
		return $aInput;
		
	}
	
}
new FetchTweets_Template_Settings_Sample( dirname( __FILE__ ) );


