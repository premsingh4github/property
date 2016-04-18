<?php
/*
Plugin Name: HootBoard
Plugin URI: http://wordpress.org/plugins/hootboard/
Description: HootBoard provides cool, highly interactive and visual online bulletin boards for communities of virtually any size. 
Members of these bulletin boards can easily create virtual flyers (hoots) by uploading PDF flyers OR creating cool multimedia hoots using the hoot creator. 
Hoots can also be created on the platform using the Hoot editor where users can add components like videos, music, call to action to engage their audience.
Version: 2.1
Author: HootBoard	
Author URI: http://www.hootboard.com/
License: GPL2
*/

add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page(){
    add_menu_page( 'hootboard', 'Hootboard', 'manage_options', 'hootboard/hootboard-setting.php', '', plugins_url( 'hootboard/images/icon.png' ), 6 );
}



if (!class_exists('Hootboard_Plugin'))
{
  class Hootboard_Plugin
  {
    public $_name;
    public $page_title;
    public $page_name;
    public $page_id;
    public $page_link;

    public function __construct()
    {
      $this->_name      = 'Hootboard';
      $this->page_title = 'Hootboard';
      $this->page_name  = $this->_name;
      $this->page_id    = '0';
     // $this->link    = '';

      register_activation_hook(__FILE__, array($this, 'activate'));
      register_deactivation_hook(__FILE__, array($this, 'deactivate'));
      register_uninstall_hook(__FILE__, array($this, 'uninstall'));

      add_filter('parse_query', array($this, 'query_parser'));
    //  add_filter('the_posts', array($this, 'page_filter'));
    }

	


    public function activate()
    {
      global $wpdb;      

      delete_option($this->_name.'_page_title');
      add_option($this->_name.'_page_title', $this->page_title, '', 'yes');

      delete_option($this->_name.'_page_name');
      add_option($this->_name.'_page_name', $this->page_name, '', 'yes');

      delete_option($this->_name.'_page_id');
      add_option($this->_name.'_page_id', $this->page_id, '', 'yes');
      
    //  $defaulturl = "http://www.hootboard.com/thirdpartyapp.jsp?disp=popwin&ref=wp&utm_source=WP&utm_medium=App&utm_content=CreateOne&utm_campaign=3PApp";
      $defaulturl = "http://www.hootboard.com/community/hootboard_Demo/134568/134568";
      delete_option($this->_name.'_hootboardurl');
      add_option($this->_name.'_hootboardurl', $defaulturl, '', 'yes');
      
      delete_option($this->_name.'_bgcolor');
      add_option($this->_name.'_bgcolor', '', '', 'yes');
      
      delete_option($this->_name.'_boxbgcolor');
      add_option($this->_name.'_boxbgcolor', '', '', 'yes');
      
      delete_option($this->_name.'_boxtextcolor');
      add_option($this->_name.'_boxtextcolor', '', '', 'yes');
      
       delete_option($this->_name.'_buttoncolor');
      add_option($this->_name.'_buttoncolor', '', '', 'yes');
      
      

      $the_page = get_page_by_title($this->page_title);

      if (!$the_page)
      {
        // Create post object
        $_p = array();
        $_p['post_title']     = $this->page_title;
        $_p['post_content']   = '[displayhootboard]';
        $_p['post_status']    = 'publish';
        $_p['post_type']      = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status']    = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncategorised'

        // Insert the post into the database
        $this->page_id = wp_insert_post($_p);
      }
      else
      {
        // the plugin may have been previously active and the page may just be trashed...
        $this->page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $this->page_id = wp_update_post($the_page);
      }

      delete_option($this->_name.'_page_id');
      add_option($this->_name.'_page_id', $this->page_id);
    }

    public function deactivate()
    {
      $this->deletePage();
      $this->deleteOptions();
    }

    public function uninstall()
    {
      $this->deletePage(true);
      $this->deleteOptions();
    }

    public function query_parser($q)
    {
      if(isset($q->query_vars['page_id']) AND (intval($q->query_vars['page_id']) == $this->page_id ))
      {
        $q->set($this->_name.'_page_is_called', true);
      }
      elseif(isset($q->query_vars['pagename']) AND (($q->query_vars['pagename'] == $this->page_name) OR ($_pos_found = strpos($q->query_vars['pagename'],$this->page_name.'/') === 0)))
      {
        $q->set($this->_name.'_page_is_called', true);
      }
      else
      {
        $q->set($this->_name.'_page_is_called', false);
      }
    }

   /* function page_filter($posts)
    {
      global $wp_query;

      if($wp_query->get($this->_name.'_page_is_called'))
      {
		  echo "<pre>";
		  print_r($wp_query);
		  
        echo "</pre>";
       
        $posts[0]->post_title = __('Hootboard');
        $posts[0]->post_content = do_shortcode('[displayhootboard]');
      }
      return $posts;
    }
*/
    private function deletePage($hard = false)
    {
      global $wpdb;

      $id = get_option($this->_name.'_page_id');
      if($id && $hard == true)
        wp_delete_post($id, true);
      elseif($id && $hard == false)
        wp_delete_post($id);
    }

    private function deleteOptions()
    {
      delete_option($this->_name.'_page_title');
      delete_option($this->_name.'_page_name');
      delete_option($this->_name.'_page_id');
      delete_option($this->_name.'_hootboard_hootboardurl');
      delete_option($this->_name.'_hootboard_bgcolor');
      delete_option($this->_name.'_hootboard_boxbgcolor');
      delete_option($this->_name.'_hootboard_boxtextcolor');
      delete_option($this->_name.'_hootboard_buttoncolor');
    }
    
    
    
    /* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}



    
    
    
    
    public function showboard()
    {
                $hootboardurl = get_option('hootboard_hootboardurl');
                
                $bgcolor = get_option('hootboard_bgcolor');
                $bgcolor = str_replace('#','%23',$bgcolor);
                !empty($bgcolor) ? $bgcolor = base64_encode($bgcolor) : $bgcolor = 'nobgColor';
		
                $boxbgcolor = get_option('hootboard_boxbgcolor');
                $boxbgcolor = str_replace('#','%23',$boxbgcolor);
                !empty($boxbgcolor) ? $boxbgcolor = base64_encode($boxbgcolor) : $boxbgcolor = 'nobxColor';
                
                $boxtextcolor = get_option('hootboard_boxtextcolor');
                $boxtextcolor = str_replace('#','%23',$boxtextcolor);
                !empty($boxtextcolor) ? $boxtextcolor = base64_encode($boxtextcolor) : $boxtextcolor = 'notxtColor';
                
                $buttoncolor = get_option('hootboard_buttoncolor');
                $buttoncolor = str_replace('#','%23',$buttoncolor);
                !empty($buttoncolor) ? $buttoncolor = base64_encode($buttoncolor) : $buttoncolor = 'nobtnColor';
                
		$domain_name = substr($hootboardurl, 0, 30);
		$board_det = substr($hootboardurl, 30);
		$coll_str = '';
		$pos1 = stripos($board_det, '/');
		$pos2 = strripos($board_det, '/');

		if($pos1 === false && $pos2 === false){
    			/*echo 'Neither pos found<br>';*/
		} else {
    			if($pos1 === $pos2){
        			/*echo 'Only one occurence of slash.<br>';*/
    			} else {
        			$coll_str = substr($board_det, $pos2+1);
        			if($coll_str != 'showAll'){
					$coll_str = '/nopageParam/'.$coll_str;
					/*echo $coll_str.'<br>';*/
					$board_det = substr($board_det, 0, -$pos2-1);
				} else {
					$board_det = substr($board_det, 0, -8);
					$coll_str = '';
				}
    			}
		}
		$iframe_url = $domain_name.'e/true/'.$board_det.'/'.$bgcolor.'/'.$boxbgcolor.'/'.$boxtextcolor.'/'.$buttoncolor.$coll_str;

              return  $iframe = '<iframe src="'.$iframe_url.'" height="630" width="100%" frameborder="0"></iframe><div style="float:right;position: relative; bottom: 45px;padding-right: 20px;" id="powered"><a target="_blank" href="'.$hootboardurl.'"><img src="https://www.hootboard.com/img/hootboardFinal-18.png" alt="Hootboard" width="100" height="35" /></a></div>';
    } 
  }
  add_shortcode('displayhootboard',array( 'Hootboard_Plugin','showboard'));
  
  
}
$hootboard = new Hootboard_Plugin();
?>
