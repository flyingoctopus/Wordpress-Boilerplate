=== WP-Blocks ===
Contributors: keirwhitaker
Donate link: http://keirwhitaker.com/donate/
Tags: content, blocks
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: trunk

WP-Blocks allows you to edit non page and post content. Requires PHP5

== Description ==

WP-Blocks a simple plugin designed to help you edit discrete bits of template content via the WordPress admin interface. A good example would be your sidebar bio, footer copyright notice or a simple events listing. It's not intended to be tied in with posts and pages like some other plugins.

Here's what you need to know:

* WP-Blocks can be accessed via the Settings menu in the WordPress admin (I may move this in time)
* The plugin requires PHP5 (apologies to those on PHP4)
* I have developed and tested this plugin on WordPress Version 3.0 and above
* It "should" work on earlier versions, as far as I know I haven't used any brand spanking new API calls
* Every "block", whether visible or not will incur a database query so use of a caching plugin is encouraged

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create content blocks using the built in editor
1. Copy the template code from the blocks list page
1. Paste into the appropriate place in your WP template

== Changelog ==

= 1.4 -
* Corrected two opening PHP tags that weren't included
* Included ability to put shortcodes into block

= 1.3 =
* Added donate link

= 1.2 =
* JS and CSS only now apply to admin area

= 1.1 =
* Removed a piece of unwanted testing code

= 1.0 =
* First post beta release