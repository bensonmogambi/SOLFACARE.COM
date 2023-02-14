<?php
/**
 * Banner Section
 * 
 * @package Blossom_Spa
 */

$ed_banner        = get_theme_mod( 'ed_banner_section', 'static_banner' ); 
$banner_title     = get_theme_mod( 'banner_title', __( 'Relaxing Is Never Easy On Your Own', 'blossom-spa' ) );
$banner_subtitle  = get_theme_mod( 'banner_subtitle', __( 'Come and discover your oasis. It has never been easier to take a break from stress and the harmful factors that surround you every day!', 'blossom-spa' ) );
$button1          = get_theme_mod( 'banner_cta1', __( 'VIEW SERVICES', 'blossom-spa' ) );
$button2          = get_theme_mod( 'banner_cta2', __( 'BOOK NOW', 'blossom-spa' ) );
$button1_url      = get_theme_mod( 'banner_cta1_url', '#' );
$button2_url      = get_theme_mod( 'banner_cta2_url', '#' );
        
if( $ed_banner == 'static_banner' && has_custom_header() ){ ?>
    <div id="banner_section" class="site-banner<?php if( has_header_video() ) echo esc_attr( ' video-banner' ); ?>">
        <div class="item">
            <?php 
                the_custom_header_markup(); 
                if( $banner_title || $banner_subtitle || ( $button1 && $button1_url ) || ( $button2 && $button2_url ) ){
                    echo '<div class="banner-caption center"><div class="container"><div class="banner-caption-inner">';
                    if( $banner_title ) echo '<h2 class="title">' . esc_html( $banner_title ) . '</h2>';
                    if( $banner_subtitle ) echo '<div class="description">' . wpautop( wp_kses_post( $banner_subtitle ) ) . '</div>';
                    if( $button1 || $button2 ) : ?>
                        <div class="btn-wrap">
                            <?php if( $button1 && $button1_url ) : ?>
                                <a href="<?php echo esc_url( $button1_url ); ?>" class="btn btn-transparent">
                                    <span><?php echo esc_html( $button1 ); ?></span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            <?php endif; ?>
                            <?php if( $button2 && $button2_url ) : ?>
                                <a href="<?php echo esc_url( $button2_url ); ?>" class="btn btn-green">
                                    <span><?php echo esc_html( $button2 ); ?></span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif;
                    echo '</div></div></div>';
                }  
            ?>
        </div>
    </div>
<?php
}