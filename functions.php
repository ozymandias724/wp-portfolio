<?php

/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if (! function_exists('wp_starter_post_format_setup')) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_post_format_setup()
	{
		add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
	}
endif;
add_action('after_setup_theme', 'wp_starter_post_format_setup');

// Enqueues editor-style.css in the editors.
if (! function_exists('wp_starter_editor_style')) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_editor_style()
	{
		add_editor_style('assets/css/editor-style.css');
	}
endif;
add_action('after_setup_theme', 'wp_starter_editor_style');

// Enqueues the theme stylesheet on the front.
if (! function_exists('wp_starter_enqueue_styles')) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_enqueue_styles()
	{
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'wp-starter-style',
			get_parent_theme_file_uri($src),
			array(),
			wp_get_theme()->get('Version')
		);
		wp_style_add_data(
			'wp-starter-style',
			'path',
			get_parent_theme_file_path($src)
		);
	}
endif;
add_action('wp_enqueue_scripts', 'wp_starter_enqueue_styles');

// Registers custom block styles.
if (! function_exists('wp_starter_block_styles')) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_block_styles()
	{
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __('Checkmark', 'wp-starter'),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action('init', 'wp_starter_block_styles');

// Registers pattern categories.
if (! function_exists('wp_starter_pattern_categories')) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_pattern_categories()
	{

		register_block_pattern_category(
			'wp_starter_page',
			array(
				'label'       => __('Pages', 'wp-starter'),
				'description' => __('A collection of full page layouts.', 'wp-starter'),
			)
		);

		register_block_pattern_category(
			'wp_starter_post-format',
			array(
				'label'       => __('Post formats', 'wp-starter'),
				'description' => __('A collection of post format patterns.', 'wp-starter'),
			)
		);
	}
endif;
add_action('init', 'wp_starter_pattern_categories');

// Registers block binding sources.
if (! function_exists('wp_starter_register_block_bindings')) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function wp_starter_register_block_bindings()
	{
		register_block_bindings_source(
			'wp-starter/format',
			array(
				'label'              => _x('Post format name', 'Label for the block binding placeholder in the editor', 'wp-starter'),
				'get_value_callback' => 'wp_starter_format_binding',
			)
		);
	}
endif;
add_action('init', 'wp_starter_register_block_bindings');

// Registers block binding callback function for the post format name.
if (! function_exists('wp_starter_format_binding')) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function wp_starter_format_binding()
	{
		$post_format_slug = get_post_format();

		if ($post_format_slug && 'standard' !== $post_format_slug) {
			return get_post_format_string($post_format_slug);
		}
	}
endif;


function wpstarter_assets()
{

	wp_enqueue_style(
		'wp-starter',
		get_template_directory_uri() . '/dist/css/main.css',
		[],
		filemtime(
			get_template_directory() . '/dist/css/main.css'
		)
	);

	wp_enqueue_script(
		'wp-starter',
		get_template_directory_uri() . '/dist/js/main.js',
		[],
		filemtime(
			get_template_directory() . '/dist/js/main.js'
		),
		true
	);
}
add_action('wp_enqueue_scripts', 'wpstarter_assets');
