<?php

/**
 * Custom Fields
 *
 * @link       http://contempographicdesign.com
 * @since      1.0.0
 *
 * @package    Contempo Real Estate Custom Posts
 * @subpackage ct-real-estate-custom-posts/includes
 */

// Include & setup custom metabox and fields
$prefix = '_ct_'; // start with an underscore to hide fields from custom fields list
$lang = "contempo";
add_filter( 'cmb_meta_boxes', 'ct_real_estate_metaboxes' );
function ct_real_estate_metaboxes( $meta_boxes ) {
	global $prefix;
	global $lang;

	$meta_boxes[] = array(
		'id' => 'post_options_metabox',
		'title' => __('Post Options', $lang),
		'pages' => array('post','galleries'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Title', $lang),
				'desc' => __('Display Post Title?', $lang),
				'id' => $prefix . 'post_title',
				'type' => 'select',
				'options' => array(
					array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),			
				)
			),
			array(
				'name' => __('Sub Title', $lang),
				'desc' => __('Enter the sub title here, if you\'d like to use one.', $lang),
				'id' => $prefix . 'sub_title',
				'type' => 'text'
			),
			array(
				'name' => __('Post Header Background Image', $lang),
				'desc' => __('Use Featured Image as Header Background?', $lang),
				'id' => $prefix . 'post_header_bg',
				'type' => 'select',
				'options' => array(
					array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),			
				)
			),
			array(
			    'name' => __('Post Header Background Color', $lang),
			    'desc' => __('If you don\'t have a featured post image, you can specify a custom bg color for your header here.)', $lang),
			    'id'   => $prefix . '_post_header_bg_color',
			    'type' => 'colorpicker',
			    'default'  => '',
			    'repeatable' => false,
			),
			array(
				'name' => __('Meta', $lang),
				'desc' => __('Display Post Meta?', $lang),
				'id' => $prefix . 'post_meta',
				'type' => 'select',
				'options' => array(
					array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),			
				)
			),
			array(
				'name' => __('Social', $lang),
				'desc' => __('Display Post Social?', $lang),
				'id' => $prefix . 'post_social',
				'type' => 'select',
				'options' => array(
					array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),			
				)
			),
		)
	);

	/*$meta_boxes[] = array(
		'id' => 'slider_images',
		'title' => __('Slider Images', $lang),
		'pages' => array('listings'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Slider Images', $lang),
				'desc' => __('Upload all your slider images here.', $lang),
				'id' => $prefix . 'slider',
				'type' => 'file_list'
			),
		)
	);*/

	$meta_boxes[] = array(
		'id' => 'listing_info',
		'title' => __('Listing Info', $lang),
		'pages' => array('listings'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
					'name' => __('Listing Alternate Title', $lang),
					'desc' => __('Enter the listing alternate title here replaces street address, e.g. Downtown Penthouse.', $lang),
					'id' => $prefix . 'listing_alt_title',
					'type' => 'text_medium'
				),
			array(
				'name' => __('Price Prefix Text', $lang),
				'desc' => __('Enter the price prefix text here, e.g. (From, Call for price, Price on ask).', $lang),
				'id' => $prefix . 'price_prefix',
				'type' => 'text_medium'
			),
			array(
				'name' => __('Price', $lang),
				'desc' => __('Enter the price here, without commas or seperators. If empty no price will be shown.', $lang),
				'id' => $prefix . 'price',
				'type' => 'text_money'
			),
                         array(
				'name' => __('Commission', $lang),
				'desc' => __('Enter the commission percentage here.e.g., 3.5%', $lang),
				'id' => $prefix . 'commission',
				'type' => 'text_small'
			),
                        array(
                            'name' => __('Contact Number', $lang),
                            'desc' => __('Enter contact number here.', $lang),
			    'id' => $prefix . 'contact_number',
			    'type' => 'text_medium'
                        ),
			array(
				'name' => __('Price Postfix Text', $lang),
				'desc' => __('Enter the price postfix text here, e.g. (/month, /week, /per night).', $lang),
				'id' => $prefix . 'price_postfix',
				'type' => 'text_medium'
			),
			array(
				'name' => __('Sq Ft', $lang),
				'desc' => __('Enter Floor Area here', $lang),
				'id' => $prefix . 'sqft',
				'type' => 'text_small'
			),
			// array(
			// 	'name' => __('Lot Size', $lang),
			// 	'desc' => __('Enter the lot size here.', $lang),
			// 	'id' => $prefix . 'lotsize',
			// 	'type' => 'text_small'
			// ),
             array(
				'name' => __('Lot Area', $lang),
				'desc' => __('Enter the lot area here.', $lang),
				'id' => $prefix . 'floorarea',
				'type' => 'text_small'
			),
			array(
				'name' => __('Property ID', $lang),
				'desc' => __('Enter the property ID here, e.g. 5648973', $lang),
				'id' => $prefix . 'mls',
				'type' => 'text_medium'
			),
			array(
				'name' => __('Broker', $lang),
				'desc' => __('Enter the Broker here.', $lang),
				'id' => $prefix . 'broker',
				'type' => 'text_medium'
			),
			array(
				'name' => __('Latitude &amp; Longitude', $lang),
				'desc' => __('<strong>OPTIONAL:</strong> Only use the latitude and longitude if the regular full address can\'t be found. (ex: 37.4419, -122.1419)', $lang),
				'id' => $prefix . 'latlng',
				'type' => 'text_medium'
			),
			array(
				'name' => __('Owner/Agent Notes', $lang),
				'desc' => __('Owner/Agent Notes (*not visible on front end).', $lang),
				'id' => $prefix . 'ownernotes',
				'type' => 'textarea_small'
			),
		)
	);

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if(is_plugin_active('booking/wpdev-booking.php')) {
		$meta_boxes[] = array(
			'id' => 'rental_metabox',
			'title' => __('Rental Info', $lang),
			'pages' => array('post','listings'), // post type
			'context' => 'normal',
			'priority' => 'default',
			'show_names' => false, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Booking Calendar Shortcode', $lang),
					'desc' => __('Paste your booking calendar shortcode here, e.g. [booking nummonths=1].', $lang),
					'id' => $prefix . 'booking_cal_shortcode',
					'type' => 'text_medium'
				),
				array(
					'name' => __('Listing Title', $lang),
					'desc' => __('Enter the listing title here, e.g. Villa in Bali.', $lang),
					'id' => $prefix . 'rental_title',
					'type' => 'text_medium'
				),
				array(
					'name' => __('Guests', $lang),
					'desc' => __('Enter the max-number of guests here, e.g. 2.', $lang),
					'id' => $prefix . 'rental_guests',
					'type' => 'text_medium'
				),
				array(
					'name' => __('Availability', $lang),
					'desc' => __('Enter minimum stay, e.g. 1 night.', $lang),
					'id' => $prefix . 'rental_min_stay',
					'type' => 'text_medium'
				),
				array(
					'name' => __('Check In Time', $lang),
					'desc' => __('Enter check in time.', $lang),
					'id' => $prefix . 'rental_checkin',
					'type' => 'text_time'
				),
				array(
					'name' => __('Check Out Time', $lang),
					'desc' => __('Enter check out time.', $lang),
					'id' => $prefix . 'rental_checkout',
					'type' => 'text_time'
				),
				array(
					'name' => __('Extra People Charge', $lang),
					'desc' => __('Enter extra per person charge, without commas or seperators.', $lang),
					'id' => $prefix . 'rental_extra_people',
					'type' => 'text_money'
				),
				array(
					'name' => __('Cleaning Fee', $lang),
					'desc' => __('Enter cleaning fee, without commas or seperators.', $lang),
					'id' => $prefix . 'rental_cleaning',
					'type' => 'text_money'
				),
				array(
					'name' => __('Cancellation Fee', $lang),
					'desc' => __('Enter cancellation fee, without commas or seperators.', $lang),
					'id' => $prefix . 'rental_cancellation',
					'type' => 'text_money'
				),
				array(
					'name' => __('Security Deposit', $lang),
					'desc' => __('Enter the security deposit, without commas or seperators.', $lang),
					'id' => $prefix . 'rental_deposit',
					'type' => 'text_money'
				),
			)
		);
	}

	$meta_boxes[] = array(
		'id' => 'files',
		'title' => __('Files & Documents', $lang),
		'pages' => array('listings'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Files & Documents', $lang),
				'desc' => __('Supported file types are PDF, Word, Excel & PowerPoint.<br />NOTE: The files need to be uploaded/attached to this listing in order for them to show on the frontend.', $lang),
				'id' => $prefix . 'files',
				'type' => 'file_list'
			),
		)
	);

	$meta_boxes[] = array(
		'id' => 'page_metabox',
		'title' => __('Page Options', $lang),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
            array(
                'name' => __('Display Page Title?', $lang),
                'desc' => __('Select whether or not you\'d like to display the page title?', $lang),
                'id' => $prefix . 'inner_page_title',
                'type' => 'select',
                'options' => array(
                    array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),	               
                )
            ),
            array(
                'name' => __('Sub Title', $lang),
                'desc' => __('Enter the sub title here, if you\'d like to use one.', $lang),
                'id' => $prefix . 'page_sub_title',
                'type' => 'text'
            ),
            array(
                'name' => __('Page Header Background Image', $lang),
                'desc' => __('Add a background image for your page header.', $lang),
                'id' => $prefix . 'page_header_bg_image',
                'type' => 'file'
            ),
            array(
                'name' => __('Top Page Margin?', $lang),
                'desc' => __('Select whether or not you\'d like the top page margin to seperate the header and content area?', $lang),
                'id' => $prefix . 'top_page_margin',
                'type' => 'select',
                'options' => array(
                    array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),	               
                )
            ),
            array(
                'name' => __('Bottom Page Margin?', $lang),
                'desc' => __('Select whether or not you\'d like the top page margin to seperate the content area and footer?', $lang),
                'id' => $prefix . 'bottom_page_margin',
                'type' => 'select',
                'options' => array(
                    array('name' => __('Yes', $lang), 'value' => 'Yes'),
					array('name' => __('No', $lang), 'value' => 'No'),	               
                )
            ),
		)
	);

	$meta_boxes[] = array(
		'id' => 'video_metabox',
		'title' => __('Video', $lang),
		'pages' => array('post','listings'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Video', $lang),
				'desc' => __('Paste your video url here, supports YouTube, Vimeo.', $lang),
				'id' => $prefix . 'video',
				'type' => 'text_medium'
			),
		)
	);
	
	return $meta_boxes;
}

// Initialize the metabox class
add_action( 'init', 'ct_real_estate_initialize_cmb_meta_boxes', 9999 );
function ct_real_estate_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once (plugin_dir_path( __FILE__ ) . 'init.php');
	}
}