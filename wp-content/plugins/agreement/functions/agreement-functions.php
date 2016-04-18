<?php

/**
 * Class wc_agreement will content the functions
 * which will be used to change the common functionalities of the site.
 */
class wc_agreement {
	public function call_agreement() {
		wp_enqueue_script('custom-script',plugins_url().'/agreement/js/agreement.js',array( 'jquery' ));
		wp_register_style( 'prefix-style', plugins_url().'/agreement/css/agreement.css');
		wp_enqueue_style( 'prefix-style' );
	}
    public function __construct() {
        if ( is_admin() ){
            add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }
    }
    public function add_plugin_page(){
        // This page will be under "Settings"
        add_options_page( 'Settings Admin', 'Agreement', 'manage_options', 'agreement-setting-admin', array( $this, 'create_admin_page' ) );
    }
    public function create_admin_page() {
        ?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>License Agreement Settings</h2>			
	    <form method="post" action="options.php">
	    <?php
                  
		    settings_fields( 'agreement_option_group' );	
		    do_settings_sections( 'agreement-setting-admin' );
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
    public function page_init() {		
        register_setting( 'agreement_option_group', 'agreement', array( $this, 'agreement_call' ) );
            
            add_settings_section(
            'setting_section_id',
            'Setting',
            array( $this, 'print_section_info' ),
            'agreement-setting-admin'
        );	
            
        add_settings_field(
            'agreement', 
            'Agreement Text', 
            array( $this, 'create_an_agreement_field' ), 
            'agreement-setting-admin',
            'setting_section_id'			
        );		
    }
	
    public function agreement_call( $input ) {

		if ( get_option( 'agreement_text' ) === FALSE ) {
			add_option( 'agreement_text', $input );
		} else {
			update_option( 'agreement_text', $input );
		}
		return $input;
    }
	
    public function print_section_info(){
        print 'Enter your License Agreement setting text below:';
    }
	
    public function create_an_agreement_field(){
        ?>
		<textarea name="agreement" id="agreement" style="width: 704px; height: 126px;"><?php echo get_option('agreement_text'); ?></textarea> 
		<?php 	
    }
		public function call_html_function(){
	?>
		<div class='licence-agreementbase' style='display:none;'> </div>
		<div class='licence-agreement'style='display:none;'>
			<p><?php if(get_option('agreement_text'))
					{
						echo get_option('agreement_text');
					} 
					else 
					{
						echo "Change text from Agreement option in Settings"; 
					}
				?>
			</p>
			<div class='licence-submit-button'>
				<input id='agree' type='submit' value='I agree'><input id='dis-agree' type='submit' value='Disagree'>
			</div>
		</div>
	<?php
	}
}
