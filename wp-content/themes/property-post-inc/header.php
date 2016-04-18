<?php
/**
 * Header Template
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */

// Load Theme Options
global $ct_options;

$ct_mode = isset( $ct_options['ct_mode'] ) ? esc_attr( $ct_options['ct_mode'] ) : '';
$ct_boxed = isset( $ct_options['ct_boxed'] ) ? esc_attr( $ct_options['ct_boxed'] ) : '';
$ct_top_bar = isset( $ct_options['ct_top_bar'] ) ? esc_attr( $ct_options['ct_top_bar'] ) : '';
$header_layout = isset( $ct_options['ct_header_layout'] ) ? esc_html( $ct_options['ct_header_layout'] ) : '';

?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><html <?php language_attributes(); ?>><![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php wp_head(); ?>
    
</head>

<body<?php ct_body_id('top'); ?> <?php body_class('cbp-spmenu-push'); ?>>

<?php do_action('after_body'); ?>

<?php
if($ct_boxed == "boxed") {
echo '<div class=" main">';
} ?>

	<?php do_action('before_wrapper'); ?>
    
    <!-- Wrapper -->
    <div id="wrapper" <?php if($ct_boxed == "boxed") { echo 'class="boxed"'; } ?> <?php if($ct_mode == "single-listing") { echo 'class ="single-listing-layout"'; } ?>>
    
        <div id="masthead-anchor"></div>

        <!-- Login/Register Modal -->
        <?php get_template_part('includes/login-register-modal'); ?>
        <!-- //Login/Register Modal -->

        <?php do_action('before_top_bar'); ?>
        
        <?php if($ct_top_bar == 'yes') { ?>
	        <!-- Top Bar -->
	        <div id="topbar-wrap" style="border-bottom: 1px solid #3b4d5d; border-bottom-color: #3b4d5d !important;" class="muted">
	            <div class="container">

		            <?php
					$phone = isset( $ct_options['ct_contact_phone_header'] ) ? $ct_options['ct_contact_phone_header'] : '';
		            if($ct_options['ct_header_social'] == "yes") {
						$facebook = isset( $ct_options['ct_fb_url'] ) ? esc_url( $ct_options['ct_fb_url'] ) : '';    
						$twitter = isset( $ct_options['ct_twitter_url'] ) ? esc_url( $ct_options['ct_twitter_url'] ) : '';  
						$googleplus = isset( $ct_options['ct_googleplus_url'] ) ? esc_url( $ct_options['ct_googleplus_url'] ) : '';
						$youtube = isset( $ct_options['ct_youtube_url'] ) ? esc_url( $ct_options['ct_youtube_url'] ) : '';  
						$linkedin = isset( $ct_options['ct_linkedin_url'] ) ? esc_url( $ct_options['ct_linkedin_url'] ) : '';
						$dribbble = isset( $ct_options['ct_dribbble_url'] ) ? esc_url( $ct_options['ct_dribbble_url'] ) : ''; 
						$pinterest = isset( $ct_options['ct_pinterest_url'] ) ? esc_url( $ct_options['ct_pinterest_url'] ) : '';  
						$instagram = isset( $ct_options['ct_instagram_url'] ) ? esc_url( $ct_options['ct_instagram_url'] ) : ''; 
						$github = isset( $ct_options['ct_github_url'] ) ? esc_url( $ct_options['ct_github_url'] ) : '';  
						$contact = isset( $ct_options['ct_contact_url'] ) ? esc_url( $ct_options['ct_contact_url'] ) : '';   	
					} ?>
	                
	                <?php if($phone != '') { ?>
	                <div class="contact-phone left">
                    
                    	<?php echo '<span class="flag">' ; ?>
                    		<img src="<?php bloginfo('template_directory')?>/images/flag.jpg" alt=""/> 
						<?php echo '</span>'; 
						
						 echo '<i class="fa fa-mobile-phone"></i>' . stripslashes($phone); ?>
                    </div>
                    <?php } ?>
	                
	                <div class="top-links right">
	                    <?php if($ct_options['ct_header_social'] == "yes") { ?>
	                    <ul class="social left">
							 <?php if($facebook != '') { ?>
		                        <li class="facebook"><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
		                    <?php } ?>
		                    <?php if($twitter != '') { ?>
		                        <li class="twitter"><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
		                    <?php } ?>
		                    <?php if($linkedin != '') { ?>
		                        <li class="linkedin"><a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
		                    <?php } ?>
		                    <?php if($googleplus != '') { ?>
		                        <li class="google"><a href="<?php echo esc_url($googleplus); ?>"><i class="fa fa-google-plus"></i></a></li>
		                    <?php } ?>
		                    <?php if($youtube != '') { ?>
		                        <li class="youtube"><a href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube-square"></i></a></li>
		                    <?php } ?>
		                    <?php if($dribbble != '') { ?>
		                        <li class="dribbble"><a href="<?php echo esc_url($dribbble); ?>"><i class="fa fa-dribbble"></i></a></li>
		                    <?php } ?>
		                    <?php if($pinterest != '') { ?>
		                        <li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>
		                    <?php } ?>
		                    <?php if($instagram != '') { ?>
		                        <li class="instagram"><a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a></li>
		                    <?php } ?>
		                    <?php if($github != '') { ?>
		                        <li class="github"><a href="<?php echo esc_url($github); ?>"><i class="fa fa-github"></i></a></li>
		                    <?php } ?>
		                    <?php if($contact != '') { ?>
		                        <li class="contact"><a href="<?php echo esc_url($contact); ?>"><i class="fa fa-envelope"></i></a></li>
		                    <?php } ?>
	                    </ul>
	                    <?php } ?>
	                    <?php
	                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	                        if(is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {
	                            echo '<div class="wpml-lang left">';
	                                do_action('icl_language_selector');
	                            echo '</div>';
	                        }
	                    ?>
	                    <?php if($ct_options['ct_enable_front_end'] == 'yes' && $ct_options['ct_mode'] != "single-listing") { ?>
		                    <ul class="user-frontend left">
			                    <?php if(is_user_logged_in()) {
					                    $current_user = wp_get_current_user();

					                    $saved_listings = isset( $ct_options['ct_saved_listings'] ) ? esc_html( $ct_options['ct_saved_listings'] ) : '';
					                    $submit_listing = isset( $ct_options['ct_submit'] ) ? esc_html( $ct_options['ct_submit'] ) : '';
					                    $user_listings = isset( $ct_options['ct_view'] ) ? esc_html( $ct_options['ct_view'] ) : '';
					                    $user_profile = isset( $ct_options['ct_profile'] ) ? esc_html( $ct_options['ct_profile'] ) : '';
				                    ?>
			                    	<li class="user-logged-in">
			                    		<a href="#">
				                    		<span class="user-name"><?php esc_html_e('Hi, ','contempo'); ?><?php echo esc_html($current_user->user_firstname); ?></span>
				                    		<figure>
				                    		<?php if($current_user->ct_profile_url) { ?>
							                    <img class="author-img" src="<?php echo esc_html($current_user->ct_profile_url); ?>" rel="<?php echo esc_html($current_user->user_firstname); ?>" />
									        <?php } else { ?>
												<img class="author-img" src="<?php echo get_template_directory_uri(); ?>/images/blank-user.png" />
									        <?php } ?>
							                </figure>
							                <?php
							                	$ct_user_listings = ct_listing_post_count($current_user->ID, 'listings');
							                	if($ct_user_listings >= 1) {
								                	echo '<span class="user-listing-count">' . $ct_user_listings . '</span>';
								                }
							                ?>
						                </a>
				                    	<ul class="user-drop">
					                    	<?php if ($saved_listings != '' && function_exists('wpfp_link')) { ?>
				                                <li class="saved-listings"><a href="<?php echo get_site_url() . '/?page_id=' . $saved_listings; ?>"><i class="fa fa-heart"></i> <?php esc_html_e('Favorite Listings', 'contempo'); ?></a></li>
				                            <?php } ?>
				                            <?php if (!empty($submit_listing)) { ?>
							                    <li class="submit-listing"><a href="<?php echo home_url(); ?>/?page_id=<?php echo esc_html($submit_listing); ?>"><i class="fa fa-plus"></i> <?php esc_html_e('Submit Listing', 'contempo'); ?></a></li>
						                    <?php } ?>
						                    <?php if (!empty($user_listings)) { ?>
							                    <li class="my-listings"><a href="<?php echo home_url(); ?>/?page_id=<?php echo esc_html($user_listings); ?>"><i class="fa fa-th-list"></i> <?php esc_html_e('My Listings', 'contempo'); ?> (<?php echo esc_html($ct_user_listings); ?>)</a></li>
						                    <?php } ?>
						                    <?php if (!empty($user_profile)) { ?>
							                    <li class="my-account"><a href="<?php echo home_url(); ?>/?page_id=<?php echo esc_html($user_profile); ?>"><i class="fa fa-user"></i> <?php esc_html_e('Account Settings', 'contempo'); ?></a></li>
						                    <?php } ?>
						                    <li class="logout"><a href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'contempo'); ?></a></li>
					                    </ul>
				                    </li>
			                    <?php } else { ?>
			                    	<li class="login-register"><a href="#"><i class="fa fa-sign-in"></i> <?php esc_html_e('Login / Register', 'contempo'); ?></a></li>
			                    <?php } ?>
		                    </ul>
	                    <?php } ?>
	                   
	                    
	                </div>
	                    <div class="clear"></div>
	                    
	            </div>
	        </div>
	        <!-- //Top Bar -->
	    <?php } ?>

	    <?php do_action('before_header'); ?>

        <?php
        if($ct_mode == "single-listing") { ?>

	        <!-- Single Listing Header -->
	        <header class="single-listing-header">   
		        <div class="">  
		        <?php do_action('inner_header'); ?>
		        <!-- Logo -->
		            <div class="single-listing-logo"> 
		                <?php if($ct_options['ct_text_logo'] == "yes") { ?>
		                    
		                    <div id="logo" class="left">
		                        <h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
		                    </div>
		                    
		                <?php } else { ?>
		                    
		                    <?php if(!empty($ct_options['ct_logo']['url'])) { ?>
		                        <a href="<?php echo home_url(); ?>"><img class="logo left" src="<?php echo esc_url($ct_options['ct_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>" /></a>
		                    <?php } else { ?>
		                        <a href="<?php echo home_url(); ?>"><img class="logo left" src="<?php echo get_template_directory_uri(); ?>/images/re7-logo.png" alt="WP Pro Real Estate 7, a WordPress theme by Contempo" /></a>
		                    <?php } ?>
		                    
		                <?php } ?>
	                </div>
	                <!-- //Logo -->
	            </div>
            </header>
            <!-- //Single Listing Header -->

    	<?php } else { ?>

        <!-- Header -->
        <div id="header-wrap">
            <div class="">
                <header id="masthead" class="layout-<?php echo esc_html($header_layout); ?>">
                	<?php do_action('inner_header'); ?>

                        
                        
                        
                        
                        	               

                    <?php if($header_layout == "center") { ?>


						<div class="row">
                        <div class="container">
                
                            <div class="col span_3 first">
                                &nbsp;
                            </div>
    
                            <!-- Logo -->
                            <div class="col span_6">        
                                <?php if($ct_options['ct_text_logo'] == "yes") { ?>
                                    
                                    <div id="logo" class="left">
                                        <h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
                                    </div>
                                    
                                <?php } else { ?>
                                    
                                    <?php if(!empty($ct_options['ct_logo']['url'])) { ?>
                                        <a class="logoimg" href="<?php echo home_url(); ?>">
                                        <img class="logo left" src="<?php echo esc_url($ct_options['ct_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>" /></a>
                                    <?php } else { ?>
                                        <a class="logoimg" href="<?php echo home_url(); ?>"><img class="logo left" src="<?php echo get_template_directory_uri(); ?>/images/re7-logo.png" alt="WP Pro Real Estate 7, a WordPress theme by Contempo" /></a>
                                    <?php } ?>
                                    
                                <?php } ?>
                            </div>
                            <!-- //Logo -->

							<div class="col span_3">
								<div id="header-deal" style="">
									<h3>Great Deals</h3>
									<p>For Licensed Broker</p> 
									<button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-icon-left vc_btn3-color-black"><i class="vc_btn3-icon fa fa-caret-right" href="http://propertypost.com.ph/homepage-agent/"></i> Read More</button>
								</div>
							</div>  

						</div>
                		</div>
                
                
 						<div class="row">
							<div class="col span_12">
							<div id="hdrdate">
								
								<?php echo date('l jS \of F Y '); ?>
								
							</div>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <!-- Nav -->
                            <div class="col span_12">
                                <?php ct_nav_left(); ?>
                            </div>
                            <!-- //Nav -->
                        </div>                 	                    

                        





                    <?php } elseif($header_layout == "none") { ?>
                    	
                    	<?php // No header ?>

                    <?php } ?>
                    
                    
                    
                    

                    <!-- Mobile Header -->
                    <?php ct_mobile_header(); ?>
                    <!-- //Mobile Header -->
                    
                        <div class="clear"></div>

                </header>
            </div>
        </div>
        <!-- //Header -->

        <?php do_action('before_main_content'); ?>

        <?php }  ?>
        <!-- Main Content -->
        <section id="main-content">
