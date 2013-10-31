<?php
/** 
  * The Header for our theme. 
  * 
  * Displays all of the <head> section and everything up till <div id="main"> 
  * 
  * @package CDATwentyThirteen 
  * @since CDATwentyThirteen 1.0 
  */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<!-- CDATwentyThirteen - Responsive HTML5/CSS3 WordPress Theme by Ruben Woudsma http://rubenwoudsma.nl -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<!-- Mobile specific information/needs -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=<?php echo of_get_option('viewport-maximum-scale', '1'); ?>">
	<title><?php		
		/*		 
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		//WP SEO by Yoast		
		if( function_exists( 'wpseo_get_value' ) ){
				wp_title('');
		}
		//Standard
		else {
			wp_title( '&ndash;', true, 'right' );
			// Add the blog name.
			bloginfo( 'name' );
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " &ndash; $site_description";
			
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'cdatwentythirteen' ), max( $paged, $page ) );
		}
		?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>	
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>	
	<![endif]-->	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- BEGIN #page -->	
	<div id="page" class="wrap hfeed site">
	
		<!-- BEGIN .foldout-container -->
		<!-- Foldout section begin - used for the search and additional information -->		
		<div class="foldout-container">
			<?php if( of_get_option('enable-foldout-container') ) : ?>
				<aside class="foldout-panel">
					<div class="container">
						<?php dynamic_sidebar( 'foldout-container' ); ?>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</div>
	<!-- END .foldout-container -->
		
	<?php do_action( 'before' ); ?>
		
	<!-- BEGIN #header -->		
	<header id="header" class="site-header" role="banner">
	
		<!-- BEGIN #header-inner -->
		<div id="header-inner" class="header-department container">
			<?php if( of_get_option( 'show-department-header' ) ) : ?>
				<hgroup id="masthead">
					<h1 id="site-title" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</hgroup>
			<?php endif; ?>
		</div>
		<!-- END #header-inner -->
		
		<!-- BEGIN #header-bottom -->
		<div id="header-bottom" class="header-navigation-container">
			<?php
				$pre_wrap = '
									<h1 class="assistive-text">'. __( 'Menu', 'cdatwentythirteen' ).'</h1>
									<div class="assistive-text skip-link"><a href="#content" title="'.esc_attr( 'Skip to content', 'cdatwentythirteen' ) .'">'.__( 'Skip to content', 'cdatwentythirteen' ).'</a></div>
									<a href="#main-nav-menu" class="mobile-menu-button button">Menu <i class="icon-reorder"></i></a>';
				
				if( of_get_option( 'enable-foldout-container' ) ) {
					$foldout_option = '<li class="menu-item menu-item-foldout action"><a href="#" id="foldout-panel-opener">Zoeken</a></li>';
				} else {
					$foldout_option = '';
				}
				
				$wrap_root = '<li class="rootpage">
					<a title="Navigate to root section" href="' . esc_url( home_url( '/' ) ) . '">
						<span class="parent-organisation">ChristenDemocratisch Appèl</span>
						<span class="department">' . of_get_option( 'department-code' ) . '</span>
					</a>
				</li>';
				
				wp_nav_menu( array(
					'theme_location'	=> 'primary',
					'container'			=> 'nav',
					'container_class'	=> 'menu-primary-container container site-navigation main-navigation',
					'container_id'		=> 'main-nav',
					'menu_class'		=> 'nav-menu',
					'menu_id'			=> 'main-nav-menu',
					'items_wrap'		=> $pre_wrap.'<ul id="%1$s" class="%2$s">'.$wrap_root.'%3$s'.$foldout_option.'</ul>',
					'fallback_cb'		=> 'cdatwentythirteen_nav_hint'
				) );
			?>
		</div>
		<!-- END #header-bottom -->
		
	</header>
	<!-- END #header -->