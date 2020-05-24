<?php

/*
Plugin Name: KC Addons

Version: 1.0
*/


add_action('init', 'kc_addons_init', 99 );

function kc_addons_init()
{

    if (function_exists('kc_add_map')) {


        kc_add_map(
            array(

                'lab_year_lines' => array(
                    'name' => 'Image Block',
                    'description' => __('Display a Image block', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'image',
                            'label' => 'Upload Image',
                            'type' => 'attach_image',
                            'admin_label' => true,
                        ),

                        array(
                            'name' => 'has_imag_description',
                            'label' => 'Has Image Description',
                            'type' => 'radio',
                            'options' => array(
                                'yes' => 'Has Description',
                                'no' => 'No Description',
                            )
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'img_options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'relation' => array(
                                'parent'    => 'has_imag_description',
                                'show_when' => 'yes'
                            ),
                            'options' => array('add_text' => __('Add new Image Set', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'image',
                                    'label' => 'Upload Image',
                                    'type' => 'attach_image',
                                    'admin_label' => true,
                                ),

                                array(
                                    'name' => 'image_name',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Image Name.', 'kc_addons'),
                                ),

                                array(
                                    'name' => 'image_description',
                                    'label' => 'Description',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Image Description.', 'kc_addons'),
                                ),

                            )

                        ),

                        array(
                            'name' => 'h4',
                            'label' => 'H4',
                            'type' => 'text',
                            'admin_label' => true,
                            'description' => __('Enter H4 Heading.', 'kc_addons')
                        ),

                        array(
                            'name' => 'description',
                            'label' => 'Description',
                            'type' => 'editor',
                            'admin_label' => true,
                            'description' => __('Enter Description.', 'kc_addons')
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'li',
                                    'label' => 'List Item',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter List Item.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('lab_year_lines', 'lab_year_lines');

        function lab_year_lines( $atts )
        {

            $lines = $atts['options'];

            if ( count( $lines ) > 0 ) {
                $left_list = '<ul class="ib-list left">';
                $right_list = '<ul class="ib-list right">';
                $list = '<div class="ib-list-box">';
                foreach ($lines as $i => $li) {
                    if ($i <= count($lines) / 2) {
                        $left_list .= '<li>' . $li->li . '</li>';
                    } else {
                        $right_list .= '<li>' . $li->li . '</li>';
                    }
                }
                $list .= $left_list . '</ul>' . $right_list . '</ul></div>';
            }
            else $list = '';
            if ( ( $atts['h4'] == '' || !isset( $atts['h4'] ) ) ) { $list = ''; }

            $h4 = ( $atts['h4'] == '' || !isset( $atts['h4'] ) ) ? '' : '<h4>' . $atts['h4'] . '</h4>';
            $top_line = ( $atts['h4'] == '' || !isset( $atts['h4'] ) ) ? '' : ''; // '<h3 class="ib-top-title">Firmenphilosophie</h3>'

            $block_img_style = '';
            $img_description = '';
            if ( !isset( $atts['has_imag_description'] ) || ( isset( $atts['has_imag_description'] ) && $atts['has_imag_description'] == '' ) ) {
                $img_block = '<div class="ib-img-box"><div class="ib-img" style="background-image:url(' . wp_get_attachment_url( $atts['image'] ) . ');">' . $img_description . '</div></div>';
            }
            if ( isset( $atts['has_imag_description'] ) && $atts['has_imag_description'] == 'yes' ) {
                if (isset($atts['img_options']) && is_array($atts['img_options']) && count($atts['img_options']) > 0) {
                    $imgs = '';
                    foreach( $atts['img_options'] as $i => $img_option ) {
                        if ( isset( $img_option->image_name ) ) {
                            $img_description =
                                '<div class="img-description">
                                 <div class="title">' . $img_option->image_name . '</div>
                                 <div class="description">' . $img_option->image_description . '</div>
                             </div>';
                            $imgs .= '<div class="ib-img ib-img-' . $i . '">' . $img_description . '</div>';
                            if ( $block_img_style == '' ) {
                                $block_img_style = ' style="background-image:url(' . wp_get_attachment_url($img_option->image) . ');"';
                            }
                        }
                    }
                    $img_block =
                        '<div class="ib-img-box" ' . $block_img_style . '>' .
                             $imgs .
                        '</div>';
                }
            }

            $out =
                '<div class="img-block-box">' .
                     $img_block .
                     '<div class="ib-content-box">
                         <div class="ib-content-bg"></div>
                         <div class="ib-content">' .
                             $top_line .
                             $h4 .
                             '<div class="ib-description">' . $atts['description'] . '</div>' .
                             $list .
                         '</div>
                     </div>
                 </div>';


            return $out;

        }



        kc_add_map(
            array(

                'loads_get_posts' => array(
                    'name' => 'Posts',
                    'description' => __('Display Posts', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'posts',
                            'label' => 'Posts',
                            'type' => 'multiple',
                            'options' => gft_get_posts_for_select(),
                            'admin_label' => true,
                            'description' => __('Select Posts.', 'kc_addons')
                        ),

                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('loads_get_posts', 'loads_get_posts');

        function loads_get_posts( $atts )
        {

            $query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3 ) );

            $out = '<h2 class="news-h2">news</h2>';

            $out .=
                '<div class="news-content">';

            foreach ( $query->posts as $i => $p ) {
                $out .= gft_get_single_new( $p, true );

            }

            $out .= '</div>';

            return $out;

        }


        kc_add_map(
            array(

                'gft_iconed_blocks' => array(
                    'name' => 'Iconed Block',
                    'description' => __('Display Iconed Blocks', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(


                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'icon',
                                    'label' => 'Select Icon',
                                    'type' => 'icon_picker',
                                    'admin_label' => true,
                                ),

                                array(
                                    'name' => 'title',
                                    'label' => 'Title',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter List Item.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'description',
                                    'label' => 'Description',
                                    'type' => 'textarea',
                                    'admin_label' => true,
                                    'description' => __('Enter Description.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('gft_iconed_blocks', 'gft_iconed_blocks');

        function gft_iconed_blocks( $atts )
        {

            $out = '';
            $data = $atts['options'];

            foreach( $data as $set ) {

                $out .= '<div class="uu-iconed-block-box">
                            <div class="uu-icon-box"><div class="uu-icon ' . $set->icon . '"></div></div>
                            <div class="uu-icon-content-box">
                                <div class="uu-icon-title">' . $set->title . '</div>
                                <div class="uu-icon-description">' . $set->description . '</div>
                            </div>
                        </div>';

            }


            return $out;

        }



        kc_add_map(
            array(

                'gft_list' => array(
                    'name' => 'Decorated List',
                    'description' => __('Display Decoreted List', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'title',
                            'label' => 'Title',
                            'type' => 'text',
                            'admin_label' => true,
                            'description' => __('Enter title.', 'kc_addons')
                        ),

                        array(
                            'name' => 'subtitle',
                            'label' => 'SubTitle',
                            'type' => 'text',
                            'admin_label' => true,
                            'description' => __('Enter Subtitle.', 'kc_addons')
                        ),

                        array(
                            'name' => 'image',
                            'label' => 'Upload Background Image',
                            'type' => 'attach_image',
                            'admin_label' => true,
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'li',
                                    'label' => 'List Item',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter List Item.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('gft_list', 'gft_list');

        function gft_list( $atts )
        {

            $data = $atts['options'];
            $style = ' style="background : linear-gradient( rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8) ), url(' . wp_get_attachment_url( $atts['image'] ) . ')";';
            $out =
                '<div class="gft-list-box full-width page-h2"' . $style . '>
                     <div class="gft-list-container container">
                         <h2>' . $atts['title'] . '</h2>
                         <div class="gft-list-subtitle">' . $atts['subtitle'] . '</div>
                         <ul class="gft-list">';

            foreach( $data as $set ) {

                $out .= '<li>' . $set->li . '</li>';

            }

            $out .= '</ul></div></div>';

            return $out;

        }





        kc_add_map(
            array(

                'gft_slider_box' => array(
                    'name' => 'Slider Block',
                    'description' => __('Slider Block', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'text',
                            'label' => 'Main text',
                            'type' => 'text',
                            'admin_label' => true,
                            'description' => __('Enter Main Text.', 'kc_addons')
                        ),

                        array(
                            'name' => 'image',
                            'label' => 'Upload Background Image',
                            'type' => 'attach_image',
                            'admin_label' => true,
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer'),
                            'options' => array('add_text' => __('Add new progress bar', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'image',
                                    'label' => 'Upload Background Image',
                                    'type' => 'attach_image',
                                    'admin_label' => true,
                                ),

                                array(
                                    'name' => 'title',
                                    'label' => 'Title',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Title.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'phone',
                                    'label' => 'Main Phone',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Phone.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'email',
                                    'label' => 'Email',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Email.', 'kc_addons')
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('gft_slider_box', 'gft_slider_box');

        function gft_slider_box( $atts )
        {

            $slides = $atts['options'];
            $slides_html = '<div class="gft-slides-container">';
            foreach( $slides as $i => $slide ) {
                $style = ' style="background:linear-gradient( rgba(35, 55, 108, 0.7), rgba(35, 55, 108, 0.7) ), url(' . wp_get_attachment_url( $slide->image ) . ') no-repeat 50% 50%";';
                $slides_html .=
                    '<div class="gft-slide-item-box" ' . $style . '>
                         <div class="gft-slide-item">
                             <div lang="de" class="gft-slide-title">' . umlauts( $slide->title ) . '</div>
                             <div class="gft-dots"><div class="gft-dot"></div><div class="gft-dot"></div><div class="gft-dot"></div></div>
                             <div class="gft-slide-phone"><a href="tel:' . preg_replace( '/\s/', '', $slide->phone ) . '">' . $slide->phone . '</a></div>
                             <div class="gft-slide-email"><a href="mailto:' . $slide->email . '">' . $slide->email . '</a></div>
                         </div>
                     </div>';
            }
            $slides_html .= '</div>';
            $style = ' style="background-image:url(' . wp_get_attachment_url( $atts['image'] ) . ')";';
            $out =
                '<div class="gft-slide-block">
                     <div class="gft-slide-text" ' . $style . '><div class="gft-slide-text-content">' . $atts['text'] . '</div></div>
                     <div class="gft-slides">' . $slides_html . '</div>
                </div>';



            return $out;

        }





        kc_add_map(
            array(

                'gft_tabs' => array(
                    'name' => 'GFT Tabs',
                    'description' => __('GFT Tabs', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(


                        array(
                            'type' => 'group',
                            'label' => __('Options', 'KingComposer'),
                            'name' => 'options',
                            'description' => __('New Tab', 'KingComposer'),
                            'options' => array('add_text' => __('Add Tab', 'kingcomposer')),

                            'params' => array(

                                array(
                                    'name' => 'title',
                                    'label' => 'Title',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter Title.', 'kc_addons')
                                ),

                                array(
                                    'name' => 'icon',
                                    'label' => 'SVG Icon',
                                    'type' => 'text',
                                    'admin_label' => true,
                                    'description' => __('Enter SVG Icon', 'kc_addons')
                                ),

                                array(
                                    'name' => 'content',
                                    'label' => 'Content',
                                    'type' => 'editor',
                                    'admin_label' => true,
                                ),

                            ),
                        ),
                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('gft_tabs', 'gft_tabs');

        function gft_tabs( $atts )
        {

            $contents = $atts['options'];
            $nav = $items = '';

            foreach( $contents as $i => $data ) {
                $nav .=
                    '<div class="gft-tab-nav-item" data-n="' .  $i. '">
                         <div class="tni-icon-box"><div class="tni-icon">' . $data->icon . '</div></div>
                         <div class="tni-nav-title"><span>' . $data->title . '</span></div>
                     </div>';

                $items .=
                    '<div class="gft-tab-content-item" data-n="' . $i . '">' .$data->content . '<div class="tab-mail-box">Bewerbungen bitte ausschließlich per E-Mail an <a href="mailto:karriere@gft-sicherheit.de">karriere@gft-sicherheit.de</a></div></div>';
            }
            $content = '<div class="gft-tab-contents">' . $items . '</div>';

            $out =
                '<div class="gft-tabs-box">
                     <div class="gft-tab-nav-box">' . $nav . '</div>
                     <div class="gft-tab-content-box">' . $content . '</div>
                 </div>';

            return $out;

        }




        kc_add_map(
            array(

                'gft_legend_block' => array(
                    'name' => 'Legend Block',
                    'description' => __('Legend Block', 'kc_addons'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'LAB',
                    'params' => array(

                        array(
                            'name' => 'title',
                            'label' => 'Title',
                            'type' => 'editor',
                            'admin_label' => true,
                            'description' => __('Left Column Content', 'kc_addons')
                        ),

                        array(
                            'name' => 'description',
                            'label' => 'Description',
                            'type' => 'editor',
                            'admin_label' => true,
                            'description' => __('Right Column Content', 'kc_addons')
                        ),

                    )
                ),  // End of elemnt kc_service

            )
        ); // End add map


        add_shortcode('gft_legend_block', 'gft_legend_block');

        function gft_legend_block( $atts )
        {

            global $gft;

            $out =
                '<div class="agency-legend">
                     <div class="al-left"><p>' . $atts['title'] . get_logo1() . '</p></div>
                     <div class="al-right">' . $atts['description'] . '</div>
                </div>';

            return $out;

        }



    }


    add_shortcode ( 'get_logo1', 'get_logo1' );

    function get_logo1() {

        global $gft;

        return $gft['logo1'];

    }

}







