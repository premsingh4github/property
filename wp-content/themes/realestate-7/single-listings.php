<?php
/**
 * Single Template
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options;
$ct_listing_tools = isset( $ct_options['ct_listing_tools'] ) ? esc_html( $ct_options['ct_listing_tools'] ) : '';
$ct_listing_propinfo = isset( $ct_options['ct_listing_propinfo'] ) ? esc_html( $ct_options['ct_listing_propinfo'] ) : '';
$ct_listing_agent_info = isset( $ct_options['ct_listing_agent_info'] ) ? esc_html( $ct_options['ct_listing_agent_info'] ) : '';
$ct_listing_section_nav = isset( $ct_options['ct_listing_section_nav'] ) ? esc_html( $ct_options['ct_listing_section_nav'] ) : '';

get_header();
 
if (!empty($_GET['search-listings'])) {
	require('search-listings.php');
	return;
}

$cat = get_the_category();

do_action('before_single_listing_header');

// Header
echo '<header id="title-header">';
	echo '<div class="container">';
		echo '<div class="left">';
			echo '<h5 class="marT0 marB0">';
    			esc_html_e('Listings', 'contempo');
			echo '</h5>';
		echo '</div>';
		echo ct_breadcrumbs();
		echo '<div class="clear"></div>';
	echo '</div>';
echo '</header>';

// Listing Tools
if($ct_listing_tools == 'yes') { ?>

<!-- Listing Tools -->
<div id="tools">
    <ul class="social marB0">
        <li class="twitter"><a href="javascript:void(0);" onclick="popup('http://twitter.com/home/?status=<?php esc_html_e('Check out this great listing on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php ct_listing_title(); ?> &mdash; <?php the_permalink(); ?>', 'twitter',500,260);"><i class="fa fa-twitter"></i></a></li>
        <li class="facebook"><a href="javascript:void(0);" onclick="popup('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php esc_html_e('Check out this great listing on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php ct_listing_title(); ?>', 'facebook',658,225);"><i class="fa fa-facebook"></i></a></li>
        <li class="linkedin"><a href="javascript:void(0);" onclick="popup('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php esc_html_e('Check out this great listing on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php ct_listing_title(); ?>&summary=&source=<?php bloginfo('name'); ?>', 'linkedin',560,400);"><i class="fa fa-linkedin"></i></a></li>
        <li class="google"><a href="javascript:void(0);" onclick="popup('https://plusone.google.com/_/+1/confirm?hl=en&url=<?php the_permalink(); ?>', 'google',500,275);"><i class="fa fa-google-plus"></i></a></a></li>
        <li class="print"><a class="print" href="javascript:window.print()"><i class="fa fa-print"></i></a></li>
    </ul>
    <span id="tools-toggle"><a href="#"><span id="text-toggle"><?php esc_html_e('Close', 'contempo'); ?></span></a></span>
</div>
<!-- //Listing Tools -->

<?php } 

do_action('before_single_listing_content');

echo '<div class="container">';

		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article class="col span_9 marB60">

            <!-- FPO Site name -->
	        <h4 id="sitename-for-print-only">
	            <?php bloginfo('name'); ?>
	        </h4>

            <?php do_action('before_single_listing_location'); ?>

            <!-- Location -->
	        <header class="listing-location">
                <div class="snipe-wrap">
                    <?php
                    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                    if(is_plugin_active('co-authors-plus/co-authors-plus.php')) {
                        if ( 2 == count( get_coauthors( get_the_id() ) ) ) { ?>
                            <h6 class="snipe co-listing"><span><?php esc_html_e('Co-listing', 'contempo'); ?></span></h6>
                        <?php }
                    } ?>
    		        <?php ct_status(); ?>
                        <div class="clear"></div>
                </div>
                <h2 class="marT5 marB0"><?php ct_listing_title(); ?></h2>
	            <p class="location marB0"><?php city(); ?>, <?php state(); ?> <?php zipcode(); ?><?php country(); ?></p>
            </header>

            <?php do_action('before_single_ct_listing_price'); ?>
            
            <!-- Price -->
            <h4 class="price marT0 marB0"><?php ct_listing_price(); ?></h4>

            <?php do_action('before_single_listing_propinfo'); ?>

            <?php if(empty($ct_listing_propinfo) || $ct_listing_propinfo == 'above') { ?>
            <!-- Listing Info -->
            <ul class="propinfo marB0">
				<?php ct_propinfo(); ?>
                <?php if(get_post_meta($post->ID, "_ct_mls", true)) {
                    echo '<li class="row propid">';
                        echo '<span class="muted left">';
                            _e('Property ID', 'contempo');
                        echo '</span>';
                        echo '<span class="right">';
                             echo '#' . get_post_meta($post->ID, "_ct_mls", true);
                        echo '</span>';
                    echo '</li>';
                } ?>
            </ul> 
            <!-- //Listing Info -->  
            <?php } ?>

            <!-- FPO First Image -->
            <figure id="first-image-for-print-only">
                <?php ct_first_image_lrg(); ?>
            </figure>

            <?php do_action('before_single_listing_lead_media'); ?>
            
            <!-- Lead Media -->
            <?php

            $listingslides = get_post_meta($post->ID, "_ct_slider", true);

            if(!empty($listingslides)) {
                // Grab Slider custom field images
                $imgattachments = get_post_meta($post->ID, "_ct_slider", true);
            } else {
                // Grab images attached to post via Add Media
                $imgattachments = get_children(
                array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'post_parent' => $post->ID
                ));
            }
            ?>
            <figure id="lead-media" <?php if(count($imgattachments) <= 1) { ?>class="single-image"<?php } ?>>
				<?php
                if(count($imgattachments) > 1) { ?>
                    <div id="slider" class="flexslider">
                        <?php ct_property_type_icon(); ?>
                        <?php ct_fav_listing(); ?>
                        <ul class="slides">
                            <?php if(!empty($listingslides)) {
                                ct_slider_field_images();
                            } else {
                                ct_slider_images();
                            } ?>
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            <?php if(!empty($listingslides)) {
                                ct_slider_field_carousel_images();
                            } else {
                                ct_slider_carousel_images();
                            } ?>
                        </ul>
                    </div>
                <?php } else { ?>
                    <?php ct_property_type_icon(); ?>
                    <?php ct_fav_listing(); ?>
                    <?php ct_first_image_lrg(); ?>
                <?php } ?>
            </figure>
            <!-- //Lead Media -->

            <?php if($ct_listing_propinfo == 'below') { ?>
            <!-- Listing Info -->
            <ul class="propinfo marB0">
                <?php ct_propinfo(); ?>
                <?php if(get_post_meta($post->ID, "_ct_mls", true)) {
                    echo '<li class="row propid">';
                        echo '<span class="muted left">';
                            _e('Property ID', 'contempo');
                        echo '</span>';
                        echo '<span class="right">';
                             echo '#' . get_post_meta($post->ID, "_ct_mls", true);
                        echo '</span>';
                    echo '</li>';
                } ?>
            </ul> 
            <!-- //Listing Info -->  
            <?php } ?>

            <?php if($ct_listing_section_nav != 'no') { ?>
            <nav id="listing-sections">
                <ul>
                    <li class="listing-nav-icon"><i class="fa fa-navicon"></i></li>
                    <li><a href="#listingfeatures"><?php _e('Listing Features', 'contempo'); ?></a></li>
                    <li><a href="#listingattachments"><?php _e('Attachments', 'contempo'); ?></a></li>
                    <li><a href="#listingvideo"><?php _e('Video', 'contempo'); ?></a></li>
                    <li><a href="#location"><?php _e('Location', 'contempo'); ?></a></li>
                    <li><a href="#listingcontact"><?php _e('Contact', 'contempo'); ?></a></li>
                </ul>
            </nav>
            <?php } ?>

            <?php do_action('before_single_listing_content'); ?>
            
            <div class="post-content">

                <!-- Content -->
				<?php the_content(); ?>

                <?php 
                global $ct_options;

                $ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';

                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                if($ct_rentals_booking == 'yes' || is_plugin_active('booking/wpdev-booking.php')) {

                    $checkin = get_post_meta($post->ID, "_ct_rental_checkin", true);
                    $checkout = get_post_meta($post->ID, "_ct_rental_checkout", true);

                    if( !empty($checkin) || !empty($checkout) ) { ?>
                    <!-- Info -->
                    <ul class="propinfo marB0 pad0">
                        <?php ct_rental_info(); ?>
                    </ul>
                    <!-- //Info -->
                    <?php } ?>

                    <?php

                    $extra_people = get_post_meta($post->ID, "_ct_rental_extra_people", true);
                    $cleaning = get_post_meta($post->ID, "_ct_rental_cleaning", true);
                    $cancellation = get_post_meta($post->ID, "_ct_rental_cancellation", true);
                    $deposit = get_post_meta($post->ID, "_ct_rental_deposit", true);

                    if( !empty($extra_people) || !empty($cleaning) || !empty($cancellation) || !empty($deposit) ) { ?>
                    <!-- Costs & Fees -->
                    <h5 class="marT20"><?php esc_html_e('Prices', 'contempo'); ?></h5>
                    <ul class="propinfo marB0 pad0">
                        <?php ct_rental_costs(); ?>
                    </ul>
                    <!-- //Costs & Fees -->
                    <?php }

                } ?>

                <?php do_action('before_single_listing_featlist'); ?>
                
                <!-- Feature List -->
                <div id="listingfeatures">
                    <?php addfeatlist(); ?>
                </div>

                <!-- Booking Calendar -->
                <?php 
                    $book_cal_shortcode = get_post_meta($post->ID, "_ct_booking_cal_shortcode", true);
                    if(!empty($book_cal_shortcode)) {
                        echo '<div class="booking-form-calendar">';
                            echo '<h4 class="border-bottom marB18">' . __('Book this listing', 'contempo') . '</h4>';
                            echo do_shortcode($book_cal_shortcode);
                            echo '<div class="clear"></div>';
                        echo '</div>';
                    }
                ?>
                <!-- //Booking Calendar -->

                <?php do_action('before_single_listing_attachments'); ?>

                <!-- Listing Attachments -->
                <?php
                    $fileattachments = get_post_meta( get_the_ID(), '_ct_files', 1 );

                    if ($fileattachments) {
                        echo '<h4 id="listingattachments" class="border-bottom marB20">' .  __('Attachments', 'contempo') . '</h4>';
                        echo '<ul class="attachments col span_4">';
                        $count = 0;
                        
                        foreach ($fileattachments as $attachment_id => $attachment_url) {
                            $attachment_title =  get_the_title($attachment_id);
                            echo '<li>';
                                echo '<a href="' . $attachment_url . '" target="_blank">';
                                    echo '<i class="fa fa-file-' . ct_get_mime_for_attachment($attachment_id) . '-o"></i>';
                                    echo $attachment_title;
                                echo '</a>';
                            echo '</li>';
                            $count++;
                            if ($count == 3) {
                                echo '</ul><ul class="attachments col span_4">';
                                $count = 0;
                            }
                        }
                        echo '</ul>';
                            echo '<div class="clear"></div>';
                    }
                ?>
                <!-- //PDF Attachments -->

                <?php do_action('before_single_listing_video'); ?>
                
                <!-- Video -->
                <?php
                $ct_video_url = get_post_meta($post->ID, "_ct_video", true);
                $ct_embed_code = wp_oembed_get( $ct_video_url, $args );
                if($ct_video_url) { ?>
                <div id="listingvideo" class="videoplayer marB20">
                    <h4 class="border-bottom marB20"><?php esc_html_e('Video', 'contempo'); ?></h4>
                    <?php echo $ct_embed_code; ?>
                </div>       
                <?php } ?>
                <!-- //Video -->

                <?php do_action('before_single_listing_map'); ?>
                
                <!-- Map -->
                <?php if($ct_options['ct_disable_google_maps'] == 'no') { ?>
                <div id="location">
                    <h4 class="border-bottom marB18"><?php esc_html_e('Location', 'contempo'); ?></h4>
                    <?php ct_listing_map(); ?>
                </div>  
                <?php } ?>
                <!-- //Map -->
            </div>       

            <?php do_action('before_single_listing_agent'); ?>

            <?php if($ct_listing_agent_info != 'no') { ?>
            <!-- Agent Contact -->
            <div id="listingcontact" class="marb20 listing-agent-contact">
                <div class="main-agent">
    	            <?php 
                		$first_name = get_the_author_meta('first_name');
    					$last_name = get_the_author_meta('last_name');
    					$author_id = get_the_author_meta('ID');
    					$tagline = get_the_author_meta('tagline');
    					$mobile = get_the_author_meta('mobile');
    					$office = get_the_author_meta('office');
    					$fax = get_the_author_meta('fax');
    					$email = get_the_author_meta('email');
                        $twitterhandle = get_the_author_meta('twitterhandle');
                        $facebookurl = get_the_author_meta('facebookurl');
                        $linkedinurl = get_the_author_meta('linkedinurl');
                        $gplus = get_the_author_meta('gplus');
    				?>
    	            <h4 class="border-bottom marB20"><a href="<?php echo esc_url(home_url()); ?>/?author=<?php esc_html($author_id); ?>"><?php echo esc_html($first_name); ?> <?php echo esc_html($last_name); ?></a></h4>

                    <?php do_action('before_single_listing_agent_img'); ?>

                	<div class="col span_4 first agent-info">
        	            <?php if(get_the_author_meta('ct_profile_url')) {
        						echo '<figure class="col span_12 first row">';
        						echo '<a href="';
        						echo site_url() . '/?author=';
        						echo the_author_meta('ID');
        						echo '">';
        						echo '<img class="authorimg" src="';
        						echo the_author_meta('ct_profile_url');
        						echo '" />';
        						echo '</a>';
        						echo '</figure>';
        				} ?>

                        <?php do_action('before_single_listing_agent_details'); ?>

        				<div class="details col span_12 first row">	        
        			        <ul class="marB0">
        			            <?php if($mobile) { ?>
        				            <li class="marT3 marB0 row"><span class="left"><i class="fa fa-phone"></i></span><span class="right"><?php echo esc_html($mobile); ?></span></li>
        			            <?php } ?>
        			            <?php if($office) { ?>
        				            <li class="marT3 marB0 row"><span class="left"><i class="fa fa-building"></i></span><span class="right"><?php echo esc_html($office); ?></span></li>
        			            <?php } ?>
        			            <?php if($fax) { ?>
        				            <li class="marT3 marB0 row"><span class="left"><i class="fa fa-print"></i></span><span class="right"><?php echo esc_html($fax); ?></span></li>
        				        <?php } ?>
        			        	<?php if($email) { ?>
        				        	<li class="marT3 marB0 row"><span class="left"><i class="fa fa-envelope"></i></span><span class="right"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php esc_html_e('Email', 'contempo'); ?></a></span></li>
        					    <?php } ?>
        					</ul>
                            <ul class="social marT15 marL0">
                                <?php if ($twitterhandle) { ?><li class="twitter"><a href="http://twitter.com/#!/<?php echo esc_html($twitterhandle); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                                <?php if ($facebookurl) { ?><li class="facebook"><a href="<?php echo esc_url($facebookurl); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                                <?php if ($linkedinurl) { ?><li class="facebook"><a href="<?php echo esc_url($linkedinurl); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                                <?php if ($gplus) { ?><li class="google"><a href="<?php echo esc_url($gplus); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                            </ul>
        			    </div>
                    </div>

                    <?php do_action('before_single_listing_agent_contact'); ?>
                    
                    <div class="col span_8 agent-contact">
                    	<h5 class="marT0 marB20"><?php esc_html_e('Request More Information', 'contempo'); ?></h5>
                    	 <form id="listingscontact" class="formular" method="post">
        					<fieldset class="col span_12">
        						<select id="ctsubject" name="ctsubject">
        							<option><?php esc_html_e('Tell me more about this property', 'contempo'); ?></option>
        							<option><?php esc_html_e('Request a showing', 'contempo'); ?></option>
        						</select>
        							<div class="clear"></div>
        						<input type="text" name="name" id="name" class="validate[required] text-input" placeholder="<?php esc_html_e('Name', 'contempo'); ?>" />

        						<input type="text" name="email" id="email" class="validate[required,custom[email]] text-input" placeholder="<?php esc_html_e('Email', 'contempo'); ?>" />

        						<input type="text" name="ctphone" id="ctphone" class="text-input" placeholder="<?php esc_html_e('Phone', 'contempo'); ?>" />

        						<textarea class="validate[required,length[2,1000]] text-input" name="message" id="message" rows="6" cols="10"></textarea>

        						<input type="hidden" id="ctyouremail" name="ctyouremail" value="<?php the_author_meta('user_email'); ?>" />
        						<input type="hidden" id="ctproperty" name="ctproperty" value="<?php the_title(); ?>, <?php city(); ?>, <?php state(); ?> <?php zipcode(); ?>" />
        						<input type="hidden" id="ctpermalink" name="ctpermalink" value="<?php the_permalink(); ?>" />

        						<input type="submit" name="Submit" value="<?php esc_html_e('Submit', 'contempo'); ?>" id="submit" class="btn" />  
        					</fieldset>
        				</form>
                    </div>
                </div>
                        <div class="clear"></div>

                <?php
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                if(is_plugin_active('co-authors-plus/co-authors-plus.php')) {
                    if (count( get_coauthors(get_the_id())) >= 2) { ?>
                    <!-- Co Agent -->
                    <div class="co-list-agent col span_12 first marB20">
                        <h5 class="border-bottom marB20"><?php esc_html_e('Co-listing Agent', 'contempo'); ?></h5>
                        <?php

                            $coauthors = get_coauthors();

                            // Remove the first author/agent
                            array_shift($coauthors);

                            echo '<ul id="co-agent" class="marB0">';
                                foreach($coauthors as $coauthor) {
                                    echo '<li class="agent">';
                                        if($coauthor->ct_profile_url) {
                                            echo '<figure class="col span_3 first">';
                                                echo '<img class="author-img" src="' . esc_html($coauthor->ct_profile_url) . '" />';
                                            echo '</figure>';
                                        }
                                        echo '<div class="agent-info col span_9">';
                                            echo '<h4 class="marT0 marB0">' . esc_html($coauthor->display_name) . '</h4>';
                                            if ($coauthor->title) { 
                                                echo '<h5 class="muted marB10">' . esc_html($coauthor->title) . '</h5>';
                                            } ?>
                                            <div class="agent-bio col span_8 first">
                                               <?php if($coauthor->tagline) { ?>
                                                   <p class="tagline"><strong><?php echo esc_html($coauthor->tagline); ?></strong></p>
                                               <?php } ?>
                                               <ul class="col span_8 marT15 first">
                                                    <?php if($coauthor->mobile) { ?>
                                                        <li class="row"><span class="muted left"><i class="fa fa-phone"></i></span> <span class="right"><?php echo esc_html($coauthor->mobile); ?></span></span></li>
                                                    <?php } ?>
                                                    <?php if($coauthor->office) { ?>
                                                        <li class="row"><span class="muted left"><i class="fa fa-building"></i></span> <span class="right"><?php echo esc_html($coauthor->office); ?></span></li>
                                                    <?php } ?>
                                                    <?php if($coauthor->fax) { ?>
                                                        <li class="row"><span class="muted left"><i class="fa fa-print"></i></span> <span class="right"><?php echo esc_html($coauthor->fax); ?></span></li>
                                                    <?php } ?>
                                                    <?php if($coauthor->user_email) { $email = $coauthor->user_email; ?>
                                                        <li class="row"><span class="muted left"><i class="fa fa-envelope"></i></span> <span class="right"><a href="mailto:<?php echo antispambot($email,1 ) ?>"><?php esc_html_e('Email', 'contempo'); ?></a></span></li>
                                                    <?php } ?>
                                                    <?php if($coauthor->brokername) { ?><p class="marB3"><strong><?php echo esc_html($coauthor->brokername); ?></strong></p><?php } ?>
                                                    <?php if($coauthor->brokernum) { ?><p class="marB3"><?php echo esc_html($coauthor->brokernum); ?></p><?php } ?>
                                                </ul>
                                                
                                            </div>
                                            <ul class="social">
                                                <?php if ($coauthor->twitterhandle) { ?><li class="twitter"><a href="http://twitter.com/#!/<?php echo esc_url($coauthor->twitterhandle); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                                                <?php if ($coauthor->facebookurl) { ?><li class="facebook"><a href="<?php echo esc_url($coauthor->facebookurl); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                                                <?php if ($coauthor->linkedinurl) { ?><li class="facebook"><a href="<?php echo esc_url($coauthor->linkedinurl); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                                                <?php if ($coauthor->gplus) { ?><li class="google"><a href="<?php echo esc_url($coauthor->gplus); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                                            </ul>
                                        </div>
                                   <?php  echo '</li>';
                                }
                            echo '</ul>';
                        ?>
                    </div>
                        <div class="clear"></div>
                    <!-- //Co Agent -->
                    <?php }
                } ?>

            </div>
            <!-- //Agent Contact -->
            <?php } ?>

            <?php do_action('before_single_listing_community'); ?>

            <?php
            $terms = $terms = get_the_terms( $post->id, 'community' );
            if ($terms) { ?>
                <!-- Sub Listings -->
                <div class="marb20 sub-listings">
                     <h4 class="border-bottom marB20"><?php esc_html_e('Other Listings in Community', 'contempo'); ?></h4>
                     <?php get_template_part('includes/sub-listings'); ?>
                </div>
                <!-- //Sub Listings -->
            <?php } ?>

             <?php endwhile; endif; ?>
            
                    <div class="clear"></div>

        </article>

        <?php do_action('before_single_listing_sidebar'); ?>
        
        <div id="sidebar" class="col span_3">
            <?php if (is_active_sidebar('listings-single-right')) {
                dynamic_sidebar('listings-single-right');
            } ?>
        </div>

        <?php do_action('after_single_listing_sidebar'); ?>

</div>

<?php get_footer(); ?>