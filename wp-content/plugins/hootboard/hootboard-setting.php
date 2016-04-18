<?php 
$page_id = get_option( 'hootboard_page_id', '');
if($_POST['save']=="Go")
{ 
$url = $_POST['url'];
if(trim($_POST['url']) === '')  {
		$_SESSION['Feedback']  = 'Please enter hootboard url.';
		$hasError = true;
	} else if (!strncmp($url ,'https://www.hootboard.com/#/b/' ,30)==0) {
		$_SESSION['Feedback']  = 'Oops!	This doesn\'t look like a valid	HootBoard link.</br>		
Try	something	like	this:	"https://www.hootboard.com/#/b/317186/About_Hootboard"';
		$hasError = true;
	} else {
		$iframe = $url;
		$_SESSION['PlaceholderText'] = $url;
	}
	

if(!isset($hasError)) {

          if(update_option('hootboard_hootboardurl', $iframe ));
          {
                $_SESSION['Success'] = "Your board is embeded and running.";
          }
  }
  }


/*====================Saving setting color value=============================*/
$resultbgcolor = $_POST['resultbgcolor'];
if(!empty($resultbgcolor)) { update_option( 'hootboard_bgcolor', $resultbgcolor ); }

$resultboxbgcolor = $_POST['resultboxbgcolor'];
if(!empty($resultboxbgcolor)) { update_option( 'hootboard_boxbgcolor', $resultboxbgcolor ); }

$boxtextcolorresult = $_POST['boxtextcolorresult'];
if(!empty($boxtextcolorresult)) { update_option( 'hootboard_boxtextcolor', $boxtextcolorresult ); }

$buttoncolorresult = $_POST['buttoncolorresult'];
if(!empty($buttoncolorresult)) { update_option( 'Hootboard_buttoncolor', $buttoncolorresult ); }


/*====================Reset Saved setting color value=============================*/


$resetallstyle = $_POST['resetallstyle'];
if(!empty($resetallstyle)) { 
		update_option( 'hootboard_bgcolor', $resetallstyle ); 
		update_option( 'hootboard_boxbgcolor', $resetallstyle );
		update_option( 'hootboard_boxtextcolor', $resetallstyle ); 
		update_option( 'hootboard_buttoncolor', $resetallstyle );
	}


?> 

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$( document ).ready(function() {

 $('#backgroundColorPicker').spectrum({
		color: '<?php echo get_option('hootboard_bgcolor');?>',
		showAlpha: true,
		showInitial: true,
		clickoutFiresChange: true,
		preferredFormat: "hex",
		showInput: true,
		move: function(color){
			$('#resultbgcolor').css('background-color',color.toRgbString());
			$('#resultbgcolor').css('display','none');
		}
	});
	
	 $('#boxbackgroundColorPicker').spectrum({
		color: '<?php echo get_option('hootboard_boxbgcolor');?>',
		showAlpha: true,
		showInitial: true,
		clickoutFiresChange: true,
		preferredFormat: "hex",
		showInput: true,
		move: function(color){
			$('#resultboxbgcolor').css('background-color',color.toRgbString());
			$('#resultboxbgcolor').css('display','none');
		}
	});
	 $('#boxtextbackgroundColorPicker').spectrum({
		color: '<?php echo get_option('hootboard_boxtextcolor');?>',
		showAlpha: true,
		showInitial: true,
		clickoutFiresChange: true,
		preferredFormat: "hex",
		showInput: true,
		move: function(color){
			$('#boxtextcolorresult').css('background-color',color.toRgbString());
			$('#boxtextcolorresult').css('display','none');
		}
	});
	 $('#buttonColorPicker').spectrum({
		color: '<?php echo get_option('hootboard_buttoncolor');?>',
		showAlpha: true,
		showInitial: true,
		clickoutFiresChange: true,
		preferredFormat: "hex",
		showInput: true,
		move: function(color){
			$('#buttoncolorresult').css('background-color',color.toRgbString());
			$('#buttoncolorresult').css('display','none');
		}
	});
	

});
</script>





<script>
$( document ).ready(function() {
$( "#backgroundColorPicker" ).change(function() {
var value = $("div#resultbgcolor").css( "background-color" );
jQuery.ajax({
    url: '<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php',
    type: "POST",
    data: {'resultbgcolor':value},
    success: function(data)
        {
           //alert('Board background color saved');
        }
});
});



$( "#boxbackgroundColorPicker" ).change(function() {
var value = $("div#resultboxbgcolor").css( "background-color" );
jQuery.ajax({
    url: '<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php',
    type: "POST",
    data: {'resultboxbgcolor':value},
    success: function(data)
        {
          // alert('Title area background color saved');
        }
});
});



$( "#boxtextbackgroundColorPicker" ).change(function() {
var value = $("div#boxtextcolorresult").css( "background-color" );
jQuery.ajax({
    url: '<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php',
    type: "POST",
    data: {'boxtextcolorresult':value},
    success: function(data)
        {
           //alert('Title text color saved');
        }
});
});



$( "#buttonColorPicker" ).change(function() {
var value = $("div#buttoncolorresult").css( "background-color" );
jQuery.ajax({
    url: '<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php',
    type: "POST",
    data: {'buttoncolorresult':value},
    success: function(data)
        {
           //alert('Join button color saved');
        }
});
});

});
</script>


<script>
$( document ).ready(function() {
$( "#reset" ).click(function() {
var value = " ";

jQuery.ajax({
    url: '<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php',
    type: "POST",
    data: {'resetallstyle':value},
    success: function(data)
        {
			$('.sp-preview-inner').css('backgroundColor','rgb(0, 0, 0)');
			//alert('All style setting has been reset');
        }
});
});
});
</script>


<?php 
wp_register_style( 'hootboard', plugins_url( '/css/hootboard.css', __FILE__ ), array(), '20120208', 'all' ); 
wp_enqueue_style( 'hootboard' );  

wp_register_style( 'spectrum', plugins_url( '/css/spectrum.css', __FILE__ ), array(), '20120208', 'all' ); 
wp_enqueue_style( 'spectrum' );  

wp_register_script( 'spectrum', plugins_url( '/js/spectrum.js', __FILE__ ), array( 'jquery' ) );  
wp_enqueue_script( 'spectrum' ); 

wp_register_script( 'docs', plugins_url( '/js/docs.js', __FILE__ ), array( 'jquery' ) );  
wp_enqueue_script( 'docs' );  
?>

<div class="wrap">
	<div class="welcome-panel" id="welcome-panel">
		<div class="welcome-panel-content">
			<div class="welcome-panel-column-container">
				<h2>HootBoard</h2>
				<p>HootBoard is a bulletin board for your community website. Whether you are a school, university, government, neighborhood, organization OR a workplace there is now a better way to get members engaged, content organized and to partner with other local organizations.</p>
				<p><strong>Need more information?</strong> Take a <a href="http://about.hootboard.com/"  target="_blank">tour</a> or visit the <a href="https://wordpress.org/plugins/hootboard/" target="_blank">plugin page</a>.</p>

				<!-- Step 1 -->
				<div class="steps">
					<h4>Step 1: Create your HootBoard</h4>
					<div>Register and create your board at <a href="https://www.hootboard.com" target="_blank">www.hootboard.com</a></div>
					<a href="https://www.hootboard.com/#/createBoard" target="_blank" onclick="return popitup('https://www.hootboard.com/#/createBoard')" class="button button-primary">Create One</a>
				</div>
				<!-- /Step 1 -->

				<!-- Step 2 -->
				<div class="steps">
					<h4>Step 2: Copy/paste your board link below</h4>
					<div>The link of you board should look like http://www.hootboard.com/#/b/yourboard</div>
<?php if(!empty($_SESSION['Feedback'])) { 
						echo '<span style="color:#D56161; margin-bottom: 10px;">'.$_SESSION['Feedback'].'</span>';
					} 
					unset($_SESSION['Feedback']);?>					
					<form name="" action="" method="post" id="addUrlForm">		
						<input type="text" placeholder="Enter the community link of your HootBoard" name="url" style="width:50%; height: 32px;" id="addUrlInput">
						<button type="submit" accesskey="p" id="publish" class="button button-primary button-large" name="save" value="Go" disabled="disabled">Apply</button>
					</form>
				</div>
				<!-- /Step 2 -->

				<!-- Step 3 -->
				<div class="steps">
					<h4>Step 3: Customize your HootBoard</h4>
					<div class="color-picker">					
						<span>
							<form method="post" action="<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php">
								<label for="link_color"><strong><?php echo __('Board Background'); ?></strong></label>
								<input type="text" name="hootboard_setting_options[bgcolor]" id="backgroundColorPicker" value=""/>
								<div id="resultbgcolor">&nbsp;</div>
							</form>
						</span>
						
						<span>
							<form method="post" action="<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php">
								<label for="link_color"><strong><?php echo __('Title area background'); ?></strong></label>
								<input type="text" name="hootboard_setting_options[boxbgcolor]" id="boxbackgroundColorPicker" value=""/>
								<div id="resultboxbgcolor">&nbsp;</div>
							</form>
						</span>
						
						<span>
							<form method="post" action="<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php">
								<label for="link_color"><strong><?php echo __('Title text'); ?></strong></label>
								<input type="text" name="hootboard_setting_options[boxtextcolor]" id="boxtextbackgroundColorPicker" value=""/>
								<div id="boxtextcolorresult">&nbsp;</div>
							</form>
						</span>
						
						<span>
							<form method="post" action="<?php echo home_url();?>/wp-admin/admin.php?page=hootboard/hootboard-setting.php">
								<label for="link_color"><strong><?php echo __('Join Board Button'); ?></strong></label>    
								<input type="text" name="hootboard_setting_options[buttoncolor]" id="buttonColorPicker" value=""/>    
								<div id="buttoncolorresult">&nbsp;</div>
							</form>
						</span>
					</div>
				</div>
				<!-- /Step 3 -->
				<!-- Step 4 -->
				<div class="steps">
					<a target="_blank" href="<?php echo site_url(); ?>?page_id=<?php echo $page_id;?>" class="button button-primary" style="display: none" id="finishButton">Finish</a>
					<a id="emptyButton" href="javascript:void(0);" class="button button-primary">Finish</a>
					<?php if(!empty($_SESSION['Success'])) {
						$showFinish = true; 
						echo '<span style="color:#5FAB21; margin-bottom: 10px; margin-left: 10px;">'.$_SESSION['Success'].'</span>';
					} else {
						$showFinish = false;
						echo '<span style="color:#D56161; margin-bottom: 10px; margin-left: 10px; display: none;" id="step2Error">Please complete step 2 first!!!</span>';
					}
					unset($_SESSION['Success']);?>
				</div>
				<!-- /Step 4 -->
			</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','height=850,width=790,scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
	}
</script>
<script>
$('#addUrlInput').bind("change keyup input", function(){
    //console.log('enable it');
	if($(this).val().length > 0){
		//console.log('text entered');

		$('#publish').removeAttr('disabled');
	}
});
$( document ).ready(function() {
	<?php if($showFinish) { 
		echo '$("#emptyButton").hide();$("#finishButton").show();';
	} else {
		echo '$("#finishButton").hide();$("#emptyButton").show();';
	}
	?>

	<?php if(!empty($_SESSION['PlaceholderText'])) {
		echo '$("#addUrlInput").attr("placeholder","'.$_SESSION['PlaceholderText'].'");';
	} else {
		echo '$("#addUrlInput").attr("placeholder","Enter the community link of your HootBoard");';
	}
	unset($_SESSION['Success']);?>

});
$('#emptyButton').click(function(){
	$('#step2Error').show();
});

</script>
