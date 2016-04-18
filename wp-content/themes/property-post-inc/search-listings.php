<?php
/**
 * Search Listings Template
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */

global $ct_options;
$ct_home_adv_search_style = isset( $ct_options['ct_home_adv_search_style'] ) ? $ct_options['ct_home_adv_search_style'] : '';
$ct_search_results_layout = isset( $ct_options['ct_search_results_layout'] ) ? $ct_options['ct_search_results_layout'] : '';

/*-----------------------------------------------------------------------------------*/
/* Query multiple taxonomies */
/*-----------------------------------------------------------------------------------*/

$taxonomies_to_search = array(
	'beds' => 'Bedrooms',
	'baths' => 'Bathrooms',
	'property_type' => 'Property Type',
	'ct_status' => 'Status',
	'state' => 'State',
	'zipcode' => 'Zipcode',
	'city' => 'City',
	'country' => 'Country',
	'community' => 'Community',
	'additional_features' => 'Additional Features'
);                                                                       

$search_values = array();

foreach ($taxonomies_to_search as $t => $l) {
	$var_name = 'ct_'. $t;
	
	if (!empty($_GET[$var_name])) {  
		$search_values[$t] = utf8_encode($_GET[$var_name]);
	}                                                     
}                                                          
                                   
$search_values['post_type'] = 'listings';
$search_values['paged'] = ct_currentPage();
$search_num = $ct_options['ct_listing_search_num'];
$search_values['showposts'] = $search_num;

// Order by Price
if (!empty($_GET['ct_orderby_price'])) {

	$order = utf8_encode($_GET['ct_orderby_price']);

	$search_values['orderby'] = 'meta_value';
	$search_values['meta_key'] = '_ct_price';
	$search_values['meta_type'] = 'numeric';
	$search_values['order'] = $order;

}

/*-----------------------------------------------------------------------------------*/
/* Order by (Title, Price or upload date) */
/*-----------------------------------------------------------------------------------*/ 

if (!empty($_GET['ct_orderby'])) {
	$orderBy = $_GET['ct_orderby'];

	if ($orderBy == 'priceASC') {
		$search_values['orderby'] = 'meta_value';
		$search_values['meta_key'] = '_ct_price';
		$search_values['meta_type'] = 'numeric';
		$search_values['order'] = 'ASC';		
	} elseif ($orderBy == 'priceDESC') {
		$search_values['orderby'] = 'meta_value';
		$search_values['meta_key'] = '_ct_price';
		$search_values['meta_type'] = 'numeric';
		$search_values['order'] = 'DESC';
	} elseif ($orderBy == 'dateDESC') {
		$search_values['orderby'] = 'date';
		$search_values['order'] = 'DESC';
	}elseif ($orderBy == 'dateASC') {
		$search_values['orderby'] = 'date';
		$search_values['order'] = 'ASC';
	} else { //	titleASC	
		$search_values['orderby'] = 'title';
		$search_values['order'] = 'ASC';
	}
} 

$mode = 'search'; 
    
// Check Price From/To
if (!empty($_GET['ct_price_from']) && !empty($_GET['ct_price_to'])) {
	$ct_price_from = str_replace(',', '', $_GET['ct_price_from']);
	$ct_price_to = str_replace(',', '', $_GET['ct_price_to']);
	$search_values['meta_query'] = array(
		array(
			'key' => '_ct_price',
			'value' => array( $ct_price_from, $ct_price_to ),
			'type' => 'numeric',
			'compare' => 'BETWEEN'
		)
	);
}
else if (!empty($_GET['ct_price_from'])) {               
	$ct_price_from = str_replace(',', '', $_GET['ct_price_from']);
	$search_values['meta_query'] = array(
		array(
			'key' => '_ct_price',
			'value' => $ct_price_from,
			'type' => 'numeric',
			'compare' => '>='
		)
	);	
}
else if (!empty($_GET['ct_price_to'])) {               
	$ct_price_to = str_replace(',', '', $_GET['ct_price_to']);
	$search_values['meta_query'] = array(
		array(
			'key' => '_ct_price',
			'value' => $ct_price_to,
			'type' => 'numeric',
			'compare' => '<='
		)
	);	
}

/*-----------------------------------------------------------------------------------*/
/* Check to see if reference number matches */
/*-----------------------------------------------------------------------------------*/ 
 
if (!empty($_GET['ct_mls'])) {
	$ct_mls = $_GET['ct_mls'];
	$search_values['meta_query'] = array(
		array(
			'key' => '_ct_mls',
			'value' => $ct_mls,
			'type' => 'char',
			'compare' => '='
		)
	);	
}

/*-----------------------------------------------------------------------------------*/
/* Check to see if number of guests matches */
/*-----------------------------------------------------------------------------------*/ 
 
if (!empty($_GET['ct_rental_guests'])) {
	$ct_rental_guests = $_GET['ct_rental_guests'];
	$search_values['meta_query'] = array(
		array(
			'key' => '_ct_rental_guests',
			'value' => $ct_rental_guests,
			'type' => 'num',
			'compare' => '<='
		)
	);	
}

global $wp_query;

/*-----------------------------------------------------------------------------------*/
/* Save the existing query */
/*-----------------------------------------------------------------------------------*/ 

$existing_query_obj = $wp_query;

$wp_query = new WP_Query( $search_values ); 
$total_results = $wp_query->found_posts;
unset($search_values['post_type']);
unset($search_values['paged']);
unset($search_values['showposts']);   

/*-----------------------------------------------------------------------------------*/
/* Prepare the title string by looping through all
/* the values we're going to query and put them together
/*-----------------------------------------------------------------------------------*/                             

$search_params = ''; 
$loop = 0;
foreach ($search_values as $t => $s) {                                     
	if ($loop == 1) { 
		$search_params .= ', '; 
	} else {
		$loop = 1;
	}                              

	$term = get_term_by('slug',$s,$t);
	$name = $term->name;   
	
	$search_params .= $name;                                    
}

get_header();

	do_action('before_listings_search_header');
	
	echo '<!-- Title Header -->';
    echo '<header id="title-header" class="marB0">';
        echo '<div class="container">';
            echo '<h5 class="marT0 marB0 left">';
			echo esc_html($total_results);
			echo ' ';
			if($total_results != '1') { esc_html_e('listings found', 'contempo'); } else { esc_html_e('listing found', 'contempo'); }
			echo '</h5>';
			echo '<div class="muted right">';
				esc_html_e('Find A Home', 'contempo');
			echo '</div>';
		echo '<div class="clear"></div>';
        echo '</div>';
    echo '</header>';
    echo '<!-- //Title Header -->';

    if($ct_search_results_layout == 'sidebyside') {
    	echo '<!-- Searching On -->';
		echo '<div class="side-by-side searching-on ' . $ct_home_adv_search_style . '">';
			echo '<div class="container">';
				echo '<span class="searching">' . __('Searching:', 'contempo') . '</span>';
				if($search_params != "") {
					echo '<span class="search-params">' . $search_params . '</span>';
				} else { 
					echo '<span class="search-params">' . __('All listings', 'contempo') . '</span>';
				}
				echo '<span class="search-toggle"><a href="#"><span id="text-toggle">' . __('Open Search', 'contempo') . '</span><i class="fa fa-plus-square-o"></i></a></span>';
			echo '</div>';
		echo '</div>';
		echo '<!-- //Searching On -->';
	
		do_action('before_listings_adv_search');

		echo '<section class="side-by-side search-results advanced-search ' . $ct_home_adv_search_style . '">';
			echo '<div class="container">';
				get_template_part('/includes/advanced-search');
			echo '</div>';
		echo'</section>';
		echo '<div class="clear"></div>';
	}

    do_action('before_listings_search_map');
	
	// Start Search Results Map
	if($ct_options['ct_disable_google_maps'] == 'no') {
		echo '<!-- Map -->';

		if($ct_search_results_layout == 'sidebyside') {
			echo '<div id="map-wrap" class="listings-results-map col span_6 side-map">';
		} else {
			echo '<div id="map-wrap" class="listings-results-map">';
		}
		 
			wp_reset_postdata();
			
			$search_values['post_type'] = 'listings';
			$search_values['paged'] = ct_currentPage();
			$search_values['showposts'] = $search_num;
			$wp_query = new wp_query( $search_values ); 
	
				ct_search_results_map();
		
		// End Search Results Map
		echo '</div>';
		echo '<!-- //Map -->';
	}

	do_action('before_listings_searching_on');
	
	echo '<!-- Search Results -->';
		if($ct_search_results_layout == 'sidebyside') {
		echo '<div class="col span_6 side-results">';
		}
			if($ct_search_results_layout != 'sidebyside') {
				echo '<!-- Searching On -->';
				echo '<div class="searching-on ' . $ct_home_adv_search_style . '">';
					echo '<div class="container">';
						echo '<span class="searching">' . __('Searching:', 'contempo') . '</span>';
						if($search_params != "") {
							echo '<span class="search-params">' . $search_params . '</span>';
						} else { 
							echo '<span class="search-params">' . __('All listings', 'contempo') . '</span>';
						}
						echo '<span class="map-toggle"><a href="#"><span id="text-toggle">' . __('Close Map', 'contempo') . '</span><i class="fa fa-minus-square-o"></i></a></span>';
						echo '</div>';
				echo '</div>';
				echo '<!-- //Searching On -->';
			
				do_action('before_listings_adv_search');

				echo '<section class="search-results advanced-search ' . $ct_home_adv_search_style . '">';
					echo '<div class="container">';
						get_template_part('/includes/advanced-search');
					echo '</div>';
				echo'</section>';
				echo '<div class="clear"></div>';
			}
			?>

			<?php do_action('before_listing_search_results'); ?>

			<div class="container">
				<!-- Listing Results -->
				<div id="listings-results" class="col span_12 first">

					<div class="col span_12">
						<?php ct_sort_by(); ?>
					</div>

					<?php
	                
						// Reset Query for Listings
						wp_reset_query();
						wp_reset_postdata();

						$search_values['post_type'] = 'listings';
						$search_values['paged'] = ct_currentPage();
						$search_values['showposts'] = $search_num;
						$wp_query = new wp_query( $search_values ); 
						
						get_template_part( 'layouts/grid');
					
				// End Listing Results
				echo '</div>';
				echo '<!-- Listing Results -->';

			// Restore WP_Query object
			$wp_query = $existing_query_obj;
			
		echo '</div>';
	if($ct_search_results_layout == 'sidebyside') {
	echo '</div>';
	}
	echo '<!-- //Search Results -->';

	do_action('after_listing_search_results');

get_footer(); ?>
