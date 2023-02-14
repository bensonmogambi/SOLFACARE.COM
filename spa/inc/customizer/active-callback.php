<?php
/**
 * Active Callback
 * 
 * @package Blossom_Spa
*/

/**
 * Active Callback for Banner Slider
*/
function blossom_spa_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_cta1' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_cta1_url' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_cta2' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_cta2_url' && $banner == 'static_banner' ) return true;        
    
    return false;
}

/**
 * Active Callback for Blog View All Button
*/
function blossom_spa_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}

/**
 * Active Callback for post/page
*/
function blossom_spa_post_page_ac( $control ){
    
    $ed_related = $control->manager->get_setting( 'ed_related' )->value();
    $control_id = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    if ( $control_id == 'ed_featured_image' ) return true;
    
    return false;
}

/**
 * Active Callback for Shop page description
*/
function blossom_spa_shop_description_ac( $control ){
    $ed_shop_archive_desc = $control->manager->get_setting( 'ed_shop_archive_description' )->value();
    $control_id = $control->id;
    
    if( $control_id == 'shop_archive_description' && $ed_shop_archive_desc == true && blossom_spa_is_woocommerce_activated() ) return true;
    
    return false;
}

/**
 * Active Callback for static front page
*/
function blossom_spa_is_front_page( $control ){
    if ( is_front_page() && is_home() ) {
        return false;
    } elseif ( is_front_page() ) {
        return true;
    } elseif ( is_home() ) {
        return false;
    }
}

/**
 * Active Callback for local fonts
*/
function blossom_spa_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}