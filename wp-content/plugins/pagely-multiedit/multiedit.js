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

function initMultiEdit() {
	if(jQuery('#multiEditHidden span').length > 1) {
		jQuery('#multiEditControl').append(jQuery('#multiEditHidden span'));
		jQuery('#postdivrich').before(jQuery('#multiEditControl'));
		jQuery('#postdivrich').attr('rel','default');
				
		//shorten the span text and hide the custom fields
		jQuery('#multiEditControl span').each( function(index) {
			//var oldstr = jQuery(this).html();
			//var newstr = oldstr.split('_');	
			//if (newstr[1]) {
			//	 jQuery(this).html(newstr[1]);
			//}
			
			var metaid = jQuery(this).attr('rel');
			// find and hide the tr for multiedit custom fields
			jQuery('tr#meta-'+metaid).addClass('mevalue').hide();
		});
		
		jQuery('table#list-table tbody').append('<tr id="multishow"><td class="left"><span>Show/Hide MultiEdit fields</span></td><td></td></tr>');
		
		jQuery('a#edButtonPreview').click(function(){
			jQuery('#multiEditControl span').show();
			jQuery('#multiEditControl em').remove();
		});
	
		jQuery('a#edButtonHTML').click(function(){
			jQuery('#multiEditControl span').hide();
			jQuery('#multiEditControl').append('<em>Enable Visual Editing to use MultiEdit</em>');	
		});
	
		//alert(jQuery('#postdivrich').html());
		if(jQuery('#postdivrich').html() == null) {
			jQuery('#multiEditControl').hide();
		}
		

	
	} else {
		// if not multiedit regions defined.. hide the divs... 
		// This should probably be done on the php side
		jQuery('#multiEditHidden').hide();
		jQuery('#multiEditControl').hide();
	}
	
}

function getTinyMCEContent() {
	var iframeRef = jQuery('#content_ifr');
	return jQuery(iframeRef).contents().find('body').html();
}

function toggleTinyMCE(newcontent) {
	var iframeRef = jQuery('#content_ifr');
	jQuery(iframeRef).contents().find('body').html(newcontent);
	jQuery('#editorcontainer textarea').text(newcontent);

}

function copyDefaultToFreezer(content) {
	jQuery('#multiEditFreezer').html(content);
}
function getFreezer() {
	return jQuery('#multiEditFreezer').html();
}
function triggerSelected(idref,newid) {
	jQuery('span.multieditbutton').removeClass('selected');
	jQuery(idref).addClass('selected');
	jQuery('#postdivrich').attr('rel',newid);
}
function getSelectedPostDiv() {
	return jQuery('#postdivrich').attr('rel');
}
function getMetaContent(metaID) {
	return jQuery("tr#meta-"+metaID+" td textarea").val();
}
function setMetaContent(metaID,string) {
	return jQuery("tr#meta-"+metaID+" td textarea").val(string);
}


// ready
jQuery(document).ready( function() {
	
	// if multiedit link is clicked lets store current tinymce string somwhere so we can retreive it later
	// then retrieve stored string and place into tinyMCE 	
	jQuery('span.multieditbutton').click(function() {
		
		// the tinyMCE iframe
		var iframeRef = jQuery('#content_ifr');
		// id of this multiedit 
		var thisID = jQuery(this).attr('id');
		var thisWPMetaID = jQuery(this).attr('rel');
		
		// get current rel attr #postdivrich that will tell use what content is inside of it
		var selectedpostdiv = getSelectedPostDiv();	

		// main the_content() tinymce
		if(selectedpostdiv=="default") {
			copyDefaultToFreezer(getTinyMCEContent());
		} else {
			// currently showing a multiedit region, lets update the meta textarea before switching	
			var active = jQuery('span#'+selectedpostdiv).attr('rel');
			setMetaContent(active,getTinyMCEContent());
		}
		
	 	// Toggle the actual tinymce content
		if (thisID == 'default') {	
			// if default, grab content from freezer
			toggleTinyMCE(getFreezer());
		} else {
			// grab the content from the meta field
			toggleTinyMCE(getMetaContent(thisWPMetaID));
			
		}
		
		// trigger class changes for active button
		triggerSelected(this,thisID);
	});
	
	
	// we want to catch the submit action to do some cleanup 
	// and save the meta fields before wordpress posts the form
	
	jQuery('form#post').submit( function() {	
			// force tinymcs visual mode
			jQuery('a#edButtonPreview').click();
 			// reverts tinymce back to default thereby saving and open tab
			jQuery('span#default.multieditbutton').click();
			// this clicks the update button (saves them) on the all custom fields
			jQuery('#postcustomstuff input.updatemeta').click();
		
	});
	
	// show or hide the multiedit custom field table rows
	jQuery('table#list-table tr#multishow span').live( 'click' , function (){
		jQuery('table#list-table tbody tr.mevalue').toggle();
	});
	
	// start
	initMultiEdit();
	jQuery('#nonactive').addClass('upgrade fade error');
	jQuery('#postdivrich').before(jQuery('#nonactive'));
	jQuery('#nonactive').fadeIn();

});
