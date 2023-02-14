<?php
/**
 * Front Page Settings
 *
 * @package Blossom_Spa
 */

function blossom_spa_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'blossom-spa' ),
            'description' => __( 'Static Home Page settings.', 'blossom-spa' ),
        ) 
    );

    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'blossom-spa' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'blossom_spa_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'blossom_spa_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'blossom_spa_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
        'ed_banner_section',
        array(
            'default'           => 'static_banner',
            'sanitize_callback' => 'blossom_spa_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Spa_Select_Control(
            $wp_customize,
            'ed_banner_section',
            array(
                'label'       => __( 'Banner Options', 'blossom-spa' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'blossom-spa' ),
                'section'     => 'header_image',
                'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'blossom-spa' ),
                    'static_banner'    => __( 'Static/Video CTA Banner', 'blossom-spa' ),
                ),
                'priority' => 5 
            )            
        )
    );
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Relaxing Is Never Easy On Your Own', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.site-banner .banner-caption-inner h2.title',
        'render_callback' => 'blossom_spa_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Come and discover your oasis. It has never been easier to take a break from stress and the harmful factors that surround you every day!', 'blossom-spa' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Sub Title', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector' => '.site-banner .banner-caption-inner .description',
        'render_callback' => 'blossom_spa_get_banner_sub_title',
    ) );                

    /** Banner Label */
    $wp_customize->add_setting(
        'banner_cta1',
        array(
            'default'           => __( 'VIEW SERVICES', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_cta1',
        array(
            'label'           => __( 'Banner Button One Label', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_cta1', array(
        'selector' => '.site-banner .banner-caption-inner .btn-wrap .btn-transparent span',
        'render_callback' => 'blossom_spa_get_banner_cta_one',
    ) );

    /** Banner Link */
    $wp_customize->add_setting(
        'banner_cta1_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_cta1_url',
        array(
            'label'           => __( 'Banner Button One Link', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );

    /** Banner Label */
    $wp_customize->add_setting(
        'banner_cta2',
        array(
            'default'           => __( 'BOOK NOW', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_cta2',
        array(
            'label'           => __( 'Banner Button Two Label', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_cta2', array(
        'selector' => '.site-banner .banner-caption-inner .btn-wrap .btn-green span',
        'render_callback' => 'blossom_spa_get_banner_cta_two',
    ) );
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_cta2_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_cta2_url',
        array(
            'label'           => __( 'Banner Button Two Link', 'blossom-spa' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'blossom_spa_banner_ac'
        )
    );


    /** HR */
    $wp_customize->add_setting(
        'hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Note_Control( 
            $wp_customize,
            'hr',
            array(
                'section'     => 'header_image',
                'description' => '<hr/>',
                'active_callback' => 'blossom_spa_banner_ac'
            )
        )
    );
    /** Slider Settings Ends */
    
    /** Testimonial Section */
    $wp_customize->add_section(
        'testimonial',
        array(
            'title'    => __( 'Testimonial Section', 'blossom-spa' ),
            'priority' => 90,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'testimonial_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Note_Control( 
            $wp_customize,
            'testimonial_note_text',
            array(
                'section'     => 'testimonial',
                'description' => __( '<hr/>', 'blossom-spa' ),
            )
        )
    );
    
    /** Testimonial Title  */
    $wp_customize->add_setting(
        'testimonial_title',
        array(
            'default'           => __( 'Here\'s What Our Customers Think', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_title',
        array(
            'label'           => __( 'Testimonial Section Title', 'blossom-spa' ),
            'description'     => __( 'Add title for testimonial section.', 'blossom-spa' ),
            'section'         => 'testimonial',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_title', array(
        'selector' => '.testimonial-section .container h2.section-title',
        'render_callback' => 'blossom_spa_get_testimonial_title',
    ) );

    /** Testimonial Content  */
    $wp_customize->add_setting(
        'testimonial_content',
        array(
            'default'           => __( 'Our customers love us. We make sure that we make every customer happy. Showcase the feedback from your old customers to build trust with new customers using testimonials.', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_content',
        array(
            'label'           => __( 'Testimonial Section Description', 'blossom-spa' ),
            'description'     => __( 'Add description for testimonial section.', 'blossom-spa' ),
            'section'         => 'testimonial',
            'type'            => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_content', array(
        'selector' => '.testimonial-section .container .section-desc',
        'render_callback' => 'blossom_spa_get_testimonial_content',
    ) );

    $testimonial_section = $wp_customize->get_section( 'sidebar-widgets-testimonial' );
    if ( ! empty( $testimonial_section ) ) {

        $testimonial_section->panel     = 'frontpage_settings';
        $testimonial_section->priority  = 90;
        $wp_customize->get_control( 'testimonial_note_text' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_title' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_content' )->section  = 'sidebar-widgets-testimonial';
    }

    /** Team Section */
    $wp_customize->add_section(
        'team',
        array(
            'title'    => __( 'Team Section', 'blossom-spa' ),
            'priority' => 100,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'team_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Note_Control( 
            $wp_customize,
            'team_note_text',
            array(
                'section'     => 'team',
                'description' => __( '<hr/>', 'blossom-spa' ),
            )
        )
    );
    
    /** About Section Menu Label  */
    $wp_customize->add_setting(
        'team_title',
        array(
            'default'           => __( 'Meet Our Experienced Team Members', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'team_title',
        array(
            'label'           => __( 'Team Section Title', 'blossom-spa' ),
            'description'     => __( 'Add title for team section.', 'blossom-spa' ),
            'section'         => 'team',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'team_title', array(
        'selector' => '.team-section .container h2.section-title',
        'render_callback' => 'blossom_spa_get_team_title',
    ) );

    /** Team Content  */
    $wp_customize->add_setting(
        'team_content',
        array(
            'default'           => __( 'Some of our team members have 10+ years of experience. You can introduce your team members to give a more human feeling to the company.', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'team_content',
        array(
            'label'           => __( 'Team Section Description', 'blossom-spa' ),
            'description'     => __( 'Add description for team section.', 'blossom-spa' ),
            'section'         => 'team',
            'type'            => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'team_content', array(
        'selector' => '.team-section .container .section-desc',
        'render_callback' => 'blossom_spa_get_team_content',
    ) );

    $team_section = $wp_customize->get_section( 'sidebar-widgets-team' );
    if ( ! empty( $team_section ) ) {

        $team_section->panel     = 'frontpage_settings';
        $team_section->priority  = 100;
        $wp_customize->get_control( 'team_note_text' )->section  = 'sidebar-widgets-team';
        $wp_customize->get_control( 'team_title' )->section  = 'sidebar-widgets-team';
        $wp_customize->get_control( 'team_content' )->section  = 'sidebar-widgets-team';
    }

    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'blossom-spa' ),
            'priority' => 120,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_blog_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control( 
            $wp_customize,
            'ed_blog_section',
            array(
                'section'       => 'blog_section',
                'label'         => __( 'Enable Blog post section in FrontPage', 'blossom-spa' ),
            )
        )
    );   

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Read Our Recent Articles', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Title', 'blossom-spa' ),
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector' => '.recent-post-section .container h2.section-title',
        'render_callback' => 'blossom_spa_get_blog_title',
    ) );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_content',
        array(
            'default'           => __( 'Show your customers that you know what you are doing by writing helpful articles related to your business. You can display your recent blog posts here. To modify this section, go to Appearance > Customize > Front Page Settings > Blog Section.', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_content',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Description', 'blossom-spa' ),
            'type'    => 'textarea',
        )
    ); 

    $wp_customize->selective_refresh->add_partial( 'blog_section_content', array(
        'selector' => '.recent-post-section .container .section-desc',
        'render_callback' => 'blossom_spa_get_blog_content',
    ) );
    
    /** Readmore Label */
    $wp_customize->add_setting(
        'blog_readmore',
        array(
            'default'           => __( 'READ MORE', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_readmore',
        array(
            'label'           => __( 'Read More Label', 'blossom-spa' ),
            'section'         => 'blog_section',
            'type'            => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_readmore', array(
        'selector' => '.recent-post-section .container .grid .entry-footer .btn-readmore',
        'render_callback' => 'blossom_spa_get_blog_readmore',
    ) ); 
    
    /** View All Label */
    $wp_customize->add_setting(
        'blog_view_all',
        array(
            'default'           => __( 'VIEW MORE', 'blossom-spa' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_view_all',
        array(
            'label'           => __( 'View All Label', 'blossom-spa' ),
            'section'         => 'blog_section',
            'type'            => 'text',
            'active_callback' => 'blossom_spa_blog_view_all_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
        'selector' => '.recent-post-section .container .btn-wrap .btn-readmore',
        'render_callback' => 'blossom_spa_get_blog_view_all',
    ) ); 
    /** Blog Section Ends */

    $wp_customize->add_setting(
        'disable_all_section',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_spa_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Blossom_Spa_Toggle_Control(
            $wp_customize,
            'disable_all_section',
            array(
                'label'       => __( 'Enable to hide All Home Section', 'blossom-spa' ),
                'description' => __( 'Enable to show default content of home page instead of predefined home page sections.', 'blossom-spa' ),
                'section'     => 'static_front_page',
                'active_callback' => 'blossom_spa_is_front_page',
            )            
        )
    );
      
}
add_action( 'customize_register', 'blossom_spa_customize_register_frontpage' );