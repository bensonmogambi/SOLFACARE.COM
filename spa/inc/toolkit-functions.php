<?php
/**
 * Toolkit Filters
 *
 * @package Blossom_Spa
 */

if( ! function_exists( 'blossom_spa_default_cta_color' ) ) :
    function blossom_spa_default_cta_color(){
        return '#9cbe9c';
    }
endif;
add_filter( 'bttk_cta_bg_color', 'blossom_spa_default_cta_color' );

if( ! function_exists( 'blossom_spa_bttk_img_alignment' ) ) :
    function blossom_spa_bttk_img_alignment(){
        $array = array(
            'left'  => esc_html__( 'Left', 'blossom-spa' ),
            'right' => esc_html__( 'Right', 'blossom-spa' ),
        );
        return $array; 
    }
endif;
add_filter( 'bttk_img_alignment', 'blossom_spa_bttk_img_alignment' );

if( ! function_exists( 'blossom_spa_default_cta_button_alignent' ) ) :
    function blossom_spa_default_cta_button_alignent(){
        $array = array(
            'right'     => esc_html__( 'Right', 'blossom-spa' ),
            'left'      => esc_html__( 'Left', 'blossom-spa' ),
            'centered'  => esc_html__( 'Centered', 'blossom-spa' ),
        );
        return $array; 
    }
endif;
add_filter( 'blossomthemes_cta_button_alignment', 'blossom_spa_default_cta_button_alignent' );

if( ! function_exists( 'blossom_spa_default_icon_text_image_size' ) ) :
    function blossom_spa_default_icon_text_image_size(){
        return 'blossom-spa-service';
    }
endif;
add_filter( 'bttk_icon_img_size', 'blossom_spa_default_icon_text_image_size' );

if( ! function_exists( 'blossom_spa_default_team_member_image_size' ) ) :
    function blossom_spa_default_team_member_image_size(){
        return 'blossom-spa-team';
    }
endif;
add_filter( 'bttk_team_member_icon_img_size', 'blossom_spa_default_team_member_image_size' );

if( ! function_exists( 'blossom_spa_newsletter_bg_image_size' ) ) :
    function blossom_spa_newsletter_bg_image_size(){
        return 'full';
    }
endif;
add_filter( 'bt_newsletter_img_size', 'blossom_spa_newsletter_bg_image_size' );

if( ! function_exists( 'blossom_spa_ad_image' ) ) :
    function blossom_spa_ad_image(){
        return 'full';
    }
endif;
add_filter( 'bttk_ad_img_size', 'blossom_spa_ad_image' );

if( ! function_exists( 'blossom_spa_newsletter_bg_color' ) ) :
    function blossom_spa_newsletter_bg_color(){
        return '#ff91a4';
    }
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'blossom_spa_newsletter_bg_color' );

if( ! function_exists( 'blossom_spa_author_image' ) ) :
   function blossom_spa_author_image(){
       return 'blossom-spa-blog-list';
   }
endif;
add_filter( 'author_bio_img_size', 'blossom_spa_author_image' );

if( ! function_exists( 'blossom_spa_featured_page_widget_filter' ) ) :
/**
 * Filter for Featured page widget
*/
function blossom_spa_featured_page_widget_filter( $html, $args, $instance ){ 
    $read_more         = !empty( $instance['readmore'] ) ? $instance['readmore'] : __( 'Read More', 'blossom-spa' );      
    $show_feat_img     = !empty( $instance['show_feat_img'] ) ? $instance['show_feat_img'] : '' ;  
    $show_page_content = !empty( $instance['show_page_content'] ) ? $instance['show_page_content'] : '' ;        
    $show_readmore     = !empty( $instance['show_readmore'] ) ? $instance['show_readmore'] : '' ;        
    $page_list         = !empty( $instance['page_list'] ) ? $instance['page_list'] : 1 ;
    $image_alignment   = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : 'left' ;
    if( !isset( $page_list ) || $page_list == '' ) return;
    
    $post_no = get_post($page_list); 

    $target = 'target="_blank"';
    if( isset($instance['target']) && $instance['target']!='' )
    {
        $target = 'target="_self"';
    }
    
    if( $post_no ){
        setup_postdata( $post_no );
        ob_start();
            ?>
            <div class="widget-featured-holder <?php echo esc_attr($image_alignment);?>">
                <div class="featured-holder-wrap">
                    <?php
                        echo is_page_template( 'templates/about.php' ) ? '<h1 class="widget-title">' : $args['before_title']; //Done for SEO
                        echo esc_html( $post_no->post_title );
                        echo is_page_template( 'templates/about.php' ) ? '</h1>' : $args['after_title'];
                    ?>
                    <?php if( has_post_thumbnail( $post_no ) && $show_feat_img ){ ?>
                    <div class="img-holder">
                        <a <?php echo $target;?> href="<?php the_permalink( $post_no ); ?>">
                            <?php 
                            $featured_img_size = apply_filters( 'featured_img_size', 'full' );
                            echo get_the_post_thumbnail( $post_no, $featured_img_size ); ?>
                        </a>
                    </div>
                    <?php } ?>
                    <div class="text-holder">
                        <div class="featured_page_content">
                            <?php 
                            if( isset( $show_page_content ) && $show_page_content!='' ) {
                                echo apply_filters( 'the_content', $post_no->post_content );
                            }else{
                                echo apply_filters( 'the_excerpt', get_the_excerpt( $post_no ) );                                
                            }
                            
                            if( isset( $show_readmore ) && $show_readmore!='' ){ ?>
                                <a href="<?php the_permalink( $post_no ); ?>" <?php echo $target;?> class="btn-readmore"><?php echo esc_html( $read_more );?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>                    
            </div>        
        <?php    
        $html = ob_get_clean();
        wp_reset_postdata();
        return $html;        
    }
}
endif;
add_filter( 'blossom_featured_page_widget_filter', 'blossom_spa_featured_page_widget_filter', 10, 3 );