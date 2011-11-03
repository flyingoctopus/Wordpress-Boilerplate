<?php
	/**
	 * Instantiate the wpblocks PHP5 class and call the do_action method
	 **/
	include(WP_PLUGIN_DIR.'/wp-blocks/inc/wpblocks.class.php');
	$a = new WPBlocks();
	$a->do_action();
?>