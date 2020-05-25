<?php

class True_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0  ) {

        global $wp_query;

        $icon = $title_before = $title_after = '';

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        if ( isset( $item->object ) && $item->object == 'service' ) {
            $icon = '<div class="service-menu-icon">' . get_field( 'regular_icon', $item->object_id ) . '</div>';
            $title_before = '<span>';
            $title_after = '</span>';
            $classes[] = 'service-menu-item service-id-' . $item->object_id;
        }
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>' . $icon;
        $item_output .= $args->link_before . $title_before . apply_filters('the_title', $item->title, $item->ID) . $title_after . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        if ( in_array( 'sign-in-link', $classes ) ) {
            $item_output .= get_ajax_login_form();
        }


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}






class Bottom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0  ) {

        global $wp_query;

        $icon = $title_before = $title_after = '';

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $title_data = explode( ' ', $item->title );
        $title = '';
        foreach( $title_data as $td ) {
            //if ( strlen( $td ) > 3 ) {
                $title .= '<span>' . $td . '</span>';
            /*}
            else {
                $title .= $td;
            }*/
        }

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>' . $icon;
        $item_output .= $args->link_before . $title_before . apply_filters( 'the_title', $title, $item->ID ) . $title_after . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



add_filter( 'bcn_template_tags', 'custom_bcn_template_tags', 100, 3 );

function custom_bcn_template_tags( $replacements, $type, $id ) {

    global $post;

    if ( $replacements['%type%'] == 'home' ) {
        $replacements['%title%'] = '';
        $replacements['%htitle%'] = '';
        $replacements['%ftitle%'] = '';
        $replacements['%fhtitle%'] = '';
    }

    if ( isset( $replacements['%title%'] ) && $replacements['%title%'] == 'Uncategorized' ) {
        $type = $replacements['%type%'];
        $current_item = preg_match( '/current-item/', $replacements['%type%'] ) ? ' current-item' : '';

        $replacements['%title%'] = 'news';
        $replacements['%link%'] = get_permalink( 72 );
        $replacements['%htitle%'] = 'news';
        $replacements['%type%'] = 'page' . $current_item;
        $replacements['%ftitle%'] = 'news';
        $replacements['%fhtitle%'] = 'news';

    }



    return $replacements;

}




add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    $phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = "smtp.ionos.de";
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = "587";
    $phpmailer->Username = "info@gft-sicherheit.de";
    $phpmailer->Password = "LmzzWuCQsNgrJjYqpinTPKMWE36TR$2aKiZ";
    $phpmailer->SMTPSecure = "STARTTLS";
    $phpmailer->CharSet = 'UTF-8';

    $phpmailer->isHTML( true );

    $phpmailer->smtpConnect(
        array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        )
    );

    $phpmailer->setFrom('info@gft-sicherheit.de', 'GFT Mailer');
    $phpmailer->addReplyTo('info@gft-sicherheit.de', 'GFT Informer');

    //$phpmailer->Subject = 'New Lead';


}





function get_wpdm_cat_menu() {

    global $udft, $wp_query;

    $query_cat = get_query_var( 'wpdmcategory' );
    if ( $query_cat != '' ) {
        $qc = get_term_by( 'slug', $query_cat, 'wpdmcategory' );
        $qc = $qc->term_id;
    }
    else {
        $qc = 0;
    }

    $args = array(
        'child_of'            => 0,
        'current_category'    => $qc,
        'depth'               => 0,
        'echo'                => 1,
        'exclude'             => '',
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 0,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'name',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories' ),
        'style'               => 'list',
        'taxonomy'            => 'wpdmcategory',
        'title_li'            => '',
        'use_desc_for_title'  => 1,
        'walker'              => new Custom_Walker_Category()
    );

    $categories = get_categories( $args );
    $cats = array();
    foreach( $categories as $cat ) {
        $t = dpdm_term_access_filter( $cat, $udft['user']['role'] );
        if ( $t ) $cats[] = $cat;
    }

    $out = walk_category_tree( $cats, 0, $args );
    $html = '<ul class="dpbm-cats">' . apply_filters( 'wp_list_categories', $out, $args ) . '</ul>';

    return $html;

}






class Custom_Walker_Category extends Walker {

    /**
     * What the class handles.
     *
     * @since 2.1.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'category';

    /**
     * Database fields to use.
     *
     * @since 2.1.0
     * @var array
     *
     * @see Walker::$db_fields
     * @todo Decouple this
     */
    public $db_fields = array(
        'parent' => 'parent',
        'id'     => 'term_id',
    );

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent<ul class='children'>\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::end_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     *
     * @since 2.1.0
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */

        global $udft;

        $cat_name = apply_filters( 'list_cats', esc_attr( $category->name ), $category );

        // Don't generate an element if the category name is empty.
        if ( '' === $cat_name ) {
            return;
        }

        $atts         = array();
        $atts['href'] = get_term_link( $category );

        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $atts['title'] = strip_tags( apply_filters( 'category_description', $category->description, $category ) );
        }

        /**
         * Filters the HTML attributes applied to a category list item's anchor element.
         *
         * @since 5.2.0
         *
         * @param array   $atts {
         *     The HTML attributes applied to the list item's `<a>` element, empty strings are ignored.
         *
         *     @type string $href  The href attribute.
         *     @type string $title The title attribute.
         * }
         * @param WP_Term $category Term data object.
         * @param int     $depth    Depth of category, used for padding.
         * @param array   $args     An array of arguments.
         * @param int     $id       ID of the current category.
         */
        $atts = apply_filters( 'category_list_link_attributes', $atts, $category, $depth, $args, $id );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $link = sprintf(
            '<a%s>%s<div class="open-category"></div></a>',
            $attributes,
            $cat_name
        );

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';

            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

            if ( empty( $args['feed'] ) ) {
                /* translators: %s: Category name. */
                $alt = ' alt="' . sprintf( __( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
            } else {
                $alt   = ' alt="' . $args['feed'] . '"';
                $name  = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }

            $link .= '>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . esc_url( $args['feed_image'] ) . "'$alt" . ' />';
            }
            $link .= '</a>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }

        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' (' . number_format_i18n( $category->count ) . ')';
        }
        if ( 'list' == $args['style'] ) {
            $output     .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );

            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms(
                    array(
                        'taxonomy'   => $category->taxonomy,
                        'include'    => $args['current_category'],
                        'hide_empty' => false,
                    )
                );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                        $css_classes[] = 'opened';
                        $link          = str_replace( '<a', '<a aria-current="page"', $link );
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                        $css_classes[] = 'opened';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] = 'current-cat-ancestor';
                            $css_classes[] = 'opened';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            $css_classes[] = 'depth-' . $depth;
            $term_children = get_term_children( filter_var( $category->term_id, FILTER_VALIDATE_INT ), filter_var( $category->taxonomy, FILTER_SANITIZE_STRING ) );
            if ( !empty( $term_children ) && !is_wp_error( $term_children ) ) {
                $css_classes[] = 'has-sub-categories';
            }

            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
            $css_classes = $css_classes ? ' class="' . esc_attr( $css_classes ) . '"' : '';

            $output .= $css_classes;
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.1.0
     *
     * @see Walker::end_el()
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $page   Not used.
     * @param int    $depth  Optional. Depth of category. Not used.
     * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
     *                       to output. See wp_list_categories(). Default empty array.
     */
    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] ) {
            return;
        }

        $output .= "</li>\n";
    }

}



if ( ! class_exists( 'CT_TAX_META' ) ) {

    class CT_TAX_META
    {

        public function __construct()
        {
            //
        }

        /*
         * Initialize the class and start calling our hooks and filters
         * @since 1.0.0
        */
        public function init()
        {
            add_action('service_cat_add_form_fields', array($this, 'add_category_image'), 10, 2);
            add_action('created_aervice_cat', array($this, 'save_category_image'), 10, 2);
            add_action('service_cat_edit_form_fields', array($this, 'update_category_image'), 10, 2);
            add_action('edited_service_cat', array($this, 'updated_category_image'), 10, 2);
            add_action('admin_enqueue_scripts', array($this, 'load_media'));
            add_action('admin_footer', array($this, 'add_script'));
        }

        public function load_media()
        {
            wp_enqueue_media();
        }

        /*
         * Add a form field in the new category page
         * @since 1.0.0
        */
        public function add_category_image($taxonomy)
        { ?>
            <div class="form-field term-group">
                <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button"
                           name="ct_tax_media_button" value="<?php _e('Add Image', 'hero-theme'); ?>"/>
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove"
                           name="ct_tax_media_remove" value="<?php _e('Remove Image', 'hero-theme'); ?>"/>
                </p>
            </div>
            <?php
        }

        /*
         * Save the form field
         * @since 1.0.0
        */
        public function save_category_image($term_id, $tt_id)
        {
            if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
                $image = $_POST['category-image-id'];
                add_term_meta($term_id, 'category-image-id', $image, true);
            }
        }

        /*
         * Edit the form field
         * @since 1.0.0
        */
        public function update_category_image($term, $taxonomy)
        { ?>
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
                </th>
                <td>
                    <?php $image_id = get_term_meta($term->term_id, 'category-image-id', true); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id"
                           value="<?php echo $image_id; ?>">
                    <div id="category-image-wrapper">
                        <?php if ($image_id) { ?>
                            <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button"
                               id="ct_tax_media_button" name="ct_tax_media_button"
                               value="<?php _e('Add Image', 'hero-theme'); ?>"/>
                        <input type="button" class="button button-secondary ct_tax_media_remove"
                               id="ct_tax_media_remove" name="ct_tax_media_remove"
                               value="<?php _e('Remove Image', 'hero-theme'); ?>"/>
                    </p>
                </td>
            </tr>
            <?php
        }

        /*
         * Update the form field value
         * @since 1.0.0
         */
        public function updated_category_image($term_id, $tt_id)
        {
            if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
                $image = $_POST['category-image-id'];
                update_term_meta($term_id, 'category-image-id', $image);
            } else {
                update_term_meta($term_id, 'category-image-id', '');
            }
        }

        /*
         * Add script
         * @since 1.0.0
         */
        public function add_script()
        { ?>
            <script>
                jQuery(document).ready(function ($) {
                    function ct_media_upload(button_class) {
                        var _custom_media = true,
                            _orig_send_attachment = wp.media.editor.send.attachment;
                        $('body').on('click', button_class, function (e) {
                            var button_id = '#' + $(this).attr('id');
                            var send_attachment_bkp = wp.media.editor.send.attachment;
                            var button = $(button_id);
                            _custom_media = true;
                            wp.media.editor.send.attachment = function (props, attachment) {
                                if (_custom_media) {
                                    $('#category-image-id').val(attachment.id);
                                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                    $('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                                } else {
                                    return _orig_send_attachment.apply(button_id, [props, attachment]);
                                }
                            }
                            wp.media.editor.open(button);
                            return false;
                        });
                    }

                    ct_media_upload('.ct_tax_media_button.button');
                    $('body').on('click', '.ct_tax_media_remove', function () {
                        $('#category-image-id').val('');
                        $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    });
                    // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
                    $(document).ajaxComplete(function (event, xhr, settings) {
                        var queryStringArr = settings.data.split('&');
                        if ($.inArray('action=add-tag', queryStringArr) !== -1) {
                            var xml = xhr.responseXML;
                            $response = $(xml).find('term_id').text();
                            if ($response != "") {
                                // Clear the thumb image
                                $('#category-image-wrapper').html('');
                            }
                        }
                    });
                });
            </script>
        <?php }

    }

    $CT_TAX_META = new CT_TAX_META();
    $CT_TAX_META->init();

}

