<?php
/*  Copyright 2011  MistViper.com

   	This program is free software; you can redistribute it and/or 	modify it under the terms of the GNU General Public License as 	published by the Free Software Foundation; either version 2 of 	the License, or any later version.

   	This program is distributed in the hope that it will be useful,
    	but WITHOUT ANY WARRANTY; without even the implied warranty of
   	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    	GNU General Public License for more details.

*/


/*
	Plugin Name: MistViper AgeGate
	Plugin URI:http://www.mistviper.com/agegate
	Description: This plugin will restrict content and age gate 	chosen posts.
	Version: 1.1
	Author: MistViper.com
	Author URI: http://www.mistviper.com
*/
require_once ABSPATH.'/wp-includes/pluggable.php';
require_once 'includes/agegate_templatetags.php';
require_once 'includes/agegate_filters.php';
require_once 'includes/agegate_metadata.php';
require_once 'includes/agegate_css.php';


define ('agegate_PATH',ABSPATH.'/'.PLUGINDIR.'/agegate/');
define ('agegate_formsPATH', ABSPATH.'/'.PLUGINDIR.'/agegate/forms');
define ('agegate_TRANSLATEDIR', PLUGINDIR.'/agegate/translation');
define ('agegate_TRANSLATIONDOMAIN', 'agegate');
define ('agegate_PLUGINURL', get_bloginfo ( 'wpurl' ).'/wp-content/plugins/agegate/');
define ('agegate_DEFAULT_MESSAGE', __('This post is restricted, and may contain content inapropriate for minors. Please insert your age.', agegate_TRANSLATIONDOMAIN));
define ('agegate_NUONCETARGET', plugin_basename(__FILE__));

/**
 * Initialize the translation for the Plugin.
 *
 */
function agegate_init_translation()
{	
	
	load_plugin_textdomain(agegate_TRANSLATIONDOMAIN, agegate_TRANSLATEDIR);
}
add_action('init', 'agegate_init_translation');


if (!function_exists ('print_rn'))
{
	function print_rn ($p_mData)
	{
		echo '<pre>';
		print_r ($p_mData);
		echo '</pre>';
	}
}


?>
