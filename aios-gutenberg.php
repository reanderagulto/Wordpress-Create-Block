<?php
/**
 * Plugin Name:       AIOS Gutenberg
 * Description:       Example static block scaffolded with Create Block tool.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           0.1.2
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       aios-gutenberg
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_aios_gutenberg_block_init() {

	/*
	* Register AIOS Block Pattern Category
	*/
	register_block_pattern_category(
		'agent-image',
		array( 'label' => __( 'Agent Image', 'aios-gutenberg' ) )
	);

	/*
	* Register AIOS Communities Block
	*/
	register_block_type( 
		__DIR__ . '/build/communities', array(
			'render_callback' 	=> 'render_communities_block'
		) 
	);

	/*
	* Register AIOS Listing Block
	*/
	register_block_type( 
		__DIR__ . '/build/listings', array(
			'render_callback' 	=> 'render_listing_block'
		)
	);

	/*
	* Register AIOS Listing Pattern
	*/
	register_block_pattern(
		'aios-gutenberg/aios-listings-template',
		array(
			'title'      => __( 'AIOS Gutenberg', 'aios-gutenberg' ),
			'blockTypes' => array( 'core/paragraph', 'core/heading', 'create-block/aios-listing-block' ),
			'content'    => '<!-- wp:group -->
							<div class="wp-block-group">
								<!-- wp:group -->
								<div class="wp-block-group">
									<!-- wp:heading {"fontSize":"large"} -->
									<h2 class="has-large-font-size">
										<span style="color:#ba0c49" class="has-inline-color">Hi everyone</span>
									</h2>
									<!-- /wp:heading -->
									<!-- wp:paragraph {"backgroundColor":"black","textColor":"white"} -->
									<p class="has-white-color has-black-background-color has-text-color has-background">
										Powered by WordPress
									</p>
									<!-- /wp:paragraph -->
								</div>
								<!-- /wp:group -->
							</div>
							<!-- /wp:group -->',
		)
	);


}
add_action( 'init', 'create_block_aios_gutenberg_block_init' );

/**
 * This function is called when the block is being rendered on the front end of the site
 *
 * @param array    $attributes     The array of attributes for this block.
 * @param string   $content        Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
 */
function render_listing_block( $attributes, $content, $block_instance ){
	ob_start();
	/**
	 * Keeping the markup to be returned in a separate file is sometimes better, especially if there is very complicated markup.
	 * All of passed parameters are still accessible in the file.
	 */
	if ( isset($attributes['selected_theme']) ) {
		switch($attributes['selected_theme']){
			case 'classic':
				require plugin_dir_path( __FILE__ ) . 'src/listings/templates/classic/index.php';
				break;
			case 'default':
				require plugin_dir_path( __FILE__ ) . 'src/listings/templates/default/index.php';
				break;
			default:
		}
	}
	return ob_get_clean();
}

/**
 * This function is called when the block is being rendered on the front end of the site
 *
 * @param array    $attributes     The array of attributes for this block.
 * @param string   $content        Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
 */
function render_communities_block( $attributes, $content, $block_instance ){
	ob_start();
	/**
	 * Keeping the markup to be returned in a separate file is sometimes better, especially if there is very complicated markup.
	 * All of passed parameters are still accessible in the file.
	 */
	if ( isset($attributes['selected_theme']) ) {
		switch($attributes['selected_theme']){
			case 'element':
				require plugin_dir_path( __FILE__ ) . 'src/communities/templates/element/index.php';
				break;
			case 'classic':
				require plugin_dir_path( __FILE__ ) . 'src/communities/templates/classic/index.php';
				break;
			case 'iconic':
				require plugin_dir_path( __FILE__ ) . 'src/communities/templates/iconic/index.php';
				break;
			case 'legacy':
				require plugin_dir_path( __FILE__ ) . 'src/communities/templates/legacy/index.php';
				break;
			case 'minimalist':
				require plugin_dir_path( __FILE__ ) . 'src/communities/templates/minimalist/index.php';
				break;
			default:
		}
	}
	return ob_get_clean();
}