<?php
/**
 * Footer Template
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options;

$ct_footer_widget = isset( $ct_options['ct_footer_widget'] ) ? esc_attr( $ct_options['ct_footer_widget'] ) : '';
$ct_footer_text = isset( $ct_options['ct_footer_text'] ) ? esc_attr( $ct_options['ct_footer_text'] ) : '';
$ct_boxed = isset( $ct_options['ct_boxed'] ) ? esc_attr( $ct_options['ct_boxed'] ) : '';

?>
            <div class="clear"></div>
            
        </section>
        <!-- //Main Content -->

        <?php do_action('before_footer_widgets'); ?>
        
        <?php if($ct_footer_widget == 'yes') {
        echo '<!-- Footer Widgets -->';
        echo '<div id="footer-widgets">';
            echo '<div class="dark-overlay">';
                echo '<div class="container">';
        				if (is_active_sidebar('footer')) {
                            dynamic_sidebar('Footer');
                        }
                        echo '<div class="clear"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- //Footer Widgets -->';
        } ?>

        <?php do_action('before_footer'); ?>
        
        <!-- Footer -->
        <footer class="footer muted">
            <div class="container">   
                <?php ct_footer_nav(); ?>
                    
                <?php if($ct_footer_text) { ?>
                    <p class="marB0 right"><?php echo esc_html(stripslashes($ct_options['ct_footer_text'])); ?>. <a href="#top"><?php esc_html_e( 'Back to top', 'contempo' ); ?></a></p>
                <?php } else { ?>
                    <p class="marB0 right">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, <?php esc_html_e( 'All Rights Reserved.', 'contempo' ); ?> <a id="back-to-top" href="#top"><?php esc_html_e( 'Back to top ', 'contempo' ); ?></a></p>
                <?php } ?>
                <div class="clear"></div>
            </div>
        </footer>
        <!-- //Footer -->
        
    <?php if($ct_boxed == "boxed") {
	echo '</div>';
    echo '<!-- //Wrapper -->';
	} ?>

    <?php do_action('after_wrapper'); ?>

	<?php wp_footer(); ?>
</body>
</html>