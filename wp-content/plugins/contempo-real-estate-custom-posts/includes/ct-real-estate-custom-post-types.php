<?php

/**
 * Register Custom Post Types
 *
 * @link       http://contempographicdesign.com
 * @since      1.0.0
 *
 * @package    Contempo Real Estate Custom Posts
 * @subpackage contempo-real-estate-custom-posts/includes
 */

	/**
	 * Register Listings Menu Custom Post Type
	 */

	add_action( 'init', 'ct_listings_init' );

	function ct_listings_init() {
		$labels = array(
			'name'                => _x( 'Listings', 'Post Type General Name', 'contempo' ),
			'singular_name'       => _x( 'Listing', 'Post Type Singular Name', 'contempo' ),
			'add_new' => _x( 'Add New', 'contempo'),
			'add_new_item' => __( 'Add New Listing', 'contempo'),
			'edit_item' => __( 'Edit Listing', 'contempo'),
			'new_item' => __( 'New Listing', 'contempo'),
			'view_item' => __( 'View Listing', 'contempo'),
			'search_items' => __( 'Search Listings', 'contempo'),
			'not_found' =>  __( 'No listings items found', 'contempo'),
			'not_found_in_trash' => __( 'No listings found in Trash', 'contempo'),
			'parent_item_colon' => ''
		);

		$supports = array(
			'title',
			'editor',
			'author',
			'thumbnail'
		);

		$args = array(
			'labels' => $labels,
			'supports' => $supports,
			'label' => __('Listings', 'contempo'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => false,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'listings'),
			'menu_position' => 5,
			'menu_icon' => 'dashicons-location',
			'has_archive' => true,
			'taxonomies' => array('')
		); 

		register_post_type( 'listings', $args );
	}

	add_filter("manage_edit-listings_columns", "ct_listings_cols");

	// Add Custom CSS to Admin
	add_action('admin_head', 'ct_listings_admin_css');
	function ct_listings_admin_css() {
	  echo '<style>
		td.image.column-image { width: 15%; overflow: hidden;}
		td.image.column-image img { width: 100%;} 
		td.status a { padding: 6px 10px; color: #fff; font-size: 10px; border-radius: 3px; text-transform: uppercase;}
			td.status a.sold { background: #ff6400;}
			td.status a.for-sale { background: #34495e;}
			td.status a.leased { background: #90f;}
			td.status a.reduced { background: #bc0000;}
			td.status a.open-house { background: #7faf1b;}
			td.status a.available { background: #3b504b;}
			td.status a.rental,
			td.status a.for-rent { background: #0097d6;}
			td.status a.new-addition { background: #76bcad;}
			td.status a.special-offer { background: #f39c12;}
	   @media screen and (max-width: 782px) {
	   		.column-price,
	   		.column-beds,
	   		.column-baths,
	   		.column-author,
	   		.column-status,
	   		.column-date,
	   		.column-image,
	   		.column-title,
	   		.column-location { display: none;}
	   			.column-image img { position: relative; z-index: 10;}
	   }
	  </style>';
	}

	// Define columns to filter in the edit posts section
	function ct_listings_cols($columns) {
		$columns = array(
			//Create custom columns
			'cb' => '<input type="checkbox" />',
			'image' => __('Image', 'contempo'),
			'title' => __('Address', 'contempo'),
			'location' => __('Location', 'contempo'),
			'price' => __('Price', 'contempo'),
			'beds' => __('Beds', 'contempo'),
			'baths' => __('Baths', 'contempo'),
			'author' => __('Agent', 'contempo'),
			'status' => __('Status', 'contempo'),
			'date' => __('Listed', 'contempo')
		);
		return $columns;
	}

	add_action("manage_posts_custom_column", "ct_custom_listings_cols");

	// Output custom columns
	function ct_custom_listings_cols($column) {
		global $post;

		switch( $column ) {

			// Image
			case 'image' :

				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

				if( function_exists('the_post_thumbnail') ) {
			        echo '<img src="' . $feat_image . '" />';
				}

			break;

			// City, State and Zipcode/Postcode
			case 'location' :

				$_taxonomy = 'city';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}
				echo ', ';
				$_taxonomy = 'state';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}
				echo ' ';
				$_taxonomy = 'zipcode';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}
				echo ' ';
				$_taxonomy = 'country';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}

			break;

			// Price
			case 'price' :
				if( function_exists('ct_listing_price') ) {
					ct_listing_price();
				}

			break;

			// Beds
			case 'beds' :

				$_taxonomy = 'beds';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}

			break;

			// Baths
			case 'baths' :

				$_taxonomy = 'baths';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}

			break;

			// Status
			case 'status' :

				$_taxonomy = 'ct_status';
				$terms = get_the_terms( $post->ID, $_taxonomy );
				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $c )
						$statusClass = preg_replace('/\s+/', '-', $c->name);
						$out[] = "<a class='" . strtolower($statusClass) . "' href='edit-tags.php?action=edit&taxonomy=$_taxonomy&post_type=listings&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
				}
				else {
					_e('-', 'contempo');
				}	

			break;

		}
		
	}

	/**
	 * Register Testimonial Custom Post Type
	 */

	add_action( 'init', 'ct_testimonial_init' );

	function ct_testimonial_init() {
		$labels = array(
			'name'                => _x( 'Testimonials', 'Post Type General Name', 'contempo' ),
			'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'contempo' ),
			'add_new' => _x( 'Add New', 'contempo'),
			'add_new_item' => __( 'Add New Testimonial', 'contempo'),
			'edit_item' => __( 'Edit Testimonial', 'contempo'),
			'new_item' => __( 'New Testimonial', 'contempo'),
			'view_item' => __( 'View Testimonial', 'contempo'),
			'search_items' => __( 'Search Testimonials', 'contempo'),
			'not_found' =>  __( 'No Testimonials found', 'contempo'),
			'not_found_in_trash' => __( 'No Testimonials found in Trash', 'contempo'),
			'parent_item_colon' => ''
		);

		$supports = array(
			'title',
			'editor',
			'author',
			'page-attributes',
			'thumbnail'
		);

		$args = array(
			'labels' => $labels,
			'supports' => $supports,
			'label' => __('Testimonials', 'contempo'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'testimonials'),
			'menu_position' => 5,
			'menu_icon' => 'dashicons-format-quote',
			'has_archive' => true,
			'taxonomies' => array('category', 'post_tag')
		);

		register_post_type( 'testimonial', $args );
	}

	add_filter("manage_edit-testimonial_columns", "ct_testimonial_cols");

	// Define columns to filter in the edit posts section
	function ct_testimonial_cols($columns) {
		$columns = array(
			//Create custom columns
			'cb' => '<input type="checkbox" />',
			'image' => __('Image', 'contempo'),
			'title' => __('Person or Company', 'contempo'),
			'quote' => __('Quote', 'contempo'),
			'tags' => __('Tags', 'contempo'),
			'author' => __('Author', 'contempo'),
			'date' => __('Created', 'contempo')
		);
		return $columns;
	}

	add_action("manage_posts_custom_column", "ct_custom_testimonial_cols");

	// Output custom columns
	function ct_custom_testimonial_cols($column) {
		global $post;
		if ("ID" == $column) echo $post->ID;
		
		elseif ("quote" == $column) echo $post->post_content;
	}

?>