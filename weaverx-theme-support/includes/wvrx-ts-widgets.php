<?php
if (!defined('ABSPATH')) {
	exit;
}
// File refactored: 2026-03-24 11:44
/*
 *  Weaver X Widgets and shortcodes - widgets
 */

class WeaverX_Widget_Text extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'WeaverX_Widget_Text',
		 'description' => esc_html__('Text Widget with Two Columns - with HTML and shortcode support. Also adds shortcodes to standard Text widget.', 'weaverx-theme-support' /*adm*/));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('wvrx2_text', esc_html__('Weaver Text 2 Col', 'weaverx-theme-support' /*adm*/), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		$before_widget = $args['before_widget'] ?? '';
		$after_widget  = $args['after_widget'] ?? '';
		$before_title  = $args['before_title'] ?? '';
		$after_title   = $args['after_title'] ?? '';

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text  = apply_filters( 'weaverx_text', $instance['text'] ?? '', $instance );
		$text2 = apply_filters( 'weaverx_text', $instance['text2'] ?? '', $instance );

		echo wp_kses_post( $before_widget );
		
		if ( !empty( $title ) ) { 
			echo wp_kses_post( $before_title . $title . $after_title ); 
		} 
		?>
		<div class="textwidget"><div style="float: left; width: 48%; padding-right: 2%;">
		<?php
		if ( !empty($instance['filter']) ) {
			echo wp_kses_post( wpautop($text) ); 
			echo '</div><div style="float: left; width: 48%; padding-left: 2%;">';
			echo wp_kses_post( wpautop($text2) ); 
		} else {
			echo wp_kses_post( $text ); 
			echo '</div><div style="float: left; width: 48%; padding-left: 2%;">';
			echo wp_kses_post( $text2 ); 
		}
		echo '</div><div style="clear: both;"></div></div>';
		
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ):array {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] ?? '' );
		
		if ( current_user_can('unfiltered_html') ) {
			$instance['text']  = $new_instance['text'] ?? '';
			$instance['text2'] = $new_instance['text2'] ?? '';
		} else {
			$instance['text']  = wp_kses_post( $new_instance['text'] ?? '' );
			$instance['text2'] = wp_kses_post( $new_instance['text2'] ?? '' );
		}
		$instance['filter'] = isset($new_instance['filter']);
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'text2' => '',  'filter' => 0) );
		$title = sanitize_text_field( $instance['title'] );
		$text  = format_to_edit( $instance['text'] );
		$text2 = format_to_edit( $instance['text2'] );
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'weaverx-theme-support') /*a*/; ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea($text); ?></textarea>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr($this->get_field_id('text2')); ?>" name="<?php echo esc_attr($this->get_field_name('text2')); ?>"><?php echo esc_textarea($text2); ?></textarea>
		
		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(!empty($instance['filter'])); ?> />
			&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php esc_html_e('Automatically add paragraphs', 'weaverx-theme-support'); ?></label></p>
<?php
	}
}

/**
 * Weaver X Per Page Text
 */
class WeaverX_Widget_PPText extends WP_Widget {

    function __construct() {
		$widget_ops = array('classname' => 'wvrx_widget_pptext', 'description' =>
			esc_html__('Display text on a Per Page basis. Add to Widget area to see instructions.', 'weaverx-theme-support' /*adm*/) );
		parent::__construct('wvrx_pptext', esc_html__('Weaver Per Page Text', 'weaverx-theme-support' /*adm*/), $widget_ops);
    }

    function widget( $args, $instance ) {
		$before_widget = $args['before_widget'] ?? '';
		$after_widget  = $args['after_widget'] ?? '';
		$before_title  = $args['before_title'] ?? '';
		$after_title   = $args['after_title'] ?? '';

		$title = get_post_meta(get_the_ID(), 'wvrx_ts_pp_title', true);
		$text  = get_post_meta(get_the_ID(), 'wvrx_ts_pp_text', true);

		if (empty($title) && empty($text)) {
            return;
        }

		echo wp_kses_post( $before_widget );
		if ( !empty( $title ) ) {
        	echo wp_kses_post( $before_title . $title . $after_title );
    	}
		
    	echo wp_kses_post( do_shortcode( wp_kses_post($text) ) );
		echo wp_kses_post( $after_widget );
    }

	function update( $new_instance, $old_instance ):array {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] ?? '' );
		return $instance;
	}

	function form( $instance ) {
?>
<p><?php echo wp_kses_post(__('This widget will work like a text widget, but the title and content are defined by custom
fields set on a Per Page basis. For any page, define the Custom Field <em>wvrx_ts_pp_title</em>
if you want a title, and define Custom Field <em>wvrx_ts_pp_text</em> as the content. Content can include arbitrary text,
HTML, and shortcodes. The text will not automatically add paragraphs. The widget will display only if the custom
fields are defined when that page is displayed. (This widget won\'t display on the default blog or other archive-like pages.)', 'weaverx-theme-support' /*adm*/)); ?></p>
<?php
	}
}

/**
 * Weaver X login
 */
class WeaverX_Widget_Login extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'wvrx_widget_login', 'description' => esc_html__( "Log in/out, admin", 'weaverx-theme-support' /*adm*/ ) );
		parent::__construct('wvrx_login', esc_html__('Weaver Login', 'weaverx-theme-support' /*adm*/), $widget_ops);
	}

	function widget( $args, $instance ) {
		$before_widget = $args['before_widget'] ?? '';
		$after_widget  = $args['after_widget'] ?? '';
		$before_title  = $args['before_title'] ?? '';
		$after_title   = $args['after_title'] ?? '';

		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Login', 'weaverx-theme-support' /*adm*/ ) : $instance['title'], $instance, $this->id_base);

		echo wp_kses_post( $before_widget );
		if ( $title ) {
			echo wp_kses_post( $before_title . $title . $after_title );
		}
			
		global $current_user;
		$current_user = wp_get_current_user();
		if (isset($current_user->display_name)) {
			printf( '<span class="wvrx-welcome-user">%s %s.</span><br />' . "\n", esc_html__('Welcome', 'weaverx-theme-support' /*adm*/), esc_html($current_user->display_name) );
		}
?>
		<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		</ul>
<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ):array {
	    $instance = $old_instance;
	    $instance['title'] = sanitize_text_field( $new_instance['title'] ?? '' );
	    return $instance;
	}

	function form( $instance ) {
	    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	    $title = sanitize_text_field($instance['title']);
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'weaverx-theme-support' /*adm*/); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
<?php
	}
}

// ###################################### ELEMENTOR WIDGET ####################################

if ((defined('WVRX_TS_PAGEBUILDERS') && WVRX_TS_PAGEBUILDERS) && defined( 'ELEMENTOR_VERSION' ) ) :
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
class Weaver_Theme_Support_Widget_Elementor extends WP_Widget {

	function __construct() {
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
		$widget_ops = array('classname' => 'Weaver_Theme_Support_Widget_Elementor',
		 'description' => esc_html__('Show an Elementor Page or Post', 'weaverx-theme-support' /*adm*/));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('wvr_elementor_page', esc_html__('Weaver Elementor Page', 'weaverx-theme-support' /*adm*/), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		$before_widget = $args['before_widget'] ?? '';
		$after_widget  = $args['after_widget'] ?? '';
		$before_title  = $args['before_title'] ?? '';
		$after_title   = $args['after_title'] ?? '';

		$title = apply_filters('widget_title', $instance['title'] ?? '', $instance, $this->id_base);
		$use_post_title = !empty( $instance['use_post_title'] );
		
		$show_post = !empty($instance['pb_post_ID']) ? $instance['pb_post_ID'] : ($instance['post_list'] ?? '');

		echo wp_kses_post( $before_widget );

		if ( $use_post_title ) {
			$post_title = get_the_title($show_post);
			echo wp_kses_post( $before_title . $post_title . $after_title );
		} else if ( !empty($title) ) {
			echo wp_kses_post( $before_title . $title . $after_title );
		}

		$before = $show_post ? "<div class='weaver-pagebuilder-elementor weaver-pagebulder-" . esc_attr($show_post) . "'>" : '';
		$after  = $show_post ? "</div>" : '';
		$out    = '';

		// This widget is elementor specific...
		$is_elementor = !!get_post_meta( $show_post, '_elementor_edit_mode', true );
		if  ( $is_elementor ) {

			// okay, gotta fetch the_post for this post so that it will be properly intercepted by the page builder
			$query_args = array(
				'p'         => (int) $show_post, // ID of a page, post, or custom type
				'post_type' => 'page',
			);

			$use_posts = new WP_Query($query_args);
			while ( $use_posts->have_posts() ) {
				$use_posts->the_post();

				$out .= '<div id="post-' . esc_attr($show_post) . '" class="' . esc_attr(join( ' ', get_post_class('content-page-builder'))) . '">';
                // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				$out .= apply_filters('the_content', get_the_content());
				$out .= "</div>\n";
			}
			wp_reset_postdata();
		} else {
			$out = esc_html__('Sorry, you did not specify an Elementor Page.', 'weaverx-theme-support');
		}

		echo wp_kses_post( $before . $out . $after );
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ):array {
		$instance['title']          = sanitize_text_field( $new_instance['title'] ?? '' );
		$instance['post_list']      = sanitize_text_field( $new_instance['post_list'] ?? '' );
		$instance['use_post_title'] = !empty($new_instance['use_post_title']) ? 1 : 0;
		$post_id_string             = sanitize_text_field( trim($new_instance['pb_post_ID'] ?? '') );

		$post_id = (int) $post_id_string;
		if ( (string) $post_id === $post_id_string && $post_id !== 0 ) {
			$instance['pb_post_ID'] = $post_id_string;
		} else {
			$instance['pb_post_ID'] ='';
		}
		return $instance;
	}

	function form( $instance ) {
		$title          = $instance['title'] ?? '';
		$post_list      = $instance['post_list'] ?? '0';
		$pb_post_ID     = $instance['pb_post_ID'] ?? '';
		$use_post_title = !empty( $instance['use_post_title'] );
?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title (optional):', 'weaverx-theme-support') /*a*/; ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('use_post_title')); ?>" name="<?php echo esc_attr($this->get_field_name('use_post_title')); ?>"<?php checked( $use_post_title ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('use_post_title')); ?>"><?php esc_html_e( 'Use the Title of the selected Page for widget title.', 'weaverx-theme-support' ); ?></label>
	</p>

<?php
	if ( $pb_post_ID ) {
		echo wp_kses_post( "<p>" . __('Please clear the <em>ID of an Elementor Page or Post</em> value below to show a selection list of Elementor Pages.', 'weaverx-theme-support') . "</p>\n" );
	} else {
		$pargs = array (
			'post_type' => 'page',
		);
		$posts = get_pages($pargs);
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_list')); ?>"><?php esc_html_e('Select an Elementor Page. (Override this selection in Page/Post field below to select Page OR Post by ID.)', 'weaverx-theme-support'); ?></label><br />
			<select id="<?php echo esc_attr($this->get_field_id('post_list')); ?>" name="<?php echo esc_attr($this->get_field_name('post_list')); ?>">
		<?php
			foreach ( $posts as $post) {
				if ( !!get_post_meta( $post->ID, '_elementor_edit_mode', true ) ) {
					printf( '<option %s value="%s">%s</option>', selected($post_list, $post->ID, false), esc_attr($post->ID), esc_html(substr( $post->post_title, 0, 60)) );
				}
			}
		?>
			</select>
		</p>
<?php
	}
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pb_post_ID')); ?>"><?php esc_html_e('ID of an Elementor Page or Post (overrides Selection list above):', 'weaverx-theme-support'); ?></label>
			<input type="text" size="12" id="<?php echo esc_attr($this->get_field_id('pb_post_ID')); ?>" name="<?php echo esc_attr($this->get_field_name('pb_post_ID')); ?>" value="<?php echo esc_attr($pb_post_ID); ?>" />
		</p>
<?php
	}
}
endif;

// ###################################### SITEORIGIN PAGE BUILDER WIDGET ####################################
if ( (defined('WVRX_TS_PAGEBUILDERS') && WVRX_TS_PAGEBUILDERS) && defined('SITEORIGIN_PANELS_VERSION' ) ) :
// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
class Weaver_Theme_Support_Widget_Elementor extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'Weaver_Theme_Support_Widget_Elementor',
		 'description' => esc_html__('Show a SiteOrigin Page or Post', 'weaverx-theme-support' /*adm*/));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('wvr_siteorigin_page', esc_html__('Weaver SiteOrigin Page', 'weaverx-theme-support' /*adm*/), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		$before_widget = $args['before_widget'] ?? '';
		$after_widget  = $args['after_widget'] ?? '';
		$before_title  = $args['before_title'] ?? '';
		$after_title   = $args['after_title'] ?? '';

		$title = apply_filters('widget_title', $instance['title'] ?? '', $instance, $this->id_base);
		$use_post_title = !empty( $instance['use_post_title'] );
		
		$show_post = !empty($instance['pb_post_ID']) ? $instance['pb_post_ID'] : ($instance['post_list'] ?? '');

		echo wp_kses_post( $before_widget );

		if ( $use_post_title ) {
			$post_title = get_the_title($show_post);
			echo wp_kses_post( $before_title . $post_title . $after_title );
		} else if ( !empty($title) ) {
			echo wp_kses_post( $before_title . $title . $after_title );
		}

		$before = $show_post ? "<div class='weaver-pagebuilder-siteorigin weaver-pagebulder-" . esc_attr($show_post) . "'>" : '';
		$after  = $show_post ? "</div>" : '';
		$out    = '';

		// This widget is SiteOrigin specific...
		$is_siteorigin = !!get_post_meta( $show_post, 'panels_data', true );
		if  ( $is_siteorigin ) {

			// okay, gotta fetch the_post for this post so that it will be properly intercepted by the page builder
			$query_args = array(
				'p'         => (int) $show_post, // ID of a page, post, or custom type
				'post_type' => 'page',
			);

			$use_posts = new WP_Query($query_args);
			while ( $use_posts->have_posts() ) {
				$use_posts->the_post();

				$out .= '<div id="post-' . esc_attr($show_post) . '" class="' . esc_attr(join( ' ', get_post_class('content-page-builder'))) . '">';
                // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				$out .= apply_filters('the_content', get_the_content());
				$out .= "</div>\n";
			}
			wp_reset_postdata();
		} else {
			$out = esc_html__('Sorry, you did not specify a SiteOrigin Page.', 'weaverx-theme-support');
		}

		echo wp_kses_post( $before . $out . $after );
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ):array {
		$instance['title']          = sanitize_text_field( $new_instance['title'] ?? '' );
		$instance['post_list']      = sanitize_text_field( $new_instance['post_list'] ?? '' );
		$instance['use_post_title'] = !empty($new_instance['use_post_title']) ? 1 : 0;
		$post_id_string             = sanitize_text_field( trim($new_instance['pb_post_ID'] ?? '') );

		$post_id = (int) $post_id_string;
		if ( (string) $post_id === $post_id_string && $post_id !== 0 ) {
			$instance['pb_post_ID'] = $post_id_string;
		} else {
			$instance['pb_post_ID'] ='';
		}
		return $instance;
	}

	function form( $instance ) {
		$title          = $instance['title'] ?? '';
		$post_list      = $instance['post_list'] ?? '0';
		$pb_post_ID     = $instance['pb_post_ID'] ?? '';
		$use_post_title = !empty( $instance['use_post_title'] );
?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title (optional):', 'weaverx-theme-support') /*a*/; ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('use_post_title')); ?>" name="<?php echo esc_attr($this->get_field_name('use_post_title')); ?>"<?php checked( $use_post_title ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('use_post_title')); ?>"><?php esc_html_e( 'Use the Title of the selected Page for widget title.', 'weaverx-theme-support' ); ?></label>
	</p>

<?php
	if ( $pb_post_ID ) {
		echo wp_kses_post( "<p>" . __('Please clear the <em>ID of a SiteOrigin Page or Post</em> value below to show a selection list of SiteOrigin Pages.', 'weaverx-theme-support') . "</p>\n" );
	} else {
		$pargs = array (
			'post_type' => 'page',
		);
		$posts = get_pages($pargs);
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_list')); ?>"><?php esc_html_e('Select an SiteOrigin Page. (Override this selection in Page/Post field below to select Page OR Post by ID.)', 'weaverx-theme-support'); ?></label><br />
			<select id="<?php echo esc_attr($this->get_field_id('post_list')); ?>" name="<?php echo esc_attr($this->get_field_name('post_list')); ?>">
		<?php
			foreach ( $posts as $post) {
				if ( !!get_post_meta( $post->ID, 'panels_data', true ) ) {
					printf( '<option %s value="%s">%s</option>', selected($post_list, $post->ID, false), esc_attr($post->ID), esc_html(substr( $post->post_title, 0, 60)) );
				}
			}
		?>
			</select>
		</p>
<?php
	}
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pb_post_ID')); ?>"><?php esc_html_e('ID of an SiteOrigin Page or Post (overrides Selection list above):', 'weaverx-theme-support'); ?></label>
			<input type="text" size="12" id="<?php echo esc_attr($this->get_field_id('pb_post_ID')); ?>" name="<?php echo esc_attr($this->get_field_name('pb_post_ID')); ?>" value="<?php echo esc_attr($pb_post_ID); ?>" />
		</p>
<?php
	}
}
endif;

add_action("widgets_init", "wvrx_ts_load_widgets");
add_filter('weaverx_text', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');		// add to standard text widget, too.

function wvrx_ts_load_widgets():void {
	register_widget('WeaverX_Widget_Text');
	register_widget('WeaverX_Widget_PPText');
	register_widget('WeaverX_Widget_Login');
	
	if (defined('WVRX_TS_PAGEBUILDERS') && WVRX_TS_PAGEBUILDERS) :
		if (defined( 'ELEMENTOR_VERSION' ) ) {		// only provide if elementor is active
			register_widget('Weaver_Widget_Elementor');
		}
		if (defined( 'SITEORIGIN_PANELS_VERSION' ) ) {		// only provide if siteorigin is active
			register_widget('Weaver_Widget_SiteOrigin');
		}
	endif;
}