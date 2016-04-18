<?php
/**
 * Template Name: Listing Email Alerts
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options, $current_user, $wp_roles;

$inside_page_title = get_post_meta($post->ID, "_ct_inner_page_title", true);

get_header();

if ( ! function_exists( 'wp_handle_upload' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

while ( have_posts() ) : the_post();

if($inside_page_title == "Yes") { 
	// Custom Page Header Background Image
	if(get_post_meta($post->ID, '_ct_page_header_bg_image', true) != '') {
		echo'<style type="text/css">';
		echo '#single-header { background: url(';
		echo get_post_meta($post->ID, '_ct_page_header_bg_image', true);
		echo ') no-repeat center center; background-size: cover;}';
		echo '</style>';
	} ?>

	<!-- Single Header -->
	<div id="single-header">
		<div class="dark-overlay">
			<div class="container">
				<h1 class="marT0 marB0"><?php the_title(); ?></h1>
				<?php if(get_post_meta($post->ID, '_ct_page_sub_title', true) != '') { ?>
					<h2 class="marT0 marB0"><?php echo get_post_meta($post->ID, "_ct_page_sub_title", true); ?></h2>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- //Single Header -->
<?php } ?>

<?php echo '<div class="container">'; ?>
    
        <article class="col span_12 listing-email-alerts">

        	<?php if(!is_user_logged_in()) {
                echo '<h4 class="center">' . __('You must be logged in to view this page.', 'contempo') . '</h4>';
            } else { ?>
            
				<?php the_content(); ?>

                <section class="col span_12 create-alert marB60">

    				<h3 class="marB5"><?php _e('Create a new email alert', 'contempo'); ?></h3>
                    <p class="muted"><?php _e('What are you looking for? Fill out the fields below it can be as precise or as broad as you like.', 'contempo'); ?></p>

    				<div class="col span_3 first">
                        <label><?php esc_html_e('Type', 'contempo'); ?></label>
                        <?php ct_submit_listing_form_select('property_type'); ?>
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('Status', 'contempo'); ?></label>
                        <?php ct_submit_listing_form_select('ct_status'); ?>
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('Beds', 'contempo'); ?></label>
                        <input type="text" name="beds" id="beds" value="" placeholder="3" />
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('Baths', 'contempo'); ?></label>
                        <input type="text" name="baths" id="baths" value="" placeholder="4" />
                    </div>

                    <div class="col span_3 first">
                        <label><?php esc_html_e('Price From', 'contempo'); ?> (<?php ct_currency(); ?>)</label>
                        <input type="text" name="pricefrom" id="pricefrom" value="" placeholder="<?php esc_html_e('650000', 'contempo'); ?>" />
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('Price To', 'contempo'); ?> (<?php ct_currency(); ?>)</label>
                        <input type="text" name="priceto" id="priceto" value="" placeholder="<?php esc_html_e('1200000', 'contempo'); ?>" />
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('City', 'contempo'); ?></label>
                        <input type="text" name="city" id="city" value="" placeholder="San Diego" />
                    </div>

                    <div class="col span_3">
                        <label><?php esc_html_e('State', 'contempo'); ?></label>
                        <input type="text" name="state" id="state" value="" placeholder="CA" />
                    </div>

                    <div class="col span_3 first">
                        <label><?php ct_zip_or_post(); ?></label>
                        <input type="text" name="zip" id="zip" value="" placeholder="92101" />
                    </div>

                     <div class="col span_3 submit">
                        <label><?php esc_html_e('Submit', 'contempo'); ?></label>
                        <input type="submit" value="<?php esc_html_e('Submit Alert', 'contempo'); ?>" tabindex="5" id="submit" name="submit" class="btn" />
                    </div>

                </section>

                    <div class="clear"></div>

                <section class="col span_12 first marB60 manage-alerts">

                    <h3 class="marB5"><?php _e('Manage your alerts', 'contempo'); ?></h3>
                    <p class="muted"><?php _e('Here you can turn saved alerts on/off or remove them completely.', 'contempo'); ?></p>

                    <div class="col span_12 first current-alerts">

                        <header class="marB20">
                            <div class="col span_5 first">
                                <h5><?php _e('Query', 'contempo'); ?></h5>
                            </div>
                            <div class="col span_3">
                                <h5><?php _e('Date Created', 'contempo'); ?></h5>
                            </div>
                            <div class="col span_2">
                                <h5><?php _e('Email Setting', 'contempo'); ?></h5>
                            </div>
                            <div class="col span_2 delete">
                                <h5><?php _e('Delete', 'contempo'); ?></h5>
                            </div>
                                <div class="clear"></div>
                        </header>

                        <ul>
                            <li>
                                <div class="col span_5 first">
                                    <p>3 beds, 4 baths, San Diego, CA</p>
                                </div>
                                <div class="col span_3">
                                    <p>3/23/2016</p>
                                </div>
                                <div class="col span_2">
                                    <select>
                                        <option value="<?php _e('on', 'contempo'); ?>"><?php _e('On', 'contempo'); ?></option>
                                        <option value="<?php _e('off', 'contempo'); ?>"><?php _e('Off', 'contempo'); ?></option>
                                    </select>
                                </div>
                                <div class="col span_2 delete">
                                    <p><a class="btn" href="#"><i class="fa fa-trash-o"></i></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="col span_5 first">
                                    <p>Single Family Home, For Sale, La Jolla, CA</p>
                                </div>
                                <div class="col span_3">
                                    <p>2/15/2016</p>
                                </div>
                                <div class="col span_2">
                                    <select>
                                        <option value="<?php _e('on', 'contempo'); ?>"><?php _e('On', 'contempo'); ?></option>
                                        <option value="<?php _e('off', 'contempo'); ?>"><?php _e('Off', 'contempo'); ?></option>
                                    </select>
                                </div>
                                <div class="col span_2 delete">
                                    <p><a class="btn" href="#"><i class="fa fa-trash-o"></i></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="col span_5 first">
                                    <p>Condo, $450,000 to $890,000, Coronado, CA 92118</p>
                                </div>
                                <div class="col span_3">
                                    <p>10/23/2015</p>
                                </div>
                                <div class="col span_2">
                                    <select>
                                        <option value="<?php _e('on', 'contempo'); ?>"><?php _e('On', 'contempo'); ?></option>
                                        <option value="<?php _e('off', 'contempo'); ?>" selected><?php _e('Off', 'contempo'); ?></option>
                                    </select>
                                </div>
                                <div class="col span_2 delete">
                                    <p><a class="btn" href="#"><i class="fa fa-trash-o"></i></a></p>
                                </div>
                            </li>
                        </ul>

                    </div>

                </section>

			<?php } ?>
            
            <?php //wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'contempo' ) . '</span>', 'after' => '</div>' ) ); ?>
            
            <?php endwhile; ?>
            
                <div class="clear"></div>

        </article>

<?php 
	echo '<div class="clear"></div>';
echo '</div>';

get_footer(); ?>