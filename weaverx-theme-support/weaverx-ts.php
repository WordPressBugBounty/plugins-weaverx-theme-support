<?php
// File refactored: 2026-02-27 - weaverx-ts
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/*
Plugin Name: Weaver Xtreme Theme Support
Plugin URI: http://weavertheme.com/plugins
Description: Weaver Xtreme Theme Support - Includes Legacy Admin, plus useful shortcodes and widgets that match the theme..
Author: wpweaver
Author URI: http://weavertheme.com/about/
Version: 7.0
License: GPL V3
Requires PHP: 7.4
Requires at least: 6.6
Tested up to: 7.0
Stable tag: 7.0

Weaver Xtreme Theme Support

Copyright (C) 2014-2026 Bruce E. Wampler - weaver@weavertheme.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Allow plugin to try to start in this file, so this file is PHP 5.4 compatible.
*/


/* CORE FUNCTIONS
*/
$wvrx_ts_theme_dir = get_template_directory();

function wvrx_ts_alert(string $msg): void
{
	echo "<script> alert('" . esc_js($msg) . "'); </script>\n";
}
$wvrx_ts_php_version = phpversion();
$wvrx_ts_php_version_ok = true;

if (version_compare($wvrx_ts_php_version, '7.2', '<')) {
	$wvrx_ts_php_version_ok = false;
	wvrx_ts_alert('WARNING! Weaver Xtreme Theme Support requires PHP Version 7.2 or greater. Your version is ' . $wvrx_ts_php_version . '. The plugin will not be installed. The associated Weaver Xtreme Theme is also likely to crash now.');
}


if ($wvrx_ts_php_version_ok && (strpos($wvrx_ts_theme_dir, '/weaver-xtreme') !== false ||
	strpos($wvrx_ts_theme_dir, '/weaver-xtreme-5') !== false )) {        // only load if Weaver Xtreme is the theme

	define('WVRX_TS_VERSION', '7.0');
	define('WVRX_TS_PAGEBUILDERS', true);

	function wvrx_ts_installed(): bool
	{
		return true;
	}


	function wvrx_ts_plugins_url(string $file, string $ext): string
	{
		return plugins_url($file, __FILE__) . $ext;
	}

	function wvrx_ts_enqueue_scripts(): void
	{    // action definition

		if (function_exists('wvrx_ts_slider_header')) {
			wvrx_ts_slider_header();
		}

		// add plugin CSS here, too.

		// need new admin styling for Gutenberg

	}

	add_action('wp_enqueue_scripts', 'wvrx_ts_enqueue_scripts');

//require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-editor-style.php'); // Load the editor style generation

	require_once(dirname(__FILE__) . '/includes/wvrx-ts-runtime-lib.php'); // NOW - load the basic library
	require_once(dirname(__FILE__) . '/includes/wvrx-ts-widgets.php');        // widgets runtime library
	require_once(dirname(__FILE__) . '/includes/wvrx-ts-shortcodes.php'); // load the shortcode definitions

// load traditional Weaver Xtreme Options

	function wvrx_ts_weaver_xtreme_load_admin_action(): void
	{
		require_once(dirname(__FILE__) . '/admin/add-weaverx-sapi-options.php'); // NOW - load the traditional options admin
	}

	add_action('weaver_xtreme_load_admin', 'wvrx_ts_weaver_xtreme_load_admin_action');


// ======================================== subthemes ========================================
	add_action('weaverx_child_show_extrathemes', 'wvrx_ts_child_show_extrathemes_action');

	function wvrx_ts_child_show_extrathemes_action(): void
	{
// old code found in version before 2.0.4
	}

	add_action('weaverx_child_process_options', 'wvrx_ts_child_process_options');
	function wvrx_ts_child_process_options(): void
	{
// old code found in version before 2.0.4

		if (weaverx_submitted('toggle_shortcode_prefix')) {
			$val = get_option('wvrx_toggle_shortcode_prefix');
			if ($val) {
				delete_option('wvrx_toggle_shortcode_prefix');
				weaverx_save_msg(__("Weaver Xtreme Theme Support Shortcodes NOT prefixed with 'wvrx_'", 'weaverx-theme-support'));
			} else {
				update_option('wvrx_toggle_shortcode_prefix', 'wvrx_');
				weaverx_save_msg(__("Weaver Xtreme Theme Support Shortcodes now prefixed with 'wvrx_'", 'weaverx-theme-support'));
			}
			return;
		}

		if (weaverx_submitted('show_per_page_report')) {
			wvrx_ts_per_page_report();
		}
	}

// old code found in version before 2.0.4

	add_action('weaverx_child_saverestore', 'wvrx_ts_child_saverestore_action');
	function wvrx_ts_child_saverestore_action(): void
	{
	}

// --------------------------------------
	function wvrx_ts_per_page_report(): void
	{
		echo '<div style="border:1px solid black; padding:1em;background:#F8FFCC;width:70%;margin:1em auto 1em auto;">';
		echo "<h2>" . esc_html__('Show Pages and Posts with  Per Page / Per Post Settings', 'weaverx-theme-support') . "</h2>\n";
		echo "<h3>" . esc_html__('Posts','weaverx-theme-support') . "</h3>\n";
		wvrx_ts_scan_section('post');
		echo "<h3>" . esc_html__('Pages', 'weaverx-theme-support') . "</h3>\n";
		wvrx_ts_scan_section('page');
		echo "</div>\n";
	}

	function wvrx_ts_scan_section(string $what): void
	{
		// Use keys for lookup to optimize performance (O(1) vs O(N))
		$post_fields = [
			'_pp_category'                    => true,
			'_pp_tag'                         => true,
			'_pp_onepost'                     => true,
			'_pp_orderby'                     => true,
			'_pp_sort_order'                  => true,
			'_pp_author'                      => true,
			'_pp_posts_per_page'              => true,
			'_pp_primary-widget-area'         => true,
			'_pp_secondary-widget-area'       => true,
			'_pp_sidebar_width'               => true,
			'_pp_top-widget-area'             => true,
			'_pp_bottom-widget-area'          => true,
			'_pp_sitewide-top-widget-area'    => true,
			'_pp_sitewide-bottom-widget-area' => true,
			'_pp_post_type'                   => true,
			'_pp_hide_page_title'             => true,
			'_pp_hide_site_title'             => true,
			'_pp_hide_menus'                  => true,
			'_pp_hide_header_image'           => true,
			'_pp_hide_footer'                 => true,
			'_pp_hide_header'                 => true,
			'_pp_hide_sticky'                 => true,
			'_pp_force_post_full'             => true,
			'_pp_force_post_excerpt'          => true,
			'_pp_show_post_avatar'            => true,
			'_pp_bodyclass'                   => true,
			'_pp_fi_link'                     => true,
			'_pp_fi_location'                 => true,
			'_pp_post_fi_location'            => true,
			'_pp_post_styles'                 => true,
			'_pp_hide_top_post_meta'          => true,
			'_pp_hide_bottom_post_meta'       => true,
			'_pp_stay_on_page'                => true,
			'_pp_hide_on_menu'                => true,
			'_pp_show_featured_img'           => true,
			'_pp_hide_infotop'                => true,
			'_pp_hide_infobottom'             => true,
			'_pp_hide_visual_editor'          => true,
			'_pp_masonry_span2'               => true,
			'_show_post_bubble'               => true,
			'_pp_hide_post_title'             => true,
			'_pp_post_add_link'               => true,
			'_pp_hide_post_format_label'      => true,
			'_pp_page_layout'                 => true,
			'_pp_wvrx_pwp_type'               => true,
			'_pp_wvrx_pwp_cols'               => true,
			'_pp_post_filter'                 => true,
			'_pp_header-widget-area'          => true,
			'_pp_footer-widget-area'          => true,
			'_pp_hide_page_infobar'           => true,
			'_pp_hide_n_posts'                => true,
			'_pp_fullposts'                   => true,
			'_pp_pwp_masonry'                 => true,
			'_pp_pwp_compact'                 => true,
			'_pp_pwp_compact_posts'           => true,
			'_primary-widget-area'            => true,
			'_secondary-widget-area'          => true,
			'_header-widget-area'             => true,
			'_footer-widget-area'             => true,
			'_sitewide-top-widget-area'       => true,
			'_sitewide-bottom-widget-area'    => true,
			'_page-top-widget-area'           => true,
			'_page-bottom-widget-area'        => true,
			'_pp_full_browser_height'         => true,
			'_pp_page_cols'                   => true,
			// Plus options
			'_pp_bgcolor'                     => true,
			'_pp_color'                       => true,
			'_pp_bg_fullwidth'                => true,
			'_pp_lr_padding'                  => true,
			'_pp_tb_padding'                  => true,
			'_pp_margin'                      => true,
			'_pp_post_class'                  => true,
			'_pp_bgimg'                       => true,
			'_pp_mobile_bgimg'                => true,
			'_pp_parallax_height'             => true,
			'_pp_use_parallax'                => true,
			'_pp_parallax_not_wide'           => true,
			'_pp_footer_add_class'            => true,
			'_pp_container_add_class'         => true,
			'_pp_content_add_class'           => true,
			'_pp_post_add_class'              => true,
			'_pp_infobar_add_class'           => true,
			'_pp_wrapper_add_class'           => true,
			'_pp_header_add_class'            => true,
			'_pp_header_image_html_text'      => true,
			'_pp_alt_primary_menu'            => true,
			'_pp_alt_secondary_menu'          => true,
			'_pp_alt_mini_menu'               => true,
		];

		$args     = ['posts_per_page' => -1, 'post_type' => $what, 'post_status' => 'any'];
		$allposts = get_posts($args);

		if (empty($allposts)) {
			return;
		}

		echo "<ul>\n";

		foreach ($allposts as $post) {
			$id   = $post->ID;
			$meta = get_post_meta($id);

			if (empty($meta)) {
				continue;
			}

			foreach ($meta as $name => $val_array) {
				if (!isset($post_fields[$name])) {
					continue;
				}

				// Cache values for efficiency
				$type  = $post->post_type;
				$title = $post->post_title;
				$link  = get_permalink($id);
				$msg   = ($type === 'page') ? __('has Per Page settings.', 'weaverx-theme-support') : __('has Per Post settings.', 'weaverx-theme-support');

				echo sprintf(
					"<li><strong><em><a href=\"%s\" target=\"_blank\">%s</a></em></strong> %s</li>\n",
					esc_url($link),
					esc_html($title),
					esc_html($msg)
				);
				break;
			}
		}

		echo "</ul>\n";
		wp_reset_postdata();
	}

} // end only load if Weaver Xtreme installed

add_action('plugins_loaded', 'wvrx_check_jetpack');
function wvrx_check_jetpack(): void
{
	if (!is_admin()) {
		return;
	}

	if (!method_exists('Jetpack', 'is_module_active')) {
		return;
	}

	if (!Jetpack::is_module_active('minileven')) {
		return;
	}

	wvrx_ts_alert(__('**** IMPORTANT: The Jetpack Mobile theme is active. ****\nIt is NOT compatible with Weaver Xtreme, and will break the theme. Please deactivate it from the Jetpack control panel.\n\n**** This message will continue to be displayed until you deactivate the Jetpack Mobile Theme from the Jetpack settings panel. ****', 'weaverx-theme-support'));
}