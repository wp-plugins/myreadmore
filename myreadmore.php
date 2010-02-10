<?php
/*
Plugin Name: myReadMore - accessibility aid
Plugin URI: http://www.wdmac.com/wp-plugins/myreadmore
Description: This plugin allows users to improve WP accessibility by customizing their read-more links with custom-unique links on all excerpted posts.
Author: Miguel Azevedo e Castro
Version: 0.1
Author URI: http://www.wdmac.com/
*/

/* 
================================================================= */
function addAdminMenu_myreadMore() {	
	 
    add_menu_page('myReadMore Settings', 'myReadMore', 1, __FILE__, 'myReadMore_options');      
   	add_submenu_page(__FILE__, 'myReadMore Instructions', 'Instructions', 1, 'ADMsub-page', 'myReadMore_specs');
	}	
	add_action('admin_menu', 'addAdminMenu_myreadMore');  // Invoca a função
/*=============================================================== */
function myReadMore_options() {
	$opt_name_MRM = 'o_meu_input_MRM';
	$opt_name_MRM_2 = 'o_meu_input_MRM_2';
	$hidden_field_name = 'controlo';
	$data_field_name = 'o_meu_fieldName';	
	$data_field_name_2 = 'o_meu_fieldName_2';		
	$opt_val_MRM = get_option( $opt_name_MRM );
	$opt_val_MRM_2 = get_option( $opt_name_MRM_2 );
	if( $_POST[ $hidden_field_name ] == 'Y' ) {
	$opt_val_MRM = $_POST[ $data_field_name ];
	$opt_val_MRM_2 = $_POST[ $data_field_name_2 ];
	update_option( $opt_name_MRM, $opt_val_MRM );
	update_option( $opt_name_MRM_2, $opt_val_MRM_2 );
?>

<div class="updated">
  	<p><strong><?php _e('Options saved.', 'zuka_la_truka' ); ?></strong></p>
</div>
<?php
	}
	echo '<div class="wrap">';
	echo "<h2>" . __( 'Menu "myReadMore" Plugin Options', 'zuka_la_truka' ) . "</h2>";
																																																			
?> <p style="font-weight:bold;">Please read <a href="?page=ADMsub-page">the instructions page</a>, before starting. </p>
	<form name="form1" method="post" action="<?php echo esc_url(str_replace( '%7E', '~', $_SERVER['REQUEST_URI'])); ?>" >
  	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
  	<p>
	<?php _e("The constant \"Read-More-replacer\" word(s) to display:", 'zuka_la_truka' ); ?>
    <input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val_MRM; ?>" size="30" style="border-color:#999;">
    <br />
    <?php _e("Number of post-title words to display", 'zuka_la_truka' ); ?>
    <input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_MRM_2; ?>" size="3" style="border-color:#999;">
    </p>
  	<hr />
 	<p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Update Options', 'zuka_la_truka' ) ?>" />
  	</p>
	</form>
	</div>
   
<?php
}
function myReadMore_specs(){
	echo '<div class="wrap">';
		echo "<h2>Increasing word press accessibility conformance, according to the W3C-WCAG</h2>";
		echo "<div style=\"margin-bottom:10px;\">";
		echo "<h2>" . __( 'How, and why use the "myReadMore" Plugin', 'zuka_la_truka' ) . "</h2>";
		echo "<em>\"Provide clear and consistent navigation mechanisms - orientation information, navigation bars, a site map etc. - to increase the likelihood that a person will find what they are looking for at a site.\"</em> - Web Content Accessibility Guideline 13";
		echo "</div>";
		echo "<h2>Facts:</h2>";	
		echo "<p>- Most of the times you will not show all your posts content in a listing or in the first page of your website, since it simply takes too much precious \"real-estate\" prime space.<br />- Most of the times after a few \"teasing\" lines of text, you will use the MORE tag to break the post in an excerpt and (let's say) the rest of the post.<br />
		As a result you will have a pretty formatted listing with a few strong lines of each post, and at the end of each, the monotonous \"Read More...\" link, that takes you to the full post.</p>";
		echo "<p>One of the many things automatic validations will immediately pick upon is the repetition of different hyperlinks with the same link text.<br />
		The links actually will lead you to a complete different page, but the link text will always be the repetitive \"read more\" or similar. <br />Now this is an accessibility obstacle since it confuses users about where to go.</p>
		<p>Hyperlinks should clearly indicate their targets, so that users know in advance what to expect, should they choose to open them.<br />
		To avoid this repetition, we need different text links to different content. This plugin is about achieving that in a straightforward way.</p>";
		echo"<h2>How does \"myReadMore\" plugin work?</h2>";
		echo "<p><em>With this plugin you can replace the default \"read more\" with your chosen text AND adds a chosen number of the post-title-words to it, so all text links read different from each other.</em></p>";
		echo "<p>In the <strong>myReadMore panel</strong>, you can enter the \"constant\" word or words you wish to use to replace the default \"Read more\". Then you will choose how many of the post-title-words you wish to add to it, to make a unique \"continue reading\" link.</p>";
		echo "Example: after filling the \"constant\" field with: \"Click and read more about\" and choose 3 as the number of post-title-words to be read, you will end up with something like: \"<span style=\"color:blue; text-decoration:underline;\">Click and read more about  your-post-title</span>\"</p>";
		echo "<p>Choose your \"constant\" words wisely, since you'll need them to make sense along with the <em>(variable)</em> post title. Remember your readers should  know precisely where they will be taken after clicking it. </p>";
		echo "<p>Accessibility is not a drag. Have fun!</p>";
		echo "<p style=\"font-size:.8em;\">This plug-in is all-user-level config-enabled. This means that \"myReadMore admin panel\" is present to all admin-level users, subscribers not included, and not only to the global administrator (admin)</p>";
		
echo "</div>";
echo "<div style=\"margin-left:3px; margin-top:30px; font-size:.8em; background-color:#e5e5e5; padding:2px 8px;\"><strong>myReadMore</strong> by Miguel Azevedo e Castro - <a href=\"htp://www.wdmac.com\" target=\"_blank\">www.wdmac.com</a> - Help me to help others while developing free accessibility solutions. <a href=\"http://www.wdmac.com/buy-me-a-coffee\">Please support my accessibility projects</a></div>";

}
/* ========================================================== */
function mudaTexto(){
	$excerto = explode(" ", get_the_title() );
	// define as variaveis e define defaults em caso de 1st time users
	$more_link_text = get_option( 'o_meu_input_MRM' )?get_option( 'o_meu_input_MRM' ) . " " : "More about ";
	$z = get_option( 'o_meu_input_MRM_2' )?get_option( 'o_meu_input_MRM_2' ): 3;	
	if (count($excerto)<$z)
		$z = count($excerto);		
	for($n = 0; $n < $z; $n++)
		$more_link_text .= $excerto[$n]." "; 		
	return '<div><a href="' . get_permalink() . '#more-'. get_the_ID() .'" class="more-link">'.$more_link_text.'(...)</a></div>';
}
/* =========================================================== */
add_action('the_content_more_link', 'mudaTexto');  // Invoca a função  
?>
