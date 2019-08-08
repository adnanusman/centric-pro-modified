<?php
// Prefixing is recommended if you are not using a namespace.
// namespace TimJensen\GenesisStarter\Setup;
/**
 * Adds hooks immediately before and after Genesis structural wraps.
 *
 * @version 1.1.0
 *
 * @return void
 */
function add_hooks_outside_structural_wraps() {
	$structural_wraps = array(
		'header',
		'menu-primary',
		'menu-secondary',
		'site-inner',
		'footer-widgets',
		'footer'
	);
	foreach ( $structural_wraps as $context ) {
		/**
		 * Inserts an action hook before the opening div and after the closing div for the structural wraps.
		 *
		 * @param string $output          HTML markup for opening or closing the structural wrap.
		 * @param string $original_output Either 'open' or 'close'.
		 *
		 * @return string
		 */
		add_filter( "genesis_structural_wrap-{$context}", function ( $output, $original_output ) use ( $context ) {
			$position = ( 'open' === $original_output ) ? 'before' : 'after';
			ob_start();
			do_action( "{$position}_genesis_{$context}_wrap" );
			if ( 'open' === $original_output ) {
				return ob_get_clean() . $output;
			} else {
				return $output . ob_get_clean();
			}
		}, 10, 2 );
	}
}
add_hooks_outside_structural_wraps();