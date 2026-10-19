<?php
// File refactored: 2026-02-27 - ts-shortcodes
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/*
 Weaver X shortcodes
*/

function wvrx_ts_setup_shortcodes(): void
{
	$codes = [
		// list of shortcodes
		'bloginfo'     => 'wvrx_ts_sc_bloginfo',      // [bloginfo]
		'box'          => 'wvrx_ts_sc_box',           // [box]
		'div'          => 'wvrx_ts_sc_div',           // [div]
		'header_image' => 'wvrx_ts_sc_header_image',  // [header_image]
		'hide_if'      => 'wvrx_ts_sc_hide_if',       // [hide_if]
		'html'         => 'wvrx_ts_sc_html',          // [html]
		'iframe'       => 'wvrx_ts_sc_iframe',        // [iframe]
		'login'        => 'wvrx_ts_sc_login',         // [login]
		'show_if'      => 'wvrx_ts_sc_show_if',       // [show_if]
		'span'         => 'wvrx_ts_sc_span',          // [span]
		'site_tagline' => 'wvrx_ts_sc_site_tagline',  // [site_tagline]
		'site_title'   => 'wvrx_ts_sc_site_title',    // [site_title]
		'tab_group'    => 'wvrx_ts_sc_tab_group',
		'tab'          => 'wvrx_ts_sc_tab',           // [tab_group], [tab]
		'vimeo'        => 'wvrx_ts_sc_vimeo',         // [vimeo]
		'youtube'      => 'wvrx_ts_sc_yt',            // [youtube]
		'ytube'        => 'wvrx_ts_sc_yt',            // [youtube]
		'weaverx_info' => 'wvrx_ts_weaverx_sc_info'   // [weaverx_info]
	];

	$prefix = (string) get_option('wvrx_toggle_shortcode_prefix');

	foreach ($codes as $code => $func) {
		$tag = $prefix . $code;
		remove_shortcode($tag);        // use our shortcode instead of someone elses.
		add_shortcode($tag, $func);
	}
}

// load our definitions of shortcodes later than probably most anyone else so that we user our versions.
add_action('init', 'wvrx_ts_setup_shortcodes', 99);


// ===============  [box] ===================
function wvrx_ts_sc_box($args = '', $text = ''): string
{
	$atts = shortcode_atts([
		'align'         => '',
		'border'        => true,
		'border_rule'   => '1px solid black',
		'border_radius' => '',
		'color'         => '',
		'background'    => '',
		'margin'        => '',
		'padding'       => '1',
		'shadow'        => '',
		'style'         => '',
		'width'         => '',
	], $args);

	$sty_parts = [];

	if ($atts['align']) {
		$align = strtolower($atts['align']);
		if ($align === 'center') {
			$sty_parts[] = 'display:block;margin-left:auto;margin-right:auto;';
		} elseif ($align === 'right') {
			$sty_parts[] = 'float:right;';
		} else {
			$sty_parts[] = 'float:left;';
		}
	}

	if ($atts['border']) {
		$sty_parts[] = 'border:' . esc_attr($atts['border_rule']) . ';';
	}
	if ($atts['border_radius']) {
		$sty_parts[] = 'border-radius:' . esc_attr($atts['border_radius']) . 'px;';
	}
	if ($atts['shadow']) {
		$shadow = max(1, min(5, (int) $atts['shadow']));
		$sty_parts[] = "box-shadow:0 0 4px {$shadow}px rgba(0,0,0,0.25);";
	}
	if ($atts['color']) {
		$sty_parts[] = 'color:' . esc_attr($atts['color']) . ';';
	}
	if ($atts['background']) {
		$sty_parts[] = 'background-color:' . esc_attr($atts['background']) . ';';
	}
	if ($atts['margin']) {
		$sty_parts[] = 'margin:' . esc_attr($atts['margin']) . 'em;';
	}
	if ($atts['padding']) {
		$sty_parts[] = 'padding:' . esc_attr($atts['padding']) . 'em;';
	}
	if ($atts['width']) {
		$sty_parts[] = 'width:' . esc_attr($atts['width']) . '%;';
	}
	if ($atts['style']) {
		$sty_parts[] = wp_kses_post($atts['style']);
	}

	$sty_string = !empty($sty_parts) ? ' style="' . implode('', $sty_parts) . '"' : '';

	return "<div$sty_string><!--[box]-->" . do_shortcode($text) . '</div><!--[box]-->';
}

// ===============  [hide_if] ===================
function wvrx_ts_sc_hide_if($args = '', $text = ''): string
{
	return wvrx_ts_show_hide_if($args, $text, false);
}

// ===============  [show_if] ===================
function wvrx_ts_sc_show_if($args = '', $text = ''): string
{
	return wvrx_ts_show_hide_if($args, $text, true);
}

// ===============  [show_hide_if] ===================
function wvrx_ts_show_hide_if($args = '', $text = '', bool $show = false): string
{
	$atts = shortcode_atts([
		'device'      => 'default',       // desktop, mobile, smalltablet, phone, all
		'logged_in'   => 'default',       // true or false
		'not_post_id' => 'default',     // comma separated list of post IDs (includes pages, too)
		'post_id'     => 'default',       // comma separated list
		'user_can'    => 'default'        // http://codex.wordpress.org/Function_Reference/current_user_can
	], $args);

	$device = strtolower(esc_attr($atts['device']));
	$valid_devices = ['default', 'desktop', 'mobile', 'smalltablet', 'phone', 'all'];

	if (!in_array($device, $valid_devices, true)) {
        // translators: %s is device name
		return '<br /><strong>' . sprintf(esc_html__('Error with [hide/show_if]: %s not valid for device parameter.', 'weaverx-theme-support'), esc_html($device)) . '</strong><br />';
	}

	$current_post_id = get_the_ID();
	$is_user_logged  = is_user_logged_in();

	// Logged in check
	$cond_logged = true;
	if ($atts['logged_in'] !== 'default') {
		$cond_logged = ($atts['logged_in'] === 'true' || $atts['logged_in'] === '1') ? $is_user_logged : !$is_user_logged;
	}

	// Not Post ID check
	$cond_not_id = true;
	if ($atts['not_post_id'] !== 'default') {
		$list        = explode(',', str_replace(' ', '', $atts['not_post_id']));
		$cond_not_id = !in_array((string) $current_post_id, $list, true);
	}

	// Post ID check
	$cond_id = true;
	if ($atts['post_id'] !== 'default') {
		$list    = explode(',', str_replace(' ', '', $atts['post_id']));
		$cond_id = in_array((string) $current_post_id, $list, true);
	}

	// User Can check
	$cond_can = true;
	if ($atts['user_can'] !== 'default') {
		$cond_can = current_user_can(strtolower($atts['user_can']));
	}

	$all_true = ($cond_logged && $cond_not_id && $cond_id && $cond_can);

	if (!$all_true) {
		return (!$show) ? do_shortcode($text) : '';
	}

	if ($device === 'default') {
		return ($show) ? do_shortcode($text) : '';
	}

	$class_prefix = ($show) ? 'show-' : 'hide-';
	$sc_class     = strtolower($class_prefix . $device);
	
	// Legacy global setting for [extra_menu] compatibility
	$GLOBALS['wvrx_sc_show_hide'] = $sc_class;
	$ret = '<div class="wvr-' . esc_attr($sc_class) . '">' . do_shortcode($text) . '</div>';
	unset($GLOBALS['wvrx_sc_show_hide']);

	return $ret;
}


// ===============  [header_image style='customstyle'] ===================
function wvrx_ts_sc_header_image($args = ''): string
{
	$atts = shortcode_atts([
		'style' => '',    // STYLE
		'h'     => '',
		'w'     => '',
	], $args);

	$hdr = get_header_image();
	if (!$hdr) {
		return '';
	}
	$hdr = str_replace(['http://', 'https://'], '//', $hdr);

	$theme_width = weaverx_getopt_default('theme_width_int', 1100);
	$custom_header_sizes = apply_filters('weaverx_custom_header_sizes', "(max-width: {$theme_width}px) 100vw, 1920px");

	$header_obj = get_custom_header();
	$width      = $atts['w'] ? esc_attr($atts['w']) : $header_obj->width;
	$height     = $atts['h'] ? esc_attr($atts['h']) : $header_obj->height;
	$st         = $atts['style'] ? ' style="' . esc_attr($atts['style']) . '"' : '';
	$sizes      = esc_attr($custom_header_sizes);
	$alt        = esc_attr(get_bloginfo('name', 'display'));

	if (stripos($hdr, '.gif') !== false) {
		$hdrimg = '<img src="' . esc_url($hdr) . '" width="' . $width . '" height="' . $height . '"' . $st . ' alt="' . $alt . '" />';
	} else {
		$hdrimg = '<img src="' . esc_url($hdr) . '" sizes="' . $sizes . '" width="' . $width . '" height="' . $height . '"' . $st . ' alt="' . $alt . '" />';
	}

	return wp_kses_post($hdrimg);
}

// ===============  [bloginfo arg='name'] ======================
function wvrx_ts_sc_bloginfo($args = ''): string
{
	$atts = shortcode_atts([
		'arg'   => 'name',        // a WP bloginfo name
		'style' => ''             // wrap with style
	], $args);

	$arg   = esc_attr($atts['arg']);
	$style = (string) $atts['style'];
	$info  = get_bloginfo($arg);

	if ($style !== '') {
		return wp_kses_post('<span style="' . esc_attr($style) . '">' . $info . '</span>');
	}

	return wp_kses_post($info);
}

// ===============  [site_title style='customstyle'] ======================
function wvrx_ts_sc_site_title($args = ''): string
{
	$atts = shortcode_atts([
		'style'      => '',        /* styling for the header */
		'matchtheme' => false,
	], $args);

	$title  = esc_html(get_bloginfo('name', 'display'));
	$before = '';
	$after  = '';

	if ($atts['matchtheme'] == 'true' || $atts['matchtheme'] == 1) {
		$before = '<h1' . weaverx_title_class('site_title', false, 'site-title') . '><a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($title) . '" rel="home">';
		$after  = '</a></h1>';
	}

	$content = $atts['style'] ? '<span style="' . esc_attr($atts['style']) . '">' . $title . '</span>' : $title;

	return wp_kses_post($before . $content . $after);
}

// ===============  [site_tagline style='customstyle'] ======================
function wvrx_ts_sc_site_tagline($args = ''): string
{
	$atts = shortcode_atts([
		'style'      => '',        /* styling for the header */
		'matchtheme' => false,
	], $args);

	$tagline = get_bloginfo('description');
	$before  = '';
	$after   = '';

	if ($atts['matchtheme'] == 'true' || $atts['matchtheme'] == 1) {
		$before = '<h2' . weaverx_title_class('tagline', false, 'site-tagline') . '>';
		$after  = '</h2>';
	}

	$content = $atts['style'] ? '<span style="' . esc_attr($atts['style']) . '">' . $tagline . '</span>' : $tagline;

	return wp_kses_post($before . $content . $after);
}

// ===============  [iframe src='address' height=nnn] ======================
function wvrx_ts_sc_iframe($args = ''): string
{
	$atts = shortcode_atts([
		'src'    => '',
		'height' => '300',
		'width'  => '400',
		'style'  => 'border:1px;',
	], $args);

	if (!$atts['src']) {
		return '<h4>' . esc_html__('No src address provided to [iframe]', 'weaverx-theme-support') . '</h4>';
	}

	$sty = $atts['style'] ? ' style="' . esc_attr($atts['style']) . '"' : '';

	return sprintf(
		"\n<iframe src=\"%s\" height=\"%s\" width=\"%s\" %s></iframe>\n",
		esc_url($atts['src']),
		esc_attr($atts['height']),
		esc_attr($atts['width']),
		wp_kses_post($sty)
	);
}

// ===============  [login] ======================
function wvrx_ts_sc_login($args = ''): string
{
	$atts = shortcode_atts([
		'style' => '',
	], $args);

	$style_attr = ($atts['style'] !== '') ? ' style="' . esc_attr($atts['style']) . '"' : '';
	return wp_kses_post('<span class="wvrx-loginout"' . $style_attr . '>' . wp_loginout('', false) . '</span>');
}

// ===============  [tab_group ] ======================
function wvrx_ts_sc_tab_group($args, $content): string
{
	$atts = shortcode_atts([
		'border_color'       => '',        // tab and pane border color - default #888
		'tab_bg'             => '',        // normal bg color of tab (default #CCC)
		'tab_selected_color' => '',        // color of tab when selected (default #EEE)
		'pane_min_height'    => '',        // min height of a pane to help make all even if needed
		'pane_bg'            => ''         // bg color of pane
	], $args);

	if (isset($GLOBALS['wvrx_ts_in_tab_container']) && $GLOBALS['wvrx_ts_in_tab_container']) {
		return '<strong>' . esc_html__('Sorry, you cannot nest tab_groups.', 'weaverx-theme-support') . '</strong>';
	}

	if (!isset($GLOBALS['wvrx_ts_tab_id'])) {
		$GLOBALS['wvrx_ts_tab_id'] = 1;
	} else {
		++$GLOBALS['wvrx_ts_tab_id'];
	}

	$group_id = 'wvr-tab-group-' . $GLOBALS['wvrx_ts_tab_id'];
	$css      = '';

	if ($atts['border_color'] !== '') {
		$b_col = esc_attr($atts['border_color']);
		$css  .= "#$group_id.wvr-tabs-style .wvr-tabs-pane,#$group_id.wvr-tabs-style .wvr-tabs-nav span {border-color:$b_col;}\n";
	}
	if ($atts['pane_min_height'] !== '') {
		$css .= "#$group_id.wvr-tabs-style .wvr-tabs-pane {min-height:" . esc_attr($atts['pane_min_height']) . ";}\n";
	}
	if ($atts['pane_bg'] !== '') {
		$css .= "#$group_id.wvr-tabs-style .wvr-tabs-pane {background-color:" . esc_attr($atts['pane_bg']) . ";}\n";
	}
	if ($atts['tab_bg'] !== '') {
		$css .= "#$group_id.wvr-tabs-style .wvr-tabs-nav span {background-color:" . esc_attr($atts['tab_bg']) . ";}\n";
	}
	if ($atts['tab_selected_color'] !== '') {
		$sel_col = esc_attr($atts['tab_selected_color']);
		$css    .= "#$group_id.wvr-tabs-style .wvr-tabs-nav span.wvr-tabs-current,#$group_id.wvr-tabs-style .wvr-tabs-nav span:hover {background-color:$sel_col;}\n";
	}

	$add_style = ($css !== '') ? "<style>\n" . $css . "</style>\n" : '';

	$GLOBALS['wvrx_ts_in_tab_container'] = true;
	$GLOBALS['wvrx_ts_num_tabs']         = 0;
	$GLOBALS['wvrx_ts_tabs']             = [];

	do_shortcode($content);    // process the tabs on this

	$out = '*** Unclosed or mismatched [tab_group] shortcodes ***';

	if (!empty($GLOBALS['wvrx_ts_tabs'])) {
		$tabs  = [];
		$panes = [];
		foreach ($GLOBALS['wvrx_ts_tabs'] as $idx => $tab) {
			$tabs[] = '<span>' . esc_html($tab['title']) . '</span>' . "\n";
			$state  = ($idx === 0) ? 'wvr-tabs-show' : 'wvr-tabs-hide';
			$panes[] = "\n" . '<div class="wvr-tabs-pane ' . $state . '">' . wvrx_ts_strip_pp($tab['content']) . '</div>';
		}
		
		$out = '<div id="' . esc_attr($group_id) . '" class="wvr-tabs wvr-tabs-style"> <!-- tab_group -->' . "\n"
			. '<div class="wvr-tabs-nav">' . "\n"
			. implode('', $tabs) . '</div>' . "\n"
			. '<div class="wvr-tabs-panes">'
			. implode('', $panes) . "\n"
			. '</div><div class="wvr-tabs-clear"></div>' . "\n"
			. '</div> <!-- end tab_group -->' . "\n";
	}

	unset($GLOBALS['wvrx_ts_in_tab_container'], $GLOBALS['wvrx_ts_tabs'], $GLOBALS['wvrx_ts_num_tabs']);

	return $add_style . $out;
}

function wvrx_ts_strip_pp(string $content): string
{
	// strip leading </p>\n<p> from tab content - added by editor
	if (strpos($content, "</p>\n<p>") === 0) {
		return substr($content, 8);
	}
	return $content;
}

function wvrx_ts_sc_tab($args, $content): void
{
	$atts = shortcode_atts(['title' => 'Tab %d'], $args);

	if (!isset($GLOBALS['wvrx_ts_num_tabs'])) {
		$GLOBALS['wvrx_ts_num_tabs'] = 0;
	}
	
	$cur = $GLOBALS['wvrx_ts_num_tabs'];
	$GLOBALS['wvrx_ts_tabs'][$cur] = [
		'title'   => sprintf(esc_attr($atts['title']), $cur + 1),
		'content' => do_shortcode($text = (string) $content),
	];
	$GLOBALS['wvrx_ts_num_tabs']++;
}


// ===============  [youtube id=videoid sd=0 hd=0 related=0 https=0 privacy=0 w=0 h=0] ======================

function wvrx_ts_sc_yt($args = ''): string
{
	$share = isset($args[0]) ? esc_url(trim($args[0])) : '';

	$atts = shortcode_atts([
		'autohide'       => '~!',
		'autoplay'       => '0',
		'id'             => '',
		'sd'             => false,
		'related'        => '0',
		'privacy'        => false,
		'ratio'          => false,
		'center'         => '1',
		'border'         => '0',
		'color'          => false,
		'color1'         => false,
		'color2'         => false,
		'controls'       => '1',
		'disablekb'      => '0',
		'egm'            => '0',
		'end'            => false,
		'fs'             => '1',
		'fullscreen'     => 1,
		'hd'             => '0',
		'iv_load_policy' => '1',
		'loop'           => '0',
		'modestbranding' => '0',
		'origin'         => false,
		'percent'        => 100,
		'playlist'       => false,
		'rel'            => '0',
		'showinfo'       => '1',
		'showsearch'     => '1',
		'start'          => false,
		'theme'          => 'dark',
		'wmode'          => 'transparent',
		'vertical'       => false,
		'aspect'         => 'hd',
	], $args);

	if (!$share && !$atts['id']) {
		return '<strong>' . esc_html__('No share or id values provided for youtube shortcode.', 'weaverx-theme-support') . '</strong>';
	}

	$yt_id = (string) $atts['id'];
	if ($share) {
		$yt_id = str_replace(['youtu.be/', 'www.youtube.com/watch?v='], '', $share);
		$yt_id = str_replace(['&amp;', '&', "'", '"', 'http://', 'https://'], ['+', '+', '', '', '', ''], $yt_id);
	}

	$query_opts = $yt_id . '%%';
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['hd'] != '0', 'hd=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['autohide'] != '~!', 'autohide=' . esc_attr($atts['autohide']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['autoplay'] != '0', 'autoplay=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['border'] != '0', 'border=1');
	
	foreach (['color', 'color1', 'color2', 'origin', 'playlist', 'start', 'end', 'wmode'] as $f) {
		if ($atts[$f]) {
			$query_opts = wvrx_ts_add_url_opt($query_opts, true, "$f=" . esc_attr($atts[$f]));
		}
	}

	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['controls'] != '1', 'controls=0');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['disablekb'] != '0', 'disablekb=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['egm'] != '0', 'egm=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, true, 'fs=' . esc_attr($atts['fs']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, true, 'iv_load_policy=' . esc_attr($atts['iv_load_policy']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['loop'] != '0', 'loop=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['modestbranding'] != '0', 'modestbranding=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, true, 'rel=' . esc_attr($atts['rel']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, true, 'showinfo=' . esc_attr($atts['showinfo']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['showsearch'] != '1', 'showsearch=0');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['theme'] != 'dark', 'theme=light');

	$domain = $atts['privacy'] ? 'www.youtube-nocookie.com' : 'www.youtube.com';
	$query_opts = str_replace(['%%+', '%%', '+'], ['%%?', '', '&amp;'], $query_opts);
	$final_url = '//' . $domain . '/embed/' . $query_opts;

	$allowfull = $atts['fullscreen'] ? ' allowfullscreen="allowfullscreen"' : '';
	$percent   = (float) $atts['percent'];
	
	$classes   = ['wvrx-video', 'wvrx-youtube'];
	$styles    = ["max-width:$percent%;"];
	
	if ($atts['vertical'] && $percent == 100) {
		$styles = ['max-width: 444px;', 'display:block;', 'margin:0 auto 10px;'];
	} elseif ($atts['center']) {
		$styles[] = 'margin-left:auto;margin-right:auto;';
	}

	$aspect = $atts['sd'] ? 'sd' : strtolower((string)$atts['aspect']);
	$h = wvrx_ts_video_height($aspect, $atts['vertical']);
	$w = wvrx_ts_video_width($aspect, $atts['vertical']);

	return sprintf(
		"\n<div class=\"%s\" style=\"%s\"><iframe src=\"%s\" style=\"border-width:0px\" width=\"%s\" height=\"%s\"%s></iframe></div>\n",
		implode(' ', $classes),
		implode('', $styles),
		esc_url($final_url),
		esc_attr($w),
		esc_attr($h),
		$allowfull
	);
}

// ===============  [vimeo id=videoid sd=0 w=0 h=0 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1] ======================
function wvrx_ts_sc_vimeo($args = ''): string
{
	$share = isset($args[0]) ? esc_url(trim($args[0])) : '';

	$atts = shortcode_atts([
		'id'       => '',
		'sd'       => false,
		'color'    => '',
		'autoplay' => false,
		'loop'     => false,
		'portrait' => true,
		'title'    => true,
		'byline'   => true,
		'percent'  => 100,
		'vertical' => false,
		'center'   => 1,
		'aspect'   => 'hd',
	], $args);

	if (!$share && !$atts['id']) {
		return '<strong>' . esc_html__('No share or id values provided for vimeo shortcode.', 'weaverx-theme-support') . '</strong>';
	}

	$v_id = (string) $atts['id'];
	if ($share) {
		$v_id = str_replace(['http://vimeo.com/', 'https://vimeo.com/'], '', $share);
	}

	$query_opts = $v_id . '##';
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['autoplay'], 'autoplay=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['loop'], 'loop=1');
	$query_opts = wvrx_ts_add_url_opt($query_opts, $atts['color'], 'color=' . esc_attr($atts['color']));
	$query_opts = wvrx_ts_add_url_opt($query_opts, !$atts['portrait'], 'portrait=0');
	$query_opts = wvrx_ts_add_url_opt($query_opts, !$atts['title'], 'title=0');
	$query_opts = wvrx_ts_add_url_opt($query_opts, !$atts['byline'], 'byline=0');

	$query_opts = str_replace(['##+', '##', '+'], ['##?', '', '&amp;'], $query_opts);
	$final_url  = '//player.vimeo.com/video/' . $query_opts;

	$percent = (float) $atts['percent'];
	if (function_exists('weaverii_use_mobile') && weaverii_use_mobile('mobile')) {
		$percent = 100;
	}

	$styles = ["max-width:$percent%;"];
	if ($atts['vertical'] && $percent == 100) {
		$styles = ['max-width: 444px;', 'display:block;', 'margin:0 auto 10px;'];
	} elseif ($atts['center']) {
		$styles[] = 'margin-left:auto;margin-right:auto;';
	}

	$aspect = $atts['sd'] ? 'sd' : strtolower((string)$atts['aspect']);
	$h      = wvrx_ts_video_height($aspect, $atts['vertical']);
	$w      = wvrx_ts_video_width($aspect, $atts['vertical']);

	return sprintf(
		"\n<div class=\"wvrx-video wvrx-vimeo\" style=\"%s\"><iframe src=\"%s\" style=\"border-width:0px\" width=\"%s\" height=\"%s\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></div>\n",
		implode('', $styles),
		esc_url($final_url),
		esc_attr($w),
		esc_attr($h)
	);
}

// ===== video utils =====

function wvrx_ts_add_url_opt(string $opts, $add, string $add_val): string
{
	return $add ? $opts . '+' . $add_val : $opts;
}

function wvrx_ts_video_width(string $aspect, $vertical): int
{
	switch ($aspect) {
		case 'sd':
		case 'SD':
		case '4:3':
			return $vertical ? 3 : 4;
		case '1.85:1':
		case 'widescreen':
			return $vertical ? 100 : 185;
		case '2.35:1':
		case '2.39:1':
		case 'anamorphic':
			return $vertical ? 100 : 235;
		case '2.76:1':
		case '70mm':
			return $vertical ? 100 : 276;
		case '1:1':
		case 'square':
			return 100;
		default:
			return $vertical ? 9 : 16;
	}
}

function wvrx_ts_video_height(string $aspect, $vertical): int
{
	switch ($aspect) {
		case 'sd':
		case 'SD':
		case '4:3':
			return $vertical ? 4 : 3;
		case '1.85:1':
		case 'widescreen':
			return $vertical ? 185 : 100;
		case '2.35:1':
		case '2.39:1':
		case 'anamorphic':
			return $vertical ? 235 : 100;
		case '2.76:1':
		case '70mm':
			return ($vertical !== 'no' && $vertical) ? 276 : 100;
		case '1:1':
		case 'square':
			return 100;
		default:
			return $vertical ? 16 : 9;
	}
}


function wvrx_ts_sc_html($vals = '', $text = ''): string
{
	$tag  = isset($vals[0]) ? trim($vals[0]) : 'span';
	$atts = shortcode_atts(['args' => ''], $vals);
	$args = $atts['args'] ? ' ' . $atts['args'] : '';

	return wp_kses_post('<' . $tag . $args . '>');
}

function wvrx_ts_sc_div($vals = '', $text = ''): string
{
	$atts = shortcode_atts(['id' => '', 'class' => '', 'style' => ''], $vals);

	$sty_attr = $atts['style'] ? ' style="' . esc_attr($atts['style']) . '"' : '';
	$id_attr  = $atts['id'] ? ' id="' . esc_attr($atts['id']) . '"' : '';
	$cl_attr  = $atts['class'] ? ' class="' . esc_attr($atts['class']) . '"' : '';

	return '<div' . $id_attr . $cl_attr . $sty_attr . '>' . do_shortcode($text) . '</div>';
}

function wvrx_ts_sc_span($vals = '', $text = ''): string
{
	$atts = shortcode_atts(['id' => '', 'class' => '', 'style' => ''], $vals);

	$sty_attr = $atts['style'] ? ' style="' . esc_attr($atts['style']) . '"' : '';
	$id_attr  = $atts['id'] ? ' id="' . esc_attr($atts['id']) . '"' : '';
	$cl_attr  = $atts['class'] ? ' class="' . esc_attr($atts['class']) . '"' : '';

	return '<span' . $id_attr . $cl_attr . $sty_attr . '>' . do_shortcode($text) . '</span>';
}

function wvrx_ts_weaverx_sc_info(): string
{
	$out = '<strong>' . esc_html__('Theme/User Info', 'weaverx-theme-support') . '</strong><hr />';

	$current_user = wp_get_current_user();
	if (isset($current_user->display_name)) {
		$out .= '<em>' . esc_html__('User: ', 'weaverx-theme-support') . '</em>' . esc_html($current_user->display_name) . '<br />';
	}
	$out .= '&nbsp;&nbsp;' . wp_register('', '<br />', false);
	$out .= '&nbsp;&nbsp;' . wp_loginout('', false) . '<br />';

	$agent = esc_html__('Not Available', 'weaverx-theme-support');
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
	    $agent = sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT']));
	}
	$out .= '<em>' . esc_html__('User Agent', 'weaverx-theme-support') . '</em>: <small>' . esc_html($agent) . '</small>';
	$out .= '<div id="example"></div>
<script type="text/javascript">
var txt = "";
var myWidth;
if( typeof( window.innerWidth ) == "number" ) {
myWidth = window.innerWidth;
} else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
myWidth = document.documentElement.clientWidth;
} else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
myWidth = document.body.clientWidth;
}
txt+= "<em>Browser Width: </em>" + myWidth + " px</br>";
document.getElementById("example").innerHTML=txt;
</script>';

	$out .= esc_html__('Feed title: ', 'weaverx-theme-support') . get_bloginfo_rss('name') . '<br />' . get_wp_title_rss();
    // translators: %s is WP Version
	$out .= '<br />' . sprintf(esc_html__('You are using WordPress %s', 'weaverx-theme-support'), $GLOBALS['wp_version']) . '<br />';
	$out .= esc_html__('PHP Version:', 'weaverx-theme-support') . phpversion() . '<br />';
	$out .= esc_html__('Memory:', 'weaverx-theme-support') . round(memory_get_usage() / 1024 / 1024, 2) . 'M of ' . (int)ini_get('memory_limit') . 'M <hr />';

	return wp_kses_post($out);
}


function wvrx_ts_set_shortcodes(array $sc_list, string $prefix): void
{
	foreach ($sc_list as $sc_name => $sc_func) {
		remove_shortcode($prefix . $sc_name);
		add_shortcode($prefix . $sc_name, $sc_func);
	}
}