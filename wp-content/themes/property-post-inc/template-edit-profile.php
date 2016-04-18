<?php
/**
 * Template Name: Edit Profile
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options; 

$inside_page_title = get_post_meta($post->ID, "_ct_inner_page_title", true);

get_header();

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
    
        <article class="col span_12">

        	<?php if(!is_user_logged_in()) {
                echo '<h4 class="center">' . __('You must be logged in to view this page.', 'contempo') . '</h4>';
            } else { ?>
            
				<?php the_content(); ?>

				<?php 
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
				if(is_plugin_active('frontend-edit-profile/fep.php')) {
					echo do_shortcode('[EDITPROFILE]');
				} ?>

			<?php } ?>
            
            <?php //wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'contempo' ) . '</span>', 'after' => '</div>' ) ); ?>
            
            <?php endwhile; ?>
            
                <div class="clear"></div>

        </article>

<?php 
	echo '<div class="clear"></div>';
echo '</div>';

get_footer(); ?>