<?php
/**
 * WordPress Network Administration Bootstrap
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

define( 'WP_NETWORK_ADMIN', TRUE );

/** Load WordPress Administration Bootstrap */
require_once( dirname( dirname( __FILE__ ) ) . '/admin.php' );

if ( ! is_multisite() )
	wp_die( __( 'Multisite support is not enabled.' ) );

if ( ! is_main_site() ) {
	wp_redirect( network_admin_url() );
	exit;
}
?>
