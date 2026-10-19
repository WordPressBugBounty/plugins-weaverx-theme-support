<?php
// File refactored: 2026-02-27 - admin-saverestore4
if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Save/Restore
 *  __ added - 12/10/14
 * This will come after the Options form has been closed, and is used for non-SAPI options
 *
 */

function weaverx_ts_admin_saverestore4(): void
{
	$func_get = WEAVER_GET_OPTION;
	$saved    = $func_get(apply_filters('weaverx_options', 'weaverx_settings_backup'), []);

	$style_date = !empty($saved['style_date']) ? $saved['style_date'] : esc_html__('No saved settings', 'weaverx-theme-support' /*adm*/);
	$is_pre_v5  = version_compare(WEAVERX_VERSION, '4.9.0', '<');
	$v5_opt     = get_option('weaverx5_settings', false);
	?>

	<div class="atw-option-header" style="clear:both;">
		<?php esc_html_e('Save/Restore Theme Settings', 'weaverx-theme-support' /*adm*/); ?>
		<?php weaverx_help_link('help.html#SaveRestore', esc_html__('Help on Save/Restore Themes', 'weaverx-theme-support' /*adm*/)); ?>
	</div>
	<p>
		<?php esc_html_e('Note: if you have Weaver Xtreme Plus installed, then options marked with ★Plus will be included in saves and restores.', 'weaverx-theme-support' /*adm*/); ?>
	</p>
	<div class="atw-option-subheader">
		<?php esc_html_e('Save/Restore Current Theme Settings using WordPress Database', 'weaverx-theme-support' /*adm*/); ?>
	</div>
	<?php echo wp_kses_post(__('<p>This option allows you to save and restore all current theme settings using your host\'s WordPress database. Your options will be preserved across Weaver Xtreme theme upgrades, as well when you change to different themes. There is only one saved backup available. You can also download your setting to your computer with the options below.</p>
<p>Note: This save option saves <strong>all</strong> settings, including those marked with ♦.</p>', 'weaverx-theme-support' /*adm*/)); ?>
	
	<form name="save_mysave_form" method="post">
		<input class="button-primary" type="submit" name="save_mytheme"
			   value="<?php esc_attr_e('Save Current Theme Settings', 'weaverx-theme-support' /*adm*/); ?>"/>
		<strong><?php esc_html_e('Backup all current theme settings using the WordPress database.', 'weaverx-theme-support' /*adm*/); ?></strong>
		<?php weaverx_nonce_field('save_mytheme'); ?>
		<br/><br/>
		<input class="button-primary" type="submit" name="restore_mytheme"
			   value="<?php esc_attr_e('Restore Settings', 'weaverx-theme-support' /*adm*/); ?>"/>
		<strong><?php esc_html_e('Restore from saved settings.', 'weaverx-theme-support' /*adm*/); ?></strong>
		<em><?php esc_html_e('Last save date:', 'weaverx-theme-support' /*adm*/); ?> <?php echo esc_html($style_date); ?></em>
		<?php
		weaverx_nonce_field('restore_mytheme');

		// REMOVED Versoiion 7: deleted V5 settings - don't need, and harmless if don't...

		do_action('weaverxplus_admin', 'save_restore'); ?>
	</form>

	<?php
	weaverx_saverestore();      // download/upload to computer
	do_action('weaverx_child_saverestore');    // allow additional save/restore in child
	do_action('weaverx_child_update');
	?>
	
	<div class="atw-option-subheader"><?php esc_html_e('Reset Current Settings to Default', 'weaverx-theme-support' /*adm*/); ?></div>
	<br/>
	<form name="resetweaverx_form" method="post"
		  onSubmit="return confirm('<?php echo esc_js(__('Are you sure you want to reset all Weaver Xtreme settings? This will include the [Saved Current Settings using WordPress Database].', 'weaverx-theme-support' /*adm*/)); ?>');">
		<strong><?php esc_html_e('Click the Clear button to reset all Weaver Xtreme settings, including ♦, ★Plus, and Weaver Xtreme Plus shortcode settings, to the default values.', 'weaverx-theme-support' /*adm*/); ?></strong><br>
		<em style="color:red;"><?php esc_html_e('Warning: You will lose all current settings, including settings from "Save Settings using the WordPress Database".', 'weaverx-theme-support' /*adm*/); ?></em><br/>
		<?php esc_html_e('You should use the "Download Current Settings To Your Computer" option above to save a copy of your current settings before clearing! If you have Weaver Xtreme Plus installed, you should also save shortcode settings from the Xtreme Plus Save/Restore tab.', 'weaverx-theme-support' /*adm*/); ?>
		<br/>
		<input class="button-primary" type="submit" name="reset_weaverx"
			   value="<?php esc_attr_e('Clear All Weaver Xtreme Settings', 'weaverx-theme-support' /*adm*/); ?>"/>&nbsp;&nbsp;
		<?php
		esc_html_e('Note: after clearing, settings will be reset to the default subtheme. This is required by WordPress.org standards.', 'weaverx-theme-support');
		weaverx_nonce_field('reset_weaverx'); ?>
	</form> <!-- resetweaverx_form -->
	<br/>
	<hr/>

	<?php
}

function weaverx_process_options_admin_standard($processed)
{
	if (weaverx_submitted('weaverx_clear_messages')) {
		return true;
	}
	
	if (weaverx_submitted('reset_weaverx')) {
		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have the capability to do that.', 'weaverx-theme-support' /*adm*/));
		}
		// delete everything!
		weaverx_save_msg(__('All Weaver Xtreme settings have been reset to the defaults.', 'weaverx-theme-support'));
		delete_option(apply_filters('weaverx_options', WEAVER_SETTINGS_NAME));
		
		global $weaverx_opts_cache;
		$weaverx_opts_cache = false;    // clear the cache
		weaverx_init_opts('reset_weaverx');
		set_theme_mod('_options_level', 0);
		delete_option(apply_filters('weaverx_options', 'weaverx_settings_backup'));

		do_action('weaverxplus_admin', 'reset_weaverxplus');
		update_user_meta(get_current_user_id(), 'tgmpa_dismissed_notice', 0);     // reset the dismiss on the plugin loader

		return true;
	}

	if (weaverx_submitted('uploadtheme') && function_exists('weaverx_loadtheme')) {
		weaverx_loadtheme();
		return true;
	}

	return $processed;
}

function weaverx_saverestore(): void
{
	/* admin tab for saving and restoring theme */
	$download_path     = esc_url(weaverx_relative_url('includes/download.php'));
	$download_img_path = esc_url(weaverx_relative_url('assets/images/download.png'));
	$nonce             = wp_create_nonce('weaverx_download');
	$plus_installed    = function_exists('weaverxplus_plugin_installed');
	$a_pro             = $plus_installed ? '-plus' : '';
	$file_access_ok    = weaverx_ts_allow_file_read();

	$req_uri = '';
	if (isset($_SERVER['REQUEST_URI'])) {
		$req_uri = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
	}

	?>
	<h3 class="atw-option-subheader" style="color:blue;">
		<?php esc_html_e('Save/Restore Current Theme Settings using Your Computer', 'weaverx-theme-support' /*adm*/); ?>
	</h3>
	<p>
		<?php esc_html_e('This option allows you to save and restore all current theme settings by uploading and downloading to your own computer.', 'weaverx-theme-support' /*adm*/); ?>
	</p>


    <h3><?php esc_html_e('Download Current Settings To Your Computer', 'weaverx-theme-support' /*adm*/); ?></h3>

    <?php
    $dp = $download_path . '?_wpnonce=' . $nonce;
    ?>

    <a href="<?php echo wp_kses_post($dp) ?>"><img
                src="<?php echo esc_url($download_img_path); ?>" alt='download'/>
        &nbsp; <strong><?php esc_html_e('Download', 'weaverx-theme-support' /*adm*/); ?></strong>&nbsp;</a> -

    <?php echo wp_kses_post(__('<strong>Save all</strong> current settings to file on your computer.
(Full settings backup, including those marked with &diams;.) <em>File:</em>', 'weaverx-theme-support' /*adm*/)); ?>
    <strong>weaverx-backup-settings<?php echo esc_url($a_pro); ?>.wxb</strong>
    <br/>
    <br/>
    <a href="<?php echo esc_url($download_path) . '?_wpnoncet=' . esc_html($nonce); ?>"><img
                src="<?php echo esc_url($download_img_path); ?>" alt='download'/>
        &nbsp;<strong><?php esc_html_e('Download', 'weaverx-theme-support' /*adm*/); ?></strong></a>&nbsp; -
	<?php echo wp_kses_post(__('<strong><em>Save only theme related</em></strong> current settings to file on your computer. <em>File:</em>', 'weaverx-theme-support' /*adm*/)); ?>
	<strong>weaverx-theme-settings<?php echo esc_html($a_pro); ?>.wxt</strong>

	<?php if ($plus_installed) : ?>
		<p>
			<?php echo wp_kses_post(__('Note: Downloaded settings include <em>Weaver Xtreme Plus</em> settings. Setting files from Weaver Xtreme Plus can be uploaded to the Free Weaver Xtreme version, but will not be used or saved by the free version. If you get error messages while downloading or uploading (a very rare host related issue), try the Customizer save/restore options instead.', 'weaverx-theme-support' /*adm*/)); ?>
		</p>
	<?php endif; ?>

	<form enctype="multipart/form-data" action="<?php echo esc_url($req_uri); ?>" method="POST">
		<table>
			<tr>
				<td colspan="2">
					<h3><?php esc_html_e('Upload settings from file saved on your computer', 'weaverx-theme-support' /*adm*/); ?></h3>
				</td>
			</tr>
			<?php if ($file_access_ok) : ?>
				<tr>
					<td>
						<?php esc_html_e('Select theme/backup file to upload:', 'weaverx-theme-support' /*adm*/); ?>
						<span style="border:1px solid black;padding:2px;"><input name="uploaded" type="file"/></span>
						<input type="hidden" name="uploadit" value="yes"/>&nbsp;<?php esc_html_e('(Restores settings in file to current settings.)', 'weaverx-theme-support' /*adm*/); ?>
					</td>
				</tr>
				<tr>
					<td>
						<span class='submit'>
							<input class="button-primary" name="uploadtheme" type="submit" value="<?php esc_attr_e('Upload theme/backup', 'weaverx-theme-support' /*adm*/); ?>"/>
						</span>
						&nbsp;<small><?php echo wp_kses_post(__('<strong>Upload and Restore</strong> a theme/backup from file on your computer. Will become current settings.', 'weaverx-theme-support' /*adm*/)); ?></small>
					</td>
				</tr>
				<?php if (!$plus_installed) : ?>
					<tr>
						<td>
							<small><?php echo wp_kses_post(__('Note: Any Weaver Xtreme Plus settings will <em>not</em> be restored for Weaver Xtreme Free version.', 'weaverx-theme-support' /*adm*/)); ?></small>
						</td>
					</tr>
				<?php endif; ?>
			<?php else : ?>
				<tr>
					<td>
						<span style="font-weight: bold; color:red;"><?php esc_html_e('File Upload Access Restriction:', 'weaverx-theme-support' /*adm*/); ?></span>
						<?php esc_html_e('Sorry, you must be a Multi-Site Super Admin or have the install_plugins capability set for your account by a Super Admin to read settings files.', 'weaverx-theme-support' /*adm*/); ?>
					</td>
				</tr>
			<?php endif; ?>
		</table>
		<?php weaverx_nonce_field('uploadtheme'); ?>
	</form>

	<h3 class="atw-option-header" style="color:blue;">
		<?php esc_html_e('Save/Restore Current Settings in files on your site\'s host file system. (★Plus)', 'weaverx-theme-support' /*adm*/); ?>
	</h3>
	<p>
		<?php esc_html_e('This option allows you to save and restore current subtheme settings on the file system of your site\'s host.', 'weaverx-theme-support' /*adm*/); ?><br/>
		<?php esc_html_e('This option is NOT available in the Customizer interface.', 'weaverx-theme-support' /*adm*/); ?>
	</p>
	<p>
	<?php
	if (!$file_access_ok) {
		echo '<span style="font-weight: bold; color:red;">' . esc_html__('File Access Restriction for Weaver Xtreme Plus:', 'weaverx-theme-support' /*adm*/) . ' </span>';
		esc_html_e('Sorry, you must be a Multi-Site Super Admin or have the install_plugins capability set for your account by a Super Admin. (e.g., with the User Role Editor plugin.) to access Plus Save/Restore options.', 'weaverx-theme-support' /*adm*/);
	} else {
		if (!$plus_installed || !version_compare(WEAVER_XPLUS_VERSION, '3.1', '>=')) {
			echo '<strong>' . esc_html__('This option requires that you have installed Weaver Xtreme Plus version greater or equal to 3.1', 'weaverx-theme-support') . '</strong>';
		} else {
			do_action('weaverxplus_admin', 'save_restore_files');
		}
	}
	echo '</p>';
}