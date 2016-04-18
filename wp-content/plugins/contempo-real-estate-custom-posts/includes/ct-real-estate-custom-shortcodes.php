<?php

/**
 * Register Custom Shortcodes
 *
 * @link       http://contempographicdesign.com
 * @since      1.0.0
 *
 * @package    Contempo Real Estate Custom Posts
 * @subpackage ct-real-estate-custom-posts/includes
 */

/*-----------------------------------------------------------------------------------*/
/* Listings Shortcode */
/*-----------------------------------------------------------------------------------*/

function ct_listings_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'orderby' => '',
			'order' => '',
			'meta_key' => '',
			'meta_type' => '',
			'number' => '6',
			'type' => '',
			'beds' => '',
                        'parking' => '',
			'baths' => '',
                        'classification' => '',
			'status' => '',
			'city' => '',
			'state' => '',
			'zipcode' => '',
			'country' => '',
			'community' => '',
                        'referring_partner' => '',
			'additional_features' => ''
		), $atts )
	);

	// Output
	echo '<ul class="col span_12 row">';

		global $post;
    	$args = array(
            'ct_status' => $status,
            'property_type' => $type,
            'beds' => $beds,
            'parking' => $parking,
            'commission' => $commission,
            'baths' => $baths,
            'classification' => $classification,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'country' => $country,
            'community' => $community,
            'referring_partner' => $referring_partner,
            'additional_features' => $additional_features,
            'post_type' => 'listings',
            'orderby' => $orderby,
			'order' => $order,
			'meta_key' => $meta_key,
			'meta_type' => 'numeric',
            'posts_per_page' => $number
        );
        $wp_query = new wp_query( $args ); 
        
        $count = 0; if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $city = strip_tags( get_the_term_list( $wp_query->post->ID, 'city', '', ', ', '' ) );
        $state = strip_tags( get_the_term_list( $wp_query->post->ID, 'state', '', ', ', '' ) );
        $zipcode = strip_tags( get_the_term_list( $wp_query->post->ID, 'zipcode', '', ', ', '' ) );
        $country = strip_tags( get_the_term_list( $wp_query->post->ID, 'country', '', ', ', '' ) );

        $beds = strip_tags( get_the_term_list( $wp_query->post->ID, 'beds', '', ', ', '' ) );
	    $baths = strip_tags( get_the_term_list( $wp_query->post->ID, 'baths', '', ', ', '' ) );
            $parking = strip_tags( get_the_term_list( $wp_query->post->ID, 'parking', '', ', ', '' ) );

        ?>
            
        <li class="listing col span_4 <?php if($count % 3 == 0) { echo 'first'; } ?>">
            <figure>
                <?php
	                $status_tags = strip_tags( get_the_term_list( $wp_query->post->ID, 'ct_status', '', ' ', '' ) );
					if($status_tags != '') {
						echo '<h6 class="snipe ';
								$status_terms = get_the_terms( $wp_query->post->ID, 'ct_status', array() );
								if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ){
								     foreach ( $status_terms as $term ) {
								       echo esc_html($term->slug) . ' ';
								     }
								 }
							echo '">';
							echo '<span>';
								echo esc_html($status_tags);
							echo '</span>';
						echo '</h6>';
					}
                ?>
                <?php if( function_exists('ct_property_type_icon') ) {
                	ct_property_type_icon();
            	} ?>
                <?php if (function_exists('wpfp_link')) { ?><span class="save-this"><?php wpfp_link(); ?></span><?php } ?>
                <?php if( function_exists('ct_first_image_linked') ) {
                	ct_first_image_linked();
                } ?>
            </figure>
            <div class="grid-listing-info">
	            <header>
	                <h5 class="marB0"><a href="<?php the_permalink(); ?>"><?php if( function_exists('ct_listing_title') ) { ct_listing_title(); } ?></a></h5>
	                <p class="location muted marB0"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zipcode); ?> <?php echo esc_html($country); ?></p>
                </header>
                <p class="price marB0"><?php if( function_exists('ct_listing_price') ) { ct_listing_price(); } ?></p>
	            <div class="propinfo">
	            	<p><?php if( function_exists('ct_excerpt') ) { echo ct_excerpt(25); } ?></p>
	                <ul class="marB0">
						<?php

					    if( function_exists('ct_has_type') ) {
						    if(ct_has_type('commercial') || ct_has_type('lot') || ct_has_type('land')) { 
						        // Dont Display Bed/Bath
						    } else {
						    	echo '<li class="row beds">';
						    		echo '<span class="muted left">';
						    			_e('Bed', 'contempo');
						    		echo '</span>';
						    		echo '<span class="right">';
						               echo $beds;
						            echo '</span>';
						        echo '</li>';
						        echo '<li class="row baths">';
						            echo '<span class="muted left">';
						    			_e('Baths', 'contempo');
						    		echo '</span>';
						    		echo '<span class="right">';
						               echo $baths;
						            echo '</span>';
						        echo '</li>';
						    }
						}
					    include_once ABSPATH . 'wp-admin/includes/plugin.php';
						if(is_plugin_active('booking/wpdev-booking.php')) {
						    if((get_post_meta($post->ID, "_ct_rental_guests", true))) {
						        echo '<li class="row guests">';
						            echo '<span class="muted left">';
						                _e('Guests', 'contempo');
						            echo '</span>';
						            echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_rental_guests", true);
						            echo '</span>';
						        echo '</li>';
						    }

						    if((get_post_meta($post->ID, "_ct_rental_min_stay", true))) {
						        echo '<li class="row min-stay">';
						            echo '<span class="muted left">';
						                _e('Min Stay', 'contempo');
						            echo '</span>';
						            echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_rental_min_stay", true);
						            echo '</span>';
						        echo '</li>';
						    }
						}
					    
					    if((get_post_meta($post->ID, "_ct_sqft", true))) {
					        echo '<li class="row sqft">';
					            echo '<span class="muted left">';
					            	if( function_exists('ct_sqftsqm') ) {
						    			ct_sqftsqm();
						    		}
					    		echo '</span>';
					    		echo '<span class="right">';
					                 echo get_post_meta($post->ID, "_ct_sqft", true);
					            echo '</span>';
					        echo '</li>';
					    }
					    
					    // if((get_post_meta($post->ID, "_ct_lotsize", true))) {
					    //     if((get_post_meta($post->ID, "_ct_sqft", true))) {
					    //         echo '<li class="row lotsize">';
					    //     }
					    //         echo '<span class="muted left">';
					    // 			_e('Lot Size', 'contempo');
					    // 		echo '</span>';
					    // 		echo '<span class="right">';
					    //              echo get_post_meta($post->ID, "_ct_lotsize", true);
					    //              ct_acres();
					    //         echo '</span>';
					            
					    //     if((get_post_meta($post->ID, "_ct_sqft", true))) {
					    //         echo '</li>';
					    //     }
					    // } 
					    ?>
                    </ul>
                </div>
            </div>
	
        </li>
        
        <?php
		
		$count++;
		
		if($count % 3 == 0) {
			echo '<div class="clear"></div>';
		}
		
		endwhile; endif;
		wp_reset_postdata();

	echo '</ul>';
	    echo '<div class="clear"></div>';
	
}
add_shortcode( 'ct-listings', 'ct_listings_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* Add Listings Shortcode to Visual Composer if the plugin is enabled */
/*-----------------------------------------------------------------------------------*/

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if(is_plugin_active('js_composer/js_composer.php')) {

	add_action( 'vc_before_init', 'ct_listings_integrateWithVC' );
	function ct_listings_integrateWithVC() {
	   vc_map( array(
	      "name" => __( "CT Listings", "contempo" ),
	      "base" => "ct-listings",
	      "class" => "",
	      "category" => __( "CT Listings", "contempo"),
	      "params" => array(
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Number", "contempo" ),
	            "param_name" => "number",
	            "value" => __( "3", "contempo" ),
	            "description" => __( "Enter the number to show.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Order", "contempo" ),
	            "param_name" => "order",
	            "value" => array(
	            	"ASC" => "ASC",
	            	"DESC" => "DESC",
            	),
	            "description" => __( "Order ascending or descending.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Order By", "contempo" ),
	            "param_name" => "orderby",
	            "value" => array(
	            	"Date" => "date",
	            	"Meta (Price)" => "meta_value",
            	),
	            "description" => __( "Order by Date or Price.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Meta Key", "contempo" ),
	            "param_name" => "meta_key",
	            "value" => array(
	            	"Date" => "",
	            	"Price" => "_ct_price",
            	),
	            "description" => __( "If selected price above select Price here.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Type", "contempo" ),
	            "param_name" => "type",
	            "value" => "",
	            "description" => __( "Enter the type, e.g. single-family-home, commercial.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Beds", "contempo" ),
	            "param_name" => "beds",
	            "value" => "",
	            "description" => __( "Enter the beds, e.g. 2, 3, 4.", "contempo" )
	         ),
                   array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Parking", "contempo" ),
	            "param_name" => "parking",
	            "value" => "",
	            "description" => __( "Enter the parking, e.g. 1, 2.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Baths", "contempo" ),
	            "param_name" => "baths",
	            "value" => "",
	            "description" => __( "Enter the baths, e.g. 2, 3, 4.", "contempo" )
	         ),
                  array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Classification", "contempo" ),
	            "param_name" => "classification",
	            "value" => "",
	            "description" => __( "Enter the classification, e.g. residential.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Status", "contempo" ),
	            "param_name" => "status",
	            "value" => "",
	            "description" => __( "Enter the status, e.g. for-sale, for-rent, open-house.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "City", "contempo" ),
	            "param_name" => "city",
	            "value" => "",
	            "description" => __( "Enter the city, e.g. san-diego, los-angeles, new-york.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "State", "contempo" ),
	            "param_name" => "state",
	            "value" => "",
	            "description" => __( "Enter the state, e.g. ca, tx, ny.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Zip or Postcode", "contempo" ),
	            "param_name" => "zipcode",
	            "value" => "",
	            "description" => __( "Enter the zip or postcode, e.g. 92101, 92065, 94027.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Country", "contempo" ),
	            "param_name" => "country",
	            "value" => "",
	            "description" => __( "Enter the country, e.g. usa, england, greece.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Community", "contempo" ),
	            "param_name" => "community",
	            "value" => "",
	            "description" => __( "Enter the community, e.g. the-grand-estates, broadstone-apartments.", "contempo" )
	         ),
                  array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Referring Partner", "contempo" ),
	            "param_name" => "referring_partner",
	            "value" => "",
	            "description" => __( "Enter the referring partner, e.g. the-grand-estates, broadstone-apartments.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Additional Features", "contempo" ),
	            "param_name" => "additional_features",
	            "value" => "",
	            "description" => __( "Enter the additional features, e.g. pool, gated, beach-frontage.", "contempo" )
	         )
	      )
	   ) );
	}
}

?>