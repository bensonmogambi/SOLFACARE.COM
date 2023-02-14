<?php
/**
 * Blossom Spa Dynamic Styles
 * 
 * @package Blossom_Spa
*/

function blossom_spa_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Nunito Sans' );
    $primary_fonts   = blossom_spa_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Marcellus' );
    $secondary_fonts = blossom_spa_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );

    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Marcellus', 'variant'=>'regular' ) );
    $site_title_fonts     = blossom_spa_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
    $primary_color = '#9cbe9c';    

    echo "<style type='text/css' media='all'>"; ?>

    :root {
    --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
    --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
    }

    body,
    button,
    input,
    select,
    optgroup,
    textarea {        
        font-size: <?php echo absint( $font_size ); ?>px;
    }

    /*Typography*/

    .site-branding .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }

    a.btn-readmore:hover:before, .btn-cta:hover:before, 
    a.btn-readmore:hover:after, .btn-cta:hover:after {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="<?php echo blossom_spa_hash_to_percent23( blossom_spa_sanitize_hex_color( $primary_color ) ); ?>" d="M187.8 264.5L41 412.5c-4.7 4.7-12.3 4.7-17 0L4.2 392.7c-4.7-4.7-4.7-12.3 0-17L122.7 256 4.2 136.3c-4.7-4.7-4.7-12.3 0-17L24 99.5c4.7-4.7 12.3-4.7 17 0l146.8 148c4.7 4.7 4.7 12.3 0 17z" class=""></path></svg>');    
    } 

    .widget_bttk_testimonial_widget .bttk-testimonial-inner-holder:before, 
    blockquote:before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 24"><path fill="<?php echo blossom_spa_hash_to_percent23( blossom_spa_sanitize_hex_color( $primary_color ) ); ?>" d="M33.54,28.5a8,8,0,1,1-8.04,8,16,16,0,0,1,16-16A15.724,15.724,0,0,0,33.54,28.5Zm-12.04,8a8,8,0,0,1-16,0h0a16,16,0,0,1,16-16,15.724,15.724,0,0,0-7.96,8A7.989,7.989,0,0,1,21.5,36.5Z" transform="translate(-5.5 -20.5)"/></svg>');
    };
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'blossom_spa_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function blossom_spa_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function blossom_spa_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

/**
 * Convert '#' to '%23'
*/
function blossom_spa_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}