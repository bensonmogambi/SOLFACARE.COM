<?php
/**
 * General Settings
 *
 * @package Blossom_Spa
 */

function blossom_spa_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'blossom-spa' ),
            'description' => __( 'Customize Header, Social, Sharing, SEO, Post/Page, Newsletter, Performance and Miscellaneous settings.', 'blossom-spa' ),
        ) 
    );

    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'blossom-spa' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );

    /** Enable Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_header_search',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Enable Header Search', 'blossom-spa' ),
                'description' => __( 'Enable to show Search button in header.', 'blossom-spa' ),
            )
        )
    );
        
    /** Phone */
    $wp_customize->add_setting(
        'phone_label',
        array(
            'default'           => __( 'Phone Number', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'

        )
    );
    
    $wp_customize->add_control(
        'phone_label',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Phone Label', 'blossom-spa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'phone_label', array(
        'selector' => '.header-contact .contact-block span.hphone-label',
        'render_callback' => 'blossom_spa_get_phone_label',
    ) );
    
    $wp_customize->add_setting(
        'phone',
        array(
            'default'           => __( '+123-456-7890', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'phone',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Phone', 'blossom-spa' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'phone', array(
        'selector' => '.header-contact .contact-block p.hphone',
        'render_callback' => 'blossom_spa_get_phone',
    ) );
    /** Email */

    $wp_customize->add_setting(
        'email_label',
        array(
            'default'           => __( 'Email', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'email_label',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Email Label', 'blossom-spa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'email_label', array(
        'selector' => '.header-contact .contact-block span.hemail-label',
        'render_callback' => 'blossom_spa_get_email_label',
    ) );

    $wp_customize->add_setting(
        'email',
        array(
            'default'           => __( 'mail@domain.com', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'email',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Email', 'blossom-spa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'email', array(
        'selector' => '.header-contact .contact-block p.hemail',
        'render_callback' => 'blossom_spa_get_email',
    ) );

    /** Email */

    $wp_customize->add_setting(
        'opening_hours_label',
        array(
            'default'           => __( 'Opening Hours', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'opening_hours_label',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Opening Hours Label', 'blossom-spa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'opening_hours_label', array(
        'selector' => '.header-contact .contact-block span.hopening-label',
        'render_callback' => 'blossom_spa_get_opening_hours_label',
    ) );

    $wp_customize->add_setting(
        'opening_hours',
        array(
            'default'           => __( 'Mon - Fri: 7AM - 7PM', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'opening_hours',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Opening Hours', 'blossom-spa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'opening_hours', array(
        'selector' => '.header-contact .contact-block p.hopening',
        'render_callback' => 'blossom_spa_get_opening_hours',
    ) );

    $wp_customize->add_setting( 'header_background_image',
        array(
            'default'           => esc_url( get_template_directory_uri() . '/images/header-bg.jpg' ),
            'sanitize_callback' => 'blossom_spa_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'header_background_image',
            array(
                'label'         => esc_html__( 'Header Background Image', 'blossom-spa' ),
                'description'   => esc_html__( 'Choose background Image of your choice. Recommended size for this image is 1920px by 232px. Works on archive, search pages.', 'blossom-spa' ),
                'section'       => 'header_settings',
                'type'          => 'image',
            )
        )
    );
    /** Header Settings Ends */

    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'blossom-spa' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_social_links',
            array(
                'section'     => 'social_media_settings',
                'label'       => __( 'Enable Social Links', 'blossom-spa' ),
                'description' => __( 'Enable to show social links at header and in footer.', 'blossom-spa' ),
            )
        )
    );
    
    $wp_customize->add_setting( 
        new Blossom_Spa_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Blossom_Spa_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Control_Repeater(
            $wp_customize,
            'social_links',
            array(
                'section' => 'social_media_settings',               
                'label'   => __( 'Social Links', 'blossom-spa' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'blossom-spa' ),
                        'description' => __( 'Example: fab fa-facebook-f', 'blossom-spa' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'blossom-spa' ),
                        'description' => __( 'Example: https://facebook.com', 'blossom-spa' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'blossom-spa' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                )                         
            )
        )
    );
    /** Social Media Settings Ends */

    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'blossom-spa' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_post_update_date',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Last Update Post Date', 'blossom-spa' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'blossom-spa' ),
            )
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_breadcrumb',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Breadcrumb', 'blossom-spa' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'blossom-spa' ),
            )
        )
    );
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => __( 'Breadcrumb Home Text', 'blossom-spa' ),
        )
    );  
    /** SEO Settings Ends */

    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'blossom-spa' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_prefix_archive',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Prefix in Archive Page', 'blossom-spa' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'blossom-spa' ),
            )
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_excerpt',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Enable Blog Excerpt', 'blossom-spa' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'blossom-spa' ),
            )
        )
    );
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 30,
            'sanitize_callback' => 'blossom_spa_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Slider_Control( 
            $wp_customize,
            'excerpt_length',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Excerpt Length', 'blossom-spa' ),
                'description' => __( 'Automatically generated excerpt length (in words).', 'blossom-spa' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 100,
                    'step'  => 5,
                )                 
            )
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Read More', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'blossom-spa' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'blossom_spa_get_read_more',
    ) );

    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Note_Control( 
            $wp_customize,
            'post_note_text',
            array(
                'section'     => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'blossom-spa' ), '<hr/>' ),
            )
        )
    );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_related',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Related Posts', 'blossom-spa' ),
                'description' => __( 'Enable to show related posts in single page.', 'blossom-spa' ),
            )
        )
    );
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'Recommended Articles', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'blossom-spa' ),
            'active_callback' => 'blossom_spa_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .post-title span',
        'render_callback' => 'blossom_spa_get_related_title',
    ) );
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Comments', 'blossom-spa' ),
                'description' => __( 'Enable to hide Comments in Single Post/Page.', 'blossom-spa' ),
            )
        )
    );
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_category',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Category', 'blossom-spa' ),
                'description' => __( 'Enable to hide category.', 'blossom-spa' ),
            )
        )
    );
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_post_author',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Post Author', 'blossom-spa' ),
                'description' => __( 'Enable to hide post author.', 'blossom-spa' ),
            )
        )
    );
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_post_date',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Hide Posted Date', 'blossom-spa' ),
                'description' => __( 'Enable to hide posted date.', 'blossom-spa' ),
            )
        )
    );
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_featured_image',
            array(
                'section'         => 'post_page_settings',
                'label'           => __( 'Show Featured Image', 'blossom-spa' ),
                'description'     => __( 'Enable to show featured image in post detail (single post).', 'blossom-spa' ),
                'active_callback' => 'blossom_spa_post_page_ac'
            )
        )
    );
    /** Posts(Blog) & Pages Settings Ends */

    /** Instagram Settings */
    $wp_customize->add_section(
        'instagram_settings',
        array(
            'title'    => __( 'Instagram Settings', 'blossom-spa' ),
            'priority' => 70,
            'panel'    => 'general_settings',
        )
    );
    
    if( blossom_spa_is_btif_activated() ){
        /** Enable Instagram Section */
        $wp_customize->add_setting( 
            'ed_instagram', 
            array(
                'default'           => false,
                'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Blossom_Spa_Toggle_Control( 
                $wp_customize,
                'ed_instagram',
                array(
                    'section'     => 'instagram_settings',
                    'label'       => __( 'Instagram Section', 'blossom-spa' ),
                    'description' => __( 'Enable to show Instagram Section', 'blossom-spa' ),
                )
            )
        );
        
        /** Note */
        $wp_customize->add_setting(
            'instagram_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Blossom_Spa_Note_Control( 
                $wp_customize,
                'instagram_text',
                array(
                    'section'     => 'instagram_settings',
                    'description' => sprintf( __( 'You can change the setting of BlossomThemes Social Feed %1$sfrom here%2$s.', 'blossom-spa' ), '<a href="' . esc_url( admin_url( 'admin.php?page=class-blossomthemes-instagram-feed-admin.php' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );        
    }else{
        /** Note */
        $wp_customize->add_setting(
            'instagram_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Blossom_Spa_Note_Control( 
                $wp_customize,
                'instagram_text',
                array(
                    'section'     => 'instagram_settings',
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Social Feed%2$s. After that option related with this section will be visible.', 'blossom-spa' ), '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );
    }

    /** Instagram Settings End */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'blossom-spa' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'misc_settings',
                'label'           => __( 'Shop Page Description', 'blossom-spa' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'blossom-spa' ),
                'active_callback' => 'blossom_spa_is_woocommerce_activated'
            )
        )
    );
    /** Miscellaneous Settings Ends */
}
add_action( 'customize_register', 'blossom_spa_customize_register_general' );