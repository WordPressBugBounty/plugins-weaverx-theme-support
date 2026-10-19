<?php
// File refactored: 2026-02-27 - admin-subthemes4
if (!defined('ABSPATH')) {
    exit;
}

// Weaver 4 legacy interface options
function weaverx_admin_subthemes4(): void
{
	weaverx_tab_title(__('Predefined Weaver Xtreme Subthemes', 'weaverx-theme-support'), 'help.html#PredefinedThemes', esc_html__('Help for Weaver Xtreme Predefined Themes', 'weaverx-theme-support' /*adm*/)); ?>
	<small style="font-weight:normal;font-size:10px;"><?php esc_html_e('You can click the ?\'s found throughout Weaver Xtreme admin pages for context specific help.', 'weaverx-theme-support' /*adm*/); ?></small>

	<?php echo wp_kses_post('<h3>' . __('Welcome to Weaver Xtreme', 'weaverx-theme-support') . '</h3>'); ?>

	<?php echo wp_kses_post('<p>' . __('Weaver Xtreme gives you extreme control of your WordPress blog appearance using the
different admin tabs here. This tab lets you get a quick start by picking one of the many
predefined subthemes. Once you\'ve picked a starter theme, use the *Main Options* and *Advanced Options*
tabs to tweak the theme to be whatever you like. After you have a theme you\'re happy with,
you can save it from the Save/Restore tab. The *Help* tab has much more useful information.', 'weaverx-theme-support' /*adm*/) . '</p>'); ?>

	<h3 class="atw-option-subheader"><span style="color:black;padding:.2em;"
										   class="dashicons dashicons-images-alt2"></span>
		<?php esc_html_e('Get started by trying one of the predefined subthemes!', 'weaverx-theme-support' /*adm*/); ?>
	</h3>
	<?php
	$theme_dir  = trailingslashit(WP_CONTENT_DIR) . 'themes/' . get_template() . '/subthemes/';
	$theme_list = [];

	if (is_dir($theme_dir) && ($media_dir = opendir($theme_dir))) {        // build the list of themes from directory
		while (false !== ($m_file = readdir($media_dir))) {
			$len = strlen($m_file);
			if ($len <= 4) {
				continue;
			}
			$base = substr($m_file, 0, $len - 4);
			$ext  = substr($m_file, $len - 4, 4);
			if ($ext === '.wxt' || $ext === '.wxb') {
				$theme_list[] = $base;
			}
		}
		closedir($media_dir);
	}

	if (!empty($theme_list)) {
		echo '<p style="font-size:120%;font-weight:bold;">';
		echo wp_kses_post(__('Please remember: these subthemes are only starting points!
You can use <em>Weaver Xtreme</em> options to change virtually any part of these subthemes.
You can change colors, sidebar layouts, font family and sizes, borders, spacing - really, everything.', 'weaverx-theme-support' /*adm*/));
		echo '</p>';
		weaverx_st_pick_theme($theme_list);    // show the theme picker
		return;
	}

	if (defined('WEAVERX_SETTINGS_VERSION') && WEAVERX_SETTINGS_VERSION === 'WvrX5:2.0') {
		echo wp_kses_post(__("<h3>IMPORTANT NOTE: Weaver Xtreme Version 5 only supports picking subthemes from the Customizer.</h3>\n", 'weaverx-theme-support' /*adm*/));
	} else {
		echo wp_kses_post(__("<h3>WARNING: Your version of Weaver Xtreme is likely installed incorrectly. Unable to find subtheme definitions.</h3>\n", 'weaverx-theme-support' /*adm*/));
	}
}

function weaverx_st_pick_theme($list_in): void
{
	// output the form to select a file list from weaverx-subthemes directory
	$list = $list_in;
	natcasesort($list);
	$cur_theme = weaverx_getopt('theme_filename') ?: WEAVERX_DEFAULT_THEME;
	$cur_addon = weaverx_getopt('addon_name');
	$hide_thumbs = weaverx_getopt('_hide_theme_thumbs');
	$confirm_msg = esc_js(__('Are you sure you want select a new theme?\r\n\r\nSelecting a new subtheme will overwrite your existing theme settings. You should save your existing settings on the Save/Restore menu if you have made changes.', 'weaverx-theme-support'));
	?>
	<form enctype="multipart/form-data" name='pick_theme' method='post'
		  onSubmit="return confirm('<?php echo esc_html($confirm_msg); ?>');">
		&nbsp;&nbsp;<strong><?php esc_html_e('Click a Radio Button below to select a subtheme:', 'weaverx-theme-support' /*adm*/); ?>
			&nbsp;</strong>
		<span style="padding-left:100px;"><?php esc_html_e('Current theme:', 'weaverx-theme-support' /*adm*/); ?> <strong>
<?php
if ($cur_addon === '') {
	echo esc_html(ucwords(str_replace('-', ' ', $cur_theme)));
} else {
	echo esc_html__('Add-on Subtheme: ', 'weaverx-theme-support') . esc_html(ucwords(str_replace('-', ' ', $cur_addon)));
	$cur_theme = '';
}
?>
	</strong></span>

		<br/><br/>
		<input class="button-primary" name="set_subtheme" type="submit"
			   value="<?php esc_attr_e('Set to Selected Subtheme', 'weaverx-theme-support'); ?>"/>

		<p style="color:#b00;font-weight:bold;font-size:120%">
			<br/><?php echo wp_kses_post(__('<em>Note:</em> Before switching to any subtheme, you must Save and download a copy of your settings using the Save / Restore page, in order to be able to go back to them if required.', 'weaverx-theme-support' /*adm*/)); ?>
		</p>
		<?php
		weaverx_nonce_field('set_subtheme');

		$thumbs_base = weaverx_relative_url('subthemes/');

		foreach ($list as $addon) {
			$name = ucwords(str_replace('-', ' ', $addon));
			$is_checked = checked($cur_theme, $addon, false);
			?>
			<div style="float:left; width:200px;">
				<label>
					<input type="radio" name="theme_picked" value="<?php echo esc_attr($addon); ?>" <?php echo esc_attr($is_checked); ?> />
					<strong><?php echo esc_html($name); ?></strong><br />
					<?php if (!$hide_thumbs) : ?>
						<img style="border: 1px solid gray; margin: 5px 0px 10px 0px;" src="<?php echo esc_url($thumbs_base . $addon . '.jpg'); ?>" width="150" height="113" alt="thumb" />
					<?php endif; ?>
				</label>
			</div>
			<?php
		}

		if (!$hide_thumbs) {
			weaverx_clear_both();
			?>
			<span class='submit' style='padding-top:6px;'>
				<input class="button-primary" name="set_subtheme" type="submit" value="<?php esc_attr_e('Set to Selected Subtheme', 'weaverx-theme-support' /*adm*/); ?>"/>
			</span>
			<?php
		}
		?>

	</form>
	<div style="clear:both;padding-top:6px;"></div>

	<form enctype="multipart/form-data" name='hide_thumbs_form' method='post'>
		<?php
		$hide_btn_text = $hide_thumbs ? esc_html__('Show Subtheme Thumbnails', 'weaverx-theme-support' /*adm*/) : esc_html__('Hide Subtheme Thumbnails', 'weaverx-theme-support' /*adm*/);
		?>
		<input class="button-primary" name="hide_thumbs" type="submit" value="<?php echo esc_attr($hide_btn_text); ?>"/>
		<?php weaverx_nonce_field('hide_thumbs'); ?>
	</form>
	<div style="clear:both;"></div>
	<hr/>
	<?php
	do_action('weaverx_child_show_extrathemes');
	do_action('weaverxplus_admin', 'show_subthemes');
}

function weaverx_confirm_select_theme(): void
{
	$confirm_js = esc_js(__('Are you sure you want select a new theme? This will overwrite you existing theme settings.', 'weaverx-theme-support'));
	?>
	<br/>
	<input class="button-primary" type="submit"
		   onSubmit="return confirm('<?php echo esc_attr($confirm_js); ?>');"
		   name="set_subtheme" value="<?php esc_attr_e('Set to Selected Subtheme', 'weaverx-theme-support' /*adm*/); ?>"/>
	<?php weaverx_nonce_field('set_subtheme');
}