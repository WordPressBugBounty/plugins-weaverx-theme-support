<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Main Options
 * admin-mainopts-1
*  __ added: 12/9/14 split: 03/26/2026
 * This function will start the main sapi form, which will be closed in admin-adminopts
 */

function weaverx_admin_mainopts_start(): void
{
    // Weaver 4 legacy interface
    ?>
    <div id="tabwrap_main" style="padding-left:4px;">

        <div id="tab-container-main" class='yetiisub'>
            <ul id="tab-container-main-nav" class='yetiisub'>
                <?php
                weaverx_elink('#asp_genappear', esc_html__('Wrapping background colors, rounded corners, borders, fade, shadow', 'weaverx-theme-support' /*adm*/), esc_html__('Wrapping Areas', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_widgets', esc_html__('Settings for Sidebars and Sidebar Layout', 'weaverx-theme-support' /*adm*/), esc_html__('Sidebars &amp; Layout', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_full', esc_html__('Settings to create full width sites', 'weaverx-theme-support' /*adm*/), esc_html__('Full Width', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_headeropts', esc_html__('Site Title/Tagline properties, Header Image', 'weaverx-theme-support' /*adm*/), esc_html__('Header', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_menus', esc_html__('Menu text and bg colors and other properties; Info Bar properties', 'weaverx-theme-support' /*adm*/), esc_html__('Menus', 'weaverx-theme-support'  /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_content', esc_html__('Text colors and bg, image borders, featured image, other properties related to all content', 'weaverx-theme-support' /*adm*/), esc_html__('Content Areas', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_postspecific', esc_html__('Properties related to posts: titles, meta info, navigation, excerpts, featured images, and more', 'weaverx-theme-support' /*adm*/), esc_html__('Post Specifics', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_footer', esc_html__('Footer options: bg color, borders, more. Site Copyright', 'weaverx-theme-support' /*adm*/), esc_html__('Footer', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                weaverx_elink('#asp_custom', esc_html__('Font settings &amp; Custom Settings', 'weaverx-theme-support' /*adm*/), esc_html__('Fonts &amp; Custom', 'weaverx-theme-support' /*adm*/), '<li>', '</li>');
                ?>
            </ul>

            <?php weaverx_tab_title(esc_html__('Main Options', 'weaverx-theme-support' /*adm*/), 'help.html#MainOptions', esc_html__('Help for Main Options', 'weaverx-theme-support' /*adm*/)); ?>

            <div id="asp_genappear" class="tab_mainopt">
                <?php weaverx_mainopts_general(); ?>
            </div>

            <div id="asp_widgets" class="tab_mainopt">
                <?php
                weaverx_mainopts_layout();
                weaverx_mainopts_widgets();
                ?>
            </div>

            <div id="asp_full" class="tab_mainopt">
                <?php weaverx_mainopts_fullwidth(); ?>
            </div>

            <div id="asp_headeropts" class="tab_mainopt">
                <?php weaverx_mainopts_header(); ?>
            </div>

            <div id="asp_menus" class="tab_mainopt">
                <?php weaverx_mainopts_menus(); ?>
            </div>

            <div id="asp_content" class="tab_mainopt">
                <?php weaverx_mainopts_content(); ?>
            </div>

            <div id="asp_postspecific" class="tab_mainopt">
                <?php weaverx_mainopts_posts(); ?>
            </div>

            <div id="asp_footer" class="tab_mainopt">
                <?php weaverx_mainopts_footer(); ?>
            </div>


            <div id="asp_links" class="tab_mainopt">
                <?php weaverx_mainopts_custom(); ?>
            </div>

        </div> <!-- #tab-container-main -->
        <?php weaverx_sapi_submit(); ?>
    </div>    <!-- #tabwrap_main -->
    <script type="text/javascript">
        let tabberMainOpts = new Yetii({
            id: 'tab-container-main',
            tabclass: 'tab_mainopt',
            persist: true
        });
    </script>
    <?php
}

// ======================== Main Options > Wrapping Areas ========================
function weaverx_mainopts_general(): void
{

    $font_size = weaverx_getopt_default('site_fontsize_int', 16);

    $opts = [
        ['type' => 'submit'],
        [
            'name' => esc_html__('Wrapping Areas', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-generic',
            'type' => 'header',
            'info' => esc_html__('Settings for wrapping areas', 'weaverx-theme-support' /*adm*/),
            'help' => 'help.html#GenApp',
        ],
        [
            'name' => esc_html__('GLOBAL SETTINGS', 'weaverx-theme-support' /*adm*/),
            'type' => 'note',
            'info' => esc_html__('These settings control site outer background and the standard link colors.', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Site Background Color', 'weaverx-theme-support' /*adm*/),
            'id' => 'body_bgcolor',
            'type' => 'ctext',
            'info' => esc_html__('Background color for &lt;body&gt;, wraps entire page.', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Fade Outside BG', 'weaverx-theme-support' /*adm*/),
            'id' => 'fadebody_bg',
            'type' => 'checkbox',
            'info' => esc_html__('Will fade the Outside BG color, darker at top to lighter at bottom.', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Full Browser Height', 'weaverx-theme-support' /*adm*/),
            'id' => 'full_browser_height',
            'type' => 'checkbox',
            'info' => esc_html__('For short pages, add extra padding to bottom of content to force full browser height.', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Standard Links', 'weaverx-theme-support' /*adm*/),
            'id' => 'link',
            'type' => 'link',
            'info' => esc_html__('Global default for link typography ( not including menus and titles ). Set Bold, Italic, and Underline by setting those options for specific areas rather than globally to have more control.', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Current Base Font Size:', 'weaverx-theme-support' /*adm*/),
            'type' => 'note',
            'info' => '<span style="font-size:' . esc_attr($font_size) . 'px;">' . esc_html($font_size) . esc_html__('px.', 'weaverx-theme-support' /*adm*/) . '</span> ' . esc_html__('Change on Custom Tab', 'weaverx-theme-support' /*adm*/),
        ],
        ['type' => 'submit'],
        [
            'name' => esc_html__('Wrapper Area', 'weaverx-theme-support' /*adm*/),
            'id' => 'wrapper',
            'type' => 'widget_area_submit',
            'info' => esc_html__('Wrapper wraps entire site (CSS id: #wrapper). Colors and font settings will be the default values for all other areas.', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Container Area', 'weaverx-theme-support' /*adm*/),
            'id' => 'container',
            'type' => 'widget_area_submit',
            'info' => esc_html__('Container (#container div) wraps content and sidebars.', 'weaverx-theme-support' /*adm*/),
        ],

    ];

    ?>

    <div class="options-intro"><?php echo wp_kses_post(__('<strong>Wrapping Areas:</strong>
The options on this tab affect the overall site appearance.
The main <strong>Wrapper Area</strong> wraps the entire site, and is used to specify default text and background colors, site width, font families, and more.
With <em>Weaver Xtreme Plus</em>, you can also specify background images for various areas of your site.', 'weaverx-theme-support' /*adm*/)); ?>
        <div class="options-intro-menu"><a
                href="#wrapping-areas"><?php esc_html_e('Wrapping Areas', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#wrapper-area"><?php esc_html_e('Wrapper Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#container-area"><?php esc_html_e('Container Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#background-images"><?php esc_html_e('Background Image (X-Plus)', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);
    do_action('weaverxplus_admin', 'general_appearance');
}

function wvrx_ts_new_xp_opt($vers, $opt)
{
    // don't support new xp opts in old xp
    if (function_exists('weaverxplus_plugin_installed') && version_compare(WEAVER_XPLUS_VERSION, $vers, '>=')) {
        return $opt;
    }

    return ['name' => $opt['name'], 'info' => esc_html__('This option requires X-Plus Version greater or equal to ', 'weaverx-theme-support') . esc_html($vers), 'type' => 'note'];
}

// ======================== Main Options > Custom ========================

function weaverx_mainopts_custom(): void
{
    $opts = [
        ['type' => 'submit'],
        [
            'name' => esc_html__('Custom Options', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-generic',
            'type' => 'header',
            'info' => esc_html__('Set various global custom values.', 'weaverx-theme-support' /*adm*/),
            'help' => 'help.html#Custom',
        ],

        [
            'name' => esc_html__('Various Custom Values', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-settings',
            'type' => 'subheader',
            'info' => esc_html__('Adjust various global settings', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => '<span class="i-left dashicons dashicons-align-none"></span>' . esc_html__('Smart Margin Width', 'weaverx-theme-support' /*adm*/),
            'id' => 'smart_margin_int',
            'type' => '+val_percent',
            'info' => esc_html__('Width used for smart column margins for Sidebars and Content Area. (Default: 1%) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Border Color', 'weaverx-theme-support' /*adm*/),
            'id' => 'border_color',
            'type' => 'color',
            'info' => esc_html__('Global color of borders. (Default: #222)', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => '<small>' . esc_html__('Border Width', 'weaverx-theme-support' /*adm*/) . '</small>',
            'id' => 'border_width_int',
            'type' => 'val_px',
            'info' => esc_html__('Global Width of borders. (Default: 1px)', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => '<span class="i-left" style="font-size:200%;margin-left:4px;">&#x25a1;</span><small>' . esc_html__('Border Style', 'weaverx-theme-support' /*adm*/) . '</small>',
            'id' => 'border_style',
            'type' => '+select_id',
            'info' => esc_html__('Style of borders - width needs to be > 1 for some styles to work correctly (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            'value' => [
                ['val' => 'solid', 'desc' => esc_html__('Solid', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'dotted', 'desc' => esc_html__('Dotted', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'dashed', 'desc' => esc_html__('Dashed', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'double', 'desc' => esc_html__('Double', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'groove', 'desc' => esc_html__('Groove', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'ridge', 'desc' => esc_html__('Ridge', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'inset', 'desc' => esc_html__('Inset', 'weaverx-theme-support' /*adm*/)],
                ['val' => 'outset', 'desc' => esc_html__('Outset', 'weaverx-theme-support' /*adm*/)],
            ],
        ],

        [
            'name' => esc_html__('Corner Radius', 'weaverx-theme-support' /*adm*/),
            'id' => 'rounded_corners_radius',
            'type' => '+val_px',
            'info' => esc_html__('Controls how "round" corners are. Specify a value (5 to 15 look best) for corner radius. (Default: 8) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Hide Menu/Link Tool Tips', 'weaverx-theme-support' /*adm*/),
            'id' => 'hide_tooltip',
            'type' => '+checkbox',
            'info' => esc_html__('Hide the tool tip pop up over all menus and links. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Custom Shadow', 'weaverx-theme-support' /*adm*/),
            'id' => 'custom_shadow',
            'type' => '+widetext',
            'info' => wp_kses_post(__('Specify full <em>box-shadow</em> CSS rule, e.g., <em>{box-shadow: 0 0 3px 1px rgba(0,0,0,0.25);}</em> (&#9733;Plus)', 'weaverx-theme-support' /*adm*/)),
        ],

        ['type' => 'submit'],

        [
            'name' => esc_html__('Custom CSS', 'weaverx-theme-support' /*adm*/),
            'id' => 'custom_css',
            'type' => 'custom_css',
            'info' => esc_html__('Create Custom CSS Rules', 'weaverx-theme-support' /*adm*/),
        ],

        ['type' => 'submit'],

        [
            'name' => esc_html__('Fonts', 'weaverx-theme-support' /*adm*/),
            'id' => '-editor-textcolor',
            'type' => 'header',
            'info' => esc_html__('Font Base Sizes', 'weaverx-theme-support' /*adm*/),
            'help' => 'font-demo.html',
        ],

        [
            'name' => esc_html__('Site Base Font Size', 'weaverx-theme-support' /*adm*/),
            'id' => 'site_fontsize_int',
            'type' => 'val_px',
            'info' => esc_html__('Base font size of standard text. This value determines the default medium font size. Note that visitors can change their browser\'s font size, so final font size can vary, as expected. (Default: 16px)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Site Base Line Height', 'weaverx-theme-support' /*adm*/),
            'id' => 'site_line_height_dec',
            'type' => '+val_num',
            'info' => esc_html__('Set the Base line-height. Most other line heights based on this multiplier. (Default: 1.5 - no units) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => '<small>' . esc_html__('Site Base Font Size - Small Tablets', 'weaverx-theme-support' /*adm*/) . '</small>',
            'id' => 'site_fontsize_tablet_int',
            'type' => '+val_px',
            'info' => esc_html__('Small Tablet base font size of standard text. (Default medium font size: 16px) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => '<small>' . esc_html__('Site Base Font Size - Phones', 'weaverx-theme-support' /*adm*/) . '</small>',
            'id' => 'site_fontsize_phone_int',
            'type' => '+val_px',
            'info' => esc_html__('Phone base font size of standard text. (Default medium font size: 16px)  (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        [
            'name' => esc_html__('Custom Font Size A', 'weaverx-theme-support' /*adm*/),
            'id' => 'custom_fontsize_a',
            'type' => '+val_em',
            'info' => esc_html__('Specify font size in em for Custom Size A (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],
        [
            'name' => esc_html__('Custom Font Size B', 'weaverx-theme-support' /*adm*/),
            'id' => 'custom_fontsize_b',
            'type' => '+val_em',
            'info' => esc_html__('Specify font size in em for Custom Size B (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ],

        ['type' => 'submit'],
    ];
    if (version_compare(WEAVERX_VERSION, '6.2.0.90', '<')) {
        $opts[] = [
            'name' => '<small>' . esc_html__('Disable Google Font Integration', 'weaverx-theme-support' /*adm*/) . '</small>',
            'id' => 'disable_google_fonts',
            'type' => '+checkbox',
            'info' => wp_kses_post(__('<strong>ADVANCED OPTION!</strong> <em>Be sure you understand the consequences of this option.</em> By disabling Google Font Integration, the Google Fonts definitions will <strong>not</strong> be loaded for your site. <strong style="color:red;font-weight:bold;">Please note:</strong> Any previously selected Google Font Families will revert to generic serif, sans, mono, and script fonts.', 'weaverx-theme-support')) . ' ' . esc_html__('Note: Weaver Xtreme Self-hosts Google fonts now, and this option is not really useful any longer', 'weaverx-theme-support'),
        ];
    }

    ?>
    <div class="options-intro"><strong><?php esc_html_e('Custom &amp; Fonts:', 'weaverx-theme-support' /*adm*/); ?> </strong>
        <?php esc_html_e('Set values for Custom options and Fonts: Smart Margin, Borders, Corners, Shadows, Custom CSS, and Fonts', 'weaverx-theme-support' /*adm*/); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#various-custom-values"><?php esc_html_e('Various Custom Values', 'weaverx-theme-support' /*adm*/); ?></a>
            |
            <a href="#custom-css-rules"><?php esc_html_e('Custom CSS Rules', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#fonts"><?php esc_html_e('Fonts', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);

    do_action('weaverxplus_admin', 'fonts');
}

// ======================== Main Options > Full Width ========================

function weaverx_mainopts_fullwidth(): void
{

    if (version_compare(WEAVERX_VERSION, '4.9.0', '>=')) {
        $opts = [
            ['type' => 'submit'],
            [
                'name' => esc_html__('Full Width Site', 'weaverx-theme-support' /*adm*/),
                'id' => '-editor-justify',
                'type' => 'header',
                'info' => esc_html__('One-Step Site Layout, Extend, and Stretch options are no longer supported in Weaver Xtreme V5. You can use Full and Wide alignment to achieve similar results. If you used Extend or Stretch settings, they will be automatically converted to equivalent settings when you load your settings.', 'weaverx-theme-support' /*adm*/),
            ],
        ];
    } else {
        $opts = [
            ['type' => 'submit'],
            [
                'name' => esc_html__('Full Width Site', 'weaverx-theme-support' /*adm*/),
                'id' => '-editor-justify',
                'type' => 'header',
                'info' => esc_html__('Options to easily create full width site designs', 'weaverx-theme-support' /*adm*/),
                'help' => 'help.html#FullWidth',
            ],


            [
                'name' => esc_html__('One-Step Site Layout', 'weaverx-theme-support' /*adm*/),
                'id' => 'site_layout',
                'type' => 'select_id',
                'info' => wp_kses_post(__('Easiest way to set overall site width layout. Settings other than Custom or blank <strong>automatically</strong> set and clear other Extend BG and Stretch Width Options. Use Custom to enable manual Custom Full Width Options. You can also use <em>Full</em> and <em>Wide Align</em> options for individual areas to enhance these one-step settings.', 'weaverx-theme-support' /*adm*/)),
                'value' => [
                    ['val' => '', 'desc' => ''],
                    ['val' => 'fullwidth', 'desc' => esc_html__('Full Width - Extends BG to full width', 'weaverx-theme-support')],
                    ['val' => 'stretched', 'desc' => esc_html__('Stretched - Expand to full width', 'weaverx-theme-support')],
                    ['val' => 'custom', 'desc' => esc_html__('Traditional - Use Traditional Width Options', 'weaverx-theme-support')],
                ],
            ],
        ];
    }

    if (version_compare(WEAVERX_VERSION, '4.9.0', '<')) {
        $opts[] = [
            'name' => esc_html__('Wide and Full Alignment', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-appearance3',
            'type' => 'header_area',
            'info' => esc_html__('Many wrapping areas and other items include Full and Wide alignment for a different way to get full or wide width.', 'weaverx-theme-support' /*adm*/),
        ];
    }

    $opts[] = [
        'name' => '<small>' . esc_html__('Align Full and Wide', 'weaverx-theme-support' /*adm*/) . '</small>',
        'type' => 'note',
        'info' => esc_html__('Two new alignment classes, .alignwide and .alignfull are supported by Weaver Xtreme. Most options with the Align option include options for full and wide alignment. Using a width alignment option will extend the full item, including content, to the specified width.', 'weaverx-theme-support' /*adm*/),
    ];

    if (version_compare(WEAVERX_VERSION, '4.9.0', '>=')) {

        $opts[] = [
            'name' => esc_html__('Extend BG Color', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-appearance',
            'type' => 'header_area',
            'info' => esc_html__('These options were first added to Weaver Xtreme many years ago, and were a "state-of-the-art" technique at the time to achieve full-width layouts. This technique has now been largely replaced by Align options. However, these old options do allow designs to use different colors for possibly interesting effects. However, there are many ways to achieve similar results, and so these options will be REMOVED from future versions of Weaver Xtreme. For now, we strongly urge you to not use these options on new sites, and to convert any use on old sites to new design. When these options are eventually dropped, they will be automatically converted to the Extend BG Attributes alignment. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ];
    } else {
        $opts[] = [
            'name' => esc_html__('Extend BG Attributes to Full Width', 'weaverx-theme-support' /*adm*/),
            'id' => '-editor-code',
            'type' => 'header_area',
            'info' => wp_kses_post(__('The Extend BG Attributes options in this section <em>retain the original content width</em>, while <em>extending the area\'s Background attributes to full width</em>. These include BG color, BG image, and borders, for example. IMPORTANT: Extend options override wide and full alignment options.', 'weaverx-theme-support' /*adm*/)),
        ];


        $extend = [
            'container' => [esc_html__('Container Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Container Area BG Attributes to full width.', 'weaverx-theme-support')],
            'header' => [esc_html__('Header Area Extend BG', 'weaverx-theme-support'), esc_html__(' Extend Header Area BG Attributes to full width.', 'weaverx-theme-support')],
            'header_sb' => [esc_html__('Header Widget Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Header Widget Area BG Attributes to full width.', 'weaverx-theme-support')],
            'header_html' => [esc_html__('Header HTML Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Header HTML Area BG Attributes to full width.', 'weaverx-theme-support')],
            'm_primary' => [esc_html__('Primary Menu Extend BG', 'weaverx-theme-support'), esc_html__('Extend Primary Menu BG Attributes to full width, keep menu items constrained to theme width.', 'weaverx-theme-support')],
            'm_secondary' => [esc_html__('Secondary Menu Extend BG', 'weaverx-theme-support'), esc_html__('Extend Secondary Menu BG Attributes to full width, keep menu items constrained to theme width.', 'weaverx-theme-support')],
            'infobar' => [esc_html__('Info Bar Extend BG', 'weaverx-theme-support'), esc_html__('Extend Info Bar BG Attributes to full width.', 'weaverx-theme-support')],
            'post' => [esc_html__('Post Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend each Post Area BG Attributes to full width.', 'weaverx-theme-support')],
            'footer' => [esc_html__('Footer Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Footer Area BG Attributes to full width.', 'weaverx-theme-support')],
            'footer_sb' => [esc_html__('Footer Widget Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Footer Widget Area BG Attributes to full width.', 'weaverx-theme-support')],
            'footer_html' => [esc_html__('Footer HTML Area Extend BG', 'weaverx-theme-support'), esc_html__('Extend Footer HTML Area BG Attributes to full width.', 'weaverx-theme-support')],

        ];

        foreach ($extend as $id => $vals) {
            $type = 'checkbox';
            if ($id == 'm_extra') {
                $type = '+checkbox';
            }
            $opts[] = [
                'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html($vals[0]),
                'id' => $id . '_extend_width',
                'type' => $type,
                'info' => $vals[1],
            ];
        }


        $opts[] = [
            'name' => esc_html__('Stretch Areas (Expand)', 'weaverx-theme-support' /*adm*/),
            'id' => '-editor-expand',
            'type' => 'header_area',
            'info' => esc_html__('This section has options that let you stretch or expand selected content areas of your site to the full browser width. The content will be responsively displayed - and fully occupy the browser window.', 'weaverx-theme-support' /*adm*/),
        ];
        $opts[] = [
            'name' => '<small>' . esc_html__('These Options OBSOLETE', 'weaverx-theme-support' /*adm*/) . '</small>',
            'type' => 'note',
            'info' => esc_html__('Due to the added support for Wide and Full Alignment, the Stretch options are essentially obsolete. Please use the Full and Wide align options available for most of these Stretch items.', 'weaverx-theme-support' /*adm*/),
        ];

        $opts[] = [
            'name' => '<span class="i-left dashicons dashicons-editor-expand"></span>' . esc_html__('Entire Site Full Width', 'weaverx-theme-support' /*adm*/),
            'id' => 'wrapper_fullwidth',
            'type' => 'checkbox',
            'info' => wp_kses_post(__('Checking this option will display the <strong>ENTIRE SITE</strong> in the full width of the browser. This option overrides the <em>Theme Width</em> option on the <em>Wrapping Areas : Wrapper Area</em> menu.', 'weaverx-theme-support' /*adm*/)),
        ];


        $stretch = [
            'header' => [esc_html__('Header Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Header Area to full width. This will include all other Header Area sub-areas as well.', 'weaverx-theme-support')],
            'header-image' => [esc_html__('Header Image Stretch', 'weaverx-theme-support'), esc_html__('Stretch Header Image to full width.', 'weaverx-theme-support')],
            'site_title' => [esc_html__('Site Title/Tagline Stretch', 'weaverx-theme-support'), esc_html__('This option includes the Site Title, Tagline, Search Button, and MiniMenu.', 'weaverx-theme-support')],
            'header-widget-area' => [esc_html__('Header Widget Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Header Widget Area to full width.', 'weaverx-theme-support')],
            'header-html' => [esc_html__('Header HTML Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Header HTML Area to full width.', 'weaverx-theme-support')],
            'm_primary' => [esc_html__('Primary Menu Stretch', 'weaverx-theme-support'), esc_html__('Stretch Primary Menu to full width.', 'weaverx-theme-support')],
            'm_secondary' => [esc_html__('Secondary Menu Stretch', 'weaverx-theme-support'), esc_html__('Stretch Secondary Menu to full width.', 'weaverx-theme-support')],
            'container' => [esc_html__('Container Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Container Area to full width.', 'weaverx-theme-support')],
            'infobar' => [esc_html__('Info Bar Stretch', 'weaverx-theme-support'), esc_html__('Stretch Info Bar to full width.', 'weaverx-theme-support')],
            'post' => [esc_html__('Post Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Post Area to full width.', 'weaverx-theme-support')],
            'footer' => [esc_html__('Footer Area Stretch', 'weaverx-theme-support'), esc_html__('Checking this option will automatically include the other Footer Area Stretch options as well.', 'weaverx-theme-support')],
            'footer_sb' => [esc_html__('Footer Widget Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Footer Widget Area to full width.', 'weaverx-theme-support')],
            'footer_html' => [esc_html__('Footer HTML Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Footer HTML Area to full width.', 'weaverx-theme-support')],
            'site-ig-wrap' => [esc_html__('Footer Copyright Area Stretch', 'weaverx-theme-support'), esc_html__('Stretch Footer Copyright Area to full width.', 'weaverx-theme-support')],

        ];

        foreach ($stretch as $id => $vals) {
            $opts[] = [
                'name' => '<span class="i-left dashicons dashicons-editor-expand"></span>' . esc_html($vals[0]),
                'id' => 'expand_' . $id,
                'type' => 'checkbox',
                'info' => $vals[1],
            ];
        }

        $opts[] = [
            'name' => esc_html__('Extend BG Color', 'weaverx-theme-support' /*adm*/),
            'id' => '-admin-appearance',
            'type' => 'header_area',
            'info' => esc_html__('These options, available with Weaver Xtreme Plus, allow you to stretch the BG color of various area to full width. This is different than the Extend BG Attributes in that only the color is extended, and that color can be different than the content. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
        ];
    }


    $extend = [
        'header' => [esc_html__('Header Area Extend BG Color', 'weaverx-theme-support'), esc_html__('Extend Header Area BG Color to full width.', 'weaverx-theme-support')],
        'm_primary' => [esc_html__('Primary Menu Extend BG', 'weaverx-theme-support'), esc_html__('Extend Primary Menu BG Color to full width.', 'weaverx-theme-support')],
        'm_secondary' => [esc_html__('Secondary Menu Extend BG', 'weaverx-theme-support'), esc_html__('Extend Secondary Menu BG Color to full width.', 'weaverx-theme-support')],
        'm_extra' => [esc_html__('Extra Menu Extend BG', 'weaverx-theme-support'), esc_html__('Extend Extra Menu BG Color to full width.', 'weaverx-theme-support')],
        'container' => [esc_html__('Container Extend BG', 'weaverx-theme-support'), esc_html__('Extend Container Area BG Color to full width.', 'weaverx-theme-support')],
        'content' => [esc_html__('Content Extend BG', 'weaverx-theme-support'), esc_html__('Extend Content Area BG Color to full width.', 'weaverx-theme-support')],
        'footer' => [esc_html__('Footer Extend BG', 'weaverx-theme-support'), esc_html__('Extend Footer Area BG Color to full width.', 'weaverx-theme-support')],
    ];

    foreach ($extend as $id => $vals) {
        $opts[] = [
            'name' => esc_html($vals[0]),
            'id' => $id . '_extend_bgcolor',
            'type' => '+color',
            'info' => $vals[1] . ' (&#9733;Plus)',
        ];
    }


    ?>
    <div class="options-intro">
        <?php
        if (version_compare(WEAVERX_VERSION, '4.9.0', '>=')) {
            echo wp_kses_post(__('<strong>OBSOLETE: Full Width:</strong> Options to create full width sites.', 'weaverx-theme-support' /*adm*/));
            echo '<p>';
            echo wp_kses_post(__('<strong style="color:red;">IMPORTANT NOTE:</strong> Full Width options have been replaced by Align Full or Align Wide in Weaver Xtreme V5.', 'weaverx-theme-support'));

        } else {

            echo wp_kses_post(__('<strong>Full Width:</strong> Options to create full width sites.', 'weaverx-theme-support' /*adm*/));
            echo '<p>';
            echo wp_kses_post(__('<strong style="color:red;">IMPORTANT NOTE:</strong> A better way to create Full and Wide Sites is to use Align Full or Align Wide on the four major areas: Wrapper, Header, Container, and the Footer. The new Left/Right Padding in percent is available for responsive padding with these areas.', 'weaverx-theme-support'));
        } ?>

        </p></div>
    <?php
    weaverx_form_show_options($opts);
}



