<?php
/*Plugin Name: Agreement
Plugin URI: http://www.indiatale.com/agreement/
Description: The Agreement plugin helps to create pop-up licence agreement or term to use before download any thing from post or page.
Author: Pranav Pathak
Version: 1.1
Author URI: http://www.indiatale.com/agreement/
*/

/**  Copyright 2013  Pranav Pathak  (email : pranavpathak125@gmail.com)
 *
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License, version 2, as 
 *    published by the Free Software Foundation.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program; if not, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 // Not a WordPress context? Stop.
! defined( 'ABSPATH' ) and exit;

//Require the code to the rest of the plugin
require_once(trailingslashit(WP_PLUGIN_DIR) . 'agreement/functions/agreement-functions.php');

$wc_agreement = new wc_agreement();

add_action( 'wp_enqueue_scripts', array($wc_agreement,'call_agreement' )); 

add_action('wp_footer', array($wc_agreement,'call_html_function'));