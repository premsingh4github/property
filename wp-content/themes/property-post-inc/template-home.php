<?php
/**
 * Template Name: Home
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
if (!empty($_GET['search-listings'])) {
	require('search-listings.php');
	return;
}

$ct_mode = isset( $ct_options['ct_mode'] ) ? esc_html( $ct_options['ct_mode'] ) : '';
$ct_rev_slider = isset( $ct_options['ct_home_rev_slider_alias'] ) ? esc_html( $ct_options['ct_home_rev_slider_alias'] ) : '';
$ct_home_adv_search_style = isset( $ct_options['ct_home_adv_search_style'] ) ? $ct_options['ct_home_adv_search_style'] : '';
$ct_cta = isset( $ct_options['ct_cta'] ) ? $ct_options['ct_cta'] : '';
$ct_cta_bg_img = isset( $ct_options['ct_cta_bg_img']['url'] ) ? esc_url( $ct_options['ct_cta_bg_img']['url'] ) : '';
$ct_cta_bg_color = isset( $ct_options['ct_cta_bg_color'] ) ? esc_html( $ct_options['ct_cta_bg_color'] ) : '';

$layout = isset( $ct_options['ct_home_layout']['enabled'] ) ? $ct_options['ct_home_layout']['enabled'] : '';

get_header();

	// Single Listing Mode
	if($ct_mode == "single-listing") {

		get_template_part('/includes/single-listing-home');

	    if ($layout) :
	    
	    foreach ($layout as $key=>$value) {
	    
	        switch($key) {

	        // Call To Action
	        case 'cta' :   

		        echo '<!-- Call To Action -->';
		        // Custom CTA Background Image
				if(!empty($ct_cta_bg_img)) {
					echo'<style type="text/css">';
					echo '.cta { background: url(';
					echo esc_url($ct_cta_bg_img);
					echo ') no-repeat center center; background-size: cover;}';
					echo '</style>';
				} elseif(!empty($ct_cta_bg_color)) {
			        echo'<style type="text/css">';
			        echo '.dark-overlay { background: none;} ';
			        echo '.cta { background-color:';
			        echo esc_html($ct_cta_bg_color);
			        echo '}';
			        echo '</style>';
			    }    

				echo '<section class="cta center">';
					echo '<div class="dark-overlay">';
						echo '<div class="container">';
							echo stripslashes($ct_cta);
						echo'</div>';
					echo'</div>';
				echo'</section>';
				echo '<!-- //Call To Action -->';
		
	        break;

	        // Testimonials
	        case 'testimonials' :

				echo '<!-- Testimonials -->';
				echo '<section class="testimonials">';
					echo '<div class="container">';
						get_template_part('/includes/testimonials');
					echo'</div>';
				echo'</section>';
				echo '<!-- //Testimonials -->';
				echo '<div class="clear"></div>';
				
	        break;

	        // Partners
	        case 'partners' :

				echo '<!-- Partners -->';
				echo '<section class="partners">';
					echo '<div class="container">';
						get_template_part('/includes/partners');
					echo'</div>';
				echo'</section>';
				echo '<!-- //Partners -->';
				echo '<div class="clear"></div>';
				
	        break;
			
			// Page Builder
	        case 'builder' :    

		        $ct_home_page_builder_id = isset( $ct_options['ct_home_page_builder_id'] ) ? esc_attr( $ct_options['ct_home_page_builder_id'] ) : '';
	         	
	         	echo '<!-- Page Builder -->';
                echo '<section class="page-builder ' . esc_html($ct_home_page_builder_id) . '">';
                    echo '<div class="container">';
							$args = array(
								'post_type' => 'page',
								'post__in' => array($ct_home_page_builder_id)
							);
							$query = new WP_Query( $args );
							while ($query -> have_posts()) : $query -> the_post();
								the_content();
							endwhile; wp_reset_postdata();
                    echo'</div>';
					echo'<div class="clear"></div>';
                echo'</section>';
                echo '<!-- //Page Builder -->';
			
	        break;

	        // Page Builder Two
            case 'page_builder_two' :

	            $ct_home_page_builder_two_id = isset( $ct_options['ct_home_page_builder_two_id'] ) ? esc_attr( $ct_options['ct_home_page_builder_two_id'] ) : '';
                
                echo '<!-- Page Builder Two -->';
                echo '<section class="page-builder-two ' . esc_html($ct_home_page_builder_two_id) . '">';
                    echo '<div class="container">';
							$args = array(
								'post_type' => 'page',
								'post__in' => array($ct_home_page_builder_two_id)
							);
							$query = new WP_Query( $args );
							while ($query -> have_posts()) : $query -> the_post();
								the_content();
							endwhile; wp_reset_postdata();
                    echo'</div>';
					echo'<div class="clear"></div>';
                echo'</section>';
                echo '<!-- //Page Builder Two -->';
                echo '<div class="clear"></div>';
                
            break;
			
	        }
	    
	    } endif; 

	} else {

		// Multi-Listing Mode
	    if ($layout) :
	    
	    foreach ($layout as $key=>$value) {
	    
	        switch($key) {

        	// Revolution Slider
            case 'revslider' :

	            echo '<!-- Revolution Slider -->';
	            echo '<section class="rev-slider">';
	            if(class_exists('RevSlider')) {
	                putRevSlider($ct_rev_slider);
	            }
                echo '</section>';
                echo '<!-- //Revolution Slider -->';
             
            break;
				
			// FlexSlider
	        case 'slider' :

				echo '<!-- Flexslider -->';
				ct_slider();
				echo '<!-- //Flexslider -->';
				
	        break;

	        // Featured Map
	        case 'map' :

		        echo '<!-- Featured Map -->';
	        	echo '<section class="featured-map">';
						ct_featured_listings_map();
				echo'</section>';
				echo '<!-- //Featured Map -->';
				echo '<div class="clear"></div>';

	        break;

	        // Search
	        case 'listings_search' :

		        echo '<!-- Advanced Search -->';
	        	echo '<section class="advanced-search ' . $ct_home_adv_search_style . '">';
					echo '<div class="container">';
						get_template_part('/includes/advanced-search');
					echo'</div>';
				echo'</section>';
				echo '<!-- //Advanced Search -->';
				echo '<div class="clear"></div>';
		

		
	        break;

	        // dsIDXpress Search
	        case 'dsidxpress_search' :

		        echo '<!-- dsIDXpress Search -->';
	        	echo '<section class="advanced-search dsidxpress">';
					echo '<div class="container">';
						get_template_part('/includes/advanced-search-idx');
					echo'</div>';
				echo'</section>';
				echo '<!-- //dsIDXpress Search -->';
				echo '<div class="clear"></div>';

	        break;

	        // Call To Action
	        case 'cta' :   

		        echo '<!-- Call To Action -->';
		        // Custom CTA Background Image
				if(!empty($ct_cta_bg_img)) {
					echo'<style type="text/css">';
					echo '.cta { background: url(';
					echo esc_url($ct_cta_bg_img);
					echo ') no-repeat center center; background-size: cover;}';
					echo '</style>';
				} elseif(!empty($ct_cta_bg_color)) {
			        echo'<style type="text/css">';
			        echo '.dark-overlay { background: none;} ';
			        echo '.cta { background-color:';
			        echo esc_html($ct_cta_bg_color);
			        echo '}';
			        echo '</style>';
			    }    

				echo '<section class="cta center">';
					echo '<div class="dark-overlay">';
						echo '<div class="container">';
							echo stripslashes($ct_cta);
						echo'</div>';
					echo'</div>';
				echo'</section>';
				echo '<!-- //Call To Action -->';
		
	        break;
	        
			// Featured Listings
	        case 'featured_listings' :

				echo '<!-- Featured Listings -->';
				echo '<section class="featured-listings">';
					echo '<div class="container">';
						get_template_part('/includes/featured-listings');
					echo'</div>';
				echo'</section>';
				echo '<!-- //Featured Listings -->';
				echo '<div class="clear"></div>';
				
	        break;

	        // Testimonials
	        case 'testimonials' :
			
		echo '<section class="page-builder-two section-hootboard">';	
		echo '<div class="">';
		
			echo do_shortcode('[displayhootboard]');

		
		echo '</div>';
		echo '</div>';				

				echo '<!-- Testimonails -->';
				echo '<section class="testimonials">';
					echo '<div class="container">';
						get_template_part('/includes/testimonials');
					echo'</div>';
				echo'</section>';
				echo '<!-- //Testimonails -->';
				echo '<div class="clear"></div>';
				
	        break;

	        // Partners
	        case 'partners' :
			
		

				echo '<!-- Partners -->';
				echo '<section class="partners">';
					echo '<div class="container">';
					echo '<div class="container-inner">';
							get_template_part('/includes/partners');
					echo '</div>';
					echo'</div>';
				echo'</section>';
				echo '<!-- //Partners -->';
				echo '<div class="clear"></div>';
				
	        break;
			
			// Page Builder
	        case 'builder' :    

		        $ct_home_page_builder_id = isset( $ct_options['ct_home_page_builder_id'] ) ? esc_attr( $ct_options['ct_home_page_builder_id'] ) : '';
	         	
	         	echo '<!-- Page Builder -->';
                echo '<section class="page-builder ' . esc_html($ct_home_page_builder_id) . '">';
                    echo '<div class="container">';
							$args = array(
								'post_type' => 'page',
								'post__in' => array($ct_home_page_builder_id)
							);
							$query = new WP_Query( $args );
							while ($query -> have_posts()) : $query -> the_post();
								the_content();
							endwhile; wp_reset_postdata();
                    echo'</div>';
					echo'<div class="clear"></div>';
                echo'</section>';
                echo '<!-- //Page Builder -->';
			
	        break;

	        // Page Builder Two
            case 'page_builder_two' :

	            $ct_home_page_builder_two_id = isset( $ct_options['ct_home_page_builder_two_id'] ) ? esc_attr( $ct_options['ct_home_page_builder_two_id'] ) : '';
                
                echo '<!-- Page Builder Two -->';
                echo '<section class="page-builder-two ' . esc_html($ct_home_page_builder_two_id) . '">';
                    echo '<div class="container">';
							$args = array(
								'post_type' => 'page',
								'post__in' => array($ct_home_page_builder_two_id)
							);
							$query = new WP_Query( $args );
							while ($query -> have_posts()) : $query -> the_post();
								the_content();
							endwhile; wp_reset_postdata();
                    echo'</div>';
					echo'<div class="clear"></div>';
                echo'</section>';
                echo '<!-- //Page Builder Two -->';
                echo '<div class="clear"></div>';
                
            break;
			
			// Widgets
	        case 'widgets' :      

	         	echo '<!-- Four Column Widgets -->';
                 echo '<div class="home-widgets-wrap">';
                     echo '<div class="container"> '; 
	                    if (is_active_sidebar('four-column-homepage')) {
			                dynamic_sidebar('Four Column Homepage');
			            }
			            echo '<div class="clear"></div>';
                     echo '</div>';                    
                 echo '</div>';
                 echo '<!-- //Four Column Widgets -->';
			
	        break;
			
	        }
	    
	    } endif; 

	}
	
get_footer(); ?>