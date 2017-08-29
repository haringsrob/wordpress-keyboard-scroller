<?php
/*
Plugin Name: Keyboard usage
Plugin URI: http://easycom.be
Description: Add some keyboard usage to your wordpress site!
Author: Harings Rob (tortelduif)
Version: 1.0
Author URI: http://www.easycom.be
*/
/*
 * Add the footer callback function
 */
function wp_keyboard_load_javascript() {
    $wp_keyboard_next = get_option('wp_keyboard_next');
    $wp_keyboard_previous = get_option('wp_keyboard_previous');
    $wp_keyboard_index = get_option('wp_keyboard_index');
    $wp_keyboard_open = get_option('wp_keyboard_open');
    $wp_keyboard_enable_slide = get_option('wp_keyboard_enable_slide');
    $wp_keyboard_scrollspeed = get_option('wp_keyboard_scrollspeed');
    $wp_keyboard_enable_border = get_option('wp_keyboard_enable_border');
    $wp_keyboard_border_color = get_option('wp_keyboard_border_color');
?>
<?php 
/*
 * Set the slider speed
 */
if($wp_keyboard_enable_slide=="on") {
	if($wp_keyboard_scrollspeed<>""){
		$speed=$wp_keyboard_scrollspeed;
	}else{
		$speed=0;
	}
}else{
	$speed=0;
}
/*
 * Set the color, default #cccccc
 */
if($wp_keyboard_border_color==""){
	$wp_keyboard_border_color="#cccccc";
} 
/*
 * Enable / disbale border
 */
if($wp_keyboard_enable_border==""){
	$bordersize = "0px";
	$paddingsize = "0px";
}else{
	$bordersize = "3px";
	$paddingsize = "5px";
}
?>
<!-- The following script checks if jquery is available -->
<script type="text/javascript">
	if (jQuery) {  
		/*
		 * Jquery is loaded!
		 */
		 jQuery(document).ready(function(){
			jQuery(document).scroll(function() {
				var cutoff = jQuery(window).scrollTop();
				jQuery('.post').removeClass('top').each(function() {
					if (jQuery(this).offset().top > cutoff) {
						jQuery(this).addClass('top');
						return false; // stops the iteration after the first one on screen
					}
				});
			});
			jQuery(document).keypress(function(event) {
				<?php if($wp_keyboard_open=="on") {?>
					if ( event.which == 111 ) {
						if(jQuery(".post.scrolled:last a").length > 0){
							var url = jQuery(".post.scrolled:last a").attr('href');
							window.location = url; // redirect
						}
					}
				<?php } ?>
				<?php if($wp_keyboard_index=="on") {?>
					if ( event.which == 116 ) {
						jQuery("html, body").animate({scrollTop: 0}, <?php echo $speed; ?>);
						jQuery(".post.scrolled").each(function(){
							jQuery(this).removeClass('scrolled');
						});
					}
				<?php } ?>
				<?php if($wp_keyboard_next=="on") {?>
					if ( event.which == 106 ) {
						if(jQuery(".post.scrolled").length > 0){
							jQuery(".bordered").removeClass('.bordered').css({
								"border-left": "none",
								"padding-left": "none"
							});
							jQuery("html, body").animate({scrollTop: jQuery(".post.scrolled:last").next('.post').offset().top}, <?php echo $speed; ?>);
							jQuery(".post.scrolled:last").next('.post').addClass('scrolled');
							jQuery(".post.scrolled:last .entry-content").addClass('bordered').css({ 
								"border-left": "<?php echo $bordersize; ?> solid <?php echo $wp_keyboard_border_color; ?>",
								"padding-left": "<?php echo $paddingsize; ?>"
							});
						}else if(jQuery('.post.top').length > 0 && jQuery('.post').length != 1){
							jQuery("html, body").animate({scrollTop: jQuery(".post.top:not(.scrolled)").offset().top}, <?php echo $speed; ?>);
							jQuery(".post.top:first").addClass('scrolled');
							jQuery(".post.top.scrolled:first").prevAll().addClass('scrolled');
							jQuery(".post.top.scrolled:first .entry-content").addClass('bordered').css({ 
								"border-left": "<?php echo $bordersize; ?> solid <?php echo $wp_keyboard_border_color; ?>",
								"padding-left": "<?php echo $paddingsize; ?>"
							});
						}else if(jQuery('.post').length != 1){
							jQuery("html, body").animate({scrollTop: jQuery(".post:not(.scrolled)").offset().top}, <?php echo $speed; ?>);
							jQuery(".post:first").addClass('scrolled');
							jQuery(".post.scrolled:first .entry-content").addClass('bordered').css({ 
								"border-left": "<?php echo $bordersize; ?> solid <?php echo $wp_keyboard_border_color; ?>",
								"padding-left": "<?php echo $paddingsize; ?>"
							});
						}
					};
				<?php } ?>
				<?php if($wp_keyboard_next=="on") {?>
					if (event.which == 107 ) {
						if(jQuery(".post.scrolled").length > 0){
							jQuery(".bordered").removeClass('.bordered').css({
								"border-left": "none",
								"padding-left": "none"
							});
							jQuery("html, body").animate({scrollTop: jQuery(".post.scrolled:last").prev('.post.scrolled').offset().top}, <?php echo $speed; ?>);
							jQuery(".post.scrolled:last").removeClass('scrolled');
							jQuery(".post.scrolled:last .entry-content").addClass('bordered').css({ 
								"border-left": "<?php echo $bordersize; ?> solid <?php echo $wp_keyboard_border_color; ?>",
								"padding-left": "<?php echo $paddingsize; ?>"
							});
						}
					};
				<?php } ?>
			});
		 });
	}
</script>
<?php
}
/*
 * Add action to add to footer of post
 */
add_action('wp_footer', 'wp_keyboard_load_javascript');
/*
 * Set our seperate admin hook, and make it include a settings file
 * This way we can keep our code clean;
 */
function wp_keyboad_admin() {
    include('wp_keyboard_admin.php');
}
/*
 * Create our admin actions and settings
 */
function wp_keyboad_actions() {
    add_options_page("Keyboard actions", "Keyboard actions", "edit_pages", "wp_keyboad_actions", "wp_keyboad_admin");
}
/*
 * Add it to the admin menu using the hook
 */
add_action('admin_menu', 'wp_keyboad_actions');