<?php
// File refactored: 2025-05-15 - advancedopts4
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Advanced Options
 *
 *  __ added: 12/9/14
 */

function weaverx_admin_advancedopts4(): void {
	$allow_multisite = weaverx_allow_multisite();
	$is_v5_plus      = version_compare( WEAVERX_VERSION, '4.9.0', '>=' );
	?>
	<div id="tabwrap_adv" style="padding-left:5px;">
		<div id="tab-container-adv" class='yetiisub'>
			<ul id="tab-container-adv-nav" class='yetiisub'>
				<?php
				if ( $allow_multisite ) {
					weaverx_elink( '#asptab0', esc_html__( 'Insert custom HTML, scripts, and CSS into &lt;HEAD&gt; section', 'weaverx-theme-support' ), esc_html__( '&lt;HEAD&gt; Section', 'weaverx-theme-support' ), '<li>', '</li>' );
					weaverx_elink( '#asptab1', esc_html__( 'Insert custom HTML into several different page areas', 'weaverx-theme-support' ), esc_html__( 'HTML Insertion', 'weaverx-theme-support' ), '<li>', '</li>' );
				}
				weaverx_elink( '#asptab3', esc_html__( 'Options related to this site: FavIcon, Home Page, more', 'weaverx-theme-support' ), esc_html__( 'Site Options', 'weaverx-theme-support' ), '<li>', '</li>' );

				if ( $is_v5_plus ) {
					weaverx_elink( '#asptabnew', esc_html__( 'New Weaver Xtreme V5 and later Options', 'weaverx-theme-support' ), esc_html__( 'New Options', 'weaverx-theme-support' ), '<li>', '</li>' );
				}
				weaverx_elink( '#asp_tab_admin', esc_html__( 'Basic Administrative Options', 'weaverx-theme-support' ), esc_html__( 'Admin Options', 'weaverx-theme-support' ), '<li>', '</li>' );
				?>
			</ul>
			<?php weaverx_tab_title( esc_html__( 'Advanced Options', 'weaverx-theme-support' ), 'help.html#AdvancedOptions', esc_html__( 'Help for Advanced Options', 'weaverx-theme-support' ) ); ?>

			<?php weaverx_sapi_submit( '', '<br /><br />' ); ?>

			<!-- ***************************************************** -->
			<?php if ( $allow_multisite ) : ?>
				<div id="asptab0" class="tab_adv">
					<?php weaverx_adv_head_section(); ?>
				</div> <!-- adtab 0 -->

				<!-- ***************************************************** -->

				<div id="asptab1" class="tab_adv">
					<?php weaverx_adv_html_insert(); ?>
				</div> <!-- asptab1 -->
			<?php endif; ?>

			<!-- ***************************************************** -->
			<div id="asptab3" class="tab_adv">
				<?php weaverx_adv_site_opts(); ?>
			</div> <!-- site options -->

			<!-- ***************************************************** -->
			<?php if ( $is_v5_plus ) : ?>
				<div id="asptabnew" class="tab_adv">
					<?php weaverx_adv_new_opts(); ?>
				</div> <!-- new options -->
			<?php endif; ?>

			<!-- ***************************************************** -->

			<div id="asp_tab_admin" class="tab_adv">
				<?php weaverx_admin_admin_ts(); ?>
			</div>

		</div> <!-- tab-container-adv -->

		<?php weaverx_sapi_submit(); ?>
	</div> <!-- #tabwrap_adv-->

	<script type="text/javascript">
		let tabberAdv = new Yetii({
			id: 'tab-container-adv',
			tabclass: 'tab_adv',
			persist: true
		});
	</script>
	<?php
}

function weaverx_adv_head_section(): void {
	$allow_multisite = weaverx_allow_multisite();
	?>
	<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-screenoptions"></span>
		<?php esc_html_e( 'The Site &lt;HEAD&gt; Section', 'weaverx-theme-support' ); ?>
		<?php weaverx_help_link( 'help.html#HeadSection', esc_html__( 'Help for site HEAD section', 'weaverx-theme-support' ) ); ?>
	</div><br/>
	<p>
		<?php esc_html_e( 'This tab allows you to add HTML to the &lt;HEAD&gt; Section of every page on your site.', 'weaverx-theme-support' ); ?>
	</p>
	<?php if ( $allow_multisite ) : ?>
		<p><small>
				<?php esc_html_e( 'PLEASE NOTE: Only minimal validation is made on the field values, so be careful not to use invalid code. Invalid code is usually harmless, but it can make your site display incorrectly. If your site looks broken after make changes here, please double check that what you entered uses valid HTML or CSS rules.', 'weaverx-theme-support' ); ?>
			</small></p>

		<!-- ======== -->

		<br/><br/>
		<a id="headsection"></a>
		<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-screenoptions"></span>
			<?php esc_html_e( '&lt;HEAD&gt; Section', 'weaverx-theme-support' ); ?></div>
		<br/>
		<p>
			<?php echo wp_kses_post( __( 'This input area allows you to enter allowed HTML head elements to the &lt;head&gt; section, including &lt;title&gt;, &lt;base&gt;, &lt;link&gt;, &lt;meta&gt;, and &lt;style&gt;.
Code entered into this box is included right before the &lt;/head&gt; HTML tag on each page of your site.
This code may <strong>not</strong> include <em>&lt;script&gt;s</em> unless you\'ve installed the Weaver Xtreme Theme Support plugin.
We recommend using dedicated WordPress plugins to add things like ad tracking, SEO tags, Facebook code, and so on.
<small>Note: You can add CSS Rules using the "Custom CSS Rules" option on the Main Options tab.', 'weaverx-theme-support' ) ) . '</small>'; ?>
		</p>
		<p>
			<?php esc_html_e( 'For even greater control of how your site looks, you can add code the the &lt;HEAD&gt; section on a per page basis using the per page options from the page editor.', 'weaverx-theme-support' ); ?>
		</p>
		<?php weaverx_textarea( weaverx_getopt( 'head_opts' ), 'head_opts', 2, '<!-- HTML code -->', 'width:95%;', 'wvrx-edit' ); ?>
		<br>
		<small><?php echo wp_kses_post( __( 'Weaver Xtreme will <em>always</em> load the jQuery Library.', 'weaverx-theme-support' ) ); ?></small>
		<!-- ===================================================== -->
		<br/><br/>

		<a id="headsection_alt"></a>
		<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-screenoptions"></span>
			<?php esc_html_e( '&lt;HEAD&gt; Section (Advanced Alternative - &diams;)', 'weaverx-theme-support' ); ?></div>

		<p><small>
				<?php esc_html_e( 'Same as normal &lt;HEAD&gt; box above, but works like other &diams; options - it survives changing the subtheme from the Weaver Xtreme Subthemes tab, and is saved only on a full backup Save. This option is not commonly used, and is intended for more advanced Weaver Xtreme users.', 'weaverx-theme-support' ); ?>
			</small></p>
		<?php weaverx_textarea( weaverx_getopt( '_althead_opts' ), '_althead_opts', 2, '<!-- HTML code -->', 'width:95%;', 'wvrx-edit' ); ?>
		<?php
		do_action( 'weaverxplus_admin', 'head_section' );
	endif;
}

function weaverx_adv_html_insert(): void {
	?>
	<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-editor-code"></span>
		<?php esc_html_e( 'HTML Insertion', 'weaverx-theme-support' ); ?>
		<?php weaverx_help_link( 'help.html#HTMLInsertion', 'Help on HTML Code Insertion Areas' ); ?></div><br/>
	<p>
		<?php echo wp_kses_post( __( 'The <b>Advanced Options&rarr;HTML Insertion</b> tab allows you to insert custom HTML code in many places on your site. These fields allow you to add HTML code, special CSS rules, or even JavaScripts. You will need at least a bit of knowledge of HTML coding to use these fields most effectively.', 'weaverx-theme-support' ) ); ?>
	</p>
	<p><small>
			<?php esc_html_e( 'The values you put here are saved in the WordPress database, and will survive theme upgrades and other changes.', 'weaverx-theme-support' ); ?>
		</small></p>
	<p><small>
			<?php esc_html_e( 'PLEASE NOTE: Only minimal validation is made on the field values, so be careful not to use invalid code. Invalid code is usually harmless, but it can make your site display incorrectly. If your site looks broken after make changes here, please double check that you entered valid HTML or CSS rules.', 'weaverx-theme-support' ); ?>
		</small></p>
	<hr/>
	<?php
	$base_areas = [
		[
			'name' => esc_html__( 'Pre-Wrapper Code', 'weaverx-theme-support' ),
			'id'   => 'prewrapper',
			'info' => esc_html__( 'This code will be inserted just before the #wrapper and #branding divs, before any other site content.(Area ID: #inject_prewrapper)', 'weaverx-theme-support' ),
			'help' => '',
		],
		[
			'name' => esc_html__( 'Post-Footer', 'weaverx-theme-support' ),
			'id'   => 'postfooter',
			'info' => esc_html__( 'This code will be inserted just after the footer #colophon div, outside the #wrapper div.(Area ID: #inject_postfooter)', 'weaverx-theme-support' ),
			'help' => '',
		],
	];

	$areas = apply_filters( 'weaverxplus_html_inject', $base_areas );

	foreach ( $areas as $def ) {
		weaverx_add_html_field( $def['name'], $def['id'], $def['info'], $def['help'], '<span style="color:black; padding:.2em;" class="dashicons dashicons-editor-code"></span>' );
	}

	do_action( 'weaverxplus_admin', 'html_insertion' );
}

function weaverx_add_html_field( $title, $name, $info, $help = '', $icon = '' ): void {
	if ( $name === 'submit' ) {
		weaverx_sapi_submit( '', "<br /><br />\n" );
		return;
	}

	if ( ! $info ) {
		return;
	}

	if ( $name[0] === '+' ) {
		$name = substr( $name, 1 );
	}

	$area_name    = $name . '_insert';
	$hide_front   = 'hide_front_' . $name;
	$hide_rest    = 'hide_rest_' . $name;
	$style_id     = 'inject_' . $name;
	$add_class_id = 'inject_add_class_' . $name;

	$val = [
		'name' => $title . esc_html__( ' BG', 'weaverx-theme-support' ),
		'id'   => $style_id . '_bgcolor',
		'info' => '<span style="margin-top:6px;" class="i-left-bg dashicons dashicons-admin-appearance"></span>' .
				'<strong style="font-size:larger;">' . esc_html__( 'BG Color for area. (Add custom CSS using the CSS+ option.)', 'weaverx-theme-support' ) . '</strong>',
		'help' => '',
	];

	$classes = [
		'name' => '<span class="i-left">{ }</span> <small>' . esc_html__( 'Add Classes', 'weaverx-theme-support' ) . '</small>',
		'id'   => $add_class_id,
		'type' => '+widetext',
		'info' => wp_kses_post( __( 'Space separated class names to add to this area (<em>Advanced option</em>) (&#9733;Plus)', 'weaverx-theme-support' ) ),
	];
	?>
	<div class="atw-option-subheader"><?php echo wp_kses_post( $icon ); ?><span style="color:blue;"><b><?php echo wp_kses_post( $title ); ?></b></span>
	</div><br />
	<?php echo wp_kses_post( $info ); ?>
	<br/>
	<?php weaverx_textarea( weaverx_getopt( $area_name ), $area_name, 3, esc_html__( 'Any HTML, including shortcodes.', 'weaverx-theme-support' ) ); ?>

	<br/>
	<?php
	echo '<table style="width:90%;">';
	weaverx_form_ctext( $val, true );
	weaverx_form_text( $classes );
	echo '</table>';

	$is_front_hidden = weaverx_getopt_checked( $hide_front );
	$is_rest_hidden  = weaverx_getopt_checked( $hide_rest );
	?>
	<label><span class="dashicons dashicons-visibility"></span>
		<?php esc_html_e( 'Hide on front page:', 'weaverx-theme-support' ); ?>
		<input type="checkbox" name="<?php weaverx_sapi_main_name( $hide_front ); ?>" id="<?php echo esc_attr( $hide_front ); ?>" <?php checked( $is_front_hidden ); ?> />
	</label>
	<small><?php esc_html_e( 'If you check this box, then the code from this area will not be displayed on the front (home) page.', 'weaverx-theme-support' ); ?></small>
	<br/>
	<label><span class="dashicons dashicons-visibility"></span>
		<?php esc_html_e( 'Hide on non-front pages:', 'weaverx-theme-support' ); ?>
		<input type="checkbox" name="<?php weaverx_sapi_main_name( $hide_rest ); ?>" id="<?php echo esc_attr( $hide_rest ); ?>" <?php checked( $is_rest_hidden ); ?> />
	</label>
	<small><?php esc_html_e( 'If you check this box, then the code from this area will not be displayed on non-front pages.', 'weaverx-theme-support' ); ?></small>
	<br/><br/>
	<?php
}

function weaverx_adv_site_opts(): void {
	$no_schema      = weaverx_getopt_checked( '_no_schemea' );
	$print_widgets  = weaverx_getopt_checked( '_print_show_widgets' );
	$favicon_url    = weaverx_getopt( '_favicon_url' );
	$sitemap_excl   = weaverx_getopt( '_sitemap_exclude_pages' );
	?>
	<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-generic"></span>
		<?php esc_html_e( 'Site Options', 'weaverx-theme-support' ); ?>
		<?php weaverx_help_link( 'help.html#AdvSiteOptions', esc_html__( 'Help on Advanced Site Options', 'weaverx-theme-support' ) ); ?>
	</div><br/>
	<?php esc_html_e( 'These options are available to fine tune various aspects of your site. Technically, these features are not part of the theme styling, but cover other aspects of site functionality.', 'weaverx-theme-support' ); ?>
	<br/>
	<hr/>
	<!-- ======== -->

	<h3><?php esc_html_e( 'Disable Schema.org Structured Data', 'weaverx-theme-support' ); ?></h3>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_no_schemea' ); ?>" id="_no_schemea" <?php checked( $no_schema ); ?> />
		<?php esc_html_e( 'Disable adding Schema.org structured data. (We do not recommend removing this SEO feature.) &diams;', 'weaverx-theme-support' ); ?>
	</label><br/><br/>

	<h3><?php esc_html_e( 'Include Widget Areas in Print', 'weaverx-theme-support' ); ?></h3>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_print_show_widgets' ); ?>" id="_print_show_widgets" <?php checked( $print_widgets ); ?> />
		<?php esc_html_e( 'Include all widget areas and full Footer content on browser Print page operation. &diams;', 'weaverx-theme-support' ); ?>
	</label><br/><br/>

	<br/>
	<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-format-image"></span><span style="color:blue;font-size:larger;">
	<b><?php esc_html_e( 'FavIcon', 'weaverx-theme-support' ); ?></b></span></div><br />
	<p>
		<?php echo wp_kses_post( __( 'You can add a FavIcon to your site with this option. The preferred FavIcon is in the <code>.ico</code> format which has the most universal browser compatibility. However, <code>.png, .gif, and .jpg</code> will work for most modern browsers. The standard sizes are 16x16, 32x32, or 48x48 px. You can alternatively load a <code>favicon.ico</code> file to the root directory of your site. &diams;', 'weaverx-theme-support' ) ); ?>
	</p>
	<p>
		<?php
		if ( $favicon_url !== '' ) {
			echo '<img src="' . esc_url( $favicon_url ) . '" alt="favicon" />&nbsp;';
		}
		?>
		<strong><?php esc_html_e( 'FavIcon URL:', 'weaverx-theme-support' ); ?> </strong>
		<?php weaverx_textarea( $favicon_url, '_favicon_url', 1, 'URL ', 'width:350px;' ); ?>
		<?php weaverx_media_lib_button( '_favicon_url' ); ?>
		&nbsp;&nbsp;<?php esc_html_e( 'Full path to FavIcon', 'weaverx-theme-support' ); ?>
	</p><br/>

	<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-page"></span><span style="color:blue;font-size:larger;">
	<b><?php esc_html_e( 'Exclude Pages from SiteMap', 'weaverx-theme-support' ); ?></b></span></div><br />
	<p>
		<?php echo wp_kses_post( __( 'You can specify a comma separated list of Page IDs to be excluded from the SiteMap Page list. To exclude pages from Search results, use a plugin such as "Search Exclude". You can hide different sections of the SiteMap by adding rules to the "Custom CSS Rules" box. To hide authors, for example, add the rule <code>#sitemap-authors{display:none;}</code>. The IDs for the SiteMap sections are: <code>#sitemap-pages, #sitemap-posts, #sitemap-categories, #sitemap-tags, #sitemap-authors</code>', 'weaverx-theme-support' ) ); ?>
	</p>
	<p>
		<strong><?php esc_html_e( 'Exclude Pages from SiteMap', 'weaverx-theme-support' ); ?>: </strong>
		<?php weaverx_textarea( $sitemap_excl, '_sitemap_exclude_pages', 1, '1,2,3', 'width:350px;' ); ?>
	</p><br/>


	<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-hammer"></span>
		<span style="color:blue;font-size:larger;">
		<b><?php esc_html_e( 'SEO - Search Engine Optimization', 'weaverx-theme-support' ); ?></b>
		</span></div><br/>
	<p>
		<?php echo wp_kses_post( __( 'The Weaver Xtreme Theme has been designed to follow the latest SEO guidelines. Each non-home page will use the recommended "Page Title | Site Title" format, and the site is formatted using the appropriate HTML5 tags for optimal SEO performance. An SEO plugin may help you optimize your site for SEO, but is not required. See the <em>Help</em> tab for recommended SEO plugins.', 'weaverx-theme-support' ) ); ?>
	</p><br/>

	<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-home"></span>
		<span style="color:blue;font-size:larger;">
			<b><?php esc_html_e( 'Home Page', 'weaverx-theme-support' ); ?></b>
		</span></div>
	<p>
		<?php esc_html_e( 'WordPress allows you to specify what page is used for your home page - either the standard WordPress blog, or a static page (which can be a Weaver Xtreme "Page with Posts" page). Please see the Weaver Xtreme Help topic for a more complete explanation.', 'weaverx-theme-support' ); ?>
	</p>
	<p>
		<?php echo wp_kses_post( __( 'You can set the front page on the Dashboard <em>Settings&rarr;Reading panel</em>:', 'weaverx-theme-support' ) ); ?>
		<a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>">
			<strong><?php esc_html_e( 'Set Front Page Displays', 'weaverx-theme-support' ); ?></strong></a></p><br/>

	<div class="atw-option-subheader"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-users"></span>
		<span style="color:blue;font-size:larger;">
			<b><?php esc_html_e( 'Author Avatars', 'weaverx-theme-support' ); ?></b>
		</span></div>
	<p>
		<?php esc_html_e( 'For the best look, your site should support Avatars - a small image associated with a contributors e-mail address. Gravatar.com is probably the most popular Avatar support, and is closely associated with WordPress. You should set up a Gravatar for the main authors of your blog. For contributors without any avatar, WordPress will automatically generate an avatar. See the <strong>Settings &rarr; Discussion</strong> admin page for avatar settings.', 'weaverx-theme-support' ); ?>
	</p>
	<hr/>
	<?php
	do_action( 'weaverxplus_admin', 'site_opts' );
	do_action( 'weaverx_child_siteoptions' );
}

if ( version_compare( WEAVERX_VERSION, '4.9.0', '>=' ) ) {
	function weaverx_adv_new_opts(): void {
		?>
		<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-generic"></span>
			<?php esc_html_e( 'New Version 5 and later Options', 'weaverx-theme-support' ); ?>
		</div><br/>
		<?php esc_html_e( 'This is a list of new options added to Weaver Xtreme Version 5 and later that are NOT supported by the Legacy interface. You will have to use the Customizer to use any of these options.', 'weaverx-theme-support' ); ?>
		<br/>
		<hr/>
		<!-- ======== -->
		<h3>
			<?php esc_html_e( 'Following new V5 and later options available only from the Customizer.', 'weaverx-theme-support' ); ?>
		</h3>
		<ul>
			<li><?php esc_html_e( 'Font settings for text transform, character spacing, and word spacing.', 'weaverx-theme-support' ); ?></li>
			<li><?php esc_html_e( 'Header and Footer Area replacement page/posts for Siteorigin and Elementor.', 'weaverx-theme-support' ); ?></li>
			<li><?php esc_html_e( 'Top and Bottom margins for Block Editor elements.', 'weaverx-theme-support' ); ?></li>
			<li><?php esc_html_e( 'Show Login link on top menu bar.', 'weaverx-theme-support' ); ?></li>
		</ul>
		<?php
		do_action( 'weaverxplus_admin', 'site_opts' );
		do_action( 'weaverx_child_siteoptions' );
	}
}

function weaverx_admin_admin_ts(): void {
	$disable_cust = weaverx_getopt_checked( '_disable_customizer' );
	$ignore_mem   = weaverx_getopt_checked( '_ignore_PHP_memory' );
	$hide_donate  = weaverx_getopt_checked( '_hide_donate' );
	$hide_ed_st   = weaverx_getopt_checked( '_hide_editor_style' );
	$hide_ed_font = weaverx_getopt_checked( '_hide_editor_font_selection' );
	$hide_auto    = weaverx_getopt_checked( '_hide_auto_css_rules' );
	$css_rows     = weaverx_getopt( '_css_rows' );

	$hide_mu_per     = weaverx_getopt_checked( '_hide_mu_admin_per' );
	$hide_ed_per     = weaverx_getopt_checked( '_hide_editor_per' );
	$hide_auth_per   = weaverx_getopt_checked( '_hide_author_per' );
	$show_post_all   = weaverx_getopt_checked( '_show_per_post_all' );

	$theme_name = weaverx_getopt( 'themename' );
	$theme_desc = weaverx_getopt( 'theme_description' );
	$theme_note = weaverx_getopt( 'subtheme_notes' );
	?>
	<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-generic"></span>
		<?php esc_html_e( 'Basic Administrative Options', 'weaverx-theme-support' ); ?>
		<?php weaverx_help_link( 'help.html#AdminOptions', 'Help for Admin Options' ); ?></div>

	<p>
		<?php esc_html_e( 'These options control some administrative options and appearance features.', 'weaverx-theme-support' ); ?>
	</p>

	<br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_disable_customizer' ); ?>" id="disable_customizer" <?php checked( $disable_cust ); ?> />
		<?php echo wp_kses_post( __( '<strong>Disable Weaver Xtreme Customizer Interface</strong> - If you have a slow host or slow computer, checking this option will disable loading the Weaver Xtreme Customizer interface. &diams;', 'weaverx-theme-support' ) ); ?>
	</label><br/><br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_ignore_PHP_memory' ); ?>" id="ignore_PHP_memory" <?php checked( $ignore_mem ); ?> />
		<?php echo wp_kses_post( __( '<strong>Ignore Customizer PHP Minimum Memory</strong> - If your host PHP memory is too low, it will cause an error message for using the Customizer. If your configuration still works properly with low PHP memory, check this option to disable the error messages. &diams;', 'weaverx-theme-support' ) ); ?>
	</label><br/><br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_donate' ); ?>" id="hide_donate" <?php checked( $hide_donate ); ?> />
		<?php echo wp_kses_post( __( 'I\'ve Donated - <small>Thank you for donating to the Weaver Xtreme theme. This will hide the Donate button. Purchasing Weaver Xtreme Plus also hides the Donate button.</small> &diams;', 'weaverx-theme-support' ) ); ?>
	</label><br/><br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_editor_style' ); ?>" id="_hide_editor_style" <?php checked( $hide_ed_st ); ?> />
		<?php echo wp_kses_post( __( 'Disable Page/Post Editor Styling - <small>Checking this box will disable the Weaver Xtreme subtheme based styling in the Page/Post editor. If you have a theme using transparent backgrounds, this option will likely improve the Post/Page editor visibility. &diams;</small>', 'weaverx-theme-support' ) ); ?>
	</label><br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_editor_font_selection' ); ?>" id="_hide_editor_font_selection" <?php checked( $hide_ed_font ); ?> />
		<?php echo wp_kses_post( __( 'Disable Page/Post Font Family/Size Selection - <small>Checking this box will disable the Weaver Xtreme Plus Font Family and Size options in the Page/Post editor. This option does not apply to the base Weaver Xtreme theme. &diams;</small>', 'weaverx-theme-support' ) ); ?>
	</label><br/>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_auto_css_rules' ); ?>" id="hide_auto_css_rules" <?php checked( $hide_auto ); ?> />
		<?php echo wp_kses_post( __( 'Don\'t auto-display CSS rules - <small>Checking this box will disable the auto-display of Main Option elements that have CSS settings.</small> &diams;', 'weaverx-theme-support' ) ); ?>
	</label><br/>

	<input name="<?php weaverx_sapi_main_name( '_css_rows' ); ?>" id="css_rows" type="text" style="width:40px;" class="regular-text" value="<?php weaverx_esc_textarea( $css_rows ); ?>"/>
	<?php echo wp_kses_post( __( 'lines - Set CSS+ text box height - <small>You can increase the default height of the CSS+ input area (1 to 25 lines).</small> &diams;', 'weaverx-theme-support' ) ); ?>
	<br/>
	<br/>
	<h3 class="atw-option-subheader"><?php esc_html_e( 'Per Page and Per Post Option Panels by Roles', 'weaverx-theme-support' ); ?></h3>
	<p>
		<?php esc_html_e( 'Single site Administrator and Multi-Site Super Administrator will always have the Per Page and Per Post options panel displayed. You may selectively disable these options for other User Roles using the check boxes below.', 'weaverx-theme-support' ); ?>
	</p>

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_mu_admin_per' ); ?>" id="_hide_mu_admin_per" <?php checked( $hide_mu_per ); ?> />
		<?php esc_html_e( 'Hide Per Page/Post Options for MultiSite Admins', 'weaverx-theme-support' ); ?></label> &diams;<br/>
	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_editor_per' ); ?>" id="_hide_editor_per" <?php checked( $hide_ed_per ); ?> />
		<?php esc_html_e( 'Hide Per Page/Post Options for Editors', 'weaverx-theme-support' ); ?></label> &diams;<br/>
	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_hide_author_per' ); ?>" id="_hide_author_per" <?php checked( $hide_auth_per ); ?> />
		<?php esc_html_e( 'Hide Per Page/Post Options for Authors and Contributors', 'weaverx-theme-support' ); ?></label> &diams;
	<br/>
	<br/>
	<label><input type="checkbox" name="<?php weaverx_sapi_main_name( '_show_per_post_all' ); ?>" id="_show_per_post_all" <?php checked( $show_post_all ); ?> />
		<?php echo wp_kses_post( __( 'Show Per Post Options for Custom Post Types &diams; - <small>Shows the Per Post options box on "Custom Post Type Editor" admin pages', 'weaverx-theme-support' ) ); ?></small>
	</label>
	<br/>
	<br/><br/>
	<div class="atw-option-subheader"><?php esc_html_e( 'Theme Name and Description', 'weaverx-theme-support' ); ?></div>
	<p>
		<?php esc_html_e( 'You can change the name and description of your current settings if you would like to create a new theme theme file for sharing with others, or for you own identification.', 'weaverx-theme-support' ); ?>
	</p>
	<?php esc_html_e( 'Theme Name:', 'weaverx-theme-support' ); ?> <input name="<?php weaverx_sapi_main_name( 'themename' ); ?>" id="themename" value="<?php echo esc_attr( $theme_name ); ?>"/>

	<?php
	if ( WEAVERX_DEV_MODE ) {
		$theme_file = weaverx_getopt( 'theme_filename' );
		esc_html_e( ' ------ Theme Base Filename (dev only):', 'weaverx-theme-support' );
		weaverx_textarea( $theme_file, 'theme_filename', 1, esc_html__( 'Root filename for theme save file', 'weaverx-theme-support' ), 'width:15%;' );
	}
	?>

	<br/>
	<?php esc_html_e( 'Description:', 'weaverx-theme-support' ); ?>&nbsp;&nbsp;&nbsp;
	<?php weaverx_textarea( $theme_desc, 'theme_description', 2, esc_html__( 'Describe the theme', 'weaverx-theme-support' ), 'width:65%;' ); ?>
	<br/>
	<br/>
	<h3 class="atw-option-subheader"><?php esc_html_e( 'Subtheme Notes', 'weaverx-theme-support' ); ?></h3>
	<p>
		<?php esc_html_e( 'This box may be used to keep notes and instructions about settings made for a custom subtheme. It will be saved in the both \'.wxt\' and \'.wxb\' settings files.', 'weaverx-theme-support' ); ?>
	</p>
	<?php
	weaverx_textarea( $theme_note, 'subtheme_notes', 2, esc_html__( 'Notes about theme', 'weaverx-theme-support' ), 'width:75%;' );

	do_action( 'weaverxplus_admin', 'admin_options' );
}