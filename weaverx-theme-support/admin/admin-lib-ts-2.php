<?php
// File refactored: 2026-02-27 admin-lib-ts-2
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

function weaverx_form_textarea( array $value, bool $media = false ): void {
	$rows  = $value['val'] ?? 1;
	$place = $value['placeholder'] ?? ' ';
	if ( $rows < 1 ) {
		$rows = 1;
	}

	$opt_val = weaverx_getopt( $value['id'] );
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); ?>:&nbsp;</th>
		<td colspan="2">
			<?php weaverx_textarea( $opt_val, $value['id'], $rows, $place, 'width:350px;', 'wvrx-edit' ); ?>
			<?php
			if ( $media ) {
				weaverx_media_lib_button( $value['id'] );
			}
			?>
			&nbsp;<small><?php echo wp_kses_post( $value['info'] ); ?></small>
		</td>
	</tr>
	<?php
}

function weaverx_form_text( array $value, bool $media = false ): void {
	$twide   = ( $value['type'] === 'text' ) ? 60 : 160;
	$opt_val = weaverx_getopt( $value['id'] );
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); ?>:&nbsp;</th>
		<td>
			<input name="<?php weaverx_sapi_main_name( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="text"
				   style="width:<?php echo (int) $twide; ?>px;" class="regular-text"
				   value="<?php echo esc_attr( $opt_val ); ?>"/>
			<?php
			if ( $media ) {
				weaverx_media_lib_button( $value['id'] );
			}
			?>
		</td>
		<?php weaverx_form_info( $value ); ?>
	</tr>
	<?php
}

function weaverx_form_val( array $value, string $unit = '' ): void {
	$opt_val = weaverx_getopt( $value['id'] );
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); ?>:&nbsp;</th>
		<td>
			<input name="<?php weaverx_sapi_main_name( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="text"
				   style="width:50px;" class="regular-text"
				   value="<?php echo esc_attr( $opt_val ); ?>"/> <?php echo esc_html( $unit ); ?>
		</td>
		<?php weaverx_form_info( $value ); ?>
	</tr>
	<?php
}

function weaverx_form_text_xy( array $value, string $x = 'X', string $y = 'Y', string $units = 'px' ): void {
	$xid   = $value['id'] . '_' . $x;
	$yid   = $value['id'] . '_' . $y;
	$colon = ( $value['name'] ) ? ':' : '';
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); echo esc_html( $colon ); ?>&nbsp;</th>
		<td>
			<span class="rtl-break"><?php echo esc_html( $x ); ?>:
				<input name="<?php weaverx_sapi_main_name( $xid ); ?>" id="<?php echo esc_attr( $xid ); ?>" type="text"
					style="width:40px;" class="regular-text"
					value="<?php weaverx_esc_textarea( weaverx_getopt( $xid ) ); ?>"/> <?php echo esc_html( $units ); ?>
			</span>
			&nbsp;
			<span class="rtl-break"><?php echo esc_html( $y ); ?>:
				<input name="<?php weaverx_sapi_main_name( $yid ); ?>" id="<?php echo esc_attr( $yid ); ?>" type="text"
					style="width:40px;" class="regular-text"
					value="<?php weaverx_esc_textarea( weaverx_getopt( $yid ) ); ?>"/> <?php echo esc_html( $units ); ?>
			</span>
		</td>
		<?php weaverx_form_info( $value ); ?>
	</tr>
	<?php
}

function weaverx_form_checkbox( array $value ): void {
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); ?>:&nbsp;</th>
		<td>
			<input type="checkbox" name="<?php weaverx_sapi_main_name( $value['id'] ); ?>"
				   id="<?php echo esc_attr( $value['id'] ); ?>"
				<?php checked( weaverx_getopt_checked( $value['id'] ) ); ?> >
		</td>
		<?php weaverx_form_info( $value ); ?>
	</tr>
	<?php
}

function weaverx_form_radio( array $value ): void {
	$cur_val = weaverx_getopt_default( $value['id'], 'black' );
	?>
	<tr>
		<th scope="row"><?php weaverx_echo_name( $value ); ?>:&nbsp;</th>
		<td colspan="2">
			<?php
			foreach ( $value['value'] as $option ) {
				$val = $option['val'];
				if ( $val === 'none' ) {
					$desc = esc_html__( 'None', 'weaverx-theme-support' );
				} else {
					$icon = weaverx_relative_url( 'assets/css/icons/search-' . $val . '.png' );
					$desc = sprintf( '<img style="background-color:#ccc;height:24px; width:24px;" src="%s" alt="" />', esc_url( $icon ) );
				}
				?>
				<input type="radio" name="<?php weaverx_sapi_main_name( $value['id'] ); ?>"
					   value="<?php echo esc_attr( $val ); ?>"
					<?php checked( $cur_val, $val ); ?> > <?php echo esc_html($desc); ?>&nbsp;
			<?php } ?>
			<br /><small style="margin-left:5%;"><?php echo wp_kses_post( $value['info'] ); ?></small>
		</td>
	</tr>
	<?php
}

function weaverx_form_select_id( array $value, bool $show_row = true ): void {
	if ( $show_row ) {
		echo '<tr><th scope="row">';
		weaverx_echo_name( $value );
		echo ':&nbsp;</th><td>';
	}

	$opt_val = weaverx_getopt( $value['id'] );
	?>
	<select name="<?php weaverx_sapi_main_name( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>">
		<?php foreach ( $value['value'] as $option ) : ?>
			<option value="<?php echo esc_attr( $option['val'] ); ?>" <?php selected( $opt_val, $option['val'] ); ?>>
				<?php echo esc_html( $option['desc'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
	if ( $show_row ) {
		echo '</td>';
		weaverx_form_info( $value );
		echo '</tr>';
	}
}

function weaverx_form_select_alt_theme( array $value ): void {
	$themes = function_exists( 'weaverx_pp_get_alt_themes' ) ? weaverx_pp_get_alt_themes() : [];
	$list   = [ [ 'val' => '', 'desc' => '' ] ];

	foreach ( $themes as $subtheme ) {
		$list[] = [ 'val' => $subtheme, 'desc' => $subtheme ];
	}

	$value['value'] = $list;
	weaverx_form_select_id( $value );
}

function weaverx_form_select_layout( array $value ): void {
	$value['value'] = [
		[ 'val' => 'default',   'desc' => esc_html__( 'Use Default', 'weaverx-theme-support' ) ],
		[ 'val' => 'right',     'desc' => esc_html__( 'Sidebars on Right', 'weaverx-theme-support' ) ],
		[ 'val' => 'right-top', 'desc' => esc_html__( 'Sidebars on Right (stack top)', 'weaverx-theme-support' ) ],
		[ 'val' => 'left',      'desc' => esc_html__( 'Sidebars on Left', 'weaverx-theme-support' ) ],
		[ 'val' => 'left-top',  'desc' => esc_html__( 'Sidebars on Left (stack top)', 'weaverx-theme-support' ) ],
		[ 'val' => 'split',     'desc' => esc_html__( 'Split - Sidebars on Right and Left', 'weaverx-theme-support' ) ],
		[ 'val' => 'split-top', 'desc' => esc_html__( 'Split (stack top)', 'weaverx-theme-support' ) ],
		[ 'val' => 'one-column','desc' => esc_html__( 'No sidebars, content only', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_link( array $value ): void {
	$id    = $value['id'];
	$link  = [ 'name' => $value['name'], 'id' => $id . '_color', 'type' => 'ctext', 'info' => $value['info'] ];
	$hover = [ 'name' => '<small>' . esc_html__( 'Hover', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hover_color', 'type' => 'ctext', 'info' => esc_html__( 'Hover Color', 'weaverx-theme-support' ) ];

	weaverx_form_ctext( $link );

	$id_u  = $id . '_u';
	$id_uh = $id . '_u_h';
	?>
	<tr>
		<td><small style="float:right;"><?php esc_html_e( 'Link Attributes:', 'weaverx-theme-support' ); ?></small></td>
		<td colspan="2">
			<small style="margin-left:5em;"><strong><?php esc_html_e( 'Bold', 'weaverx-theme-support' ); ?></strong></small>
			<?php weaverx_form_font_bold_italic( [ 'id' => $id . '_strong' ] ); ?>

			&nbsp;<small><em><?php esc_html_e( 'Italic', 'weaverx-theme-support' ); ?></em></small>
			<?php weaverx_form_font_bold_italic( [ 'id' => $id . '_em' ] ); ?>

			&nbsp;<small><u><?php esc_html_e( 'Link Underline', 'weaverx-theme-support' ); ?></u></small>
			<input type="checkbox" name="<?php weaverx_sapi_main_name( $id_u ); ?>" id="<?php echo esc_attr( $id_u ); ?>" <?php checked( weaverx_getopt_checked( $id_u ) ); ?> >

			&nbsp;|&nbsp;&nbsp;<small><u><?php esc_html_e( 'Hover Underline', 'weaverx-theme-support' ); ?></u></small>
			<input type="checkbox" name="<?php weaverx_sapi_main_name( $id_uh ); ?>" id="<?php echo esc_attr( $id_uh ); ?>" <?php checked( weaverx_getopt_checked( $id_uh ) ); ?> >

			<?php weaverx_form_ctext( $hover, true ); ?>
		</td>
	</tr>
	<?php
}

function weaverx_form_break( array $value ): void {
	$lim   = $value['value'] ?? 1;
	$label = isset( $value['name'] ) ? sprintf( '<em style="color:blue;"><strong>%s</strong></em>', esc_html( $value['name'] ) ) : '&nbsp;';
	for ( $n = 1; $n <= $lim; ++$n ) {
		echo '<tr><td style="text-align:right;">' . wp_kses_post($label) . '</td></tr>';
		$label = '&nbsp;';
	}
}

function weaverx_form_note( array $value ): void {
	?>
	<tr>
		<th scope="row">&nbsp;</th>
		<td style="float:right;font-weight:bold;"><?php weaverx_echo_name( $value ); ?>&nbsp;
			<?php weaverx_form_help( $value ); ?>
		</td>
		<?php weaverx_form_info( $value ); ?>
	</tr>
	<?php
}

function weaverx_form_info( array $value ): void {
	if ( ( $value['info'] ?? '' ) !== '' ) {
		echo '<td style="padding-left: 10px"><small>' . wp_kses_post( $value['info'] ) . '</small></td>';
	}
}

function weaverx_form_widget_area( array $value, bool $submit = false ): void {
	$id   = $value['id'];
	$name = $value['name'];

	$default_tb = [
		'infobar'   => '5px',
		'content'   => 'T:4px, B:8px',
		'footer'    => '8px',
		'footer_sb' => '8px',
		'primary'   => '8px',
		'secondary' => '8px',
		'extra'     => '8px',
		'top'       => '8px',
		'bottom'    => '8px',
	];

	$default_lr = [
		'infobar'   => '5px',
		'content'   => '2%',
		'post'      => '0',
		'footer'    => '8px',
		'footer_sb' => '8px',
		'primary'   => '8px',
		'secondary' => '8px',
		'extra'     => '8px',
		'top'       => '8px',
		'bottom'    => '8px',
	];

	$default_margins = [
		'infobar'   => '5px',
		'content'   => 'T:0, B:0',
		'footer'    => 'T:0, B:0',
		'footer_sb' => 'T:0, B:10',
		'primary'   => 'T:0, B:10',
		'widget'    => '0, Auto - First: T:0, Last: B:0',
		'secondary' => 'T:0, B:10',
		'extra'     => 'T:0, B:10',
		'top'       => 'T:10, B:10',
		'bottom'    => 'T:10, B:10',
		'wrapper'   => 'T:0, B:0',
		'post'      => 'T:0, B:15',
	];

	$def_tb   = $default_tb[$id] ?? '0';
	$def_lr   = $default_lr[$id] ?? '0';
	$def_marg = $default_margins[$id] ?? '0';

	$lr_type = in_array( $id, [ 'content', 'post' ], true ) ? 'text_lr_percent' : 'text_lr';

	$opts = [
		[
			'name' => $name,
			'id'   => '-welcome-widgets-menus',
			'type' => 'header_area',
			'info' => $value['info'],
		],
		[
			'name' => $name,
			'id'   => $id,
			'type' => 'titles_area',
			'info' => $name,
		],
		[
			'name' => '<span class="i-left dashicons dashicons-align-none"></span>' . esc_html__( 'Padding', 'weaverx-theme-support' ),
			'id'   => $id . '_padding',
			'type' => 'text_tb',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Top/Bottom Inner padding [Default: ', 'weaverx-theme-support' ) . esc_html( $def_tb ) . ']',
		],
		[
			'name' => '',
			'id'   => $id . '_padding',
			'type' => $lr_type,
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Left/Right Inner padding [Default: ', 'weaverx-theme-support' ) . esc_html( $def_lr ) . ']',
		],
		[
			'name' => '<span class="i-left dashicons dashicons-align-none"></span>' . esc_html__( 'Top/Bottom Margins', 'weaverx-theme-support' ),
			'id'   => $id . '_margin',
			'type' => 'text_tb',
			'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Top/Bottom margins. <em>Side margins auto-generated.</em> [Default: ', 'weaverx-theme-support' ) ) . esc_html( $def_marg ) . ']',
		],
	];

	weaverx_form_show_options( $opts, false, false );

	$no_lr_margins = [ 'primary', 'secondary', 'content', 'post', 'widget' ];
	$no_widgets    = [ 'widget', 'content', 'post', 'wrapper', 'container', 'header', 'header_html', 'footer_html', 'footer', 'infobar' ];
	$no_hide       = [ 'wrapper', 'container', 'content', 'widget', 'post' ];
	$default_auto  = [ 'top', 'bottom', 'footer_sb', 'header_sb' ];

	if ( in_array( $id, $no_lr_margins, true ) ) {
		if ( $id !== 'widget' ) {
			weaverx_form_checkbox( [
				'name' => '<span class="i-left dashicons dashicons-align-none"></span>' . esc_html__( 'Add Side Margin(s)', 'weaverx-theme-support' ),
				'id'   => $id . '_smartmargin',
				'type' => '',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Automatically add left/right "smart" margins for separation of areas (sidebar/content).', 'weaverx-theme-support' ),
			] );
		}
		weaverx_form_note( [
			'name' => '<strong>' . esc_html__( 'Width', 'weaverx-theme-support' ) . '</strong>',
			'info' => esc_html__( 'The width of this area is automatically determined by the enclosing area', 'weaverx-theme-support' ),
		] );
	} elseif ( $id !== 'wrapper' ) {
		$width_default = in_array( $id, $default_auto, true ) ? esc_html__( 'auto', 'weaverx-theme-support' ) : '100%';

        weaverx_form_val( [
			'name'  => '<span class="i-left" style="font-size:150%;">&harr;</span> ' . esc_html__( 'Width', 'weaverx-theme-support' ),
			'id'    => $id . '_width_int',
			'type'  => '',
            // translators: %s is a default is a numeric value.
			'info'  => '<em>' . esc_html( $name ) . '</em>' . sprintf( esc_html__( ': Width of Area in %% of enclosing area on desktop and small tablet. Hint: use with Center align. Use 0 to force auto width. (Default if blank: %s)', 'weaverx-theme-support' ), $width_default ),
			'value' => [],
		], '%' );

		weaverx_form_align( [
			'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__( 'Align Area', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_align',
			'type' => '',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': How to align this area (Default: Center)', 'weaverx-theme-support' ),
		] );

		if ( in_array( $id, [ 'container', 'header', 'footer' ], true ) ) {
			weaverx_form_val( [
				'name'  => '<span class="i-left" style="font-size:150%;">&harr;</span> ' . esc_html__( 'Left/Right Padding', 'weaverx-theme-support' ),
				'id'    => $id . '_padding_LRp',
				'type'  => '',
				'info'  => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Left/Right Padding in %. Value used only with Full and Wide Align, and overrides Left/Right padding in px options.', 'weaverx-theme-support' ),
				'value' => [],
			], '%' );
		}

		if ( $id === 'header_html' || $id === 'footer_html' ) {
			weaverx_form_checkbox( [
				'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Center Content', 'weaverx-theme-support' ),
				'id'   => $id . '_center_content',
				'type' => '',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Center Content within HTML Area content within the area.', 'weaverx-theme-support' ),
			] );
		}
	}

	if ( $id === 'wrapper' ) {
		weaverx_form_align( [
			'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__( 'Align Area', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_align',
			'type' => '',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': How to align this area (Default: Center)', 'weaverx-theme-support' ),
		] );

		weaverx_form_val( [
			'name'  => '<span class="i-left" style="font-size:150%;">&harr;</span> ' . esc_html__( 'Left/Right Padding', 'weaverx-theme-support' ),
			'id'    => $id . '_padding_LRp',
			'type'  => '',
			'info'  => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Left/Right Padding in %. Value used only with Full and Wide Align, and overrides Left/Right padding in px options.', 'weaverx-theme-support' ),
			'value' => [],
		], '%' );

		weaverx_form_val( [
			'name'  => '<span class="i-left" style="font-size:150%;">&harr;</span><em style="color:red;">' . esc_html__( 'Theme Width', 'weaverx-theme-support' ) . '</em>',
			'id'    => 'theme_width_int',
			'type'  => '',
			'info'  => wp_kses_post( __( '<em>Change Theme Width.</em> Standard width is 1100px. Use the options on the "Full Width" tab for full width designs, but leave this value set. Widths less than 768px may give unexpected results on mobile devices. Weaver Xtreme can not create a fixed-width site.', 'weaverx-theme-support' ) ),
			'value' => [],
		], 'px' );

		if ( version_compare( WEAVERX_VERSION, '4.9.0', '>=' ) ) {
			weaverx_form_checkbox( [
				'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Use "Lazy H" Layout', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'lazyh',
				'type' => '',
				'info' => esc_html__( 'Add styling to support "Lazy H" layout: wide Header and Footer, indented Content. (Like a sideways H.) You will also need to add fullwidth alignment to the header and footer to get this layout. Option added for backward compatibility with previous versions of Weaver Xtreme.', 'weaverx-theme-support' ),
			] );
		}
	}

	if ( in_array( $id, [ 'container', 'header', 'footer' ], true ) ) {
		weaverx_form_show_options( [ [
			'name'  => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__( 'Max Width', 'weaverx-theme-support' ) . '</small>',
			'id'    => $id . '_max_width_int',
			'type'  => '+val_px',
			'info'  => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Set Max Width of Area for Desktop View. Advanced Option. (&#9733;Plus)', 'weaverx-theme-support' ),
			'value' => [],
		] ], false, false );
	}

	if ( ! in_array( $id, $no_widgets, true ) ) {
		weaverx_form_show_options( [
			[
				'name' => '<span class="i-left" style="font-size:120%;">&nbsp;&#9783;</span>' . esc_html__( 'Columns', 'weaverx-theme-support' ),
				'id'   => $id . '_cols_int',
				'type' => 'val_num',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Equal width columns of widgets (Default: 1; max: 8)', 'weaverx-theme-support' ),
			],
			[
				'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'No Smart Widget Margins', 'weaverx-theme-support' ),
				'id'   => $id . '_no_widget_margins',
				'type' => 'checkbox',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Do not use "smart margins" between widgets on rows.', 'weaverx-theme-support' ),
			],
			[
				'name' => '<span class="i-left" style="font-size:140%;">&nbsp;=</span><small>' . esc_html__( 'Equal Height Widget Rows', 'weaverx-theme-support' ),
				'id'   => $id . '_eq_widgets',
				'type' => '+checkbox',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Make widgets equal height rows if &gt; 1 column (&#9733;Plus)', 'weaverx-theme-support' ),
			],
		], false, false );

		if ( in_array( $id, [ 'header_sb', 'footer_sb', 'primary', 'secondary', 'top', 'bottom' ], true ) ) {
			?>
			<tr>
				<th scope="row"><span class="i-left" style="font-size:120%;">&nbsp;&#9783;</span><small><?php esc_html_e( 'Custom Widget Widths:', 'weaverx-theme-support' ); ?></small></th>
				<td colspan="2" style="padding-left:20px;">
					<small><?php esc_html_e( 'You can optionally specify widget widths, including for specific devices. Please read the help entry!', 'weaverx-theme-support' ); ?>
						<?php weaverx_help_link( 'help.html#CustomWidgetWidth', esc_html__( 'Help on Custom Widget Widths', 'weaverx-theme-support' ) ); ?>
						<?php esc_html_e( '(&#9733;Plus) (&diams;)', 'weaverx-theme-support' ); ?></small></td>
			</tr>
			<?php
			weaverx_form_show_options( [
				[
					'name'        => '<span class="i-left dashicons dashicons-desktop"></span><small>' . esc_html__( 'Desktop', 'weaverx-theme-support' ) . '</small>',
					'id'          => '_' . $id . '_lw_cols_list',
					'type'        => '+textarea',
					'placeholder' => esc_html__( '25,25,50; 60,40; - for example', 'weaverx-theme-support' ),
					'info'        => esc_html__( 'List of widths separated by comma. Use semi-colon (;) for end of each row.  (&#9733;Plus) (&diams;)', 'weaverx-theme-support' ),
				],
				[
					'name' => '<span class="i-left dashicons dashicons-tablet"></span><small>' . esc_html__( 'Small Tablet', 'weaverx-theme-support' ) . '</small>',
					'id'   => '_' . $id . '_mw_cols_list',
					'type' => '+textarea',
					'info' => esc_html__( 'List of widget widths. (&#9733;Plus) (&diams;)', 'weaverx-theme-support' ),
				],
				[
					'name' => '<span class="i-left dashicons dashicons-smartphone"></span><small>' . esc_html__( 'Phone', 'weaverx-theme-support' ) . '</small>',
					'id'   => '_' . $id . '_sw_cols_list',
					'type' => '+textarea',
					'info' => esc_html__( 'List of widget widths. (&#9733;Plus) (&diams;)', 'weaverx-theme-support' ),
				],
			], false, false );
		}
	}

	weaverx_form_show_options( [
		[
			'name' => '<span class="i-left" style="font-size:200%;margin-left:4px;">&#x25a1;</span><small>' . esc_html__( 'Add Border', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_border',
			'type' => 'checkbox',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Add the "standard" border (as set on Custom tab)', 'weaverx-theme-support' ),
		],
		[
			'name' => '<span class="i-left dashicons dashicons-admin-page"></span><small>' . esc_html__( 'Shadow', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_shadow',
			'type' => 'shadows',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Wrap Area with Shadow.', 'weaverx-theme-support' ),
		],
		[
			'name' => '<span class="i-left dashicons dashicons-marker"></span><small>' . esc_html__( 'Rounded Corners', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_rounded',
			'type' => 'rounded',
			'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Rounded corners. Needs bg color or borders to show. <em>You might need to set overlapping corners for parent/child areas also!</em>', 'weaverx-theme-support' ) ),
		],
	], false, false );

	if ( ! in_array( $id, $no_hide, true ) ) {
		weaverx_form_select_hide( [
			'name'  => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__( 'Hide Area', 'weaverx-theme-support' ) . '</small>',
			'id'    => $id . '_hide',
			'info'  => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hide area on different display devices', 'weaverx-theme-support' ),
			'value' => '',
		] );
	}

	weaverx_form_show_options( [ [
		'name' => '<span class="i-left">{ }</span> <small>' . esc_html__( 'Add Classes', 'weaverx-theme-support' ) . '</small>',
		'id'   => $id . '_add_class',
		'type' => '+widetext',
		'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Space separated class names to add to this area (<em>Advanced option</em>) (&#9733;Plus)', 'weaverx-theme-support' ) ),
	] ], false, false );

	if ( $submit ) {
		weaverx_form_submit( '' );
	}
}

function weaverx_form_menu_opts( array $value, bool $submit = false ): void {
	$id      = $value['id'];
	$name    = $value['name'];
	$wp_logo = weaverx_get_wp_custom_logo_url();
	$logo_html = $wp_logo ? sprintf( '<img src="%s" alt="logo" style="max-height:16px;margin-left:10px;" />', esc_url( $wp_logo ) ) : esc_html__( 'Not set', 'weaverx-theme-support' );

	$opts = [
		[ 'name' => $name, 'id' => '-menu', 'type' => 'header_area', 'info' => $value['info'] ],
		[ 'name' => wp_kses_post(__( 'Menu Bar Layout', 'weaverx-theme-support' )), 'type' => 'break' ],
		[
			'name'  => '<span class="i-left dashicons dashicons-editor-alignleft"></span>' . esc_html__( 'Align Menu', 'weaverx-theme-support' ),
			'id'    => $id . '_align',
			'type'  => 'select_id',
			'info'  => esc_html__( 'Align this menu on desktop view. Mobile, accordion, and vertical menus always left aligned.', 'weaverx-theme-support' ),
			'value' => [
				[ 'val' => 'left',             'desc' => 'Align Left' ],
				[ 'val' => 'center',           'desc' => 'Center' ],
				[ 'val' => 'right',            'desc' => 'Align Right' ],
				[ 'val' => 'alignwide',        'desc' => esc_html__( 'Align Wide', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignwide left',   'desc' => esc_html__( 'Align Wide, Items Left', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignwide center', 'desc' => esc_html__( 'Align Wide, Items Center', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignwide right',  'desc' => esc_html__( 'Align Wide, Items Right', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignfull',        'desc' => esc_html__( 'Align Full', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignfull left',   'desc' => esc_html__( 'Align Full, Items Left', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignfull center', 'desc' => esc_html__( 'Align Full, Items Center', 'weaverx-theme-support' ) ],
				[ 'val' => 'alignfull right',  'desc' => esc_html__( 'Align Full, Items Right', 'weaverx-theme-support' ) ],
			],
		],
		[
			'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__( 'Hide Menu', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_hide',
			'type' => 'select_hide',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hide menu on different display devices', 'weaverx-theme-support' ),
		],
	];

	if ( $id !== 'm_extra' ) {
		$opts[] = [
			'name' => '<span class="i-left dashicons dashicons-editor-kitchensink"></span>' . esc_html__( 'Fixed-Top Menu', 'weaverx-theme-support' ),
			'id'   => $id . '_fixedtop',
			'type' => 'fixedtop',
			'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Fix menu to top of page. Note: the "Fix to Top on Scroll" does not play well with other "Fixed-Top" areas. Use the <em>Expand/Extend BG Attributes</em> on the Full Width tab to make a full width menu.', 'weaverx-theme-support' ) ),
		];
	}

	if ( $id === 'm_primary' ) {
		$opts = array_merge( $opts, [
			[
				'name' => '<small>' . esc_html__( 'Move Primary Menu to Top', 'weaverx-theme-support' ) . '</small>',
				'id'   => $id . '_move',
				'type' => 'checkbox',
				'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Move Primary Menu at Top of Header Area (Default: Bottom)', 'weaverx-theme-support' ),
			],
			[
				'name' => '<span class="i-left dashicons dashicons-heart"></span><small>' . esc_html__( 'Add Site Logo to Left', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'm_primary_logo_left',
				'type' => 'checkbox',
				'info' => wp_kses_post( __( 'Add the Site Logo to the primary menu. Add custom CSS for <em>.custom-logo-on-menu</em> to style. (Use Customize &rarr; General Options &rarr; Site Identity to set Site Logo.) Logo: ', 'weaverx-theme-support' ) ) . $logo_html,
			],
			[
				'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Height of Logo on Menu', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'm_primary_logo_height_dec',
				'type' => 'val_em',
				'info' => esc_html__( 'Set height of Logo on Menu. Will interact with padding. (Default: 2.0em, the standard Menu Bar height.)', 'weaverx-theme-support' ),
			],
			[
				'name' => '<small>' . esc_html__( 'Logo Links to Home', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'm_primary_logo_home_link',
				'type' => 'checkbox',
				'info' => esc_html__( 'Add a link to home page to logo on menu bar.', 'weaverx-theme-support' ),
			],
			[
				'name' => '<small>' . esc_html__( 'Add Site Title to Left', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'm_primary_site_title_left',
				'type' => 'checkbox',
				'info' => esc_html__( 'Add Site Title to primary menu left, with link to home page. (Uses Header Title font family, bold, and italic settings. Custom style with .site-title-on-menu.', 'weaverx-theme-support' ),
			],
			[
				'name' => '<small>' . esc_html__( "Add Search to Right", 'weaverx-theme-support' ) . '</small>',
				'id'   => 'm_primary_search',
				'type' => '+checkbox',
				'info' => esc_html__( 'Add slide open search icon to right end of primary menu. (&#9733;Plus)', 'weaverx-theme-support' ),
			],
			[
				'name' => '<small>' . esc_html__( 'No Home Menu Item', 'weaverx-theme-support' ) . '</small>',
				'id'   => 'menu_nohome',
				'type' => 'checkbox',
				'info' => esc_html__( 'Don\'t automatically add Home menu item for home page (as defined in Settings->Reading)', 'weaverx-theme-support' ),
			],
		] );
	} elseif ( $id === 'm_secondary' ) {
		$opts[] = [
			'name' => '<small>' . esc_html__( 'Move Secondary Menu to Bottom', 'weaverx-theme-support' ) . '</small>',
			'id'   => $id . '_move',
			'type' => 'checkbox',
			'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Move Secondary Menu at Bottom of Header Area (Default: Top)', 'weaverx-theme-support' ),
		];
	}

	weaverx_form_show_options( $opts, false, false );

	$colors_opts = [
		[ 'name' => esc_html__( 'Menu Bar Colors', 'weaverx-theme-support' ), 'type' => 'break', 'value' => 1 ],
		[ 'name' => esc_html__( 'Menu Bar', 'weaverx-theme-support' ), 'id' => $id, 'type' => 'titles_menu', 'info' => esc_html__( 'Entire Menu Bar', 'weaverx-theme-support' ) ],
		[ 'name' => esc_html__( 'Item BG', 'weaverx-theme-support' ), 'id' => $id . '_link_bgcolor', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Background Color for Menu Bar Items (links)', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Dividers between menu items', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_dividers_color', 'type' => '+color', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Add colored dividers between menu items. Leave blank for none. (&#9733;Plus)', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Hover BG', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hover_bgcolor', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hover BG Color (Default: rgba(255,255,255,0.15))', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Hover Text Color', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hover_color', 'type' => 'color', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hover Text Color', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . wp_kses_post( __( '<em>Mobile</em> Open Submenu Arrow BG -<br /><em>Not used by SmartMenus</em>', 'weaverx-theme-support' ) ) . '</small>', 'id' => $id . '_clickable_bgcolor', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Clickable mobile open submenu arrow BG. Contrasting BG color required for proper user interface. <em>Not used by SmartMenus</em>. (Default: rgba(255,255,255,0.2))', 'weaverx-theme-support' ) ) ],
		[ 'name' => esc_html__( 'Submenu BG', 'weaverx-theme-support' ), 'id' => $id . '_sub_bgcolor', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Background Color for submenus', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Submenu Text Color', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_sub_color', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Text Color for submenus', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Submenu Hover BG', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_sub_hover_bgcolor', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Submenu Hover BG Color (Default: Inherit Top Level)', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'Submenu Hover Text Color', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_sub_hover_color', 'type' => 'color', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Submenu Hover Text Color (Default: Inherit Top Level)', 'weaverx-theme-support' ) ],
		[ 'name' => esc_html__( 'Menu Bar Style', 'weaverx-theme-support' ), 'type' => 'break' ],
		[ 'name' => '<span class="i-left" style="font-size:200%;margin-left:4px;">&#x25a1;</span><small>' . esc_html__( 'Add Border', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_border', 'type' => 'checkbox', 'info' => '<em>' . esc_html( $name ) . '</em>' . ': Add the "standard" border (as set on Custom tab)' ],
		[ 'name' => '<span class="i-left" style="font-size:200%;margin-left:4px;">&#x25a1;</span><small>' . esc_html__( 'Add Border to Submenus', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_sub_border', 'type' => 'checkbox', 'info' => '<em>' . esc_html( $name ) . '</em>' . ': Add the "standard" border to Submenus' ],
		[ 'name' => '<span class="i-left dashicons dashicons-admin-page"></span><small>' . esc_html__( 'Shadow', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_shadow', 'type' => 'shadows', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Wrap Menu Bar with Shadow.', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-marker"></span><small>' . esc_html__( 'Rounded Corners', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_rounded', 'type' => 'rounded', 'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Add rounded corners to menu. <em>You might need to set overlapping corners Header/Wrapper areas also!</em>', 'weaverx-theme-support' ) ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-marker"></span><small>' . esc_html__( 'Rounded Submenu Corners', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_sub_rounded', 'type' => 'checkbox', 'info' => '<em>' . esc_html( $name ) . '</em>' . ': Add rounded corners to Submenus' ],
	];

	weaverx_form_show_options( $colors_opts, false, false );

	$r_text = ( $id === 'm_primary' ) ? 'textarea' : '+textarea';
	$r_hide = ( $id === 'm_primary' ) ? 'select_hide' : '+select_hide';
	$r_plus = ( $id === 'm_primary' ) ? '' : '(&#9733;Plus)';

	$spacing_opts = [
		[ 'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__( 'Hide Arrows', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hide_arrows', 'type' => 'checkbox', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hide Arrows on Desktop Menu', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left">{ }</span> <small>' . esc_html__( 'Add Classes', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_add_class', 'type' => '+widetext', 'info' => '<em>' . esc_html( $name ) . '</em>' . wp_kses_post( __( ': Space separated class names to add to this area (<em>Advanced option</em>) (&#9733;Plus)', 'weaverx-theme-support' ) ) ],
		[ 'name' => esc_html__( 'Menu Bar Spacing', 'weaverx-theme-support' ), 'type' => 'break' ],
		[ 'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Menu Top Margin', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_top_margin_dec', 'type' => 'val_px', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Top margin for menu bar.', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Menu Bottom Margin', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_bottom_margin_dec', 'type' => 'val_px', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Bottom margin for menu bar.', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Desktop Item Vertical Padding', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_menu_pad_dec', 'type' => 'val_em', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Add vertical padding to Desktop menu bar items and submenus. This option is NOT RECOMMENDED as it does not work with Left and Right HTML areas. (Default: 0.6em)', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'Desktop Menu Bar Padding', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_menu_bar_pad_dec', 'type' => 'val_em', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Add padding to menu bar top and bottom for Desktop devices. (Default: 0 em)', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__( 'Desktop Menu Spacing. (not on Smart Menus)', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_right_padding_dec', 'type' => 'val_em', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Add space between desktop menu bar items (Use value &gt; 1.0)', 'weaverx-theme-support' ) ],
		[ 'name' => esc_html__( 'Menu Bar Left/Right HTML', 'weaverx-theme-support' ), 'type' => 'break' ],
		[ 'name' => '<span class="i-left dashicons dashicons-editor-code"></span><small>' . esc_html__( 'Left HTML', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_html_left', 'type' => '+textarea', 'placeholder' => esc_html__( 'Any HTML, including shortcodes.', 'weaverx-theme-support' ), 'info' => esc_html__( 'Add HTML Left (Works best with Centered Menu)(&#9733;Plus)', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__( 'Hide Area', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hide_left', 'type' => '+select_hide', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hide Left HTML', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-editor-code"></span><small>' . esc_html__( 'Right HTML', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_html_right', 'type' => $r_text, 'placeholder' => esc_html__( 'Any HTML, including shortcodes.', 'weaverx-theme-support' ), 'info' => esc_html__( 'Add HTML to Menu on Right (Works best with Centered Menu)', 'weaverx-theme-support' ) . esc_html( $r_plus ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__( 'Hide Area', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_hide_right', 'type' => $r_hide, 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Hide Right HTML', 'weaverx-theme-support' ) ],
		[ 'name' => '<small>' . esc_html__( 'HTML: Text Color', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_html_color', 'type' => 'ctext', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Text Color for Left/Right Menu Bar HTML', 'weaverx-theme-support' ) ],
		[ 'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__( 'HTML: Top Margin', 'weaverx-theme-support' ) . '</small>', 'id' => $id . '_html_margin_dec', 'type' => 'val_em', 'info' => '<em>' . esc_html( $name ) . '</em>' . esc_html__( ': Margin above Added Menu HTML (Used to adjust for Desktop menu. Negative values can help.)', 'weaverx-theme-support' ) ],
	];

	weaverx_form_show_options( $spacing_opts, false, false );

	if ( $submit ) {
		weaverx_form_submit( '' );
	}
}

function weaverx_form_text_props( array $value, string $type = 'titles' ): void {
	$id   = $value['id'];
	$name = $value['name'];
	$info = $value['info'];

	if ( $id === 'wrapper' ) {
		echo '<tr><td></td><td colspan="2"><p>' . wp_kses_post( __( '<strong>Important note:</strong> The Wrapper Area provides default <em>background color, text color, and text font properties</em> for most other areas, including Header, Container, Content, Widgets, and more.', 'weaverx-theme-support' ) ) . '</p></td></tr>';
	}

	weaverx_form_ctext( [
		'name' => $name . ' BG',
		'id'   => $id . '_bgcolor',
		'info' => '<em>' . esc_html( $info ) . wp_kses_post( __( ':</em> Background Color (use CSS+ to specify custom CSS for area)', 'weaverx-theme-support' ) ),
	] );

	$color_label = $name . ' ' . esc_html__( 'Text Color', 'weaverx-theme-support' );
	$color_info  = '<em>' . esc_html( $info ) . wp_kses_post( __( ':</em> Text properties', 'weaverx-theme-support' ) );
	
	if ( $type === 'menu' || $id === 'post_title' ) {
		weaverx_form_ctext( [ 'name' => $color_label, 'id' => $id . '_color', 'info' => $color_info ] );
	} else {
		weaverx_form_color( [ 'name' => $color_label, 'id' => $id . '_color', 'info' => $color_info ] );
	}
	?>
	<tr>
		<th scope="row">
			<span class="i-left font-bold font-italic"><span style="font-size:16px;">a</span><span style="font-size:14px;">b</span><span style="font-size:12px;">c</span></span>
			<small><?php echo ( $type === 'titles' ) ? esc_html__( 'Title', 'weaverx-theme-support' ) : esc_html__( 'Text', 'weaverx-theme-support' ); ?> <?php esc_html_e( 'Font properties:', 'weaverx-theme-support' ); ?></small>&nbsp;
		</th>
		<td colspan="2">
			<?php
			if ( $type !== 'content' ) {
				echo '&nbsp;<span class="rtl-break"><small><em>' . esc_html__( 'Size:', 'weaverx-theme-support' ) . '</em></small>';
				weaverx_form_select_font_size( [ 'id' => $id . '_font_size' ], false );
				echo '</span>';
			}
			echo '&nbsp;<span class="rtl-break"><small><em>' . esc_html__( 'Family:', 'weaverx-theme-support' ) . '</em></small>';
			weaverx_form_select_font_family( [ 'id' => $id . '_font_family' ], false );
			echo '</span>';

			if ( $type === 'titles' ) {
				$id_norm = $id . '_normal';
				echo '&nbsp;<span class="rtl-break"><small>' . esc_html__( 'Normal Weight', 'weaverx-theme-support' ) . '</small>';
				echo '<input type="checkbox" name="' . esc_attr( weaverx_sapi_main_name( $id_norm ) ) . '" id="' . esc_attr( $id_norm ) . '" ' . checked( weaverx_getopt_checked( $id_norm ), true, false ) . ' ></span>';
			} else {
				echo '&nbsp;<span class="rtl-break"><small><strong>' . esc_html__( 'Bold', 'weaverx-theme-support' ) . '</strong></small>';
				weaverx_form_font_bold_italic( [ 'id' => $id . '_bold' ] );
				echo '</span>';
			}
			?>
			&nbsp;<span class="rtl-break"><small><em><?php esc_html_e( 'Italic', 'weaverx-theme-support' ); ?></em></small>
				<?php weaverx_form_font_bold_italic( [ 'id' => $id . '_italic' ] ); ?>
			</span>
			<small>&nbsp;&nbsp; <?php echo ( apply_filters( 'weaverx_xtra_type', '+plus_fonts' ) === 'inactive' ) ? esc_html__( '(Add new fonts with <em>Weaver Xtreme Plus</em>)', 'weaverx-theme-support' ) : esc_html__( '(Add new fonts from Custom &amp; Fonts tab.)', 'weaverx-theme-support' ); ?></small>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td><td>&nbsp;</td>
		<td><small><em><?php if ( version_compare( WEAVERX_VERSION, '4.9.0', '>=' ) ) { esc_html_e( 'You can set Text Transform, Character and Word Spacing in the Customizer.', 'weaverx-theme-support' ); } ?></em></small></td>
	</tr>
	<?php
}

function weaverx_from_fi_location( array $value, bool $is_post = false ): void {
	$value['value'] = [
		[ 'val' => 'content-top',     'desc' => esc_html__( 'With Content - top', 'weaverx-theme-support' ) ],
		[ 'val' => 'content-bottom',  'desc' => esc_html__( 'With Content - bottom', 'weaverx-theme-support' ) ],
		[ 'val' => 'title-before',    'desc' => esc_html__( 'With Title', 'weaverx-theme-support' ) ],
		[ 'val' => 'title-banner',    'desc' => esc_html__( 'Banner above Title', 'weaverx-theme-support' ) ],
		[ 'val' => 'header-image',    'desc' => $is_post ? esc_html__( 'Hide on Blog View', 'weaverx-theme-support' ) : esc_html__( 'Header Image Replacement', 'weaverx-theme-support' ) ],
		[ 'val' => 'post-before',     'desc' => esc_html__( 'Before Page/Post, no wrap', 'weaverx-theme-support' ) ],
		[ 'val' => 'post-bg',         'desc' => esc_html__( 'As BG Image, Tile', 'weaverx-theme-support' ) ],
		[ 'val' => 'post-bg-cover',   'desc' => esc_html__( 'As BG Image, Cover', 'weaverx-theme-support' ) ],
		[ 'val' => 'post-bg-parallax','desc' => esc_html__( 'As BG Image, Parallax', 'weaverx-theme-support' ) ],
		[ 'val' => 'post-bg-parallax-full', 'desc' => esc_html__( 'As BG Image, Parallax Full', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_align( array $value ): void {
	$id    = $value['id'];
	$is_v5 = version_compare( WEAVERX_VERSION, '4.9.0', '>=' );
	
	$options = [
		[ 'val' => 'float-left',     'desc' => esc_html__( 'Align Left', 'weaverx-theme-support' ) ],
		[ 'val' => 'align-center',   'desc' => esc_html__( 'Center', 'weaverx-theme-support' ) ],
		[ 'val' => 'float-right',    'desc' => esc_html__( 'Align Right', 'weaverx-theme-support' ) ],
		[ 'val' => 'alignnone',      'desc' => esc_html__( 'No Alignment', 'weaverx-theme-support' ) ],
		[ 'val' => 'alignwide',      'desc' => esc_html__( 'Align Wide', 'weaverx-theme-support' ) ],
		[ 'val' => 'alignfull',      'desc' => esc_html__( 'Align Full', 'weaverx-theme-support' ) ],
	];

	if ( $is_v5 ) {
		$options[] = [ 'val' => 'wvrx-fullwidth', 'desc' => esc_html__( 'Extend BG to Full width', 'weaverx-theme-support' ) ];
	}

	if ( $id === 'wrapper_align' ) {
		$center_key = array_search( 'align-center', array_column( $options, 'val' ), true );
		if ( $center_key !== false ) {
			$center_opt = $options[$center_key];
			unset( $options[$center_key] );
			array_unshift( $options, $center_opt );
		}
	}

	$value['value'] = array_values( $options );
	weaverx_form_select_id( $value );
}

function weaverx_form_align_standard( array $value ): void {
	$value['value'] = [
		[ 'val' => 'float-left',   'desc' => esc_html__( 'Align Left', 'weaverx-theme-support' ) ],
		[ 'val' => 'align-center', 'desc' => esc_html__( 'Center', 'weaverx-theme-support' ) ],
		[ 'val' => 'float-right',  'desc' => esc_html__( 'Align Right', 'weaverx-theme-support' ) ],
		[ 'val' => 'alignnone',    'desc' => esc_html__( 'No Alignment', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_fixedtop( array $value ): void {
	$value['value'] = [
		[ 'val' => 'none',       'desc' => esc_html__( 'Standard Position : Not Fixed', 'weaverx-theme-support' ) ],
		[ 'val' => 'fixed-top',  'desc' => esc_html__( 'Fixed to Top', 'weaverx-theme-support' ) ],
		[ 'val' => 'scroll-fix', 'desc' => esc_html__( 'Fix to Top on Scroll', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_fi_align( array $value ): void {
	$value['value'] = [
		[ 'val' => 'fi-alignleft',   'desc' => esc_html__( 'Align Left', 'weaverx-theme-support' ) ],
		[ 'val' => 'fi-aligncenter', 'desc' => esc_html__( 'Center', 'weaverx-theme-support' ) ],
		[ 'val' => 'fi-alignright',  'desc' => esc_html__( 'Align Right', 'weaverx-theme-support' ) ],
		[ 'val' => 'fi-alignnone',   'desc' => esc_html__( 'No Align', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_select_hide( array $value ): void {
	$value['value'] = [
		[ 'val' => 'hide-none',       'desc' => esc_html__( 'Do Not Hide', 'weaverx-theme-support' ) ],
		[ 'val' => 's-hide',          'desc' => esc_html__( 'Hide: Phones', 'weaverx-theme-support' ) ],
		[ 'val' => 'm-hide',          'desc' => esc_html__( 'Hide: Small Tablets', 'weaverx-theme-support' ) ],
		[ 'val' => 'm-hide s-hide',   'desc' => esc_html__( 'Hide: Phones+Tablets', 'weaverx-theme-support' ) ],
		[ 'val' => 'l-hide',          'desc' => esc_html__( 'Hide: Desktop', 'weaverx-theme-support' ) ],
		[ 'val' => 'l-hide m-hide',   'desc' => esc_html__( 'Hide: Desktop+Tablets', 'weaverx-theme-support' ) ],
		[ 'val' => 'hide',            'desc' => esc_html__( 'Hide on All Devices', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_select_font_size( array $value, bool $show_row = true ): void {
	$list = [
		[ 'val' => 'default',         'desc' => esc_html__( 'Inherit', 'weaverx-theme-support' ) ],
		[ 'val' => 'm-font-size',     'desc' => esc_html__( 'Medium Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'xxs-font-size',   'desc' => esc_html__( 'XX-Small Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'xs-font-size',    'desc' => esc_html__( 'X-Small Font', 'weaverx-theme-support' ) ],
		[ 'val' => 's-font-size',     'desc' => esc_html__( 'Small Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'l-font-size',     'desc' => esc_html__( 'Large Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'xl-font-size',    'desc' => esc_html__( 'X-Large Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'xxl-font-size',   'desc' => esc_html__( 'XX-Large Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'huge-font-size',  'desc' => esc_html__( 'Huge Font', 'weaverx-theme-support' ) ],
		[ 'val' => 'customA-font-size', 'desc' => esc_html__( 'Custom Size A', 'weaverx-theme-support' ) ],
		[ 'val' => 'customB-font-size', 'desc' => esc_html__( 'Custom Size B', 'weaverx-theme-support' ) ],
	];
	$value['value'] = apply_filters( 'weaverx_add_font_size', $list );
	weaverx_form_select_id( $value, $show_row );
}

function weaverx_form_select_font_family( array $value, bool $show_row = true ): void {
	$list = [
		[ 'val' => 'default',      'desc' => esc_html__( 'Inherit', 'weaverx-theme-support' ) ],
		[ 'val' => 'sans-serif',   'desc' => esc_html__( 'Arial (Sans Serif)', 'weaverx-theme-support' ) ],
		[ 'val' => 'arialBlack',   'desc' => esc_html__( 'Arial Black', 'weaverx-theme-support' ) ],
		[ 'val' => 'arialNarrow',  'desc' => esc_html__( 'Arial Narrow', 'weaverx-theme-support' ) ],
		[ 'val' => 'lucidaSans',   'desc' => esc_html__( 'Lucida Sans', 'weaverx-theme-support' ) ],
		[ 'val' => 'trebuchetMS',  'desc' => esc_html__( 'Trebuchet MS', 'weaverx-theme-support' ) ],
		[ 'val' => 'verdana',      'desc' => esc_html__( 'Verdana', 'weaverx-theme-support' ) ],
		[ 'val' => 'serif',        'desc' => esc_html__( 'Times (Serif)', 'weaverx-theme-support' ) ],
		[ 'val' => 'cambria',      'desc' => esc_html__( 'Cambria', 'weaverx-theme-support' ) ],
		[ 'val' => 'garamond',     'desc' => esc_html__( 'Garamond', 'weaverx-theme-support' ) ],
		[ 'val' => 'georgia',      'desc' => esc_html__( 'Georgia', 'weaverx-theme-support' ) ],
		[ 'val' => 'lucidaBright', 'desc' => esc_html__( 'Lucida Bright', 'weaverx-theme-support' ) ],
		[ 'val' => 'palatino',     'desc' => esc_html__( 'Palatino', 'weaverx-theme-support' ) ],
		[ 'val' => 'monospace',    'desc' => esc_html__( 'Courier (Monospace)', 'weaverx-theme-support' ) ],
		[ 'val' => 'consolas',     'desc' => esc_html__( 'Consolas', 'weaverx-theme-support' ) ],
		[ 'val' => 'papyrus',      'desc' => esc_html__( 'Papyrus', 'weaverx-theme-support' ) ],
		[ 'val' => 'comicSans',    'desc' => esc_html__( 'Comic Sans MS', 'weaverx-theme-support' ) ],
	];
	$value['value'] = apply_filters( 'weaverx_add_font_family', $list );
	$opt_val = weaverx_getopt( $value['id'] );
	?>
	<select name="<?php weaverx_sapi_main_name( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>">
		<?php foreach ( $value['value'] as $option ) : ?>
			<option class="font-<?php echo esc_attr( $option['val'] ); ?>"
					value="<?php echo esc_attr( $option['val'] ); ?>"<?php selected( $opt_val, $option['val'] ); ?>>
				<?php echo esc_html( $option['desc'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}

function weaverx_form_rounded( array $value ): void {
	$value['value'] = [
		[ 'val' => 'none',   'desc' => esc_html__( 'None', 'weaverx-theme-support' ) ],
		[ 'val' => '-all',   'desc' => esc_html__( 'All Corners', 'weaverx-theme-support' ) ],
		[ 'val' => '-left',  'desc' => esc_html__( 'Left Corners', 'weaverx-theme-support' ) ],
		[ 'val' => '-right', 'desc' => esc_html__( 'Right Corners', 'weaverx-theme-support' ) ],
		[ 'val' => '-top',   'desc' => esc_html__( 'Top Corners', 'weaverx-theme-support' ) ],
		[ 'val' => '-bottom','desc' => esc_html__( 'Bottom Corners', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value );
}

function weaverx_form_font_bold_italic( array $value ): void {
	$value['value'] = [
		[ 'val' => '',    'desc' => esc_html__( 'Inherit', 'weaverx-theme-support' ) ],
		[ 'val' => 'on',  'desc' => esc_html__( 'On', 'weaverx-theme-support' ) ],
		[ 'val' => 'off', 'desc' => esc_html__( 'Off', 'weaverx-theme-support' ) ],
	];
	weaverx_form_select_id( $value, false );
}

function weaverx_form_shadows( array $value ): void {
	$list = [
		[ 'val' => '-0',      'desc' => esc_html__( 'No Shadow', 'weaverx-theme-support' ) ],
		[ 'val' => '-1',      'desc' => esc_html__( 'All Sides, 1px', 'weaverx-theme-support' ) ],
		[ 'val' => '-2',      'desc' => esc_html__( 'All Sides, 2px', 'weaverx-theme-support' ) ],
		[ 'val' => '-3',      'desc' => esc_html__( 'All Sides, 3px', 'weaverx-theme-support' ) ],
		[ 'val' => '-4',      'desc' => esc_html__( 'All Sides, 4px', 'weaverx-theme-support' ) ],
		[ 'val' => '-rb',     'desc' => esc_html__( 'Right + Bottom', 'weaverx-theme-support' ) ],
		[ 'val' => '-lb',     'desc' => esc_html__( 'Left + Bottom', 'weaverx-theme-support' ) ],
		[ 'val' => '-tr',     'desc' => esc_html__( 'Top + Right', 'weaverx-theme-support' ) ],
		[ 'val' => '-tl',     'desc' => esc_html__( 'Top + Left', 'weaverx-theme-support' ) ],
		[ 'val' => '-custom', 'desc' => esc_html__( 'Custom Shadow', 'weaverx-theme-support' ) ],
	];
	$value['value'] = apply_filters( 'weaverx_add_shadows', $list );
	weaverx_form_select_id( $value );
}

function weaverx_custom_css( $value = '' ): void {
	$icon = $value['id'] ?? ' ';
	$dash = ( $icon[0] === '-' ) ? sprintf( '<span style="padding:.2em;" class="dashicons dashicons-%s"></span>', esc_attr( substr( $icon, 1 ) ) ) : '';
	?>
	<tr class="atw-row-header">
		<td colspan="3">
			<a id="custom-css-rules"></a>
			<span style="color:black;padding:.2em;" class="dashicons dashicons-screenoptions"></span>
			<span style="font-weight:bold; font-size: larger;"><em><?php esc_html_e( 'Custom CSS Rules', 'weaverx-theme-support' ); ?><?php weaverx_help_link( 'help.html#CustomCSS', esc_html__( 'Custom CSS Rules', 'weaverx-theme-support' ) ); ?></em></span>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p><?php esc_html_e( 'Rules you add here will be the last CSS Rules included by Weaver Xtreme, and thus override all other Weaver Xtreme generated CSS rules. Specify complete CSS rules, but don\'t add the <style> HTML element. You can prefix your selectors with .is-desktop, .is-mobile, .is-smalltablet, or .is-phone to create rules for specific devices. NOTE: Because Weaver Xtreme uses classes on many of its elements, you may to need to use !important with your rules to force the style override. It is possible that other plugins might generate CSS that comes after these rules.', 'weaverx-theme-support' ); ?></p>
			<p><?php
                // translators: %s is a url
                printf( wp_kses_post( __( 'Click <a href="%s">HERE</a> to use WordPress Global "Additional CSS" instead', 'weaverx-theme-support' ) ), esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=custom_css' ) ) ); ?></p>
			<?php weaverx_textarea( weaverx_getopt( 'add_css' ), 'add_css', 12, '', 'width:95%;', 'wvrx-edit wvrx-edit-dir' ); ?>
		</td>
	</tr>
	<?php
}