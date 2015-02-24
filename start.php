<?php

	/*
	Plugin Name: FL3R User Agent Comments
	Plugin URI: https://wordpress.org/plugins/fl3r-user-agent-comments/
	Description: Shows user agent information to your website comments by adding browser and platform icons.
	Version: 1.5
	Author: Armando "FL3R" Fiore
	E-Mail: armandofioreinfo@gmail.com
	Author URI: https://www.twitter.com/Armando_Fiore
	License: Freeware, no warranty. Modifications not allowed.
	*/

	load_plugin_textdomain('fl3r-user-agent-comments', NULL, dirname(plugin_basename(__FILE__)) . "/languages");

	add_action('admin_menu', 'fuac_menu');

	function fuac_menu() 
	{
		add_options_page('FL3R User Agent Comments', __('FL3R User Agent Comments', 'fl3r-user-agent-comments'), 8, 'fl3r-user-agent-comments', 'fuac_options');
	}

	function get_fuac_options()
	{
		$fuac_options = array('post_icon_size' => '16',
								'post_show_browser' => 'true',
								'post_show_platform' => 'true',
								'general_show_unknown' => 'false',
								'post_location' => 'pl_before',
								'show_in_dashboard' => 'true');
		$fuac_save_options = get_option('fuac_options');
		if (!empty($fuac_save_options))
		{
			foreach ($fuac_save_options as $key => $option)
			$fuac_options[$key] = $option;
		}
		update_option('fuac_options', $fuac_options);
		return $fuac_options;
	}

	function fuac_options()
	{
		$fuac_options = get_fuac_options();
		if (isset($_POST['update_fuac_settings']))
		{
			$fuac_options['post_icon_size'] = isset($_POST['post_icon_size']) ? $_POST['post_icon_size'] : '16';
			$fuac_options['post_show_browser'] = isset($_POST['post_show_browser']) ? $_POST['post_show_browser'] : 'false';
			$fuac_options['post_show_platform'] = isset($_POST['post_show_platform']) ? $_POST['post_show_platform'] : 'false';
			$fuac_options['general_show_unknown'] = isset($_POST['general_show_unknown']) ? $_POST['general_show_unknown'] : 'false';
			$fuac_options['post_location'] = isset($_POST['post_location']) ? $_POST['post_location'] : 'pl_before';
			$fuac_options['show_in_dashboard'] = isset($_POST['show_in_dashboard']) ? $_POST['show_in_dashboard'] : 'false';

			update_option('fuac_options', $fuac_options);
			?>

<div class="updated">
  <p><strong>
    <?php _e("Settings saved. (⌒‿⌒) If you like this plugin, you consider making a small donation. ","fl3r-user-agent-comments");?>
    </strong><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PG99J6Q6A3VEC"><img src="<?php echo plugins_url("/images/gui/paypal-horizontal.png", __FILE__);?>" alt="Donate with PayPal" title="Donate with PayPal" class="fl3r-uac_icon_dashboard"></a></p>
</div>
<?php
		} ?>
<div class=wrap>
<?php if(function_exists('screen_icon')) screen_icon(); ?>
<form method="post" action="<?php echo esc_url(get_permalink()); ?>">
<h2>
  <?php _e('FL3R User Agent Comments - Settings', 'fl3r-user-agent-comments'); ?>
</h2>
<h3>
  <?php _e('General', 'fl3r-user-agent-comments'); ?>
</h3>
<p>
  <input name="general_show_unknown" value="true" 
							type="checkbox" <?php if ($fuac_options['general_show_unknown'] == 'true' ) echo ' checked="checked" '; ?> />
  <style>
							.fl3r-uac_icon_dashboard
								{
								vertical-align: middle;
								margin: 0px 4px !important;
								}
							</style>
  <?php _e('Hide', 'fl3r-user-agent-comments'); ?>
  <img src="<?php echo plugins_url("/images/browser/unknown.png", __FILE__);?>" alt="<?php _e('Unknown browser', 'fl3r-user-agent-comments'); ?>" title="<?php _e('Unknown browser', 'fl3r-user-agent-comments'); ?>" class="fl3r-uac_icon_dashboard">
  <?php _e('for the unknown browsers and', 'fl3r-user-agent-comments'); ?>
  <img src="<?php echo plugins_url("/images/os/unknown.png", __FILE__);?>" alt="<?php _e('Unknown platform', 'fl3r-user-agent-comments'); ?>" title="<?php _e('Unknown platform', 'fl3r-user-agent-comments'); ?>" class="fl3r-uac_icon_dashboard">
  <?php _e('for the unknown platforms if the user agent are unavailable.', 'fl3r-user-agent-comments'); ?>
</p>
<h3>
  <?php _e('Dashboard', 'fl3r-user-agent-comments'); ?>
</h3>
<p>
  <input name="show_in_dashboard" value="true" type="checkbox" <?php if ($fuac_options['show_in_dashboard'] == 'true' ) echo ' checked="checked" '; ?> />
  <?php _e('Show browser and platform icons in the dashboard comments.', 'fl3r-user-agent-comments'); ?>
</p>
<h3>
  <?php _e('Post', 'fl3r-user-agent-comments'); ?>
</h3>
<p>
  <?php _e('Display location:', 'fl3r-user-agent-comments'); ?>
  <select name="post_location">
    <option value="pl_author" <?php if ($fuac_options['post_location'] == 'pl_author' ) echo ' selected="selected" '; ?> >
    <?php _e('After comment author name', 'fl3r-user-agent-comments'); ?>
    </option>
    <option value="pl_date" <?php if ($fuac_options['post_location'] == 'pl_date' ) echo ' selected="selected" '; ?> >
    <?php _e('After comment date', 'fl3r-user-agent-comments'); ?>
    </option>
    <option value="pl_before" <?php if ($fuac_options['post_location'] == 'pl_before' ) echo ' selected="selected" '; ?> >
    <?php _e('Before comment text', 'fl3r-user-agent-comments'); ?>
    </option>
    <option value="pl_after" <?php if ($fuac_options['post_location'] == 'pl_after' ) echo ' selected="selected" '; ?> >
    <?php _e('After comment text', 'fl3r-user-agent-comments'); ?>
    </option>
  </select>
</p>
<p>
  <?php _e('Icon size:', 'fl3r-user-agent-comments'); ?>
  <select name="post_icon_size">
    <option value="16" <?php if ($fuac_options['post_icon_size'] == '16' ) echo ' selected="selected" '; ?> >16 px</option>
    <option value="18" <?php if ($fuac_options['post_icon_size'] == '18' ) echo ' selected="selected" '; ?> >18 px</option>
    <option value="20" <?php if ($fuac_options['post_icon_size'] == '20' ) echo ' selected="selected" '; ?> >20 px</option>
    <option value="22" <?php if ($fuac_options['post_icon_size'] == '22' ) echo ' selected="selected" '; ?> >22 px</option>
    <option value="24" <?php if ($fuac_options['post_icon_size'] == '24' ) echo ' selected="selected" '; ?> >24 px</option>
    <option value="32" <?php if ($fuac_options['post_icon_size'] == '32' ) echo ' selected="selected" '; ?> >32 px</option>
  </select>
</p>
<p>
  <input name="post_show_browser" value="true" type="checkbox" <?php if ($fuac_options['post_show_browser'] == 'true' ) echo ' checked="checked" '; ?> />
  <?php _e('Show browser icon.', 'fl3r-user-agent-comments'); ?>
</p>
<p>
  <input name="post_show_platform" value="true" type="checkbox" <?php if ( $fuac_options['post_show_platform'] == 'true' ) echo ' checked="checked" '; ?> />
  <?php _e('Show platform icon.', 'fl3r-user-agent-comments'); ?>
</p>
<div class="submit">
  <input class="button-primary" type="submit" name="update_fuac_settings" value="<?php _e('Save all settings', 'fl3r-user-agent-comments'); ?>" />
</div>
<hr />
<h3><?php _e('FAQ', 'fl3r-user-agent-comments'); ?></h3>
      <p><i><?php _e('In some comments icons do not reflect the browser and the operating system correctly. Why?', 'fl3r-user-agent-comments'); ?></i></p>
      <p><?php _e('Some browsers and some operating systems do not always report a coherent user agent.', 'fl3r-user-agent-comments'); ?></p>
	  <br>
      <p><i><?php _e('Sometimes the icons in the comments are unknown. Why?', 'fl3r-user-agent-comments'); ?></i></p>
      <p><?php _e('The plugin detects over 150 browsers and operating systems, representing over 99% of the systems that access the internet. Unfortunately, for various reasons, the 1% is not identifiable.', 'fl3r-user-agent-comments'); ?></p>
	  <br>
      <p><i><?php _e('How can I show user agent icons in a widget?', 'fl3r-user-agent-comments'); ?></i></p>
      <p><?php _e('You can see the user agent icons in a widget only if in the settings you are selected "After comment author name" in "Display location". You can so use the default Wordpress comments widget.', 'fl3r-user-agent-comments'); ?></p>
<hr />
<h3><?php _e('Credits', 'fl3r-user-agent-comments'); ?></h3>
      <p><?php _e('User Agent Comments is a plugin created by Armando "FL3R" Fiore.', 'fl3r-user-agent-comments'); ?></p>
      <p><?php _e('Thanks for using User Agent Comments, you helped a developer to increase his self-esteem!', 'fl3r-user-agent-comments'); ?></p>
      <h3><?php _e('Copyright', 'fl3r-user-agent-comments'); ?></h3>
      <p><?php _e('Copyright © 2015 Armando "FL3R" Fiore. All rights reserved. This software is provided as is, without any express or implied warranty. In no event shall the author be liable for any damage arising from the use of this software.', 'fl3r-user-agent-comments'); ?></p>
      <h3><?php _e('Follow me!', 'fl3r-user-agent-comments'); ?></h3>
      <p><?php _e('If you want to ask me, you want to send your opinion or you have a question please don\'t hesitate to contact me.', 'fl3r-user-agent-comments'); ?></p>
	  <p>
	  <a href="https://twitter.com/Armando_Fiore"><img src="<?php echo plugins_url("/images/gui/twitter.png", __FILE__);?>" alt="Twitter: Armando_Fiore" title="Twitter: Armando_Fiore" class="fl3r-uac_icon_dashboard"></a>
	  <a href="https://www.facebook.com/armando.FL3R.fiore"><img src="<?php echo plugins_url("/images/gui/facebook.png", __FILE__);?>" alt="Facebook: armando.FL3R.fiore" title="Facebook: armando.FL3R.fiore" class="fl3r-uac_icon_dashboard"></a>
	  <a href="https://plus.google.com/+ArmandoFiore"><img src="<?php echo plugins_url("/images/gui/google.png", __FILE__);?>" alt="Google+: ArmandoFiore" title="Google+: ArmandoFiore" class="fl3r-uac_icon_dashboard"></a>
	  <a href="http://it.linkedin.com/in/armandofiore"><img src="<?php echo plugins_url("/images/gui/linkedin.png", __FILE__);?>" alt="LinkedIn: armandofiore" title="LinkedIn: armandofiore" class="fl3r-uac_icon_dashboard"></a>
	  </p>
<hr />
<div>
  <h3><?php _e('Donate', 'fl3r-user-agent-comments'); ?></h3>
  <p><?php _e('If you like this plugin, you consider making a small donation. Thanks.', 'fl3r-user-agent-comments'); ?></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PG99J6Q6A3VEC">
<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>

</div>
<div>
  <h3><?php _e('My other plugins', 'fl3r-user-agent-comments'); ?></h3>
<a href="https://wordpress.org/plugins/fl3r-feelbox/"><?php _e('FL3R FeelBox', 'fl3r-user-agent-comments'); ?></a>
</div>
<?php
	}

	require_once 'include/browser.php';

	function display_user_agent($comment_text)
	{
				$plugin_url = plugins_url(plugin_basename( dirname( __FILE__ )));
		global $comment;
		if(is_feed())
			return $comment_text;
		$fuac_options = get_fuac_options();
		$browser = new Browser($comment->comment_agent);
		if($fuac_options['general_show_unknown'] == 'true' and $browser->Name == "Unknown" and $browser->Platform == "Unknown")
			return $comment_text;
		if($fuac_options['post_show_browser'] != 'false')
			$fuac_string = '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/browser/'.$browser->BrowserImage.'.png" alt="'.$browser->Name.' '.$browser->Version.'" title="'.$browser->Name.' '.$browser->Version.'"> ';
		if($fuac_options['post_show_platform'] != 'false')
			$fuac_string .= '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/os/'.$browser->PlatformImage.'.png" alt="'.$browser->Platform.' '.$browser->Pver.'" title="'.$browser->Platform.' '.$browser->Pver.' '.$browser->Architecture.'">';
		$commentID = get_comment_id();
		$result = $fuac_options['post_location'] == 'pl_before' ? $fuac_string."\n\n" . $comment_text . "\n\n" : $comment_text."\n\n".$fuac_string;
		return $result;
	}
	
	// fl3r: icone per la pagina principale della dashboard
	
	function display_user_agent_excerpt($comment_text)
	{
				$plugin_url = plugins_url(plugin_basename( dirname( __FILE__ )));
		global $comment;
		if(is_feed())
			return $comment_text;
		$fuac_options = get_fuac_options();
		$browser = new Browser($comment->comment_agent);
		if($fuac_options['general_show_unknown'] == 'true' and $browser->Name == "Unknown" and $browser->Platform == "Unknown")
			return $comment_text;
		if($fuac_options['post_show_browser'] != 'false')
			
		// fl3r: ad entrambe le icone è applicata la class .fl3r-icon-excerpt che evita sovrapposioni nella dashboard
			$fuac_string = '<style>
  .fl3r-icon-excerpt {position:initial !important;}
</style>
<img class="fl3r-icon-excerpt" width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/browser/'.$browser->BrowserImage.'.png" alt="'.$browser->Name.' '.$browser->Version.'" title="'.$browser->Name.' '.$browser->Version.'" margin-right="128px !important" position="initial !important"> ';
		if($fuac_options['post_show_platform'] != 'false')
			$fuac_string .= '<img class="fl3r-icon-excerpt" width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/os/'.$browser->PlatformImage.'.png" alt="'.$browser->Platform.' '.$browser->Pver.'" title="'.$browser->Platform.' '.$browser->Pver.' '.$browser->Architecture.'">';
		$commentID = get_comment_id();
		$result = $fuac_options['post_location'] == 'pl_before' ? $fuac_string."\n\n" . $comment_text . "\n\n" : $comment_text."\n\n".$fuac_string;
		return $result;
	}
	
	// fl3r.
	
	function display_user_agent_author($link)
	{
		//print_r($link);
				$plugin_url = plugins_url(plugin_basename( dirname( __FILE__ )));
		global $comment;
		if(is_feed())
			return $link;
		$fuac_options = get_fuac_options();
		$browser = new Browser($comment->comment_agent);
		if($fuac_options['general_show_unknown'] == 'true' and $browser->Name == "Unknown" and $browser->Platform == "Unknown")
			return $link;
		if($fuac_options['post_show_browser'] != 'false')
			$fuac_string = '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/browser/'.$browser->BrowserImage.'.png" alt="'.$browser->Name.' '.$browser->Version.'" title="'.$browser->Name.' '.$browser->Version.'"> ';
		if($fuac_options['post_show_platform'] != 'false')
			$fuac_string .= '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/os/'.$browser->PlatformImage.'.png" alt="'.$browser->Platform.' '.$browser->Pver.'" title="'.$browser->Platform.' '.$browser->Pver.' '.$browser->Architecture.'">';
		$commentID = get_comment_id();
		return $link.' '.$fuac_string;
	}
	
	function display_user_agent_date($input, $d = '')
	{
				$plugin_url = plugins_url(plugin_basename( dirname( __FILE__ )));
		global $comment;
		if(is_feed())
			return '';
		$fuac_options = get_fuac_options();
		$browser = new Browser($comment->comment_agent);
		if($fuac_options['general_show_unknown'] == 'true' and $browser->Name == "Unknown" and $browser->Platform == "Unknown")
			return '';
		if($fuac_options['post_show_browser'] != 'false')
			$fuac_string = '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/browser/'.$browser->BrowserImage.'.png" alt="'.$browser->Name.' '.$browser->Version.'" title="'.$browser->Name.' '.$browser->Version.'"> ';
		if($fuac_options['post_show_platform'] != 'false')
			$fuac_string .= '<img width="'.$fuac_options['post_icon_size'].'" height="'.$fuac_options['post_icon_size'].'" src="'.$plugin_url.'/images/os/'.$browser->PlatformImage.'.png" alt="'.$browser->Platform.' '.$browser->Pver.'" title="'.$browser->Platform.' '.$browser->Pver.' '.$browser->Architecture.'">';
		$commentID = get_comment_id();
		if(WPLANG == 'fa_IR')
			echo ' '.$fuac_string.' ';
		else
			echo $input.' '.$fuac_string.' ';		
	}
	
	$fuac_options = get_fuac_options(); {
	if($fuac_options['post_location'] == 'pl_author')
		add_filter('get_comment_author','display_user_agent_author');
	elseif($fuac_options['post_location'] == 'pl_date')
	
	// fl3r: patch
	// quando si seleziona "mostra dopo data" nella dashboard le icone raddoppiano
	// le righe in basso disabilitano l'opzione nella dashboard sostituendola con "mostra dopo commento"
	// mentre nella dashboard principale le icone vengono visualizzate dopo l'excerpt
		if ( ! is_admin() ) {
			add_filter('get_comment_date','display_user_agent_date');

		}
		else
		{
			remove_filter('get_comment_date','display_user_agent_date');
			add_filter('get_comment_text','display_user_agent');
			add_filter('get_comment_excerpt','display_user_agent_excerpt');
		}
	// fl3r.
	else
		
	// fl3r: uniformare la dashboard
		if ( ! is_admin() ) {	
			add_filter('get_comment_text','display_user_agent');
		}
		else
		{
			add_filter('get_comment_text','display_user_agent');
			add_filter('get_comment_excerpt','display_user_agent_excerpt');
		}
	// fl3r.
		
	if($fuac_options['show_in_dashboard'] == 'true')
		
	// fl3r: patch
	// quando si seleziona "mostra dopo nome utente" nella dashboard viene visualizzato il codice html
	// le righe in basso disabilitano l'opzione nella dashboard sostituendola con "mostra dopo commento"
	// mentre nella dashboard principale le icone vengono visualizzate dopo l'excerpt
		if ( ! is_admin() ) {	
		}
		else
		{
			remove_filter('get_comment_author','display_user_agent_author');
			remove_filter('get_comment_date','display_user_agent_date');
			add_filter('get_comment_text','display_user_agent');
			add_filter('get_comment_excerpt','display_user_agent_excerpt');
		}
	// fl3r.
	}
	
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'fuac_links' );
	
	function fuac_links($links)
	{ 
		$settings_link = '<a href="options-general.php?page=fl3r-user-agent-comments">'.__('Settings', 'fl3r-user-agent-comments').'</a>';
		array_unshift($links, $settings_link); 
		return $links; 
	}

?>
