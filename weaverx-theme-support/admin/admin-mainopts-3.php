<?php
// File refactored: 2026-03-26 12:18 (MST)
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Main Options
 * admin-mainopts-3
*  __ added: 12/9/14 split: 03/26/2026
 * This function will start the main sapi form, which will be closed in admin-adminopts
 */

// part 3 of former file...


// ======================== Main Options > Post Specifics ========================
function weaverx_mainopts_posts(): void
{
    $opts = [
            ['type' => 'submit'],
            [
                    'name' => esc_html__('Post Specifics', 'weaverx-theme-support' /*adm*/),
                    'id' => '-admin-post',
                    'type' => 'header',
                    'info' => esc_html__('Settings affecting Posts', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#PPSpecifics',
            ],

            [
                    'name' => esc_html__('Post Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post',
                    'type' => 'widget_area',
                    'info' => esc_html__('Use these settings to override Content Area settings for Posts (blog entries).', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Sticky Post BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'stickypost_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('BG color for sticky posts, author info. (Add {border:none;padding:0;} to CSS to make sticky posts same as regular posts.)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Reset Major Content Options', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'reset_content_opts',
                    'type' => 'checkbox',
                    'info' => esc_html__('Clear wrapping Content Area bg, borders, padding, and top/bottom margins for views with posts. Allows more flexible post settings.', 'weaverx-theme-support' /*adm*/),
            ],


            ['type' => 'submit'],


            [
                    'name' => esc_html__('Post Title', 'weaverx-theme-support' /*adm*/),
                    'id' => '-text',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Options for the Post Title', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Post Title', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_title',
                    'type' => 'titles',
                    'info' => esc_html__("Post title (Blog Views)", 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Bar under Post Titles', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_title_underline_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Enter size in px if you want a bar under page title. Leave blank or 0 for no bar.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Post Title Hover', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_title_hover_color',
                    'type' => 'ctext',
                    'info' => esc_html__('Color if you want the Post Title to show alternate color for hover', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Space After Post Title', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_title_bottom_margin_dec',
                    'type' => 'val_em',
                    'info' => esc_html__('Space between Post Title and Post Info Line or content. (Default: 0.15em)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-admin-comments"></span><small>' . esc_html__('Show Comment Bubble', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'show_post_bubble',
                    'type' => 'checkbox',
                    'info' => esc_html__("Show comment bubble with link to comments on the post info line.", 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . wp_kses_post(__('Hide <em>Post Format</em> Icons', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'hide_post_format_icon',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the icons for posts with Post Format specified. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => esc_html__('Post Layout', 'weaverx-theme-support' /*adm*/),
                    'id' => '-schedule',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Layout of Posts', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#9783;</span>' . esc_html__('Post Content Columns', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_cols',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('Automatically split all post content into columns for both blog and single page views. <em>This is post content only.</em> This is not the same as "Columns of Posts". (IE&lt;=9 will display 1 col.)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => '1', 'desc' => esc_html__('1 Column', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '2', 'desc' => esc_html__('2 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3', 'desc' => esc_html__('3 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '4', 'desc' => esc_html__('4 Columns', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#9783;</span>' . esc_html__('Columns of Posts', 'weaverx-theme-support' /*adm*/),
                    'id' => 'blog_cols',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('Display posts on blog page with this many columns. (You should adjust "Display posts on blog page with this many columns" on Settings:Reading to be a multiple of this value.)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => '1', 'desc' => esc_html__('1 Column', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '2', 'desc' => esc_html__('2 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3', 'desc' => esc_html__('3 Columns', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#9783;</span><small>' . esc_html__('Use Columns on Archive Pages', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'archive_cols',
                    'type' => 'checkbox',    //code
                    'info' => esc_html__('Display posts on archive-like pages using columns. (Archive, Author, Category, Tag)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('First Post One Column', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'blog_first_one',
                    'type' => 'checkbox',
                    'info' => esc_html__('Always display the first post in one column.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Sticky Posts One Column', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'blog_sticky_one',
                    'type' => 'checkbox',
                    'info' => esc_html__("Display opening Sticky Posts in one column. If First Post One Column also checked, then first non-sticky post will be one column.", 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#9783;</span><small>' . wp_kses_post(__('Use <em>Masonry</em> for Posts', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'masonry_cols',
                    'type' => 'select_id',    //code
                    'info' => wp_kses_post(__('Use the <em>Masonry</em> blog layout option to show dynamically packed posts on blog and archive-like pages. Overrides "Columns of Posts" setting. <em>Not compatible with full width FI BG images.</em>', 'weaverx-theme-support' /*adm*/)),
                    'value' => [
                            ['val' => '0', 'desc' => ''],
                            ['val' => '2', 'desc' => esc_html__('2 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '3', 'desc' => esc_html__('3 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '4', 'desc' => esc_html__('4 Columns', 'weaverx-theme-support' /*adm*/)],
                            ['val' => '5', 'desc' => esc_html__('5 Columns', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => '<small>' . wp_kses_post(__('Compact <em>Post Format</em> Posts', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'compact_post_formats',
                    'type' => 'checkbox',
                    'info' => wp_kses_post(__('Use compact layout for <em>Post Format</em> posts (Image, Gallery, Video, etc.). Useful for photo blogs and multi-column layouts. Looks great with <em>Masonry</em>.', 'weaverx-theme-support' /*adm*/)),
            ],
            [
                    'name' => esc_html__('Photo Bloging', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('Read the Help entry for information on creating a Photo Blog page', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'help' => 'help.html#PhotoBlog',
            ],


            ['type' => 'submit'],

            [
                    'name' => esc_html__('Excerpts / Full Posts', 'weaverx-theme-support' /*adm*/),
                    'id' => '-excerpt-view',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('How to display posts in  Blog / Archive Views', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Show Full Blog Posts', 'weaverx-theme-support' /*adm*/),
                    'id' => 'fullpost_blog',
                    'type' => 'checkbox',
                    'info' => esc_html__('Will display full blog post instead of excerpts on <em>blog pages</em>.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Full Post for Archives', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'fullpost_archive',
                    'type' => 'checkbox',
                    'info' => esc_html__('Display the full posts instead of excerpts on <em>special post pages</em>. (Archives, Categories, etc.) Does not override manually added &lt;--more--> breaks.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Full Post for Searches', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'fullpost_search',
                    'type' => 'checkbox',
                    'info' => esc_html__('Display the full posts instead of excerpts for Search results. Does not override manually added &lt;--more--> breaks.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . wp_kses_post(__('Full text for 1st <em>"n"</em> Posts', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'fullpost_first',
                    'type' => 'val_num',
                    'info' => esc_html__('Display the full post for the first "n" posts on Blog pages. Does not override manually added &lt;--more--> breaks.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Excerpt length', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'excerpt_length',
                    'type' => 'val_num',
                    'info' => esc_html__('Change post excerpt length. (Default: 40 words)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . wp_kses_post(__('<em>Continue reading</em> Message', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'excerpt_more_msg',
                    'type' => 'widetext',
                    'info' => wp_kses_post(__('Change default <em>Continue reading &rarr;</em> message for excerpts. Can include HTML (e.g., &lt;img>).', 'weaverx-theme-support' /*adm*/)),
            ],
            ['type' => 'endheader'],


            [
                    'name' => esc_html__('Post Navigation', 'weaverx-theme-support' /*adm*/),
                    'id' => '-leftright',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Navigation for moving between posts', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Blog Navigation Style', 'weaverx-theme-support' /*adm*/),
                    'id' => 'nav_style',
                    'type' => 'select_id',
                    'info' => esc_html__('Style of navigation links on blog pages: "Older/Newer posts", "Previous/Next Post", or by page numbers', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'old_new', 'desc' => esc_html__('Older/Newer', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'prev_next', 'desc' => esc_html__('Previous/Next', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'paged_left', 'desc' => esc_html__('Paged - Left', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'paged_right', 'desc' => esc_html__('Paged - Right', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Top Links', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'nav_hide_above',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the blog navigation links at the top (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Bottom Links', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'nav_hide_below',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the blog navigation links at the bottom (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Show Top on First Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'nav_show_first',
                    'type' => '+checkbox',
                    'info' => esc_html__('Show navigation at top even on the first page (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Single Page Navigation Style', 'weaverx-theme-support' /*adm*/),
                    'id' => 'single_nav_style',
                    'type' => 'select_id',
                    'info' => esc_html__('Style of navigation links on post Single pages: Previous/Next, by title, or none', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'title', 'desc' => esc_html__('Post Titles', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'prev_next', 'desc' => esc_html__('Previous/Next', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'hide', 'desc' => esc_html__('None - no display', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<small>' . esc_html__('Link to Same Categories', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'single_nav_link_cats',
                    'type' => '+checkbox',
                    'info' => esc_html__('Single Page navigation links point to posts with same categories. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Top Links', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'single_nav_hide_above',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the single page navigation links at the top (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Bottom Links', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'single_nav_hide_below',
                    'type' => '+checkbox',
                    'info' => esc_html__('Hide the single page navigation links at the bottom (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],
            [
                    'name' => esc_html__('Post Meta Info Areas', 'weaverx-theme-support' /*adm*/),
                    'id' => '-info',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Top and Bottom Post Meta Information areas', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Top Post Info', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_info_top',
                    'type' => 'titles_text',
                    'info' => esc_html__("Top Post info line", 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide top post info', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_info_hide_top',
                    'type' => 'checkbox',    //code
                    'info' => esc_html__('Hide entire top info line (posted on, by) of post.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Bottom Post Info', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_info_bottom',
                    'type' => 'titles_text',
                    'info' => esc_html__('The bottom post info line', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide bottom post info', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_info_hide_bottom',
                    'type' => 'checkbox',    //code
                    'info' => esc_html__('Hide entire bottom info line (posted in, comments) of post.', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span>' . esc_html__('Show Author Avatar', 'weaverx-theme-support' /*adm*/),
                    'id' => 'show_post_avatar',
                    'type' => 'select_id',    //code
                    'info' => esc_html__('Show author avatar on the post info line (also can be set per post with post editor)', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'hide', 'desc' => esc_html__('Do Not Show', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'start', 'desc' => esc_html__('Start of Info Line', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'end', 'desc' => esc_html__('End of Info Line', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],

            [
                    'name' => '<small>' . esc_html__('Avatar size', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_avatar_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Size of Avatar in px. (Default: 28px)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Use Icons in Post Info', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_icons',
                    'type' => 'select_id',
                    'info' => esc_html__('Use Icons instead of Text descriptions in Post Meta Info', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'text', 'desc' => esc_html__('Text Descriptions', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'fonticons', 'desc' => esc_html__('Font Icons', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'graphics', 'desc' => esc_html__('Graphic Icons', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<small>' . esc_html__('Font Icons Color', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_icons_color',
                    'type' => 'color',
                    'info' => esc_html__('Color for Font Icons (Default: Post Info text color)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span style="color:red">' . esc_html__('Note:', 'weaverx-theme-support' /*adm*/) . '</span>',
                    'type' => 'note',
                    'info' => esc_html__('Hiding any meta info item automatically uses Icons instead of text descriptions.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Post Date', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_hide_date',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide the post date everywhere it is normally displayed.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Post Author', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_hide_author',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide the post author everywhere it is normally displayed.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Post Categories', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_hide_categories',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide the post categories wherever they are normally displayed.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Post Tags', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_hide_tags',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide the post tags wherever they are normally displayed.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Permalink', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_permalink',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide the permalink.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Category if Only One', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_singleton_category',
                    'type' => 'checkbox',
                    'info' => esc_html__('If there is only one overall category defined (Uncategorized), don\'t show Category of post.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Author for Single Author Site', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_hide_single_author',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide author information if site has only a single author.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Post Info Links', 'weaverx-theme-support' /*adm*/),
                    'id' => 'ilink',
                    'type' => 'link',
                    'info' => esc_html__('Links in post information top and bottom lines.', 'weaverx-theme-support' /*adm*/),
            ],

            ['type' => 'submit'],


            [
                    'name' => esc_html__('Featured Image - Posts', 'weaverx-theme-support' /*adm*/),
                    'id' => '-id',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Display of Post Featured Images', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => esc_html__('Full Width FI BG Image:', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'info' => wp_kses_post(__('To create full width Post BG images from the FI, check the <em>Post Area Extend BG Attributes</em> box at <em>Full Width</em> tab.', 'weaverx-theme-support' /*adm*/)),
            ],

            [
                    'name' => '<small>' . esc_html__("Don't add link to FI", 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_fi_nolink',
                    'type' => '+checkbox',
                    'info' => esc_html__('Do not add link to Featured Image for any post layout. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#10538;</span>' . esc_html__('FI Location - Full Post', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_full_fi_location',
                    'type' => 'fi_location_post',
                    'info' => esc_html__('Where to display Featured Image for full blog posts.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Post Height - Blog View', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_blog_min_height',
                    'type' => '+val_px',
                    'info' => esc_html__('Minimum Height of Post, full or excerpt, with Parallax BG in blog views. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__('FI Alignment - Full post', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_full_fi_align',
                    'type' => 'fi_align',
                    'info' => esc_html__('Featured Image alignment', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide FI - Full Posts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_full_fi_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Hide Featured Images on full blog posts.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('FI Size - Full Posts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_full_fi_size',
                    'type' => 'select_id',
                    'info' => esc_html__('Media Library Image Size for Featured Image on full posts.', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'thumbnail', 'desc' => esc_html__('Thumbnail', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'medium', 'desc' => esc_html__('Medium', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'large', 'desc' => esc_html__('Large', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'full', 'desc' => esc_html__('Full', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('FI Width, Full Posts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_full_fi_width',
                    'type' => '+val_percent',
                    'info' => esc_html__('Width of Featured Image on Full Posts.  Max Width in %, overrides FI Size selection. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#10538;</span>' . esc_html__('FI Location - Excerpts', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_excerpt_fi_location',
                    'type' => 'fi_location_post',
                    'info' => esc_html__('Where to display Featured Image for posts displayed as excerpt.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__('FI Alignment - Excerpts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_excerpt_fi_align',
                    'type' => 'fi_align',
                    'info' => esc_html__('How to align the Featured Image', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide FI - Excerpts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_excerpt_fi_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Where to hide Featured Images on full blog posts.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>FI Size - Excerpts</small>',
                    'id' => 'post_excerpt_fi_size',
                    'type' => 'select_id',
                    'info' => esc_html__('Media Library Image Size for Featured Image on excerpts.', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'thumbnail', 'desc' => esc_html__('Thumbnail', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'medium', 'desc' => esc_html__('Medium', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'large', 'desc' => esc_html__('Large', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'full', 'desc' => esc_html__('Full', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('FI Width, Excerpts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_excerpt_fi_width',
                    'type' => '+val_percent',
                    'info' => esc_html__('Width of Featured Image on excerpts.  Max Width in %, overrides FI Size selection. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            [
                    'name' => '<span class="i-left" style=font-size:120%;">&nbsp;&#10538;</span>' . esc_html__('FI Location - Single Page', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_fi_location',
                    'type' => 'fi_location',
                    'info' => esc_html__('Where to display Featured Image for posts on single page view.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<small>' . esc_html__('Post Height - Single Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_min_height',
                    'type' => '+val_px',
                    'info' => esc_html__('Minimum Height of Post with Parallax BG in Single Page view. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Parallax FI BG Image:', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__('It will usually be more useful to use the Per Post FI option to specify Parallax BG images.', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-editor-alignleft"></span><small>' . esc_html__('FI Alignment - Single Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_fi_align',
                    'type' => 'fi_align',
                    'info' => esc_html__('How to align the Featured Image on Single Page View.', 'weaverx-theme-support' /*adm*/),
            ],

            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide FI - Single Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_fi_hide',
                    'type' => 'select_hide',
                    'info' => esc_html__('Where to hide Featured Images on single page view.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('FI Size - Single Posts', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_fi_size',
                    'type' => 'select_id',
                    'info' => esc_html__('Media Library Image Size for Featured Image on single page view.', 'weaverx-theme-support' /*adm*/),
                    'value' => [
                            ['val' => 'thumbnail', 'desc' => esc_html__('Thumbnail', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'medium', 'desc' => esc_html__('Medium', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'large', 'desc' => esc_html__('Large', 'weaverx-theme-support' /*adm*/)],
                            ['val' => 'full', 'desc' => esc_html__('Full', 'weaverx-theme-support' /*adm*/)],
                    ],
            ],
            [
                    'name' => '<span class="i-left" style="font-size:150%;">&harr;</span><small>' . esc_html__('FI Width, Single Page', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'post_fi_width',
                    'type' => '+val_percent',
                    'info' => esc_html__('Width of Featured Image on single page view. Max Width in %, overrides FI Size selection. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ],


            ['type' => 'submit'],


            [
                    'name' => esc_html__('More Post Related Options', 'weaverx-theme-support' /*adm*/),
                    'id' => '-forms',
                    'type' => 'subheader_alt',
                    'info' => esc_html__('Other options related to post display, including single pages.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . wp_kses_post(__('Show <em>Comments are closed.</em>', 'weaverx-theme-support' /*adm*/)) . '</small>',
                    'id' => 'show_comments_closed',
                    'type' => 'checkbox',
                    'info' => esc_html__('If comments are off, and no comments have been made, show the <em>Comments are closed.</em> message.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => esc_html__('Author Info BG', 'weaverx-theme-support' /*adm*/),
                    'id' => 'post_author_bgcolor',
                    'type' => 'ctext',
                    'info' => esc_html__('Background color used for Author Bio.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<span class="i-left dashicons dashicons-visibility"></span><small>' . esc_html__('Hide Author Bio', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'hide_author_bio',
                    'type' => 'checkbox',
                    'info' => esc_html__('Hide display of author bio box on Author Archive and Single Post page views.', 'weaverx-theme-support' /*adm*/),
            ],
            [
                    'name' => '<small>' . esc_html__('Allow comments for attachments', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'allow_attachment_comments',
                    'type' => 'checkbox',
                    'info' => esc_html__('Allow visitors to leave comments for attachments (usually full size media image - only if comments allowed).', 'weaverx-theme-support' /*adm*/),
            ],
    ];

    ?>


    <div class="options-intro">
        <?php echo wp_kses_post(__('<strong>Post Specifics: </strong> Options related to <strong>Posts</strong>, including <strong>Background</strong> color, <strong>Columns</strong> displayed on blog pages, <strong>Title</strong> options, <strong>Navigation</strong> to earlier and later posts, the post <strong>Info Lines</strong>, <strong>Excerpts</strong>, and <strong>Featured Image</strong> handling.', 'weaverx-theme-support' /*adm*/)); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#post-area"><?php esc_html_e('Post Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#post-title"><?php esc_html_e('Post Title', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#post-layout"><?php esc_html_e('Post Layout', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#excerpts-full-posts"><?php esc_html_e('Excerpts / Full Posts', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#post-navigation"><?php esc_html_e('Post Navigation', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#post-meta-info-areas"><?php esc_html_e('Post Meta Info Areas', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#featured-image-posts"><?php esc_html_e('Featured Image - Posts', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#more-post-related-options"><?php esc_html_e('More Post Related Options', 'weaverx-theme-support' /*adm*/); ?></a>
            |
            <a href="#custom-post-info-lines"><?php esc_html_e('Custom Post Info Lines', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);
    do_action('weaverxplus_admin', 'post_specifics');
    ?>
    <span style="color:green;"><b><?php esc_html_e('Hiding/Enabling Page and Post Comments', 'weaverx-theme-support' /*adm*/); ?></b></span>
    <?php
    weaverx_help_link('help.html#LeavingComments', esc_html__('Help for Leaving Comments', 'weaverx-theme-support' /*adm*/));
    ?>
    <p>
        <?php echo wp_kses_post(__('Controlling "Reply/Leave a Comment" visibility for pages and posts is <strong>not</strong> a theme function. It is controlled by WordPress settings. Please click the ? just above to see the help file entry! (Additional options for comment <em>styling</em> are found on the Content Areas tab.)', 'weaverx-theme-support' /*adm*/)); ?>
    </p>
    <?php
}

// ======================== Main Options > Footer ========================
function weaverx_mainopts_footer(): void
{
    $opts = array(
            array('type' => 'submit'),

            array(
                    'name' => esc_html__('Footer Options', 'weaverx-theme-support' /*adm*/),
                    'id' => '-admin-generic',
                    'type' => 'header',
                    'info' => esc_html__('Settings for the footer', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#FooterOpt',
            ),


            array(
                    'name' => esc_html__('Footer Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'footer',
                    'type' => 'widget_area',
                    'info' => esc_html__('Properties for the footer area.', 'weaverx-theme-support' /*adm*/),
            ),
            array(
                    'name' => esc_html__('Footer Links', 'weaverx-theme-support' /*adm*/),
                    'id' => 'footerlink',
                    'type' => 'link',
                    'info' => esc_html__('Color for links in Footer (Uses Standard Link colors if left blank).', 'weaverx-theme-support' /*adm*/),
            ),

            array('name' => esc_html__('Footer Other options', 'weaverx-theme-support'), 'type' => 'break'),

            array(
                    'name' => esc_html__('Global Footer Area Replacement', 'weaverx-theme-support'),
                    'id' => 'pb_footer_replace_page_id',
                    'type' => 'widetext',
                    'info' => esc_html__('Provide any page or post ID to serve as global replacement for entire Footer area. This will override and replace most other settings in this section.', 'weaverx-theme-support'),
            ),
            array(
                    'name' => '<small>' . esc_html__('Page Builder Replacements', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'type' => 'note',
                    'info' => esc_html__('The Customizer interface has options to specify a Replacement Area from page builders.', 'weaverx-theme-support' /*adm*/),
            ),

            array('type' => 'submit'),

            array(
                    'name' => esc_html__('Footer Widget Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'footer_sb',
                    'type' => 'widget_area_submit',
                    'info' => esc_html__('Properties for the Footer Widget Area.', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Footer HTML', 'weaverx-theme-support' /*adm*/),
                    'id' => 'footer_html',
                    'type' => 'widget_area',
                    'info' => esc_html__('Add arbitrary HTML to Footer Area (in &lt;div id=\"footer-html\"&gt;)', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => '<span class="i-left dashicons dashicons-editor-code"></span>' . esc_html__('Footer HTML content', 'weaverx-theme-support' /*adm*/),
                    'id' => 'footer_html_text',
                    'type' => 'textarea',
                    'placeholder' => esc_html__('Any HTML, including shortcodes.', 'weaverx-theme-support' /*adm*/),
                    'info' => esc_html__("Add arbitrary HTML", 'weaverx-theme-support' /*adm*/),
                    'val' => 4,
            ),
            array('type' => 'submit'),
    );

    ?>
    <div class="options-intro">
        <?php echo wp_kses_post(__( '<strong>Footer: </strong> 	Options affecting the <strong>Footer</strong> area, including <strong>Background</strong>
color, <strong>Borders</strong>, and the <strong>Copyright</strong> message.', 'weaverx-theme-support' /*adm*/ )); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#footer-area"><?php esc_html_e('Footer Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#footer-widget-area"><?php esc_html_e('Footer Widget Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#footer-html"><?php esc_html_e('Footer HTML', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#site-copyright"><?php esc_html_e('Site Copyright', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php
    weaverx_form_show_options($opts);
    do_action('weaverxplus_admin', 'footer_opts');
    ?>
    <a id="site-copyright"></a>
    <strong>&copy;</strong>&nbsp;<span
        style="color:blue;"><b><?php esc_html_e('Site Copyright', 'weaverx-theme-support' /*adm*/); ?></b></span>
    <br/>
    <small>
        <?php echo wp_kses_post(__( 'If you fill this in, the default copyright notice in the footer will be replaced with the text here.
It will not automatically update from year to year.
Use &amp;copy; to display &copy;.
You can use other HTML as well.
Use <span class="style4">&amp;nbsp;</span> to hide the copyright notice. &diams;', 'weaverx-theme-support' /*adm*/ )); ?>
    </small>
    <br/>

    <span class="dashicons dashicons-editor-code"></span>
    <?php weaverx_textarea(weaverx_getopt('copyright'), 'copyright', 1, ' ', 'width:85%;'); ?>
    <br>
    <label><span
                class="dashicons dashicons-visibility"></span> <?php esc_html_e('Hide Powered By tag:', 'weaverx-theme-support' /*adm*/); ?>
        <input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_poweredby'); ?>"
               id="_hide_poweredby" <?php checked(weaverx_getopt_checked('_hide_poweredby')); ?> />
    </label>
    <small><?php esc_html_e('Check this to hide the "Proudly powered by" notice in the footer.', 'weaverx-theme-support' /*adm*/); ?></small>
    <br/><br/>
    <?php esc_html_e('You can add other content to the Footer from the Advanced Options:HTML Insertion tab.', 'weaverx-theme-support' /*adm*/); ?>
    <?php
}

// ======================== Main Options > Widget Areas ========================
function weaverx_mainopts_widgets(): void
{
    $opts = array(
            array('type' => 'submit'),
            array(
                    'name' => esc_html__('Sidebar Options', 'weaverx-theme-support' /*adm*/),
                    'id' => '-screenoptions',
                    'type' => 'header',
                    'info' => esc_html__('Settings affecting main Sidebars and individual widgets', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#WidgetAreas',
            ),

            array(
                    'name' => esc_html__('Individual Widgets', 'weaverx-theme-support' /*adm*/),
                    'id' => 'widget',
                    'type' => 'widget_area',
                    'info' => esc_html__('Properties for individual widgets (e.g., Text, Recent Posts, etc.)', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Widget Title', 'weaverx-theme-support' /*adm*/),
                    'id' => 'widget_title',
                    'type' => 'titles',
                    'info' => esc_html__('Color for Widget Titles.', 'weaverx-theme-support' /*adm*/),
            ),
            array(
                    'name' => esc_html__('Bar under Widget Titles', 'weaverx-theme-support' /*adm*/),
                    'id' => 'widget_title_underline_int',
                    'type' => 'val_px',
                    'info' => esc_html__('Enter size in px if you want a bar under Widget Titles. Leave blank or 0 for no bar.', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Widget List Bullet', 'weaverx-theme-support' /*adm*/),
                    'id' => 'widgetlist_bullet',
                    'type' => 'select_id',
                    'info' => esc_html__('Bullet used for Unordered Lists in Widget areas.', 'weaverx-theme-support' /*adm*/),
                    'value' => array(
                            array('val' => 'disc', 'desc' => esc_html__('Filled Disc (default)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'circle', 'desc' => esc_html__('Circle', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'square', 'desc' => esc_html__('Square', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'none', 'desc' => esc_html__('None', 'weaverx-theme-support' /*adm*/)),
                    ),
            ),

            array(
                    'name' => esc_html__('Widget Links', 'weaverx-theme-support' /*adm*/),
                    'id' => 'wlink',
                    'type' => 'link',
                    'info' => esc_html__('Color for links in widgets (uses Standard Link colors if left blank).', 'weaverx-theme-support' /*adm*/),
            ),

            array('type' => 'submit'),


            array(
                    'name' => esc_html__('Primary Widget Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'primary',
                    'type' => 'widget_area_submit',
                    'info' => esc_html__('Properties for the Primary (Upper/Left) Sidebar Widget Area.', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Secondary Widget Area', 'weaverx-theme-support' /*adm*/),
                    'id' => 'secondary',
                    'type' => 'widget_area_submit',
                    'info' => esc_html__('Properties for the Secondary (Lower/Right) Sidebar Widget Area.', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Top Widget Areas', 'weaverx-theme-support' /*adm*/),
                    'id' => 'top',
                    'type' => 'widget_area_submit',
                    'info' => esc_html__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaverx-theme-support' /*adm*/),
            ),


            array(
                    'name' => esc_html__('Bottom Widget Areas', 'weaverx-theme-support' /*adm*/),
                    'id' => 'bottom',
                    'type' => 'widget_area',
                    'info' => esc_html__('Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaverx-theme-support' /*adm*/),
            ),

    );

    weaverx_form_show_options($opts);
    ?>
    <hr/>
    <span style="color:blue;"><b>Define Per Page Extra Widget Areas</b></span>
    <?php
    weaverx_help_link('help.html#PPWidgets', 'Help for Per Page Widget Areas');
    ?>
    <br/>
    <small>
        <?php echo wp_kses_post(__( 'You may define extra widget areas that can then be used in the <em>Per Page</em> settings, or in the <em>Weaver Xtreme Plus</em> [widget_area] shortcode.
Enter a list of one or more widget area names separated by commas.
Your names should include only letters, numbers, or underscores - no spaces or other special characters.
The widgets areas will then appear on the Appearance->Widgets menus.
They can be included on individual pages by adding the name you define here to the "Weaver Xtreme Options For This Page" box on the Edit Page screen. (&diams;)', 'weaverx-theme-support' /*adm*/ )); ?>
    </small>
    <br/>
    <?php weaverx_textarea(weaverx_getopt('_perpagewidgets'), '_perpagewidgets', 1, ' ', $style = 'width:60%;', $class = 'wvrx-edit'); ?>
    <?php
    do_action('weaverxplus_admin', 'widget_areas');
}

// ======================== Main Options > Layout ========================
function weaverx_mainopts_layout(): void
{
    $opts = array(
            array('type' => 'submit'),
            array(
                    'name' => esc_html__('Sidebar Layout', 'weaverx-theme-support' /*adm*/),
                    'id' => '-welcome-widgets-menus',
                    'type' => 'header',
                    'info' => esc_html__('Sidebar Layout for each type of page ("stack top" used for mobile view)', 'weaverx-theme-support' /*adm*/),
                    'help' => 'help.html#layout',
            ),

            array(
                    'name' => esc_html__('Blog, Post, Page Default', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_default',
                    'type' => 'select_id',
                    'info' => esc_html__('Select the default theme layout for blog, single post, attachments, and pages.', 'weaverx-theme-support' /*adm*/),
                    'value' => array(
                            array('val' => 'right', 'desc' => esc_html__('Sidebars on Right', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'right-top', 'desc' => esc_html__('Sidebars on Right (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'left', 'desc' => esc_html__(' Sidebars on Left', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'left-top', 'desc' => esc_html__(' Sidebars on Left (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'split', 'desc' => esc_html__('Split - Sidebars on Right and Left', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'split-top', 'desc' => esc_html__('Split (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'one-column', 'desc' => esc_html__('No sidebars, content only', 'weaverx-theme-support' /*adm*/)),
                    ),
            ),

            array(
                    'name' => esc_html__('Archive-like Default', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_default_archive',
                    'type' => 'select_id',
                    'info' => esc_html__('Select the default theme layout for all other pages - archives, search, etc.', 'weaverx-theme-support' /*adm*/),
                    'value' => array(
                            array('val' => 'right', 'desc' => esc_html__('Sidebars on Right', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'right-top', 'desc' => esc_html__('Sidebars on Right (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'left', 'desc' => esc_html__(' Sidebars on Left', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'left-top', 'desc' => esc_html__(' Sidebars on Left (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'split', 'desc' => esc_html__('Split - Sidebars on Right and Left', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'split-top', 'desc' => esc_html__('Split (stack top)', 'weaverx-theme-support' /*adm*/)),
                            array('val' => 'one-column', 'desc' => esc_html__('No sidebars, content only', 'weaverx-theme-support' /*adm*/)),
                    ),
            ),

            array(
                    'name' => esc_html__('Page', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_page',
                    'type' => 'select_layout',
                    'info' => esc_html__('Layout for normal Pages on your site.', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => esc_html__('Blog', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_blog',
                    'type' => 'select_layout',
                    'info' => esc_html__('Layout for main blog page. Includes "Page with Posts" Page templates.', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => esc_html__('Post Single Page', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_single',
                    'type' => 'select_layout',
                    'info' => esc_html__('Layout for Posts displayed as a single page.', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),

            array(
                    'name' => esc_html__('Attachments', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_image',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for attachment pages such as images. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),

            array(
                    'name' => esc_html__('Date Archive', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_archive',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for archive by date pages. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),

            array(
                    'name' => esc_html__('Category Archive', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_category',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for category archive pages. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => esc_html__('Tags Archive', 'weaverx-theme-support' /*adm*/),
                    'id' => 'layout_tag',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for tag archive pages. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),

            array(
                    'name' => wp_kses_post(__('Author Archive</small>', 'weaverx-theme-support' /*adm*/)),
                    'id' => 'layout_author',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for author archive pages. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => wp_kses_post(__('Search Results, 404</small>', 'weaverx-theme-support' /*adm*/)),
                    'id' => 'layout_search',
                    'type' => '+select_layout',
                    'info' => esc_html__('Layout for search results and 404 pages. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),

            array(
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span><small>' . esc_html__('Left Sidebar Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'left_sb_width_int',
                    'type' => 'val_percent',
                    'info' => esc_html__('Width for Left Sidebar (Default: 25%)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span><small>' . esc_html__('Right Sidebar Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'right_sb_width_int',
                    'type' => 'val_percent',
                    'info' => esc_html__('Width for Right Sidebar (Default: 25%)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span><small>' . esc_html__('Split Left Sidebar Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'left_split_sb_width_int',
                    'type' => 'val_percent',
                    'info' => esc_html__('Width for Split Sidebar, Left Side (Default: 25%)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span><small>' . esc_html__('Split Right Sidebar Width', 'weaverx-theme-support' /*adm*/) . '</small>',
                    'id' => 'right_split_sb_width_int',
                    'type' => 'val_percent',
                    'info' => esc_html__('Width for Split Sidebar, Right Side (Default: 25%)', 'weaverx-theme-support' /*adm*/),
                    'value' => '',
            ),
            array(
                    'name' => '<span class="i-left" style="font-size:120%;">&harr;</span> ' . esc_html__('Content Width:', 'weaverx-theme-support' /*adm*/),
                    'type' => 'note',
                    'info' => esc_html__('The width of content area automatically determined by sidebar layout and width', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Flow color to bottom', 'weaverx-theme-support' /*adm*/),
                    'id' => 'flow_color',
                    'type' => '+checkbox',
                    'info' => esc_html__('If checked, Content and Sidebar bg colors will flow to bottom of the Container (that is, equal heights). You must provide background colors for the Content and Sidebars or the default bg color will be used. (&#9733;Plus)', 'weaverx-theme-support' /*adm*/),
            ),

            array(
                    'name' => esc_html__('Alt Page Themes', 'weaverx-theme-support' /*adm*/),
                    'id' => '-editor-codex',
                    'type' => 'header_area',
                    'info' => esc_html__('&#9733; Weaver Xtreme Plus (V 3.1.1 or later) allows you to set Alternative Themes for the blog, single, and other archive-like pages.', 'weaverx-theme-support' /*adm*/),
            ),


    );
    ?>
    <div class="options-intro">
        <strong>Sidebars &amp; Layout: </strong>
        <?php echo wp_kses_post(__( 'Options affecting <strong>Sidebar Layout</strong> and the main <strong>Sidebar Areas</strong>.
This includes properties of individual <strong>Widgets</strong>, as well as properties of various <strong>Sidebars</strong>.', 'weaverx-theme-support' /*adm*/ )); ?>
        <br/>
        <div class="options-intro-menu">
            <a href="#sidebar-layout"><?php esc_html_e('Sidebar Layout', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#individual-widgets"><?php esc_html_e('Individual Widgets', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#primary-widget-area"><?php esc_html_e('Primary Widget Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#secondary-widget-area"><?php esc_html_e('Secondary Widget Area', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#top-widget-areas"><?php esc_html_e('Top Widget Areas', 'weaverx-theme-support' /*adm*/); ?></a> |
            <a href="#bottom-widget-areas"><?php esc_html_e('Bottom Widget Areas', 'weaverx-theme-support' /*adm*/); ?></a>
        </div>
    </div>
    <?php

    weaverx_form_show_options($opts);
    do_action('weaverxplus_admin', 'layout');   // add new layout option?
}