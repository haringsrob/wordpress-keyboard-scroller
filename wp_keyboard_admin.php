<?php
/*
* Our admin page takes care of all the admin settings available.
* We seperated our settings page so that we can keep our code clean and easy to maintain.
*/
/*
 * Check if the form has been submitted
 */
if(isset($_POST['wp_keyboard_settings_hidden'])&&$_POST['wp_keyboard_settings_hidden'] == 'Y') {
    update_option('wp_keyboard_next', $_POST['wp_keyboard_next']);
    update_option('wp_keyboard_previous', $_POST['wp_keyboard_previous']);
    update_option('wp_keyboard_index', $_POST['wp_keyboard_index']);
    update_option('wp_keyboard_open', $_POST['wp_keyboard_open']);
    update_option('wp_keyboard_enable_slide', $_POST['wp_keyboard_enable_slide']);
    update_option('wp_keyboard_scrollspeed', $_POST['wp_keyboard_scrollspeed']);
    update_option('wp_keyboard_enable_border', $_POST['wp_keyboard_enable_border']);
    update_option('wp_keyboard_border_color', $_POST['wp_keyboard_border_color']);    
    $wp_keyboard_next = get_option('wp_keyboard_next');
    $wp_keyboard_previous = get_option('wp_keyboard_previous');
    $wp_keyboard_index = get_option('wp_keyboard_index');
    $wp_keyboard_open = get_option('wp_keyboard_open');
    $wp_keyboard_enable_slide = get_option('wp_keyboard_enable_slide');
    $wp_keyboard_scrollspeed = get_option('wp_keyboard_scrollspeed');
    $wp_keyboard_enable_border = get_option('wp_keyboard_enable_border');
    $wp_keyboard_border_color = get_option('wp_keyboard_border_color');
    /*
     * Display a message that the data has been saved.
     */
    ?>
    <div class="updated"><p><strong><?php _e('Options saved.', 'wp_keyboard_trdom'); ?></strong></p></div>
	<?php 
} else {
    /*
     * Retrieve our variable from the database and update the form
     */
    $wp_keyboard_next = get_option('wp_keyboard_next');
    $wp_keyboard_previous = get_option('wp_keyboard_previous');
    $wp_keyboard_index = get_option('wp_keyboard_index');
    $wp_keyboard_open = get_option('wp_keyboard_open');
    $wp_keyboard_enable_slide = get_option('wp_keyboard_enable_slide');
    $wp_keyboard_scrollspeed = get_option('wp_keyboard_scrollspeed');
    $wp_keyboard_enable_border = get_option('wp_keyboard_enable_border');
    $wp_keyboard_border_color = get_option('wp_keyboard_border_color');
}
?>
<div class="wrap">
	<?php echo "<h2>" . __( 'Wordpress Keyboard admin page', 'wp_keyboard_trdom' ) . "</h2>"; ?>
	<form name="wp_keyboard_settings_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="wp_keyboard_settings_hidden" id="wp_keyboard_settings_hidden" value="Y" />
	<?php echo "<h3>" . __( 'Select all the enabled keyboard shortcuts', 'wp_keyboard_trdom' ) . "</h3>"; ?>
	<?php if($wp_keyboard_next=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_next" <?php echo $checked; ?> > <?php _e("Enable next post [J]", 'wp_keyboard_trdom'); ?><br />
	</p>
	<?php if($wp_keyboard_previous=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_previous" <?php echo $checked; ?> > <?php _e("Enable previous post [K]", 'wp_keyboard_trdom'); ?><br />
	</p>
	<?php if($wp_keyboard_index=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_index" <?php echo $checked; ?> > <?php _e("Enable back to top [T]", 'wp_keyboard_trdom'); ?> <br />
	</p>
	<?php if($wp_keyboard_open=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_open" <?php echo $checked; ?> > <?php _e("Enable 'open current post' [O]", 'wp_keyboard_trdom'); ?> <br />
	</p>
	<?php if($wp_keyboard_enable_slide=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_enable_slide" id="wp_keyboard_enable_slide" <?php echo $checked; ?> > <?php _e("Enable smooth scrolling", 'wp_keyboard_trdom'); ?><br />
	</p>
	<div class="scrollsettingswrapper" style="display:none;">
		<?php echo "<h3>" . __( 'Scrolling effect settings', 'wp_keyboard_trdom' ) . "</h3>"; ?>
		<p>
			<?php _e("Select the scrolling speed", 'wp_keyboard_trdom'); ?> <br />
			<input type="text" name="wp_keyboard_scrollspeed" id="wp_keyboard_scrollspeed" value="<?php echo $wp_keyboard_scrollspeed; ?>" size="15"><br />
			<?php _e("Value should be between 0-1000", 'wp_keyboard_trdom'); ?>
		</p>
	</div> 
	<?php if($wp_keyboard_enable_border=='on'){ $checked = 'checked="checked"'; }else{ $checked = ''; } ?>
	<p>
		<input type="checkbox" name="wp_keyboard_enable_border" id="wp_keyboard_enable_border" <?php echo $checked; ?> > <?php _e("Appends a border in front of the text when viewed with keyboard shortcut", 'wp_keyboard_trdom'); ?><br />
	</p>
	<div class="bordersettingswrapper" style="display:none;">
		<?php echo "<h3>" . __( 'Border settings', 'wp_keyboard_trdom' ) . "</h3>"; ?>
		<p>
			<?php _e("Set the border color", 'wp_keyboard_trdom'); ?> <br />
			<input type="text" name="wp_keyboard_border_color" id="wp_keyboard_border_color" value="<?php echo $wp_keyboard_border_color; ?>" size="15"><br />
			<?php _e("Choose a color, you must enter hex color codes wich you can find here:", 'wp_keyboard_trdom'); ?> <a href="http://html-color-codes.info/" target="_blank">http://html-color-codes.info/</a><br />
			<?php _e("You must include the #!", 'wp_keyboard_trdom'); ?> <br />
		</p>
	</div>
	<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'wp_keyboard_trdom' ) ?>" />
	</p>
	<script>
		if(jQuery("#wp_keyboard_enable_slide").attr('checked')){
			jQuery(".scrollsettingswrapper").fadeIn();
		}
		jQuery("#wp_keyboard_enable_slide").click(function(){
			if(jQuery("#wp_keyboard_enable_slide").attr('checked')){
				jQuery(".scrollsettingswrapper").fadeIn();
			}else{
				jQuery(".scrollsettingswrapper").fadeOut();
			}
		});
		if(jQuery("#wp_keyboard_enable_border").attr('checked')){
			jQuery(".bordersettingswrapper").fadeIn();
		}
		jQuery("#wp_keyboard_enable_border").click(function(){
			if(jQuery("#wp_keyboard_enable_border").attr('checked')){
				jQuery(".bordersettingswrapper").fadeIn();
			}else{
				jQuery(".bordersettingswrapper").fadeOut();
			}
		});
	</script>