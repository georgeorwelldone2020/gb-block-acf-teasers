<?php
/*
Plugin Name: GfG | Gutenberg Teasers Block
Plugin URI: https://www.gfg-id.de/
Description: This Plugin registers a Gutenberg »Teasers« Block
Version: 1.0
Author: <a href="https://www.gfg-id.de/" title="GfG" tarbet="_blank">GfG / Gruppe für Gestaltung</a> | Dev Team
Author: https://www.gfg-id.de/
text-domain: sek-custom-theme-teaser-block
*/


// ---------------------------------------------------
// Security: If loaded correctly through WP and its right channels, else deny access
// ---------------------------------------------------

defined( 'ABSPATH' ) or die ( 'No authorized access!' );

// ---------------------------------------------------
// Enqueue scripts & styles (Backend & Frontend)
// ---------------------------------------------------

function teasersBlock_assets() {

	// Frontend loading
	if(!is_admin()) {
		wp_enqueue_style('teasers-block', plugin_dir_url( __FILE__ ) . 'assets/css/frontend/block.css' );
		wp_enqueue_script('teasers-block', plugin_dir_url( __FILE__ ) . 'assets/js/frontend/block.js', array(), '', true );
	}

	// Backend loading
	if(is_admin()) {
		wp_enqueue_style('teasers-block', plugin_dir_url( __FILE__ ) . 'assets/css/backend/block.css' );
		wp_enqueue_script('teasers-block', plugin_dir_url( __FILE__ ) . 'assets/js/backend/block.js', array(), '', true );
	}
}

// ---------------------------------------------------
// Register Gutenberg Block
// ---------------------------------------------------

add_action('acf/init', 'sek_acf_teasers_block_init');

function sek_acf_teasers_block_init() {

	// Check function exists.
	if( function_exists('acf_register_block_type') ) {

		// Register a teaser block.
		acf_register_block_type(array(
			'name'				=> 'teasers',
			'title'				=> __('Teasers Block'),
			'description'		=> __('A custom teasers block.'),
			/* 																								   Rendering without template
			'render_callback'	=> function() {
				echo '<h3>Sek teaser Block</h3>';
			},
			*/
			'render_template'	=> plugin_dir_path( __FILE__ ) . 'template-parts/teasers-block.php',	// Rendering with template
			'category'			=> 'formatting',
			'icon'				=> 'format-gallery',														// from »Dash Icons«
			'keywords'			=> array( 'teasers', 'quote', 'gfg' ),									// = Keywords for search results in Backend Block Search
			'enqueue_assets'	=> 'teasersBlock_assets',
		));
	}
}