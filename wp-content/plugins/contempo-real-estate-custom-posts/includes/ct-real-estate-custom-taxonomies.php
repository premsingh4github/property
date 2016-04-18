<?php

/**
 * Register Custom Taxonmoies
 * Text Domain:       contempo
 * Domain Path:       /languages
 *
 * @link       http://contempographicdesign.com
 * @since      1.0.0
 *
 * @package    Contempo Real Estate Custom Posts
 * @subpackage contempo-real-estate-custom-posts/includes
 */

if ( ! function_exists( 'ct_realestate_taxonomies' ) ) {

	/**
	 * Register Custom Taxonomies
	 *
	 */

	add_action( 'init', 'ct_realestate_taxonomies', 0 );

	function ct_realestate_taxonomies() {

		function ct_taxonomy($name){
			global $post;
			global $wp_query;
			$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, $name, '', ', ', '' ) );
			if($terms_as_text != '') {
				echo esc_html($terms_as_text);
			}
		}

		// Property Type
		$ptlabels = array(
			'name' => __( 'Property Type', 'contempo' ),
			'singular_name' => __( 'Property Type', 'contempo' ),
			'search_items' =>  __( 'Search Property Types', 'contempo' ),
			'popular_items' => __( 'Popular Property Types', 'contempo' ),
			'all_items' => __( 'All Property Types', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Property Type', 'contempo' ),
			'update_item' => __( 'Update Property Type', 'contempo' ),
			'add_new_item' => __( 'Add New Property Type', 'contempo' ),
			'new_item_name' => __( 'New Property Type Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Property Types with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Property Types', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Property Types', 'contempo' )
		);
		register_taxonomy( 'property_type', 'listings', array(
			'hierarchical' => false,
			'labels' => $ptlabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'property-type' ),
		));

		if ( ! function_exists( 'propertytype' ) ) {
			function propertytype() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'property_type', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}

		// Beds
		$bedslabels = array(
			'name' => __( 'Beds', 'contempo' ),
			'singular_name' => __( 'Beds', 'contempo' ),
			'search_items' =>  __( 'Search Beds', 'contempo' ),
			'popular_items' => __( 'Popular Beds', 'contempo' ),
			'all_items' => __( 'All Beds', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Beds', 'contempo' ),
			'update_item' => __( 'Update Beds', 'contempo' ),
			'add_new_item' => __( 'Add New Beds', 'contempo' ),
			'new_item_name' => __( 'New Beds Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Beds with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Beds', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Beds', 'contempo' )
		);
		register_taxonomy( 'beds', 'listings', array(
			'hierarchical' => false,
			'labels' => $bedslabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'beds' ),
		));

		if ( ! function_exists( 'beds' ) ) {
			function beds() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'beds', '', ', ', '' ) );
				if($terms_as_text != '') {
					echo esc_html($terms_as_text);
				}
			}
		}
                
                	// Baths
		$bathslabels = array(
			'name' => __( 'Baths', 'contempo' ),
			'singular_name' => __( 'Baths', 'contempo' ),
			'search_items' =>  __( 'Search Baths', 'contempo' ),
			'popular_items' => __( 'Popular Baths', 'contempo' ),
			'all_items' => __( 'All Baths', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Baths', 'contempo' ),
			'update_item' => __( 'Update Baths', 'contempo' ),
			'add_new_item' => __( 'Add New Baths', 'contempo' ),
			'new_item_name' => __( 'New Baths Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Baths with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Baths', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Baths', 'contempo' )
		);
		register_taxonomy( 'baths', 'listings', array(
			'hierarchical' => false,
			'labels' => $bathslabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'baths' ),
		));

		if ( ! function_exists( 'baths' ) ) {
			function baths() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'baths', '', ', ', '' ) );
				if($terms_as_text != '') {
					echo esc_html($terms_as_text);
				}
			}
		}
                
              

		// Added code for Parking
		$parkinglabels = array(
			'name' => __( 'Parking', 'contempo' ),
			'singular_name' => __( 'Parking', 'contempo' ),
			'search_items' =>  __( 'Search Parking', 'contempo' ),
			'popular_items' => __( 'Popular Parking', 'contempo' ),
			'all_items' => __( 'All Parking', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Parking', 'contempo' ),
			'update_item' => __( 'Update Parking', 'contempo' ),
			'add_new_item' => __( 'Add New Parking', 'contempo' ),
			'new_item_name' => __( 'New Parking Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Parking with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Parking', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Parking', 'contempo' )
		);
		register_taxonomy( 'parking', 'listings', array(
			'hierarchical' => false,
			'labels' => $parkinglabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'parking' ),
		));

		if ( ! function_exists( 'parking' ) ) {
			function parking() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'parking', '', ', ', '' ) );
				if($terms_as_text != '') {
					echo esc_html($terms_as_text);
				}
			}
		}
                // Added code for Parking end 
                
               //added code for  classification
		$classificationlabels = array(
			'name' => __( 'Classification', 'contempo' ),
			'singular_name' => __( 'Classification', 'contempo' ),
			'search_items' =>  __( 'Search Classification', 'contempo' ),
			'popular_items' => __( 'Popular Classification', 'contempo' ),
			'all_items' => __( 'All Classification', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Classification', 'contempo' ),
			'update_item' => __( 'Update Classification', 'contempo' ),
			'add_new_item' => __( 'Add New Classification', 'contempo' ),
			'new_item_name' => __( 'New Classification Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Classification with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Classification', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Classification', 'contempo' )
		);
		register_taxonomy( 'classification', 'listings', array(
			'hierarchical' => false,
			'labels' => $classificationlabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'classification' ),
		));

		if ( ! function_exists( 'classification' ) ) {
			function classification() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'classification', '', ', ', '' ) );
				if($terms_as_text != '') {
					echo esc_html($terms_as_text);
				}
			}
		}
                //added code for  classification end
                
                
                
		// Status
		$statuslabels = array(
			'name' => __( 'Status', 'contempo' ),
			'singular_name' => __( 'Status', 'contempo' ),
			'search_items' =>  __( 'Search Statuses', 'contempo' ),
			'popular_items' => __( 'Popular Statuses', 'contempo' ),
			'all_items' => __( 'All Statuses', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Statuses', 'contempo' ),
			'update_item' => __( 'Update Statuses', 'contempo' ),
			'add_new_item' => __( 'Add New Status', 'contempo' ),
			'new_item_name' => __( 'New Status Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Statuses with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Status', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Statuses', 'contempo' )
		);
		register_taxonomy( 'ct_status', 'listings', array(
			'hierarchical' => false,
			'labels' => $statuslabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'status' ),
		));

		if ( ! function_exists( 'status' ) ) {
			function status() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'ct_status', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}

		// City
		$citylabels = array(
			'name' => __( 'City', 'contempo' ),
			'singular_name' => __( 'City', 'contempo' ),
			'search_items' =>  __( 'Search Cities', 'contempo' ),
			'popular_items' => __( 'Popular Cities', 'contempo' ),
			'all_items' => __( 'All Cities', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Cities', 'contempo' ),
			'update_item' => __( 'Update City', 'contempo' ),
			'add_new_item' => __( 'Add New City', 'contempo' ),
			'new_item_name' => __( 'New City Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Cities with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Cities', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Cities', 'contempo' )
		);
		register_taxonomy( 'city', 'listings', array(
			'hierarchical' => false,
			'labels' => $citylabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'city' ),
		));

		if ( ! function_exists( 'city' ) ) {
			function city() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'city', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}

		// State
		$statelabels = array(
			'name' => __( 'State', 'contempo' ),
			'singular_name' => __( 'State', 'contempo' ),
			'search_items' =>  __( 'Search States', 'contempo' ),
			'popular_items' => __( 'Popular States', 'contempo' ),
			'all_items' => __( 'All States', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit States', 'contempo' ),
			'update_item' => __( 'Update State', 'contempo' ),
			'add_new_item' => __( 'Add New State', 'contempo' ),
			'new_item_name' => __( 'New State Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate States with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove States', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used States', 'contempo' )
		);
		register_taxonomy( 'state', 'listings', array(
			'hierarchical' => false,
			'labels' => $statelabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'state' ),
		));

		if ( ! function_exists( 'state' ) ) {
			function state() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'state', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}

		// Zipcode
                // post code as Province
                // Postcode as name, zipcode as taxonomy
		global $ct_options;
		$ct_zip_or_post = isset( $ct_options['ct_zip_or_post'] ) ? $ct_options['ct_zip_or_post'] : '';

		if($ct_zip_or_post == 'postcode') {

			$postlabels = array(
				'name' => __( 'Province', 'contempo' ),
				'singular_name' => __( 'Province', 'contempo' ),
				'search_items' =>  __( 'Search Province', 'contempo' ),
				'popular_items' => __( 'Popular Province', 'contempo' ),
				'all_items' => __( 'All Province', 'contempo' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Province', 'contempo' ),
				'update_item' => __( 'Update Province', 'contempo' ),
				'add_new_item' => __( 'Add New Province', 'contempo' ),
				'new_item_name' => __( 'New Province', 'contempo' ),
				'separate_items_with_commas' => __( 'Separate Province with commas', 'contempo' ),
				'add_or_remove_items' => __( 'Add or remove Province', 'contempo' ),
				'choose_from_most_used' => __( 'Choose from the most used Province', 'contempo' )
			);
			register_taxonomy( 'zipcode', 'listings', array(
				'hierarchical' => false,
				'labels' => $postlabels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'postcode' ),
			));

		} else {

			$ziplabels = array(
				'name' => __( 'Zipcode', 'contempo' ),
				'singular_name' => __( 'Zipcode', 'contempo' ),
				'search_items' =>  __( 'Search Zipcodes', 'contempo' ),
				'popular_items' => __( 'Popular Zipcodes', 'contempo' ),
				'all_items' => __( 'All Zipcodes', 'contempo' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Zipcode', 'contempo' ),
				'update_item' => __( 'Update Zipcode', 'contempo' ),
				'add_new_item' => __( 'Add New Zipcode', 'contempo' ),
				'new_item_name' => __( 'New Zipcode', 'contempo' ),
				'separate_items_with_commas' => __( 'Separate Zipcodes with commas', 'contempo' ),
				'add_or_remove_items' => __( 'Add or remove Zipcodes', 'contempo' ),
				'choose_from_most_used' => __( 'Choose from the most used Zipcodes', 'contempo' )
			);
			register_taxonomy( 'zipcode', 'listings', array(
				'hierarchical' => false,
				'labels' => $ziplabels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'zipcode' ),
			));
			
		}

		if ( ! function_exists( 'zipcode' ) ) {
			function zipcode() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'zipcode', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}

		// Country
		$countrylabels = array(
			'name' => __( 'Country', 'contempo' ),
			'singular_name' => __( 'Country', 'contempo' ),
			'search_items' =>  __( 'Search Countries', 'contempo' ),
			'popular_items' => __( 'Popular Countries', 'contempo' ),
			'all_items' => __( 'All Countries', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Countries', 'contempo' ),
			'update_item' => __( 'Update Countries', 'contempo' ),
			'add_new_item' => __( 'Add New Countries', 'contempo' ),
			'new_item_name' => __( 'New Country Name', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Countries with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Countries', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Countries', 'contempo' )
		);
		register_taxonomy( 'country', 'listings', array(
			'hierarchical' => false,
			'labels' => $countrylabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'country' ),
		));

		if ( ! function_exists( 'country' ) ) {
			function country() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'country', '', ', ', '' ) );
				if(!empty($terms_as_text)) {
					echo ', ' . esc_html($terms_as_text);
				}
			}
		}

		// Referring Partner Taxonomy
		$partnerlabels = array(
			'name' => __( 'Referring Partners', 'contempo' ),
			'singular_name' => __( 'Referring Partners', 'contempo' ),
			'search_items' =>  __( 'Search Referring Partners', 'contempo' ),
			'popular_items' => __( 'Popular Referring Partners', 'contempo' ),
			'all_items' => __( 'All Referring Partners', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Referring Partner', 'contempo' ),
			'update_item' => __( 'Update Referring Partner', 'contempo' ),
			'add_new_item' => __( 'Add New Referring Partner', 'contempo' ),
			'new_item_name' => __( 'New Referring Partner', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Referring Partner with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Referring Partner', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Referring Partner', 'contempo' )
		);
		register_taxonomy( 'referring_partner', 'listings', array(
			'hierarchical' => false,
			'labels' => $partnerlabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'referring_partner' ),
		));

		if ( ! function_exists( 'referring_partner' ) ) {
			function referring_partner() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'referring_partner', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}
                
                // Community
		$communitylabels = array(
			'name' => __( 'Community', 'contempo' ),
			'singular_name' => __( 'Community', 'contempo' ),
			'search_items' =>  __( 'Search Communities', 'contempo' ),
			'popular_items' => __( 'Popular Communities', 'contempo' ),
			'all_items' => __( 'All Communities', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Community', 'contempo' ),
			'update_item' => __( 'Update Community', 'contempo' ),
			'add_new_item' => __( 'Add New Community', 'contempo' ),
			'new_item_name' => __( 'New Community', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Communities with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Communities', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Communities', 'contempo' )
		);
		register_taxonomy( 'community', 'listings', array(
			'hierarchical' => false,
			'labels' => $communitylabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'community' ),
		));

		if ( ! function_exists( 'community' ) ) {
			function community() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'community', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}


		// Additional Features
		$addfeatlabels = array(
			'name' => __( 'Additional Features', 'contempo' ),
			'singular_name' => __( 'Additional Feature', 'contempo' ),
			'search_items' =>  __( 'Search Additional Features', 'contempo' ),
			'popular_items' => __( 'Popular Additional Features', 'contempo' ),
			'all_items' => __( 'All Additional Features', 'contempo' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Additional Features', 'contempo' ),
			'update_item' => __( 'Update Additional Feature', 'contempo' ),
			'add_new_item' => __( 'Add New Additional Feature', 'contempo' ),
			'new_item_name' => __( 'New Additional Feature', 'contempo' ),
			'separate_items_with_commas' => __( 'Separate Additional Features with commas', 'contempo' ),
			'add_or_remove_items' => __( 'Add or remove Additional Features', 'contempo' ),
			'choose_from_most_used' => __( 'Choose from the most used Additional Features', 'contempo' )
		);
		register_taxonomy( 'additional_features', 'listings', array(
			'hierarchical' => false,
			'labels' => $addfeatlabels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'features' ),
		));

		if ( ! function_exists( 'addfeat' ) ) {
			function addfeat() {
				global $post;
				global $wp_query;
				$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'additional_features', '', ', ', '' ) );
				echo esc_html($terms_as_text);
			}
		}
                
                	if ( ! function_exists( 'addfeatlist' ) ) {
			function addfeatlist () {
				global $post;
				$terms = get_the_terms($post->ID, 'additional_features');
				if ($terms) {
					echo '<h4 class="border-bottom marB20">' . __('Property Features', 'contempo') . '</h4>';
					echo '<ul class="propfeatures col span_6">';
					$count = 0;
					foreach ($terms as $taxindex => $taxitem) {
						echo '<li><i class="fa fa-check-square"></i>' . $taxitem->name . '</li>';
						$count++;
						if ($count == 6) {
							echo '</ul><ul class="propfeatures col span_6">';
							$count = 0;
						}
					}
					echo '</ul>';
					echo '<div class="clear"></div>';
				} else {
					
				}
			}
		}
                
                	if ( ! function_exists( 'addclassificationlist' ) ) {
			function addclassificationlist () {
				global $post;
				$terms = get_the_terms($post->ID, 'classification');
				if ($terms) {
                                     echo '<li class="row classification">';
                                        echo '<span class="muted left">';
                                            _e('Classification', 'contempo');
                                        echo '</span>';
                                        echo '<span class="right">';
                                        $countterms = count($terms);
                                       $i=1; foreach ($terms as $taxindex => $taxitem) {
                                             echo ucfirst($taxitem->name);
                                             if($i < $countterms){
                                                 echo ",";
                                             }
                                       $i++; }
                                        echo '</span>';
                                    echo '</li>';

				} else {
					
				}
			}
		}
                     	if ( ! function_exists( 'addparkinglist' ) ) {
			function addparkinglist () {
				global $post;
				$terms = get_the_terms($post->ID, 'parking');
				if ($terms) {
                                     echo '<li class="row parking">';
                                        echo '<span class="muted left">';
                                            _e('Parking', 'contempo');
                                        echo '</span>';
                                        echo '<span class="right">';
                                        $countterms = count($terms);
                                       $i=1; foreach ($terms as $taxindex => $taxitem) {
                                             echo $taxitem->name;
                                             if($i < $countterms){
                                                 echo ",";
                                             }
                                       $i++; }
                                        echo '</span>';
                                    echo '</li>';

				} else {
					
				}
			}
		}

                
                if ( ! function_exists( 'adddeveloperslist' ) ) {
			function adddeveloperslist () {
				global $post;
				$terms = get_the_terms($post->ID, 'community');
				if ($terms) {
                                     echo '<li class="row parking">';
                                        echo '<span class="muted left">';
                                            _e('Developers', 'contempo');
                                        echo '</span>';
                                        echo '<span class="right">';
                                        $countterms = count($terms);
                                       $i=1; foreach ($terms as $taxindex => $taxitem) {
                                             echo ucwords($taxitem->name);
                                             if($i < $countterms){
                                                 echo ",";
                                             }
                                       $i++; }
                                        echo '</span>';
                                    echo '</li>';

				} else {
					
				}
			}
		}

		if ( ! function_exists( 'addreffering_partner' ) ) {
			function addreffering_partner () {
				global $post;
				$terms = get_the_terms($post->ID, 'referring_partner');
				if ($terms) {
					 echo '<li class="row parking">';
                                        echo '<span class="muted left">';
                                            _e('Referring Partners', 'contempo');
                                        echo '</span>';
                                        echo '<span class="right">';
                                        $countterms = count($terms);
                                       $i=1; foreach ($terms as $taxindex => $taxitem) {
                                             echo ucwords($taxitem->name);
                                             if($i < $countterms){
                                                 echo ",";
                                             }
                                       $i++; }
                                        echo '</span>';
                                    echo '</li>';
				} else {
					
				}
			}
		}

	}

}

?>