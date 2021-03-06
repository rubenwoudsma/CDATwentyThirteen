<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	//Limited array
	$num_featured_posts = array (
		'1' 			=> __('One', 'cdatwentythirteen'),
		'2' 			=> __('Two', 'cdatwentythirteen'),
		'3' 			=> __('Three', 'cdatwentythirteen'),
		'4' 			=> __('Four', 'cdatwentythirteen'),
		'5' 			=> __('Five', 'cdatwentythirteen')
	);

	//Limited array
	$num_expert_posts = array (
		'6' 			=> __('Six', 'cdatwentythirteen'),
		'9' 			=> __('Nine', 'cdatwentythirteen'),
		'12' 			=> __('Twelve', 'cdatwentythirteen'),
		'15' 			=> __('Fiftheen', 'cdatwentythirteen'),
		'18' 			=> __('Eightheen', 'cdatwentythirteen')
	);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array (
		'name' 			=> __('Basic Settings', 'cdatwentythirteen'),
		'type'			=> 'heading'
	);

	$options[] = array (
		'name' 			=> __('General information', 'cdatwentythirteen'),
		'desc' 			=> __('This section of the theme options lets you customize the basic settings for the CDA Twenty Thirteen WordPress theme. It handles all the general information.', 'cdatwentythirteen'),
		'type' 			=> 'info'
	);

	$options[] = array (
		'name'			=> __('Show department header', 'cdatwentythirteen'),
		'desc'			=> __('If enabled the department header will be shown on top.', 'cdatwentythirteen'),
		'id'			=> 'show-department-header',
		'std'			=> '1',
		'type'			=> 'checkbox'
	);
			
	$options[] = array (
		'name'			=> __('Select a featured category', 'cdatwentythirteen'),
		'desc'			=> __('Select a featured category that will be used within the slider on the front page.', 'cdatwentythirteen'),
		'id'			=> 'featured_slider_cat',
		'type'			=> 'select',
		'options'		=> $options_categories
	);

	$options[] = array (
		'name'			=> __('Number of featured posts', 'cdatwentythirteen'),
		'desc'			=> __('Select the number of featured posts that will be in the slider carousel.', 'cdatwentythirteen'),
		'id'			=> 'num_featured_posts',
		'std'			=> '4',
		'type'			=> 'select',
		'options'		=> $num_featured_posts
	);
	
	$options[] = array (
		'name'			=> __('Select an expert category', 'cdatwentythirteen'),
		'desc'			=> __('Select an expert category that will be used within expert section on the front page.', 'cdatwentythirteen'),
		'id'			=> 'expert_category',
		'type'			=> 'select',
		'options'		=> $options_categories
	);

	$options[] = array (
		'name'			=> __('Number of experts to show', 'cdatwentythirteen'),
		'desc'			=> __('Select the number of experts that will be shown on the front page.', 'cdatwentythirteen'),
		'id'			=> 'num_experts_posts',
		'std'			=> '12',
		'type'			=> 'select',
		'options'		=> $num_expert_posts
	);
	
	$options[] = array (
		'name'			=> __('Department abbreviation', 'cdatwentythirteen'),
		'desc'			=> __('Provide the department abbreviation code. This normally contains 3 characters.', 'cdatwentythirteen'),
		'id'			=> 'department-code',
		'type'			=> 'text'
	);
	
	$options[] = array (
		'name' 			=> __('Enable Fold-out container', 'cdatwentythirteen'),
		'desc' 			=> __('Enable the fold-out container in order to show additional/secret information on top of the website.', 'cdatwentythirteen'),
		'id' 			=> 'enable-foldout-container',
		'std' 			=> '1',
		'type' 			=> 'checkbox'
	);

	$options[] = array (
		'name' 			=> __('Enable Social media buttons', 'cdatwentythirteen'),
		'desc' 			=> __('Enable the social media buttons. These will be shown on top and on several other parts within the website.', 'cdatwentythirteen'),
		'id' 			=> 'enable-social-media',
		'std' 			=> '1',
		'type' 			=> 'checkbox'
	);

	$options[] = array (
		'name'			=> __('Footer left', 'cdatwentythirteen'),
		'desc' 			=> __('Text to include on the left side of the footer.', 'cdatwentythirteen'),
		'id' 			=> 'footer-left',
		'std' 			=> 'CDA Twenty Thirteen WordPress Theme by <a href="http://rubenwoudsma.nl">rubenwoudsma.nl</a>',
		'type' 			=> 'textarea'
	);

	$options[] = array(
		'name' 			=> __('Footer right', 'cdatwentythirteen'),
		'desc' 			=> __('Text to include on the right side of the footer.', 'cdatwentythirteen'),
		'id' 			=> 'footer-right',
		'std' 			=> 'Proudly powered by <a href="http://wordpress.org">WordPress</a>',
		'type' 			=> 'textarea'
	);

	$options[] = array (
		'name' 			=> __('Social Media Settings', 'cdatwentythirteen'),
		'type' 			=> 'heading'
	);

	$options[] = array (
		'name' 			=> __('General information', 'cdatwentythirteen'),
		'desc' 			=> __('This section lets you set and enable the different social media platforms which can be used on the front end of the website', 'cdatwentythirteen'),
		'type' 			=> 'info'
	);
		
	$options[] = array (
		'name' 			=> __('Twitter', 'cdatwentythirteen'),
		'desc' 			=> __('Twitter user name (no @). Used for the social media icon', 'cdatwentythirteen'),
		'id' 			=> 'twitter-details',
		'type' 			=> 'text'
	);

	$options[] = array(
		'name' 			=> __('Facebook', 'cdatwentythirteen'),
		'desc'			=> __('Give the Facebook Page URL or Custom URL.', 'cdatwentythirteen'),
		'id' 			=> 'facebook-details',
		'type' 			=> 'text'
	);		

	$options[] = array(
		'name' 			=> __('Google Plus', 'cdatwentythirteen'),
		'desc' 			=> __('Provide the Google Plus URL which you would like to use.', 'cdatwentythirteen'),
		'id' 			=> 'googleplus-details',
		'type' 			=> 'text'
	);	

	$options[] = array(
		'name'			=> __('LinkedIn', 'cdatwentythirteen'),
		'desc'			=> __('Provide the LinkedIn person URL of group URL you would like to refer to.', 'cdatwentythirteen'),
		'std'			=> 'http://www.linkedin.com/groups?gid=39007',
		'id'			=> 'linkedin-details',
		'type'			=> 'text'
	);	

	$options[] = array(
		'name'			=> __('Youtube', 'cdatwentythirteen'),
		'desc'			=> __('Provide the YouTube Username where you would like to link to.', 'cdatwentythirteen'),
		'std'			=> 'cdatv',
		'id'			=> 'youtube-details',
		'type'			=> 'text'
	);	

	$options[] = array(
		'name'			=> __('Flickr', 'cdatwentythirteen'),
		'desc'			=> __('Provide the Flickr Username where you would like to link to.', 'cdatwentythirteen'),
		'std'			=> 'cdafoto',
		'id'			=> 'flickr-details',
		'type'			=> 'text'
	);	
		
	$options[] = array(
		'name'			=> __('Vimeo', 'cdatwentythirteen'),
		'desc'			=> __('Provide the Vimeo Username where you would like to link to.', 'cdatwentythirteen'),
		'id'			=> 'vimeo-details',
		'type'			=> 'text'
	);	

	$options[] = array(
		'name'			=> __('Pinterest', 'cdatwentythirteen'),
		'desc'			=> __('Provide the Pinterest Username where you would like to link to.', 'cdatwentythirteen'),
		'id'			=> 'pinterest-details',
		'type'			=> 'text'
	);	
		
	$options[] = array(
		'name'			=> __('Advanced Settings', 'cdatwentythirteen'),
		'type'			=> 'heading'
	);

	$options[] = array(
		'name'			=> __('Maximum Viewport Scale', 'cdatwentythirteen'),
		'desc'			=> __('Set the maximum viewport scale. Default is 1, indicating that users can not pinch and zoom on an iPad. Setting it to 2 will allow zooming to 200%, but will affect display on rotation.', 'cdatwentythirteen'),
		'id'			=> 'viewport-maximum-scale',
		'class'			=> 'mini',
		'std'			=> '1',
		'type'			=> 'text'
	);

	$options[] = array(
		'name'			=> __('Custom CSS', 'cdatwentythirteen'),
		'desc'			=> __('Minor CSS tweaks can be added here. They will be included in the <head> of your site. For major style adjustments, you should use a child theme.', 'cdatwentythirteen'),
		'id'			=> 'custom-cdatt-css',
		'type'			=> 'textarea'
	);

	return $options;
}

