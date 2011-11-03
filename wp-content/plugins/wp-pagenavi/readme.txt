=== WP-PageNavi ===
Contributors: GamerZ, scribu
Donate link: http://lesterchan.net/site/donation/
Tags: navigation, pagination, paging, pages
Requires at least: 2.8
Tested up to: 3.1
Stable tag: 2.74

Adds a more advanced paging navigation to your WordPress site.

== Description ==

[PHP5 is required since version 2.70](http://scribu.net/wordpress/wp-pagenavi/wp-2-70.html)

Adds a more advanced paging navigation to your WordPress site.

Example:

	Pages (17): [1] 2 3 4 » ... Last »


<br>
Links: [Demo](http://lesterchan.net/wordpress/) | [Plugin News](http://scribu.net/wordpress/wp-pagenavi/) | [Translating](http://scribu.net/wordpress/translating-plugins.html)

== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

1. Unzip the archive and put the `wp-pagenavi` folder into your plugins folder (/wp-content/plugins/).
1. Activate the plugin from the Plugins menu.

= Usage =

1. Open `wp-content/themes/your-theme-name/footer.php`
2. Add anywhere: `<?php wp_pagenavi(); ?>`
3. Go to *WP-Admin -> Settings -> PageNavi* to configure WP-PageNavi.

= Changing the CSS =

If you need to configure the CSS style of WP-PageNavi, you can copy the `pagenavi-css.css` file from the plugin directory to your theme's directory and make your modifications there. This way, you won't lose your changes when you update the plugin.

Alternatively, you can uncheck the "Use pagenavi.css?" option from the settings page and add the styles to your theme's style.css file directly.


== Screenshots ==

1. Default appearance
2. Options page

== Frequently Asked Questions ==

= Error on activation: "Parse error: syntax error, unexpected..." =

Make sure your host is running PHP 5. The only foolproof way to do this is to add this line to wp-config.php (after the opening `<?php` tag):

`var_dump(PHP_VERSION);`
<br>

= Doesn't work with query_posts() or custom query =

Read [this tutorial](http://scribu.net/wordpress/wp-pagenavi/wpn-2-74.html)

= How do I ignore the options page? =

If you are running a multi-language plugin, you will probably want to ignore the strings in the options page.

You can do that like so:

`<?php wp_pagenavi( array( 'options' => PageNavi_Core::$options->get_defaults() ) ); ?>`

== Changelog ==

= 2.74 (2011-02-17) =
* added 'smaller' and 'larger' classes
* added $query arg to wp_pagenavi()
* updated translations
* [more info](http://scribu.net/wordpress/wp-pagenavi/wpn-2-74.html)

= 2.73 (2010-08-17) =
* added $options arg to wp_pagenavi()
* updated scbFramework
* 3 new translations: AL, JA, BR

= 2.72 (2010-04-19) =
* fixed first link

= 2.71 (2010-04-18) =
* remove conflicting .left and .right from .extend elements
* bundle language files

= 2.70 (2010-04-11) =
* better default CSS
* fixed issue with slashed quotes in settings
* let WordPress handle uninstallation
* [more info](http://scribu.net/wordpress/wp-pagenavi/wp-2-70.html)

= 2.61 (2010-02-07) =
* fixed: memory limit error

= 2.60 (2010-02-07) =
* new: Compatible With WordPress 2.9
* new: Added "previouspostslink" and "nextpostslink" CSS classes for styling next/previous posts link by Joost de Valk
* new: Added option to include pagenavi-css.css In WP-Admin -> Settings -> PageNavi
* fixed: check for pagenavi-css.css in the child theme, first
* fixed: cleaner options page

= 2.50 (2009-06-01) =
* new: Compatible With WordPress 2.8
* new: Added Larger Page Number Pagination
* new: Added "first", "page" and "last" CSS Name To Link
* fixed: Removed "&#8201;" Entity
* fixed: Uses $_SERVER['PHP_SELF'] With plugin_basename(__FILE__) Instead Of Just $_SERVER['REQUEST_URI']

= 2.40 (2008-12-12) =
* new: Compatible With WordPress 2.7 Only
* new: Right To Left Language Support by Kambiz R. Khojasteh
* new: Called pagenavi_textdomain() In pagenavi_init() by Kambiz R. Khojasteh

= 2.31 (2008-07-16) =
* new: Compatible With WordPress 2.6

= 2.30 (2008-06-01) =
* new: WP-PageNavi Will Load 'pagenavi-css.css' Inside Your Theme Directory If It Exists. If Not, It Will Just Load The Default 'pagenavi-css.css' By WP-PageNavi
* new: Uses /wp-pagenavi/ Folder Instead Of /pagenavi/
* new: Uses wp-pagenavi.php Instead Of pagenavi.php
* new: Added "wp-pagenavi a:visited" Style In pagenavi-css.css
* new: Added $before And $after Function Arguments To wp_pagenavi();
* fixed: Rearranged CSS Classes In pagenavi-css.css
* fixed: "First" Text Does Not Always Appear If Page 1 Is Not Shown

= 2.20 (2007-10-01) =
* new: Supports query_posts(); Variables
* new: Ability To Uninstall WP-PageNavi

= 2.11 (2007-06-01) =
* new: Page Navigation Now Is Customizable Via 'WP-Admin -> Options -> PageNavi' And pagenavi-css.css
* new: Default Style Navigation Is Now Boxed Navigation (Similar To Digg.com) =
* fixed: Fix For Ultimate Tag Warrior By Oliver Kastler & Stephan (Netconcepts)

= 2.10 (2007-02-01) =
* new: Compatible With WordPress 2.1 Only
* new: Move pagenavi.php To pagenavi Folder

= 2.03 (2006-10-01) =
* fixed: Now Compatible With WordPress 2.1

= 2.02 (2006-06-01) =
* new: Added Drop Down Menu Style Of Page Navigation

= 2.01 (2006-03-01) =
* fixed: Paging Show If There Is Only 1 Page

= 2.00 (2006-01-01) =
* new: Compatible With WordPress 2.0
* fixed: Space Issues
