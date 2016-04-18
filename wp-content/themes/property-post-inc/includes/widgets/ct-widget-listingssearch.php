<?php
/**
 * Listings Search
 *
 * @package WP Pro Real Estate 7
 * @subpackage Widget
 */
 
class ct_ListingsSearch extends WP_Widget {

   function ct_ListingsSearch() {
	   $widget_ops = array('description' => 'Display the listings search.' );
	   parent::__construct(false, __('CT Listings Search', 'contempo'),$widget_ops);      
   }

   function widget($args, $instance) {  
	extract( $args );
	
	$title = $instance['title'];

	global $ct_options;

    $ct_home_adv_search_fields = isset( $ct_options['ct_home_adv_search_fields']['enabled'] ) ? $ct_options['ct_home_adv_search_fields']['enabled'] : '';
	
	?>
		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; }

        echo '<div class="widget-inner">'; ?>
        
            <form id="advanced_search" name="search-listings" action="<?php echo home_url(); ?>">

               <?php
        
                if ($ct_home_adv_search_fields) :
                
                foreach ($ct_home_adv_search_fields as $field=>$value) {
                
                    switch($field) {
            			
            		// Type            
                    case 'type' : ?>
                        <div class="col span_12 first ct-type">
                            <label class="muted" for="ct_type"><?php esc_html_e('Type', 'contempo'); ?></label>
                            <?php ct_search_form_select('property_type'); ?>
                        </div>
                    <?php
            		break;
            		
            		// City
            		case 'city' : ?>
            		<div class="col span_12 first ct-city">
            			<label class="muted" for="ct_city"><?php esc_html_e('City', 'contempo'); ?></label>
            			<?php ct_search_form_select('city'); ?>
            		</div>
                    <?php
            		break;
            		
                    // State            
                    case 'state' : ?>
                        <div class="col span_6 first ct-state">
                            <label class="muted" for="ct_state"><?php esc_html_e('State', 'contempo'); ?></label>
            				<?php ct_search_form_select('state'); ?>
                        </div>
                    <?php
            		break;
            		
            		// Zipcode            
                    case 'zipcode' : ?>
                        <div class="col span_12 first ct-zipcode">
                            <label class="muted" for="ct_zipcode"><?php esc_html_e('Zipcode', 'contempo'); ?></label>
            				<?php ct_search_form_select('zipcode'); ?>
                        </div>
                    <?php
            		break;

                    // Country            
                    case 'country' : ?>
                        <div class="col span_12 first ct-country">
                            <label class="muted" for="ct_country"><?php esc_html_e('Country', 'contempo'); ?></label>
                            <?php ct_search_form_select('country'); ?>
                        </div>
                    <?php
                    break;
            		
            		// Beds            
                    case 'beds' : ?>
                        <div class="col span_6 first ct-beds">
                            <label class="muted" for="ct_beds"><?php esc_html_e('Beds', 'contempo'); ?></label>
            				<?php ct_search_form_select('beds'); ?>
                        </div>
                    <?php
            		break;
            		
            		// Baths            
                    case 'baths' : ?>
                        <div class="col span_6 ct-baths">
                            <label class="muted" for="ct_baths"><?php esc_html_e('Baths', 'contempo'); ?></label>
            				<?php ct_search_form_select('baths'); ?>
                        </div>
                    <?php
            		break;
            		
            		// Status            
                    case 'status' : ?>
                        <div class="col span_12 first ct-status">
                            <label class="muted" for="ct_status"><?php esc_html_e('Status', 'contempo'); ?></label>
            				<?php ct_search_form_select('ct_status'); ?>
                        </div>
                    <?php
            		break;
            		
            		// Additional Features            
                    case 'additional_features' : ?>
                        <div class="col span_12 first ct-add-feats">
                            <label class="muted" for="ct_additional_features"><?php esc_html_e('Addtional Features', 'contempo'); ?></label>
            				<?php ct_search_form_select('additional_features'); ?>
                        </div>
                    <?php
            		break;

                    // Community          
                    case 'community' : ?>
                        <div class="col span_12 first ct-community">
                            <label for="ct_community"><?php _e('Community', 'contempo'); ?></label>
                            <?php ct_search_form_select('community'); ?>
                        </div>
                    <?php
                    break;
            		
            		// Price From            
                    case 'price_from' : ?>
                        <div id="ct_price_from" class="col span_6 first ct-price-from">
                            <label class="muted" for="ct_price_from"><?php esc_html_e('Price From', 'contempo'); ?> (<?php ct_currency(); ?>)</label>
                            <input type="text" id="ct_price_from" class="number" name="ct_price_from" size="8" placeholder="<?php esc_html_e('Price From', 'contempo'); ?> (<?php ct_currency(); ?>)" />
                        </div>
                    <?php
            		break;
            		
            		// Price To            
                    case 'price_to' : ?>
                        <div id="ct_price_to" class="col span_6 ct-price-to">
                            <label class="muted" for="ct_price_to"><?php esc_html_e('Price To', 'contempo'); ?> (<?php ct_currency(); ?>)</label>
                            <input type="text" id="ct_price_to" class="number" name="ct_price_to" size="8" placeholder="<?php esc_html_e('Price To', 'contempo'); ?> (<?php ct_currency(); ?>)" />
                        </div>
                    <?php
            		break;
            		
            		// MLS            
                    case 'mls' : ?>
                        <div class="col span_12 first ct-mls">
                            <label class="muted" for="ct_mls"><?php esc_html_e('MLS #', 'contempo'); ?></label>
                            <input type="text" id="ct_mls" name="ct_mls" size="12" />
                        </div>
                    <?php
            		break;

                    // Number of Guests            
                    case 'numguests' : ?>
                        <div class="col span_12 first ct-num-guests">
                            <label for="ct_rental_guests"><?php _e('Number of Guests', 'contempo'); ?></label>
                            <input type="text" id="ct_rental_guests" name="ct_rental_guests" size="12" placeholder="<?php esc_html_e('Number of Guests', 'contempo'); ?>" />
                        </div>
                    <?php
                    break;

                    }
                
                } endif; ?>
                
                    <div class="clear"></div>
                
                <input type="hidden" name="search-listings" value="true" />
                <?php
    		        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    		        if(is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {

    		            $lang =  ICL_LANGUAGE_CODE;

    		            //echo '<input type="hidden" name="lang" value="' . $lang . '" />';
    		        }
    		    ?>
                <input id="submit" class="btn marB0" type="submit" value="<?php esc_html_e('Search', 'contempo'); ?>" />
                <div class="left makeloading"><i class="fa fa-circle-o-notch fa-spin"></i></div>

            </form>

        </div>
		
		<?php echo $after_widget; ?>   
    <?php
   }

   function update($new_instance, $old_instance) {                
	   return $new_instance;
   }

   function form($instance) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		?>
		<p>
		   <label class="muted" for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','contempo'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<?php
	}
} 

register_widget('ct_ListingsSearch');
?>