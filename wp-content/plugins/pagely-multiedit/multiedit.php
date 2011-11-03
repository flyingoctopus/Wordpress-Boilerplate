<?php
/*
Plugin Name: Page.ly MultiEdit
Plugin URI: http://blog.page.ly/multiedit-plugin
Description: Multi-Editable Region Support for Page Templates BTYB. <a href="http://page.ly">Page.ly WordPress Hosting</a>
Version: 0.9.7
Author: Joshua Strebel
Author URI: http://page.ly
*/

/*
/--------------------------------------------------------------------\
|                                                                    |  
| License: GPL                                                       |
|                                                                    |
| Page.ly MultiEdit- Adds editable Blocks to page templates in       |
| WordPress                                                          |
| Copyright (C) 2010, Joshua Strebel,                                |
| http://page.ly                                                     |
| All rights reserved.                                               |
|                                                                    |
| This program is free software; you can redistribute it and/or      |
| modify it under the terms of the GNU General Public License        |
| as published by the Free Software Foundation; either version 2     |
| of the License, or (at your option) any later version.             |
|                                                                    |
| This program is distributed in the hope that it will be useful,    |
| but WITHOUT ANY WARRANTY; without even the implied warranty of     |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the      |
| GNU General Public License for more details.                       |
|                                                                    |
| You should have received a copy of the GNU General Public License  |
| along with this program; if not, write to the                      |
| Free Software Foundation, Inc.                                     |
| 51 Franklin Street, Fifth Floor                                    |
| Boston, MA  02110-1301, USA                                        |   
|                                                                    |
\--------------------------------------------------------------------/
*/
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
 
define ('PLUGINASSETS',WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'');

if (in_array(basename($_SERVER['PHP_SELF']),array('post.php','page.php')) && $_GET['action'] == 'edit' ) {
	add_action('init','multiedit');
}

function multiedit() {
	add_action ('admin_footer', 'doMultiMeta', 1);	
}

$GLOBALS['multiEditDisplay'] = false;

// api for templates
function multieditDisplay($index) {
	if ($GLOBALS['multiEditDisplay'] === false) {
		$GLOBALS['multiEditDisplay'] = get_post_custom(0);
	}
	$index = "multiedit_$index";	

	if (isset($GLOBALS['multiEditDisplay'][$index])) {
		echo $GLOBALS['multiEditDisplay'][$index][0];
	}

}


function multieditAdminHeader() {
	echo '<link rel="stylesheet" type="text/css" href="' . PLUGINASSETS .'/multiedit.css" />';	
	echo '<script type="text/javascript" src="' .  PLUGINASSETS .'/multiedit.js" ></script>';	
}

function drawMultieditHTML($meta,$presentregions) {
	echo '<div id="multiEditControl"></div>';
	echo '<div id="multiEditHidden"><span class="multieditbutton selected" id="default">Main Content</span>';

		//print_r($meta);
		//print_r($presentregions);
		
	// this adds the multiedit tabs that appear above the tinymce editor
		if (is_array($meta)) {
			foreach($meta as $item) {
				if (preg_match('/^multiedit_(.+)/',$item['meta_key'],$matches)) {
					// lets check regions defined in this template ($presentregions) against those in meta
					// so we can treat meta values that may be in $post, but not in this template differently
					print_r($matches);
					$notactive = false;
					if (!array_key_exists($matches[1],$presentregions)) { $notactive = 'notactive'; $fields[] = $matches[1];}
					 $mkey = trim($item['meta_key']);
					 $mval = trim($item['meta_value']);
					 $mid = trim($item['meta_id']);
					 $mclean = trim($matches[1]);
					echo "<span class='multieditbutton $notactive' id='hs_$mkey' rel='$mid'>$mclean</span><input type='hidden' id='hs_$mkey' name='$mkey' value=\"".htmlspecialchars($mval).'" />';
				
				}
			}
			// show a message if needed
			if (!empty($fields)) {echo "<div id='nonactive' style='display:none'><p>".implode(', ',$fields)." region(s) are not declared in the template.</p></div>";}
		}
	
	echo "<div id='multiEditFreezer' style='display:none'>".$post->post_content."</div></div>\n";
}

function doMultiMeta() {

	global $post;
	$meta = has_meta($post->ID);

	// if default template.. assign var to page.php
	$post->page_template == 'default' ? $post->page_template = 'page.php' : '';
	
	$templatefile = locate_template(array($post->page_template));	
	$template_data = implode('', array_slice(file($templatefile), 0, 10));	
	$matches = '';
	//check for multiedit declaration in template
	if (preg_match( '|MultiEdit:(.*)$|mi', $template_data, $matches)) {
		 $multi = explode(',',_cleanup_header_comment($matches[1]));
		 // load scripts
		 multieditAdminHeader();
		 // WE have multiedit zones, load js and css load
		 add_action ('edit_page_form', 'multieditAdminEditor', 1);
		 add_action ('edit_form_advanced', 'multieditAdminEditor', 1);
		 
		 //simple var assigment
		 foreach($meta as $k=>$v) {
		 	 foreach($multi as $region) {
		 	  	if (in_array('multiedit_'.$region,$v)) {
		 	  		$present[$region] = true;
		 	  	}
		 	 }
		 }
		
		//draw html
		drawMultieditHTML($meta,$present);

		// if custom field is not declared yet, create one with update_post_meta 
		foreach($multi as $region) {
			if(!isset($present[$region])) {
					update_post_meta($post->ID, 'multiedit_'.$region, '');
			} 
		}		 
	} // end preg_match
				 
}

