=== Page.ly MultiEdit ===
Contributors: Joshua Strebel 
Tags: admin,formatting,pages,page,cms,multiedit, blocks, editable regions, tinymce, custom fields, page.ly
Requires at least: 2.9
Tested up to: 3.0
Stable Tag: 0.9.7

MultiEdit adds tinyMCE editable "blocks" to page templates. 
== Description ==

One thing I always wished WP would do better is allow for multiple editable content blocks on page templates. This plugin uses custom fields to create simple tinyMCE editable regions on page templates. 

See Instructions and Usage Examples here: [Page.ly MultiEdit plugin](http://blog.page.ly/multiedit-plugin/)

Brought to you by: [Page.ly WordPress Hosting](http://page.ly)

Follow [@strebel](http://twitter.com/strebel) and check out Page.ly for sweet 2 minute setup of WordPress Websites.


== Installation ==

# [Instructions here](http://blog.page.ly/multiedit-plugin/)
== Changelog ==
= 0.9.7 = 
Re-assigned $post->page_template to page.php if "default".  Repsects multiedit declaration in header of page.php now. Still need to publish/update the page a couple times before the multi edit tabs appear above tinymce. I figure this is becuase $post->page_templte is null until the page is actually saved.
= 0.9.6 = 
Tested with 3.0.. added post.php to array in init check
= 0.9.5 =
* force tinymce to visual mode when saving post
* fixes the bug that main content was being overwritten if saved in html mode
= 0.9.4 = 
* added some trim() to a few places.
= 0.9.3 =
* Did some refactoring, made sure no php notices were being thrown, added a notice if you have existing multiedit regions on the page, then change template to another multiedit enabled template with different declarations.
= 0.9.2 =
* check for empty $post->page_template and ignore
= 0.9.1 =
* changed version number so wp repo will show update
= .9g =
* fixed weird behavior when saving a page not using multiedit.. basically does not load the js
= .9f =
* Fixed bug that would replace tinymce content before save if no multiedit fields avail.  You deleted or changed content, and hit update page and it would put your old content back in.
= .9e =
* Added disabled message if tinymce is not being used.. for now
= .9d =
* Mo betta 
= .9c =
* Better check for edit page and custom template before running 
= .9b =
* Fixed dumb oversight that borked 0.9, plugin can now find the .js and .css file.
= .9 =
* Ported from an [old plugin](http://saint-rebel.com/2008/09/26/multiedit-region-wordpress-plugin/) we wrote.
