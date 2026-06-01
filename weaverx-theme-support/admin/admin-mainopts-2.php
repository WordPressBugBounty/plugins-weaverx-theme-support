<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Main Options
 * admin-mainopts-2
 *  __ added: 12/9/14 split: 03/26/2026
 * This function will start the main sapi form, which will be closed in admin-adminopts
 */

// part 2

// ======================== Main Options > Header ========================
function weaverx_mainopts_header(): void
{

    $wp_logo = weaverx_get_wp_custom_logo_url();

    if ($wp_logo) {
        $wp_logo_html = "<img src='" . esc_url($wp_logo) . "' alt='logo' style='max-height:16px;margin-left:10px;' />";
    } else {
        $wp_logo_html = esc_html__('Not set', 'weaverx-theme-support');
    }


    $opts = [
            ['type' => 'submit'],
            [
                    'name' => esc_html__('Header Options', 'weaverx-theme-support' /*adm*/),
                    'id' => '-admin-generic',
                    'type' => 'header',
                    'info' => esc_html__('Options affecting site Header', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#HeaderOpt',
            ],

            [
                    'name' => esc_html__('Header Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header',
                    'type' => 'widget_area',
                    'info' => esc_html__('The Header Area includes: menu bars, standard header image, title, tagline, header widget area, header HTML area', 'weaverx-theme-support' /*adm*/),
            ],

            ['name' => esc_html__('Header Other options', 'weaverx-theme-support'), 'type' => 'break'],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Hide Search on Header', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_search_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Selectively hide the Search Box Button on top right of header', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Search Area Options:', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'type' => 'note',
                    'info' => esc_html__('Specify search icon, text and background colors Search section of Content Areas tab.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Global Header Area Replacement', 'weaverx-theme-support'),
                    'id' => 'pb_header_replace_page_id',
                    'type' => 'widetext',
                    'info' => esc_html__('Provide any page or post ID to serve as global replacement for Header area. This will override and replace most other settings in this section.', 'weaverx-theme-support'),
            ],
            [
                    'name' => '<small>' . esc_html__('Page Builder Replacements', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'type' => 'note',
                    'info' => esc_html__('The Customizer interface has options to specify a Replacement Area from page builders.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Hide Weaver Menus', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'pb_header_hide_menus',
                    'type' => 'checkbox',
                    'info' => esc_html__('Check to hide the Weaver Primary Menu normally displayed below the replacement page.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Show Only Menus in Header Area', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'menus_only_header',
                    'type' => 'checkbox',
                    'info' => esc_html__('Show only the Primary and Secondary Menus in Header area. (Hides all Header elements except menus.)', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],

            [
                    'name' => esc_html__('Header Image', 'weaverx-theme-support' /*adm*/),
                    'id' => '-format-image',
                    'type' => 'subheader',
                    'info' => esc_html__('Settings related to standard header image (Set on Appearance&rarr;Header)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Hide Header Image', 'weaverx-theme-support' /*adm*/),
                    'id' => 'hide_header_image',
                    'type' => 'select_hide',
                    'info' => esc_html__('Check to selectively hide standard header image', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Suggested Header Image Height', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_image_height_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Change the suggested height of the Header Image. This only affects the clipping window on the Appearance:Header page. Header images will be responsively sized. If used with <em>Header Image Rendering</em>, this value will be used to set the minimum height of the BG image. (Default: 188px)', 'weaverx-theme-support' /*adm*/),
            ],

            wvrx_ts_new_xp_opt('3.0',        // >= 3.0
                    [
                            'name' => esc_html__('Header Image Rendering', 'weaverx-theme-support' /*adm*/) . '</small>',
                            'id' => 'header_image_render',
                            'type' => '+select_id',    //code
                            'info' => esc_html__('How to render header image: as img in header or as header area bg image. When rendered as a BG image, other options such as moving Title/Tagline or having image link to home page are not meaningful. (Default: &lt;img&gt; in header div) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                            'value' => [
                                    ['val' => 'header-as-img', 'desc' => esc_html__('As img in header', 'weaverx-theme-support' /*adm*/)],
                                    ['val' => 'header-as-bg', 'desc' => esc_html__('As static BG image', 'weaverx-theme-support' /*adm*/)],
                                    ['val' => 'header-as-bg-responsive', 'desc' => esc_html__('As responsive BG image', 'weaverx-theme-support' /*adm*/)],
                                    ['val' => 'header-as-bg-parallax', 'desc' => esc_html__('As parallax BG image', 'weaverx-theme-support' /*adm*/)],

                            ],
                    ]
            ),

            [
                    'name' => '<small>' . esc_html__('Minimum Header Height', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_min_height',
                    'type' => '+val_px',
                    'info' => esc_html__('Set Minimum Height for Header Area. Most useful used with Parallax Header BG Image. Adding Top Margin to Primary Menu bar can also add height. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span><small>' . esc_html__('Maximum Image Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_image_max_width_dec',
                    'type' => '+val_percent',
                    'info' => esc_html__('Maximum width of Image (Default: 100%) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Use Actual Image Size', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_actual_size',
                    'type' => '+checkbox',
                    'info' => esc_html__('Check to use actual header image size. (Default: theme width) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__('Align Header Image', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_image_align',
                    'type' => 'align',
                    'info' => esc_html__('How to align header image. Wide and Full do not apply to BG header image.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Header Image Front Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_header_image_front',
                    'type' => 'checkbox',
                    'info' => esc_html__('Check to hide display of standard header image on front page only.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left">{ }</span> <small>' . esc_html__('Add Classes', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_image_add_class',
                    'type' => '+widetext',
                    'info' => '<em>' . esc_html__('Header Image', 'weaverx-theme-support' /*adm*/) . '</em>' . wp_kses_post(__(': Space separated class names to add to this area (<em>Advanced option</em>) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => '<small>' . esc_html__('Header Image Links to Site', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'link_site_image',
                    'type' => 'checkbox',
                    'info' => wp_kses_post(__('Check to add a link to site home page for Header Image. Note: If used with <em>Move Title/Tagline over Image</em>, parts of the header image will not be clickable.', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => '<small>' . esc_html__('Alternate Header Images:', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'type' => 'note',
                    'info' => wp_kses_post(__('Specify alternate header images using the <em>Featured Image Location</em> options on the <em>Content Areas</em> tab for pages, or the <em>Post Specifics</em> tab for single post views.', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-code"></span>' . esc_html__('Image HTML Replacement', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_image_html_text',
                    'type' => 'textarea',
                    'placeholder' => esc_html__('Any HTML, including shortcodes', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('Replace Header image with arbitrary HTML. Useful for slider shortcodes in place of image. FI as Header Image has priority over HTML replacement. Extreme Plus also supports this option on a Per Page/Post basis.', 'weaverx-theme-support' /*adm*/),
                    'val' => 1,
            ],

            [
                    'name' => '<small>' . esc_html__('Show On Home Page Only', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_image_html_home_only',
                    'type' => 'checkbox',
                    'info' => esc_html__('Check to use the Image HTML Replacement only on your Front/Home page.', 'weaverx-theme-support' /*adm*/),
            ],

            wvrx_ts_new_xp_opt('3.0', // >= 3.0
                    [
                            'name' => '<small>' . esc_html__('Also show BG Header Image', 'weaverx-theme-support' /*adm*/) . '</small>',
                            'id' => 'header_image_html_plus_bg',
                            'type' => '+checkbox',
                            'info' => wp_kses_post(__('If you have Image HTML Replacement defined - including Per Page/Post - and also have set the standard Header Image to display as a BG image, then show <em>both</em> the BG image and the replacement HTML. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/)),
                    ]
            ),


            [
                    'name' => esc_html__('Header Video', 'weaverx-theme-support' /*adm*/),
                    'id' => '-format-video',
                    'type' => 'subheader',
                    'info' => esc_html__('Settings related to Header Video (Set on Appearance&rarr;Header or on the Customize&rarr;Images&rarr;Header Media menu.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Header Video Rendering', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_video_render',
                    'type' => 'select_id',    //code
                    'info' => wp_kses_post(__('How to render Header Video: as image substitute in header or as full browser background cover image will parallax effect. <em style="color:red;">Note that the Header Image options above do not apply to the Header Video media.</em>', 'weaverx-theme-support' /*adm*/)),
                    'value' => [
                            ['val' => 'has-header-video', 'desc' => esc_html__('As video in header only', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'has-header-video-cover', 'desc' => esc_html__('As full cover Parallax BG Video', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'has-header-video-none', 'desc' => esc_html__('Disable Header Video', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => esc_html__('Header Video Aspect Ratio', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_video_aspect',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('It is critical to select aspect ratio of your video. If you see letterboxing black bars, you have the wrong aspect ratio selected.', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => '16:9', 'desc' => esc_html__('16:9 HDTV', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '4:3', 'desc' => esc_html__('4:3 Std TV', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3:2', 'desc' => esc_html__('3:2 35mm Photo', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '5:3', 'desc' => esc_html__('5:3 Alternate Photo', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '64:27', 'desc' => esc_html__('2.37:1 Cinemascope', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '37:20', 'desc' => esc_html__('1.85:1 VistaVision', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3:1', 'desc' => esc_html__('3:1 Banner', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '4:1', 'desc' => esc_html__('4:1 Banner', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '9:16', 'desc' => esc_html__('9:16 Vertical HD (Please avoid!)', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],


            [
                    'name' => esc_html__('Custom Logo', 'weaverx-theme-support' /*adm*/),
                    'id' => '-menu',
                    'type' => 'subheader',
                    'info' => esc_html__('The native WP Custom Logo, set on the Site Identity Customizer menu.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Replace Title with Site Logo', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'wplogo_for_title',
                    'type' => 'checkbox',
                    'info' => esc_html__('Replace the Site Title text with the WP Custom Logo Image. Logo: ', 'weaverx-theme-support' /*adm*/) . $wp_logo_html,
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide WP Custom Logo', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_wp_site_logo',
                    'type' => 'select_hide',
                    'info' => esc_html__('Hide native WP Custom Site Logo in Header, by device. (This is not the Weaver Logo/HTML!)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__('Logo for Title Height', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_logo_height_dec',
                    'type' => 'val_px',
                    'info' => esc_html__('Set maximum height of Logo when used to replace Site Title. Default 0 uses the actual image size. This is the maximum height. If the actual image height is smaller, the smaller value is used.', 'weaverx-theme-support' /*adm*/),
            ],


            ['type' => 'submit'],


            [
                    'name' => esc_html__('Site Title/Tagline', 'weaverx-theme-support' /*adm*/),
                    'id' => '-text',
                    'type' => 'subheader',
                    'info' => esc_html__('Settings related to the Site Title and Tagline (Tagline sometimes called Site Description)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Site Title', 'weaverx-theme-support' /*adm*/),
                    'id' => 'site_title',
                    'type' => 'titles',
                    'info' => esc_html__("The site's main title in the header (blog title)", 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left font-bold" style="font-size:120%;">&#x21cc;</span><small>' . esc_html__('Title Position', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'site_title_position_xy',
                    'type' => 'text_xy_percent',
                    'info' => esc_html__('Adjust left and top margins for Title. Decimal and negative values allowed. (Default: X: 7%, Y:0.25%)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('Title Max Width', 'weaverx-theme-support' /*adm*/),
                    'id' => 'site_title_max_w',
                    'type' => 'val_percent',
                    'info' => esc_html__("Maximum width of title in header area (Default: 90%)", 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Site Title', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_site_title',
                    'type' => 'select_hide',
                    'info' => esc_html__('Hide Site Title (Uses "display:none;" : SEO friendly.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Move Title/Tagline over Image', 'weaverx-theme-support' /*adm*/),
                    'id' => 'title_over_image',
                    'type' => 'checkbox',
                    'info' => esc_html__('Move the Title, Tagline, Search, Logo/HTML and Mini-Menu over the Header Image. This can make a very attractive header,', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Site Tagline', 'weaverx-theme-support' /*adm*/),
                    'id' => 'tagline',
                    'type' => 'titles',
                    'info' => esc_html__("The site's tagline (blog description)", 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left font-bold" style="font-size:120%;">&#x21cc;</span><small>' . esc_html__('Tagline Position', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'tagline_xy',
                    'type' => 'text_xy_percent',
                    'info' => esc_html__('Adjust default left and top margins for Tagline. (Default: X: 10% Y:0%)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('Tagline Max Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'tagline_max_w',
                    'type' => 'val_percent',
                    'info' => esc_html__("Maximum width of Tagline in header area (Default: 90%)", 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Site Tagline', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_site_tagline',
                    'type' => 'select_hide',
                    'info' => esc_html__('Hide Site Tagline (Uses "display:none;" : SEO friendly.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Title/Tagline Area BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'title_tagline_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('BG Color for the Title, Tagline, Search, Logo/HTML and Mini-Menu area.', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left font-bold" style="font-size:120%;">&#x21cc;</span><small>' . esc_html__('Title/Tagline Padding', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'title_tagline_xy',
                    'type' => 'text_tb',
                    'info' => esc_html__('Add Top/Bottom Padding to the Site Title/Tagline block. This option is especially useful if the Header Image is a BG image. (Default: 0,0)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-editor-code"></span><small>' . esc_html__('Weaver Site Logo/HTML', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => '_site_logo',
                    'type' => '+textarea',
                    'info' => esc_html__('HTML for Site Title area. (example: &lt;img src="url" style="position:absolute;top:20px;left:20px;"&nbsp;/&gt; + Custom CSS: #site-logo{min-height:123px;} (This is not the WP Custom Logo!) (&#9733;Plus) (&diams;)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Site Logo/HTML', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => '_hide_site_logo',
                    'type' => '+select_hide',
                    'info' => esc_html__('Hide Weaver Site Logo/HTML by device. (This is not the WP Custom Logo!) (&#9733;Plus) (&diams;)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left">{ }</span> <small>' . esc_html__('Add Classes', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'site_title_add_class',
                    'type' => '+widetext',
                    'info' => '<em>' . esc_html__('Title/Tagline', 'weaverx-theme-support' /*adm*/) . '</em>' . wp_kses_post(__(': Space separated class names to add to this area (<em>Advanced option</em>) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/)),
            ],


            ['type' => 'submit'],


            [
                    'name' => esc_html__('The Header Mini-Menu', 'weaverx-theme-support' /*adm*/),
                    'id' => '-menu',
                    'type' => 'subheader',
                    'info' => esc_html__('Horizontal "Mini-Menu" displayed right-aligned of Site Tagline', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Note:', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'info' => esc_html__('The Header Mini-Menu options are on the Menu Tab.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Header Widget Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_sb',
                    'type' => 'widget_area',
                    'info' => esc_html__('Horizontal Header Widget Area', 'weaverx-theme-support' /*adm*/),
            ],

            ['name' => esc_html__('Other Widget Area Options', 'weaverx-theme-support'), 'type' => 'break'],

            [
                    'name' => '<small>' . esc_html__('Header Widget Area Position', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'header_sb_position',
                    'type' => '+select_id',    //code
                    'info' => esc_html__('Change where Header Widget Area is displayed. (Default: Top) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'top', 'desc' => esc_html__('Top of Header', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'before_header', 'desc' => esc_html__('Before Header Image', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'after_header', 'desc' => esc_html__('After Header Image', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'after_html', 'desc' => esc_html__('After HTML Block', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'after_menu', 'desc' => esc_html__('After Lower Menu', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'pre_header', 'desc' => esc_html__('Pre-#header &lt;div&gt;', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'post_header', 'desc' => esc_html__('Post-#header &lt;div&gt;', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-kitchensink"></span>' . esc_html__('Fixed-Top Header Widget Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_sb_fixedtop',
                    'type' => 'checkbox',
                    'info' => wp_kses_post(__('Fix the Header Widget Area to top of page. If primary/secondary menus also fixed-top, header widget area will always be after secondary and before primary. Use the <em>Expand/Extend BG Attributes</em> on the "Full Width" tab to make a full width Header Widget Area.', 'weaverx-theme-support' /*adm*/)),
            ],

            ['type' => 'submit'],

            [
                    'name' => esc_html__('Header HTML', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_html',
                    'type' => 'widget_area',
                    'info' => esc_html__('Add arbitrary HTML to Header Area (in &lt;div id="header-html"&gt;)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-editor-code"></span>' . esc_html__('Header HTML content', 'weaverx-theme-support' /*adm*/),
                    'id' => 'header_html_text',
                    'type' => 'textarea',
                    'placeholder' => esc_html__('Any HTML, including shortcodes', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('Add arbitrary HTML to Header Area (in &lt;div id="header-html"&gt;)', 'weaverx-theme-support' /*adm*/),
                    'val' => 4,
            ],

            ['type' => 'submit'],

            [
                    'name' => esc_html__('Note:', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'info' => esc_html__('There are more standard WordPress Header options available on the Dashboard Appearance->Header panel.', 'weaverx-theme-support' /*adm*/),
            ],
    ];
// ******************************************* end off -1 **************************************************
    ?>

    <div class="options-intro">
        <?php echo wp_kses_post(__('<strong>Header:</strong> Options affecting the Header Area at the top of your site.', 'weaverx-theme-support' /*adm*/)); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#header-area"><?php esc_html_e('Header Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#header-image"><?php esc_html_e('Header Image', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#header-video"><?php esc_html_e('Header Video', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#site-title-tagline"><?php esc_html_e('Site Title/Tagline', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#header-widget-area"><?php esc_html_e('Header Widget Area', 'weaverx-theme-support' /*adm*/); ?></a>|
            <a href="#header-html"><?php esc_html_e('Header HTML', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);

    do_action('weaverxplus_admin', 'header_opts');
}

// ======================== Main Options > Menus ========================
function weaverx_mainopts_menus(): void
{
    $opts = [
            ['type' => 'submit'],
            [
                    'name' => esc_html__('Menu &amp; Info Bars', 'weaverx-theme-support' /*adm*/),
                    'id' => '-menu',
                    'type' => 'header',
                    'info' => esc_html__('Options affecting site Menus and the Info Bar', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#MenuBar',
            ],


        ##### SmartMenu
            [
                    'name' => '<span class="i-left dashicons dashicons-menu"></span>' . esc_html__('Use SmartMenus', 'weaverx-theme-support' /*adm*/),
                    'id' => 'use_smartmenus',
                    'type' => 'checkbox',
                    'info' => wp_kses_post(__('Use <em>SmartMenus</em> rather than default Weaver Xtreme Menus. <em>SmartMenus</em> provide enhanced menu support, including auto-visibility, and transition effects. This option is recommended. There are additional <em>Smart Menu</em> options available on the <em>Appearance &rarr; +Xtreme Plus</em> menu.', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => '<small>' . esc_html__('Menu Mobile/Desktop Switch Point', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'mobile_alt_switch',
                    'type' => '+val_px',
                    'info' => wp_kses_post(__('<em>SmartMenus Only:</em> Set when menu bars switch from desktop to mobile. (Default: 767px. Hint: use 768 to force mobile menu on iPad portrait.) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => esc_html__('Mega Menus:', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'info' => esc_html__('Weaver Xtreme Plus allows you to define Mega Menu style dropdown menu items with arbitrary HTML content. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Primary Menu Bar', 'weaverx-theme-support' /*adm*/),
                    'id' => 'm_primary',
                    'type' => 'menu_opts',
                    'info' => esc_html__('Attributes for the Primary Menu Bar (Default Location: Bottom of Header)', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],

            [
                    'name' => esc_html__('Secondary Menu Bar', 'weaverx-theme-support' /*adm*/),
                    'id' => 'm_secondary',
                    'type' => 'menu_opts',
                    'info' => esc_html__('Attributes for the Secondary Menu Bar (Default Location: Top of Header)', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],


            [
                    'name' => esc_html__('Options: All Menus', 'weaverx-theme-support' /*adm*/),
                    'id' => '-forms',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Menu Bar enhancements and features', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Current Page BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'menubar_curpage_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('BG Color for the currently displayed page and its ancestors.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Current Page Text', 'weaverx-theme-support' /*adm*/),
                    'id' => 'menubar_curpage_color',
                    'type' => 'color',
                    'info' => esc_html__('Color for the currently displayed page and its ancestors.', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-editor-bold"></span><small>' . esc_html__('Bold Current Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'menubar_curpage_bold',
                    'type' => 'checkbox',
                    'info' => esc_html__('Bold Face Current Page and ancestors', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-editor-italic"></span><small>' . esc_html__('Italic Current Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'menubar_curpage_em',
                    'type' => 'checkbox',
                    'info' => esc_html__('Italic Current Page and ancestors', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Do Not Highlight Ancestors', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'menubar_curpage_noancestors',
                    'type' => 'checkbox',
                    'info' => esc_html__('Highlight Current Page only - do not also highlight ancestor items', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Retain Menu Bar Hover BG', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'm_retain_hover',
                    'type' => 'checkbox',
                    'info' => esc_html__('Retain the menu bar hover BG color when sub-menus are opened.', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<small>' . esc_html__('Placeholder Hover Cursor', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'placeholder_cursor',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('CSS cursor :hover attribute for placeholder menus (e.g., Custom Menus with URL==#). (Default: pointer)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'pointer', 'desc' => esc_html__('Pointer (indicates link)', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'context-menu', 'desc' => esc_html__('Context Menu available', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'text', 'desc' => esc_html__('Text', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'none', 'desc' => esc_html__('No pointer', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'not-allowed', 'desc' => esc_html__('Action not allowed', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'default', 'desc' => esc_html__('The default cursor', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],


            [
                    'name' => '<small>' . esc_html__('Mobile Menu "Hamburger" Label', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'mobile_alt_label',
                    'type' => 'widetext',
                    'info' => esc_html__('Alternative label for the default mobile "Hamburger" icon. HTML allowed: &lt;span&gt; or &lt;img&gt; suggested.', 'weaverx-theme-support' /*adm*/),
            ],


            ['type' => 'submit'],

            [
                    'name' => esc_html__('Header Mini-Menu', 'weaverx-theme-support' /*adm*/),
                    'id' => '-menu',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Horizontal "Mini-Menu" displayed right-aligned of Site Tagline', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Mini-Menu', 'weaverx-theme-support' /*adm*/),
                    'id' => 'm_header_mini',
                    'type' => 'titles_text',
                    'info' => esc_html__('Color of Mini-Menu Link Items', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Mini Menu Hover', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'm_header_mini_hover_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Hover Color for Mini-Menu Links', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-align-none"></span><small>' . esc_html__('Mini Menu Top Margin', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'm_header_mini_top_margin_dec',
                    'type' => 'val_em',
                    'info' => esc_html__('Top margin for Mini-Menu. Negative value moves it up. (Default: 0em)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Mini Menu', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'm_header_mini_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Hide Mini Menu', 'weaverx-theme-support' /*adm*/),
            ],


            ['type' => 'submit'],


            [
                    'name' => esc_html__('Info Bar', 'weaverx-theme-support' /*adm*/),
                    'id' => 'infobar',
                    'type' => 'widget_area',
                    'info' => esc_html__('Info Bar : Breadcrumbs & Page Nav below primary menu', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Hide Breadcrumbs', 'weaverx-theme-support' /*adm*/),
                    'id' => 'info_hide_breadcrumbs',
                    'type' => 'checkbox',
                    'info' => esc_html__('Do not display the Breadcrumbs', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Hide Page Navigation', 'weaverx-theme-support' /*adm*/),
                    'id' => 'info_hide_pagenav',
                    'type' => 'checkbox',
                    'info' => esc_html__('Do not display the numbered Page navigation', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Show Search box', 'weaverx-theme-support' /*adm*/),
                    'id' => 'info_search',
                    'type' => 'checkbox',
                    'info' => esc_html__('Include a Search box on the right', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Show Log In', 'weaverx-theme-support' /*adm*/),
                    'id' => 'info_addlogin',
                    'type' => 'checkbox',
                    'info' => esc_html__('Include a simple Log In link on the right', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Breadcrumb for Home', 'weaverx-theme-support' /*adm*/),
                    'id' => 'info_home_label',
                    'type' => 'widetext', //code - option done in code
                    'info' => esc_html__('This lets you change the breadcrumb label for your home page. (Default: Home)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Info Bar Links', 'weaverx-theme-support' /*adm*/),
                    'id' => 'ibarlink',
                    'type' => 'link',
                    'info' => esc_html__('Color for links in Info Bar (uses Standard Link colors if left blank)', 'weaverx-theme-support' /*adm*/),
            ],
    ];

    ?>
    <div class="options-intro">
        <?php echo wp_kses_post(__('<strong>Menus:</strong> Options to control how your menus look.', 'weaverx-theme-support' /*adm*/)); ?><br/>
        <div class="options-intro-menu">
            <a href="#primary-menu-bar"><?php esc_html_e('Primary Menu Bar', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#secondary-menu-bar"><?php esc_html_e('Secondary Menu Bar', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#options-all-menus"><?php esc_html_e('Options: All Menus', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#header-mini-menu"><?php esc_html_e('Header Mini-Menu', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#info-bar"><?php esc_html_e('Info Bar', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#extra-menu"><?php esc_html_e('Extra Menu (X-Plus)', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php

    $all_opts = apply_filters('weaverxplus_menu_inject', $opts);

    weaverx_form_show_options($all_opts);

}


// ======================== Main Options > Content Areas ========================
function weaverx_mainopts_content(): void
{
    $opts = [
            ['type' => 'submit'],
            [
                    'name' => esc_html__('Content Areas', 'weaverx-theme-support' /*adm*/),
                    'id' => '-admin-page',
                    'type' => 'header',
                    'info' => esc_html__('Settings for the content areas (posts and pages)', 'weaverx-theme-support' /*adm*/),
                    'toggle' => 'content-areas',
                    'help' => 'help.html#ContentAreas',
            ],

            [
                    'name' => esc_html__('Content Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'content',
                    'type' => 'widget_area',
                    'info' => esc_html__('Area properties for page and post content', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Page Title', 'weaverx-theme-support' /*adm*/),
                    'id' => 'page_title',
                    'type' => 'titles',
                    'info' => esc_html__('Page titles, including pages, post single pages, and archive-like pages.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Bar under Title', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_title_underline_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Enter size in px if you want a bar under page title. Leave blank or 0 for no bar.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Space Between Title and Content', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'space_after_title_dec',
                    'type' => 'val_em',
                    'info' => esc_html__('Space between Page or Post title and beginning of content (Default: 1.0em)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Archive Pages Title Text', 'weaverx-theme-support' /*adm*/),
                    'id' => 'archive_title',
                    'type' => 'titles',
                    'info' => esc_html__('Archive-like page titles: archives, categories, tags, searches.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Content Links', 'weaverx-theme-support' /*adm*/),
                    'id' => 'contentlink',
                    'type' => 'link',
                    'info' => esc_html__('Color for links in Content', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Content Headings', 'weaverx-theme-support' /*adm*/),
                    'id' => 'content_h',
                    'type' => '+titles',
                    'info' => esc_html__('Headings (&lt;h1&gt;-&lt;h6&gt;) in page and post content (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],

            [
                    'name' => esc_html__('Text', 'weaverx-theme-support' /*adm*/),
                    'id' => '-text',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Text related options', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Space after paragraphs and lists', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'content_p_list_dec',
                    'type' => 'val_em',
                    'info' => esc_html__('Space after paragraphs and lists (Recommended: 1.5 em)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Page/Post Editor BG', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'editor_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('Alternative Background Color to use for Page/Post editor if you\'re using transparent or image backgrounds.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Input Area BG', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'input_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('Background color for text input (textareas) boxes.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Input Area Text', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'input_color',
                    'type' => 'color',
                    'info' => esc_html__('Text color for text input (textareas) boxes.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Auto Hyphenation', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hyphenate',
                    'type' => 'checkbox',
                    'info' => esc_html__('Allow browsers to automatically hyphenate text for appearance.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#9783;</span>' . esc_html__('Columns', 'weaverx-theme-support' /*adm*/),
                    'id' => 'page_cols',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('Automatically split all page content into columns using CSS column rules. Also can use Per Page option. (Always 1 column on IE&lt;=9.)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => '1', 'desc' => esc_html__('1 Column', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '2', 'desc' => esc_html__('2 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3', 'desc' => esc_html__('3 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '4', 'desc' => esc_html__('4 Columns', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],


            [
                    'name' => esc_html__('Search Boxes', 'weaverx-theme-support' /*adm*/),
                    'id' => '-search',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Search box related options', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Search Input BG', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'search_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('Background color for all search input boxes.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Search Input Text', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'search_color',
                    'type' => 'color',
                    'info' => esc_html__('Text color for all search input boxes.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Search Icon Color:', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('The Search Icon colored graphics used by previous versions of Weaver Xtreme have been discontinued. A text icon is now used. The color of the search icon is inherited from wrapping areas text color, including the header area and menu bar.', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
            ],


            ['type' => 'submit'],
            [
                    'name' => esc_html__('Images', 'weaverx-theme-support' /*adm*/),
                    'id' => '-format-image',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Image related options', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Image Border Color', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'media_lib_border_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Border color for images in Container and Footer.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('Image Border Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'media_lib_border_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Border width for images in Container and Footer. (Leave blank or set to 0 for no image borders.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-admin-page"></span><small>' . esc_html__('Show Image Shadows', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'show_img_shadows',
                    'type' => 'checkbox',
                    'info' => esc_html__('Add a shadow to images  in Container and Footer. Add CSS+ to Border Color for custom shadow.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Restrict Borders to Media Library', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'restrict_img_border',
                    'type' => 'checkbox',
                    'info' => esc_html__('For Container and Footer, restrict border and shadows to images from Media Library. Manually entered &lt;img&gt; HTML without Media Library classes will not have borders.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Caption text color', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'caption_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Color of captions - e.g., below media images.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Featured Image - Pages', 'weaverx-theme-support' /*adm*/),
                    'id' => '-id',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Display of Page Featured Images', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#10538;</span>' . esc_html__('Featured Image Location', 'weaverx-theme-support' /*adm*/),
                    'id' => 'page_fi_location',
                    'type' => 'fi_location',
                    'info' => esc_html__('Where to display Featured Image for Pages', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Full Width FI BG Image:', 'weaverx-theme-support' /*adm*/),
                    'info' => wp_kses_post(__('To create full width Page BG images from the FI, check the <em>Container Area Extend BG Attributes</em> box on the <em>Full Width</em> tab.', 'weaverx-theme-support' /*adm*/)),
                    'type' => 'note',
            ],
            [
                    'name' => esc_html__('Parallax FI BG Image:', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('It will usually be more useful to use the Per Page FI option to specify Parallax BG images.', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
            ],
            [
                    'name' => '<small>' . esc_html__('Page Content Height', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_min_height',
                    'type' => '+val_px',
                    'info' => esc_html__('Minimum Height Page Content with Parallax BG. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__('Featured Image Alignment', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_fi_align',
                    'type' => 'fi_align',
                    'info' => esc_html__('How to align the Featured Image', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Featured Image on Pages', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_fi_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Where to hide Featured Images on Pages (Posts have their own setting.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Page Featured Image Size', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_fi_size',
                    'type' => 'select_id',
                    'info' => esc_html__('Media Library Image Size for Featured Image on pages. (Header uses full size).', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'thumbnail', 'desc' => esc_html__('Thumbnail', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'medium', 'desc' => esc_html__('Medium', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'large', 'desc' => esc_html__('Large', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'full', 'desc' => esc_html__('Full', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('Featured Image Width, Pages', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_fi_width',
                    'type' => '+val_percent',
                    'info' => esc_html__('Width of Featured Image on Pages. Max Width in %, overrides FI Size selection. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__("Don't add link to FI", 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'page_fi_nolink',
                    'type' => '+checkbox',
                    'info' => esc_html__('Do not add link to Featured Image. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Lists - &lt;HR&gt; - Tables', 'weaverx-theme-support' /*adm*/),
                    'id' => '-list-view',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Other options related to content', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Content List Bullet', 'weaverx-theme-support' /*adm*/),
                    'id' => 'contentlist_bullet',
                    'type' => 'select_id',
                    'info' => esc_html__('Bullet used for Unordered Lists in Content areas', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'disc', 'desc' => esc_html__('Filled Disc', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'circle', 'desc' => esc_html__('Circle', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'square', 'desc' => esc_html__('Square', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'none', 'desc' => esc_html__('None', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => esc_html__('&lt;HR&gt; color', 'weaverx-theme-support' /*adm*/),
                    'id' => 'hr_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Color of horizontal (&lt;hr&gt;) lines in posts and pages.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Table Style', 'weaverx-theme-support' /*adm*/),
                    'id' => 'weaverx_tables',
                    'type' => 'select_id',
                    'info' => esc_html__('Style used for tables in content.', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'default', 'desc' => esc_html__('Theme Default', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'bold', 'desc' => esc_html__('Bold Headings', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'noborders', 'desc' => esc_html__('No Borders', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'fullwidth', 'desc' => esc_html__('Wide', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'wide', 'desc' => esc_html__('Wide 2', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'plain', 'desc' => esc_html__('Minimal', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => esc_html__('Comments', 'weaverx-theme-support' /*adm*/),
                    'id' => '-admin-comments',
                    'type' => 'subheader',
                    'info' => esc_html__('Settings for displaying comments', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Comment Headings', 'weaverx-theme-support' /*adm*/),
                    'id' => 'comment_headings_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Color for various headings in comment form', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Comment Content BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'comment_content_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('BG Color of Comment Content area', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Comment Submit Button BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'comment_submit_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('BG Color of "Post Comment" submit button', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left" style="font-size:200%;margin-left:4px;">&#x25a1;</span><small>' . esc_html__('Show Borders on Comments', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'show_comment_borders',
                    'type' => 'checkbox',
                    'info' => esc_html__('Show Borders around comment sections - improves visual look of comments.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Old Comments When Closed', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_old_comments',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide previous comments after closing comments for page or post. (Default: show old comments after closing.) (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . '<small>' . esc_html__('Show Allowed HTML', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'form_allowed_tags',
                    'type' => '+checkbox',
                    'info' => esc_html__('Show the allowed HTML tags below comment input box (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><span class="dashicons dashicons-admin-comments"></span>' .
                            '<small>' . esc_html__('Hide Comment Title Icon', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_comment_bubble',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the comment icon before the Comments title (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Separator Above Comments', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_comment_hr',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the (&lt;hr&gt;) separator line above the Comments area (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
    ];

    ?>
    <div class="options-intro">
        <?php echo wp_kses_post(__('<strong>Content Areas:</strong> Includes options common to both <em>Pages</em> and <em>Posts</em>. Options for <strong>Text</strong>, <strong>Padding</strong>, <strong>Images</strong>, <strong>Lists &amp; Tables</strong>, and user <strong>Comments</strong>.', 'weaverx-theme-support' /*adm*/)); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#content-area"><?php esc_html_e('Content Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#text"><?php esc_html_e('Text', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#search-boxes"><?php esc_html_e('Search Boxes', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#images"><?php esc_html_e('Images', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#featured-image-pages"><?php esc_html_e('Featured Image - Pages', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#lists-hr-tables"><?php esc_html_e('Lists - &lt;HR&gt; - Tables', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#comments"><?php esc_html_e('Comments', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);
    do_action('weaverxplus_admin', 'content_areas');
    ?>
    <span style="color:green;"><b><?php esc_html_e('Hiding/Enabling Page and Post Comments', 'weaverx-theme-support' /*adm*/); ?></b></span>
    <?php
    weaverx_help_link('help.html#LeavingComments', esc_html__('Help for Leaving Comments', 'weaverx-theme-support' /*adm*/));
    ?>
    <p>
        <?php echo wp_kses_post(__('Controlling "Reply/Leave a Comment" visibility for pages and posts is <strong>not</strong> a theme function. It is controlled by WordPress settings. Please click the ? just above to see the help file entry!', 'weaverx-theme-support' /*adm*/)); ?>
    </p>
    <?php
}