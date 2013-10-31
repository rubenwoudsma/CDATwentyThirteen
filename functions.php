<?php
/**
 * CDATwentyThirteen functions and definitions
 * -------------------------------------------
 * Main file which contains all the general functions and references to the correct modules, functions
 * This will be maintained as part of the central theme.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

/**
 * Set the content width based on the theme's design and style sheet.
 *
 * @since CDATwentyThirteen 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'cdatwentythirteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_setup() {

	/**
	 * Load additional file for custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Load additional custom functions that act independently of this theme template
	 * and can be used in other themes.
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Load the additional author profile settings so authors can modify their own data
	 * which will be used on the front page.
	 */
	require( get_template_directory() . '/inc/author-profile-extras.php' );
	
	
	/**
	 * Load the Theme Option Framework
	 */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
		require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	}

	/*
	 * Remove the default filter (add editor version)
	 * for 'text area' sanitization so it allows html, tags, etc.
	 */
	add_action('admin_init','cdatwentythirteen_change_santiziation', 100);
	
	function cdatwentythirteen_change_santiziation() {
		remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
		add_filter( 'of_sanitize_textarea', 'of_sanitize_editor' );
	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on CDATwentyThirteen, use a find and replace
	 * to change 'cdatwentythirteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cdatwentythirteen', get_template_directory() . '/languages' );
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	/**
	 * Add additional Featured Image sizes for this specific theme
	 */
	 
	add_image_size( 'postpage-thumb', 620, 330, true ); // cropped
	
	add_image_size( 'columns-thumb', 300, 160, true ); //  cropped

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cdatwentythirteen' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	/**
	 * Add specific CDA Custom Post Type
	 */
	register_post_type( 'standpunt',
		array( 
			'labels' 		=> array (
								'name' 					=> __( 'Positions', 'cdatwentythirteen' ), 
								'singular_name'			=> __( 'Positions', 'cdatwentythirteen' ),
								'add_new'				=> _x( 'Add New', 'position', 'cdatwentythirteen' ),
								'add_new_item'			=> __( 'Add New Position', 'cdatwentythirteen' ),
								'edit_item'				=> __( 'Edit Position', 'cdatwentythirteen' ),
								'new_item'				=> __( 'New Position', 'cdatwentythirteen' ),
								'all_items'				=> __( 'All Positions', 'cdatwentythirteen' ),
								'view_item'				=> __( 'View Positions', 'cdatwentythirteen' ),
								'search_items'			=> __( 'Search Positions', 'cdatwentythirteen' ),
								'not_found'				=> __( 'No positions found', 'cdatwentythirteen' ),
								'not_found_in_trash'	=> __( 'No positions found in the Trash', 'cdatwentythirteen' )
							   ),
			'description' 	=> __( 'The positions for the local department of the Dutch Christen Democrats (CDA) which will be used on the website for clear and to the point statements.' , 'cdatwentythirteen' ),
			'public' 		=> true, 
			'show_ui' 		=> true,
			'menu_position' => 5,
			'menu_icon' 	=> get_bloginfo('template_directory') . '/images/standpunt-16x16.png',
			'has_archive' 	=> true,
			'public' 		=> true,
			'rewrite' 		=> array( 'slug' => 'standpunten' ),
			'supports' 		=> array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		)
	);
	//register_taxonomy_for_object_type('post_tag', 'standpunt');
	//Add custom meta box for specific this type of CPT!	

	if ( ! function_exists('cdatwentytirtheen_register_taxonomy_positions') ) {

		// Register Custom Taxonomy
		function cdatwentytirtheen_register_taxonomy_positions()  {
			$labels = array(
				'name'                       => _x( 'subjects', 'Taxonomy General Name', 'cdatwentythirteen' ),
				'singular_name'              => _x( 'Subject', 'Taxonomy Singular Name', 'cdatwentythirteen' ),
				'menu_name'                  => __( 'Manage Subjects', 'cdatwentythirteen' ),
				'all_items'                  => __( 'All subjects', 'cdatwentythirteen' ),
				'parent_item'                => __( 'Parent subject', 'cdatwentythirteen' ),
				'parent_item_colon'          => __( 'Parent subject:', 'cdatwentythirteen' ),
				'new_item_name'              => __( 'New subject name', 'cdatwentythirteen' ),
				'add_new_item'               => __( 'Add New Subject', 'cdatwentythirteen' ),
				'edit_item'                  => __( 'Edit Subject', 'cdatwentythirteen' ),
				'update_item'                => __( 'Update Subject', 'cdatwentythirteen' ),
				'separate_items_with_commas' => __( 'Separate subjects with commas', 'cdatwentythirteen' ),
				'search_items'               => __( 'Search subjects', 'cdatwentythirteen' ),
				'add_or_remove_items'        => __( 'Add or remove subjects', 'cdatwentythirteen' ),
				'choose_from_most_used'      => __( 'Choose from the most used subjects', 'cdatwentythirteen' ),
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			register_taxonomy( 'subjects', array( 'standpunt', 'post' ), $args );
			//cdatwentytirtheen_register_default_position_terms();
		}

		// Hook into the 'init' action
		add_action( 'init', 'cdatwentytirtheen_register_taxonomy_positions', 0 );

	}

	function cdatwentytirtheen_register_default_position_terms ()  {

		$position_categories = $GLOBALS['cdatwentythirteen_positions_categories'];
		foreach ($position_categories as $poscat) {

			wp_insert_term( $poscat, 'subjects' );
		}
	}
	add_action( 'init', 'cdatwentytirtheen_register_default_position_terms', 1);

	
	// Styling for the custom post type icon
	//add_action( 'admin_head', 'cdatwentythirteen_positions_icons' );
	function cdatwentythirteen_positions_icons() {
		?>
		<style type="text/css" media="screen">
			#menu-posts-standpunt .wp-menu-image {
				background: url(<?php bloginfo('template_url') ?>/images/standpunt-16x16.png) no-repeat !important;
			}
			#icon-edit.icon32-posts-standpunt {
				background: url(<?php bloginfo('template_url') ?>/images/standpunt-32x32.png) no-repeat;
			}
		</style>
	<?php }
	
}
endif; // cdatwentythirteen_setup
add_action( 'after_setup_theme', 'cdatwentythirteen_setup' );


/* ************************************************************************************************ */
// NOTE: This need to be stored different and need to be attached to author/profile
//       Will be added to user settings so this can be changed (only primary group will be stored)
$cdatwentythirteen_author_groups = array( 'bestuur', 'fractie', 'lid', 'kandidaat', 'overig' );
$cdatwentythirteen_positions_categories = array( 'economie', 'werk', 'gezin', 'zorg', 'duurzaamheid', 'samenleving', 'onderwijs' );
	
/*
 * Init WordPress to add globals which can be used for the authors and levels of the authors.
 */
add_action( 'init', 'cdatwentythirteen_init' );
function cdatwentythirteen_init()
{
	global $wp_rewrite;
	$author_groups = $GLOBALS['cdatwentythirteen_author_groups'];

	// Define the tag and use it in the rewrite rule
	add_rewrite_tag( '%author_group%', '(' . implode( '|', $author_groups ) . ')' );
	$wp_rewrite->author_base = 'onze-mensen/%author_group%';
}
	
/* 
 * Hook into 'request' to modify the author request. 
 * Change the way the lookup works (via nickname in stead of the slug)
 */
add_filter( 'request', 'cdatwentythirteen_request' );
function cdatwentythirteen_request( $query_vars )
{
	if ( array_key_exists( 'author_name', $query_vars ) ) {
		global $wpdb;
		
		$author_nn = urldecode($query_vars['author_name'] );
		$author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $author_nn ) );
		if ( $author_id ) {
			$query_vars['author'] = $author_id;
			unset( $query_vars['author_name'] );
		}
	}
	return $query_vars;
}

add_filter( 'author_rewrite_rules', 'cdatwentythirteen_author_rewrite_rules' );
function cdatwentythirteen_author_rewrite_rules( $author_rewrite_rules )
{
	foreach ( $author_rewrite_rules as $pattern => $substitution ) {
		if ( FALSE === strpos( $substitution, 'author_name' ) ) {
			unset( $author_rewrite_rules[$pattern] );
		}
	}
	return $author_rewrite_rules;
}

add_filter( 'author_link', 'cdatwentythirteen_author_link', 10, 3 );
function cdatwentythirteen_author_link( $link, $author_id, $author_nicename )
{
	$groupinfo = get_user_meta( $author_id, 'usercategory', true );
	if ( !empty($groupinfo) ) {
		$author_group = $groupinfo;
	} else {
		$author_group = 'overige';
	}
	$link = str_replace( '%author_group%', $author_group, $link );

	//Below solution added from other WordPress Answers suggestion
	$author_nickname = get_user_meta( $author_id, 'nickname', true );
	if ( $author_nickname ) {
		$link = str_replace( $author_nicename, sanitize_title_with_dashes( $author_nickname ), $link );
	}

	return $link;

}
/* ************************************************************************************************ */


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar', 'cdatwentythirteen' ),
		'id' => 'sidebar-1',
		'description' => __( 'Main sidebar which can be filled with all the general widgets.', 'cdatwentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Foldout Container', 'cdatwentythirteen' ),
		'id' => 'foldout-container',
		'description' => __( 'Sidebar that is being used to display the hidden section in the top of the website.', 'cdatwentythirteen' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s cf nobottom">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Left', 'cdatwentythirteen' ),
		'id' => 'footer-left',
		'description' => __( 'Footer sidebar which is being used in the footer of the website.', 'cdatwentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s cf">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Center', 'cdatwentythirteen' ),
		'id' => 'footer-center',
		'description' => __( 'Footer sidebar which is being used in the footer of the website.', 'cdatwentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s cf">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Right', 'cdatwentythirteen' ),
		'id' => 'footer-right',
		'description' => __( 'Footer sidebar which is being used in the footer of the website.', 'cdatwentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s cf">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'cdatwentythirteen_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since CDATwentyThirteen 1.0
 */
 
function cdatwentythirteen_scripts_and_styles() {

	$dir = get_template_directory_uri().'/';

	//Style sheets
	wp_enqueue_style( 'base', 		$dir.'stylesheets/base.css' );
	wp_enqueue_style( 'skeleton', 	$dir.'stylesheets/skeleton.css' );
	wp_enqueue_style( 'layout', 	$dir.'stylesheets/layout.css' );
	wp_enqueue_style( 'prettyPhoto',$dir.'js/prettyPhoto/css/prettyPhoto.css' );
	wp_enqueue_style( 'style', 		get_stylesheet_uri() );				//enqueue last so we can override
	
	//JavaScript	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'prettyPhoto', $dir.'js/prettyPhoto/js/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'small-menu', $dir . 'js/small-menu.js', array( 'jquery' ), '20131014', true ); //rename (to theme) after go-live!

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', $dir . 'js/keyboard-image-navigation.js', array( 'jquery' ), '20120624' );
	}
	
	if ( is_page_template('page-home-carrousel.php') ) {
		wp_enqueue_script( 'flexslider-min', $dir . 'js/jquery.flexslider-min.js', array( 'jquery' ), '20131021', true );
	}
	
}
add_action( 'wp_enqueue_scripts', 'cdatwentythirteen_scripts_and_styles' );

/**
 * Add option to put custom CSS in the website without creating child theme (quick and dirty)
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_add_custom_css() {

	$customcss = of_get_option('custom-cdatt-css');

	if( $customcss ){
		?>
<style type="text/css" id="cdatwentythirtheen-css-custom">
	<?php echo $customcss; ?>
</style>
		<?php
	}

}
add_action( 'wp_head', 'cdatwentythirteen_add_custom_css' );
