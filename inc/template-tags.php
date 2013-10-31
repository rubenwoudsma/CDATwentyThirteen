<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

if ( ! function_exists( 'cdatwentythirteen_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'cdatwentythirteen' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'cdatwentythirteen' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'cdatwentythirteen' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cdatwentythirteen' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cdatwentythirteen' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // cdatwentythirteen_content_nav

if ( ! function_exists( 'cdatwentythirteen_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'cdatwentythirteen' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cdatwentythirteen' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'cdatwentythirteen' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'cdatwentythirteen' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'cdatwentythirteen' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'cdatwentythirteen' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for cdatwentythirteen_comment()

if ( ! function_exists( 'cdatwentythirteen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'cdatwentythirteen' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cdatwentythirteen' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so cdatwentythirteen_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so cdatwentythirteen_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in cdatwentythirteen_categorized_blog
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'cdatwentythirteen_category_transient_flusher' );
add_action( 'save_post', 'cdatwentythirteen_category_transient_flusher' );

/**
 * Display social media icons based on options set in the Theme options
 *
 * @since CDATwentyThirteen 1.0
 */
function cdatwentythirteen_social_media_icons( $order = array() ){

	$socialmedia_channels = array(
		'twitter-details'		=>	'Twitter',
		'facebook-details'		=>	'Facebook',
		'googleplus-details'	=>	'Google Plus',
		'youtube-details'		=>	'YouTube', 
		'linkedin-details'		=>	'LinkedIn',
		'pinterest-details'		=>	'Pinterest',
		'flickr-details'		=>	'Flickr',
		'vimeo-details'			=> 	'Vimeo',
	);

	if( !empty( $order ) ) {
		$_sm_channels = array();
		foreach( $order as $site_id ){
			$_sm_channels[$site_id] = $socialmedia_channels[$site_id];
		}
		$socialmedia_channels = $_sm_channels;
	}

	$socialmedia_channels = apply_filters( 'cdatwentythirteen_social_media_filter' , $socialmedia_channels );

	foreach( $socialmedia_channels as $site => $title ){
		if( $identifier = of_get_option( $site ) ){
			cdatwentythirteen_social_media_icon( $site, $identifier, $title );	
		}
	}

	//provide the option to hook into this function
	do_action( 'cdatwentythirteen_social_media' );

}

/**
 * Print an individual social media icon
 */
function cdatwentythirteen_social_media_icon( $site , $identifier, $title = '' ) {

	$url = '';

	//If the URL already contains the 'http', not necessary to go in the the case switch.
	if( strpos( trim( $identifier ) , 'http' ) === 0 ){

		$url = trim( $identifier );
	}
	else{
		
		switch( $site ){

			case 'twitter-details':
				$url = 'http://twitter.com/'.$identifier;
				break;

			case 'youtube-details':
				$url = 'http://youtube.com/user/'.$identifier;
				break;

			case 'pinterest-details':
				$url = 'http://pinterest.com/'.$identifier;
				break;

			case 'flickr-details':
				$url = 'http://www.flickr.com/photos/'.$identifier;
				break;
				
			case 'vimeo-details':
				$url = 'https://vimeo.com/'.$identifier;
				break;

		}
	}

	?><a href="<?php echo $url; ?>" target="_blank" class="socialmediaitem <?php echo str_replace("-details", "", $site); ?> tooltip-container" title="<?php echo $title; 
		?>" ><span class="tooltip-anchor icon <?php echo str_replace("-details", "", $site); ?>-icon"></span></a><?php
}


function cdatwentythirteen_the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

function cdatwentythirteen_people_page( $excerpt_length = 420 ) {

	$args = array(
			  'meta_query' => array (
				array (
					'key' => 'usercategory',
					'value' => array( 'bestuur', 'fractie', 'kandidaat'),
					'compare' => 'IN'
				)
			  ) );		

	$users = get_users( $args );

	$upload_dir = wp_upload_dir();
	$headingCount = 1;
	$peopleHTML = "<div id=\"people-page\" class=\"our-people\">\n\n";
	
	function do_full_text( $desc ) {
		$text = nl2br( $desc );
		return $text;
	}

	//Loop through all the people in the queue!
	foreach( $users as $user ) {
		if( is_numeric( $user->ID ) ) {
			$person = get_userdata( $user->ID );
			$description = $person->description;
			$name = $person->display_name;
			$link = get_author_posts_url( $user->ID );
				
			$noPosts = count_user_posts( $user->ID );
			$postsLink = !empty( $noPosts ) ? '<a href="'.$link.'#posts" class="posts">' . _e( 'posts', 'cdatwentythirteen' ) . '</a>' : false;
			// excerpt?
			if(strlen($description) > $excerpt_length){
				preg_match( "/^.{1,$excerpt_length}\b/s", $description, $match) ;
				$bio = nl2br($match[0]);
				$bio = trim($bio);
				$bio .= '... <a href="'.$link.'" class="more">' . _e( 'meer', 'cdatwentythirteen' ) . '</a>';
			} else{ 
				$bio = do_full_text($description);
				unset($link);
			}
			
			// return text
			$peopleHTML .= '<div id="author-'.$user->ID.'" class="person">'."\n";
			if(!empty($person->photo)){ 
				$peopleHTML .= '<img src="'.$person->photo.'" alt="'.$name.'" class="photo" />'."\n"; 
			} elseif($person->userphoto_image_file) {
				// user photo plugin
				$peopleHTML .= '<img src="'.$upload_dir['baseurl'].'/userphoto/'.$person->userphoto_image_file.'" alt="'.$name.'" class="photo userphoto" />'."\n";
			} else {
				// gravatar
				$hash = md5( strtolower( trim($person->user_email) ) );
				$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
				$headers = @get_headers($uri);
				if ( preg_match("|200|", $headers[0]) ) {
					$peopleHTML .= get_avatar( $person->user_email, $size = '140' );
				}
			}
			
			$peopleHTML .= '<h3 class="name">';
			$peopleHTML .= isset($link) ? '<a href="'.$link.'">'.$name.'</a>' : $name;
			$peopleHTML .= "</h3>\n";
			$peopleHTML .= !empty($person->title) ? '<div class="title">'.$person->title."</div>\n" : false;
			if(!empty($postsLink) || !empty($person->user_url)) {
				$peopleHTML .= '<div class="postsandwebsite"><span class="bracket">[ </span>';
				$peopleHTML .= !empty($postsLink) ? $postsLink : false;
				if(!empty($postsLink) && !empty($person->user_url)){ $peopleHTML .= ' <span class="spacer">|</span> '; }
				$peopleHTML .= !empty($person->user_url) ? '<a href="'.$person->user_url.'" class="website">website</a>' : false;
				$peopleHTML .= '<span class="bracket"> ]</span></div>'."\n";
			}
			
			if(!empty($bio)) {
				$peopleHTML .= '<p class="bio">'.$bio."</p>\n";
			}
			
			$peopleHTML .= "</div>\n\n";
		
		} else {
			if($headingCount != 1){ $peopleHTML .= "</span>\n"; }
			$peopleHTML .= '<h2 class="heading">'.$user->ID.'</h2><span class="heading'.$headingCount.'people">'."\n\n";
			$headingCount++;
		}
	}
	
	if($headingCount > 1){ echo "</span>\n"; }
	$peopleHTML .= "</div>\n\n";
	
	return $peopleHTML;

}