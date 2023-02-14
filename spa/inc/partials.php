<?php
/**
 * Blossom Spa Customizer Partials
 *
 * @package Blossom_Spa
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blossom_spa_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blossom_spa_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'blossom_spa_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function blossom_spa_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'Read More', 'blossom-spa' ) ) );    
}
endif;

if( ! function_exists( 'blossom_spa_get_banner_title' ) ) :
/**
 * Display Banner Title
*/
function blossom_spa_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title', __( 'Relaxing Is Never Easy On Your Own', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_banner_sub_title' ) ) :
/**
 * Display Banner SubTitle
*/
function blossom_spa_get_banner_sub_title(){
    return wpautop( wp_kses_post( get_theme_mod( 'banner_subtitle', __( 'Come and discover your oasis. It has never been easier to take a break from stress and the harmful factors that surround you every day!', 'blossom-spa' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_banner_cta_one' ) ) :
/**
 * Display Banner Button Label One
*/
function blossom_spa_get_banner_cta_one(){
    return esc_html( get_theme_mod( 'banner_cta1', __( 'VIEW SERVICES', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_banner_cta_two' ) ) :
/**
 * Display Banner Button Label Two
*/
function blossom_spa_get_banner_cta_two(){
    return esc_html( get_theme_mod( 'banner_cta2', __( 'BOOK NOW', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_team_title' ) ) :
/**
 * Display Team Title
*/
function blossom_spa_get_team_title(){
    return esc_html( get_theme_mod( 'team_title', __( 'Meet Our Experienced Team Members', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_team_content' ) ) :
/**
 * Display Team Content
*/
function blossom_spa_get_team_content(){
    return esc_html( get_theme_mod( 'team_content', __( 'Some of our team members have 10+ years of experience. You can introduce your team members to give a more human feeling to the company.', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_blog_title' ) ) :
/**
 * Display Blog Title
*/
function blossom_spa_get_blog_title(){
    return esc_html( get_theme_mod( 'blog_section_title', __( 'Read Our Recent Articles', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_blog_content' ) ) :
/**
 * Display Blog Content
*/
function blossom_spa_get_blog_content(){
    return wpautop( wp_kses_post( get_theme_mod( 'blog_section_content', __( 'Show your customers that you know what you are doing by writing helpful articles related to your business. You can display your recent blog posts here. To modify this section, go to Appearance > Customize > Front Page Settings > Blog Section.', 'blossom-spa' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_blog_readmore' ) ) :
/**
 * Display Blog Readmore button
*/
function blossom_spa_get_blog_readmore(){
    return esc_html( get_theme_mod( 'blog_readmore', __( 'READ MORE', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_blog_view_all' ) ) :
/**
 * Display Blog View all button
*/
function blossom_spa_get_blog_view_all(){
    return esc_html( get_theme_mod( 'blog_view_all', __( 'VIEW MORE', 'blossom-spa' ) ) );
}
endif;


if( ! function_exists( 'blossom_spa_get_testimonial_title' ) ) :
/**
 * Display Testimonial Title
*/
function blossom_spa_get_testimonial_title(){
    return esc_html( get_theme_mod( 'testimonial_title', __( 'Here\'s What Our Customers Think', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_testimonial_content' ) ) :
/**
 * Display Testimonial Content
*/
function blossom_spa_get_testimonial_content(){
    return wpautop( wp_kses_post( get_theme_mod( 'testimonial_content', __( 'Our customers love us. We make sure that we make every customer happy. Showcase the feedback from your old customers to build trust with new customers using testimonials.', 'blossom-spa' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_phone_label' ) ) :
/**
 * Header Phone Label
*/
function blossom_spa_get_phone_label(){
    return esc_html( get_theme_mod( 'phone_label', __( 'Phone Number', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_phone' ) ) :
/**
 * Header Phone
*/
function blossom_spa_get_phone(){
    return esc_html( get_theme_mod( 'phone', __( '+123-456-7890', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_email_label' ) ) :
/**
 * Header Email Label
*/
function blossom_spa_get_email_label(){
    return esc_html( get_theme_mod( 'email_label', __( 'Email', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_email' ) ) :
/**
 * Header Email 
*/
function blossom_spa_get_email(){
    return sanitize_email( get_theme_mod( 'email', __( 'mail@domain.com', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_opening_hours_label' ) ) :
/**
 * Header Opening Hours Label
*/
function blossom_spa_get_opening_hours_label(){
    return esc_html( get_theme_mod( 'opening_hours_label', __( 'Opening Hours', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_opening_hours' ) ) :
/**
 * Header Opening Hours 
*/
function blossom_spa_get_opening_hours(){
    return esc_html( get_theme_mod( 'opening_hours', __( 'Mon - Fri: 7AM - 7PM', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_related_title' ) ) :
/**
 * Display Single Related Title
*/
function blossom_spa_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'Recommended Articles', 'blossom-spa' ) ) );
}
endif;

if( ! function_exists( 'blossom_spa_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function blossom_spa_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    
    echo '<div class="copyright-wrap">'; 
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'blossom-spa' );
        echo date_i18n( esc_html__( 'Y', 'blossom-spa' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( ' All Rights Reserved.', 'blossom-spa' );
    }
    echo '</div>'; 
}
endif;