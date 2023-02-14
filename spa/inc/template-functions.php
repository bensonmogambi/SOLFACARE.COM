<?php
/**
 * Blossom Spa Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Blossom_Spa
 */

if( ! function_exists( 'blossom_spa_doctype' ) ) :
/**
 * Doctype Declaration
*/
function blossom_spa_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'blossom_spa_doctype', 'blossom_spa_doctype' );

if( ! function_exists( 'blossom_spa_head' ) ) :
/**
 * Before wp_head 
*/
function blossom_spa_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'blossom_spa_before_wp_head', 'blossom_spa_head' );

if( ! function_exists( 'blossom_spa_page_start' ) ) :
/**
 * Page Start
*/
function blossom_spa_page_start(){ ?>
    <div id="page" class="site"><a aria-label="<?php esc_attr_e( 'skip to content', 'blossom-spa' ); ?>" class="skip-link" href="#content"><?php esc_html_e( 'Skip to Content', 'blossom-spa' ); ?></a>
    <?php
}
endif;
add_action( 'blossom_spa_before_header', 'blossom_spa_page_start', 20 );

if( ! function_exists( 'blossom_spa_responsive_nav' ) ) :
/**
 * Responsive Navigation
*/
function blossom_spa_responsive_nav(){ ?>
    <div class="responsive-nav">
        <?php blossom_spa_responsive_primary_nagivation(); ?>
        <?php blossom_spa_social_links(); ?>
        <?php blossom_spa_header_contact(); ?>
    </div> <!-- .responsive-nav -->
    <?php
}
endif;
add_action( 'blossom_spa_header', 'blossom_spa_responsive_nav', 10 );

if( ! function_exists( 'blossom_spa_header' ) ) :
/**
 * Header Start
*/
function blossom_spa_header(){ ?>

    <header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
        <div class="container">
            <div class="header-main">
                <?php blossom_spa_site_branding(); ?>
                <?php blossom_spa_header_contact(); ?>
            </div><!-- .header-main -->
            <div class="nav-wrap">
                <?php blossom_spa_primary_nagivation(); ?>
                <?php if( blossom_spa_social_links( false ) || blossom_spa_header_search( false ) ) : ?>
                    <div class="nav-right">
                        <?php blossom_spa_social_links(); ?>
                        <?php blossom_spa_header_search(); ?>
                    </div><!-- .nav-right -->   
                <?php endif; ?>
            </div><!-- .nav-wrap -->
        </div><!-- .container -->    
    </header>
<?php }
endif;
add_action( 'blossom_spa_header', 'blossom_spa_header', 20 );

if( ! function_exists( 'blossom_spa_content_start' ) ) :
/**
 * Content Start
 *  
*/
function blossom_spa_content_start(){       
    $home_sections  = blossom_spa_get_home_sections(); 
    $ed_prefix      = get_theme_mod( 'ed_prefix_archive', false );
    $page_id        = get_option( 'page_for_posts' );
    $blog_background_image = get_the_post_thumbnail_url( $page_id, 'blossom-spa-single' ); 
    
    if( is_singular() ) {
        $background_image = blossom_spa_singular_post_thumbnail();
    }else{
        if( !( is_front_page() && ! is_home() ) && $blog_background_image && !( is_archive() || is_search() ) ){
            $background_image = $blog_background_image;
        }elseif( blossom_spa_is_woocommerce_activated() && is_product_category() ){
            $cat_id = get_queried_object_id();
            $thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
            $background_image = wp_get_attachment_url( $thumbnail_id );
        }elseif( blossom_spa_is_woocommerce_activated() && is_shop() ){
            $shop_page_id = wc_get_page_id( 'shop' );
            $background_image = get_the_post_thumbnail_url( $shop_page_id, 'blossom-spa-single' );
        }else{
            $background_image = get_theme_mod( 'header_background_image', esc_url( get_template_directory_uri() .'/images/header-bg.jpg' ) );
        }
    }

    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ //Make necessary adjust for pg template.
        echo '<div id="content" class="site-content">'; 
        if( !( blossom_spa_is_woocommerce_activated() && is_product() ) ) : ?>
            <header class="page-header" style="background-image: url( '<?php echo esc_url( $background_image ); ?>' );">
                <div class="container">
        			<?php        
                        if ( is_home() && ! is_front_page() ){ 
                            echo '<h1 class="page-title">';
                			single_post_title();
                            echo '</h1>';
                        }
                        
                        if( is_archive() ) :
                            if( is_author() ){
                                $author_title = get_the_author_meta( 'display_name' );
                                $author_description = get_the_author_meta( 'description' ); ?>
                                <div class="author-section">
                                    <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 230 ); ?></figure>
                                    <div class="author-content-wrap">
                                        <?php 
                                            echo '<h3 class="author-name">' . esc_html__( 'All Posts By: ','blossom-spa' ) . esc_html( $author_title ) . '</h3>';
                                            echo '<div class="author-content">' . wpautop( wp_kses_post( $author_description ) ) . '</div>';
                                        ?>      
                                    </div>
                                </div>
                                <?php 
                            }else{
                                the_archive_title();
                                the_archive_description( '<div class="archive-description">', '</div>' );
                            }
                        endif;
                        
                        if( is_search() ){ 
                            echo '<h1 class="page-title">' . esc_html__( 'SEARCH RESULTS FOR:', 'blossom-spa' ) . '</h1>';
                            get_search_form();
                        }
                        
                        if( is_singular() ){
                            
                            blossom_spa_category();
                            
                            the_title( '<h1 class="page-title">', '</h1>' );
                            
                            if( 'post' === get_post_type() ){
                                echo '<div class="entry-meta">';
                                blossom_spa_posted_by();
                                blossom_spa_posted_on();
                                blossom_spa_comment_count();
                                echo '</div>';
                            }

                        }
                        if( is_404() ) {
                            echo '<h1 class="page-title">' . esc_html__( 'Uh-Oh...','blossom-spa' ) .'</h1>';
                        }
                        
                        blossom_spa_breadcrumb();
                    ?>
                </div>
    		</header><!-- .page-header -->
        <?php endif; ?>
            <div class="container">
        <?php
    }
}
endif;
add_action( 'blossom_spa_content', 'blossom_spa_content_start' );

if( ! function_exists( 'blossom_spa_posts_per_page_count' ) ):
/**
*   Counts the Number of total posts in Archive, Search and Author
*/
function blossom_spa_posts_per_page_count(){
    $pagination = get_theme_mod( 'pagination_type','numbered' );
    global $wp_query;
    if( is_archive() || is_search() && $wp_query->found_posts > 0 ) {
        $posts_per_page = get_option( 'posts_per_page' );
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $start_post_number = 0;
        $end_post_number   = 0;

        if( $wp_query->found_posts > 0 && !( blossom_spa_is_woocommerce_activated() && is_shop() ) ):                
            $start_post_number = 1;
            if( $wp_query->found_posts < $posts_per_page  ) {
                $end_post_number = $wp_query->found_posts;
            }else{
                $end_post_number = $posts_per_page;
            }

            if( $paged > 1 ){
                $start_post_number = $posts_per_page * ( $paged - 1 ) + 1;
                if( $wp_query->found_posts < ( $posts_per_page * $paged )  ) {
                    $end_post_number = $wp_query->found_posts;
                }else{
                    $end_post_number = $paged * $posts_per_page;
                }
            }

            printf( esc_html__( '%1$s Showing:  %2$s - %3$s of %4$s RESULTS %5$s', 'blossom-spa' ), '<div class="showing-result">', absint( $start_post_number ), absint( $end_post_number ), esc_html( number_format_i18n( $wp_query->found_posts ) ), '</div>' );
        endif;
    }
}
endif; 
add_action( 'blossom_spa_before_posts_content' , 'blossom_spa_posts_per_page_count', 10 );

if ( ! function_exists( 'blossom_spa_figure_content' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function blossom_spa_figure_content() {
    if( is_single() ) return false;
    echo '<figure class="post-thumbnail">';
        blossom_spa_post_thumbnail();
        blossom_spa_category();
        blossom_spa_posted_by();
    echo '</figure>';

}
endif;
add_action( 'blossom_spa_before_post_entry_content', 'blossom_spa_figure_content', 20 );


if( ! function_exists( 'blossom_spa_entry_header' ) ) :
/**
 * Entry Header
*/
function blossom_spa_entry_header(){ 
    if( is_single() ) return false; ?>
    <div class="content-wrap">
        <header class="entry-header">
            <?php                 
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            
                if( 'post' === get_post_type() ){
                    echo '<div class="entry-meta">';
                    blossom_spa_posted_on();
                    blossom_spa_comment_count();
                    echo '</div>';
                }       
            ?>
        </header>         
    <?php    
}
endif;
add_action( 'blossom_spa_post_entry_content', 'blossom_spa_entry_header', 10 );

if( ! function_exists( 'blossom_spa_entry_content' ) ) :
/**
 * Entry Content
*/
function blossom_spa_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blossom-spa' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
            }
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'blossom_spa_page_entry_content', 'blossom_spa_entry_content', 15 );
add_action( 'blossom_spa_post_entry_content', 'blossom_spa_entry_content', 15 );

if( ! function_exists( 'blossom_spa_entry_footer' ) ) :
/**
 * Entry Footer
*/
function blossom_spa_entry_footer(){ 
        $readmore = get_theme_mod( 'read_more_text', __( 'Read More', 'blossom-spa' ) ); ?>
    	<footer class="entry-footer">
    		<?php
    			blossom_spa_tag();

                if( is_home() || is_archive() || is_search() ){
                    echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $readmore ) . '</a>';
                }
                
                if( get_edit_post_link() ){
                    edit_post_link(
    					sprintf(
    						wp_kses(
    							/* translators: %s: Name of current post. Only visible to screen readers */
    							__( 'Edit <span class="screen-reader-text">%s</span>', 'blossom-spa' ),
    							array(
    								'span' => array(
    									'class' => array(),
    								),
    							)
    						),
    						get_the_title()
    					),
    					'<span class="edit-link">',
    					'</span>'
    				);
                }
    		?>
    	</footer><!-- .entry-footer -->
    <?php if( is_home() ) echo '</div><!-- .content-wrap -->'; 
}
endif;
add_action( 'blossom_spa_page_entry_content', 'blossom_spa_entry_footer', 20 );
add_action( 'blossom_spa_post_entry_content', 'blossom_spa_entry_footer', 20 );

if( ! function_exists( 'blossom_spa_author' ) ) :
/**
 * Author Section
*/
function blossom_spa_author(){ 
    $ed_author    = get_theme_mod( 'ed_post_author', false );
    $author_title = get_the_author();
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
    <div class="author-section">
        <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></figure>
        <div class="author-content-wrap">
            <?php 
                if( $author_title ) echo '<h3 class="author-name"><span>' . esc_html( $author_title ) . '</span></h3>';
                echo '<div class="author-content">' . wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ) . '</div>';
            ?>      
        </div>
    </div>
    <?php
    }
}
endif;
add_action( 'blossom_spa_after_post_content', 'blossom_spa_author', 15 );

if( ! function_exists( 'blossom_spa_navigation' ) ) :
/**
 * Navigation
*/
function blossom_spa_navigation(){
    if( is_single() ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if( $prev_post || $next_post ){?>            
            <nav class="post-navigation pagination" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'blossom-spa' ); ?></h2>
                <div class="nav-links">
                    <?php if( $prev_post ){ ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                            <span class="meta-nav"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><defs><style>.arla{fill:#999596;}</style></defs><path class="arla" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(22 16) rotate(180)"/></svg><?php esc_html_e( 'Previous Post', 'blossom-spa' ); ?></span>
                            <span class="post-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                        </a>
                        <figure class="post-img">
                            <?php
                            $prev_img = get_post_thumbnail_id( $prev_post->ID );
                            if( $prev_img ){
                                $prev_url = wp_get_attachment_image_url( $prev_img, 'blossom-spa-pagination' );
                                echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0', $prev_post ) . '">';                                        
                            }else{
                                blossom_spa_get_fallback_svg( 'blossom-spa-pagination' );
                            }
                            ?>
                        </figure>
                    </div>
                    <?php } ?>
                    <?php if( $next_post ){ ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                            <span class="meta-nav"><?php esc_html_e( 'Next Post', 'blossom-spa' ); ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><defs><style>.arra{fill:#999596;}</style></defs><path class="arra" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(-8 -8)"/></svg></span>
                            <span class="post-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                        </a>
                        <figure class="post-img">
                            <?php
                            $next_img = get_post_thumbnail_id( $next_post->ID );
                            if( $next_img ){
                                $next_url = wp_get_attachment_image_url( $next_img, 'blossom-spa-pagination' );
                                echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0', $next_post ) . '">';                                        
                            }else{
                                blossom_spa_get_fallback_svg( 'blossom-spa-pagination' );
                            }
                            ?>
                        </figure>
                    </div>
                    <?php } ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'blossom-spa' ),
            'next_text'          => __( 'Next', 'blossom-spa' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blossom-spa' ) . ' </span>',
        ) );         
    }
}
endif;
add_action( 'blossom_spa_after_post_content', 'blossom_spa_navigation', 20 );
add_action( 'blossom_spa_after_posts_content', 'blossom_spa_navigation' );


if( ! function_exists( 'blossom_spa_related_posts' ) ) :
/**
 * Related Posts 
*/
function blossom_spa_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        blossom_spa_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'blossom_spa_after_post_content', 'blossom_spa_related_posts', 25 );

if( ! function_exists( 'blossom_spa_latest_posts' ) ) :
/**
 * Latest Posts
*/
function blossom_spa_latest_posts(){ 
    blossom_spa_get_posts_list( 'latest' );
}
endif;
add_action( 'blossom_spa_latest_posts', 'blossom_spa_latest_posts' );

if( ! function_exists( 'blossom_spa_comment' ) ) :
/**
 * Comments Template 
*/
function blossom_spa_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( ! get_theme_mod( 'ed_comments', false ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'blossom_spa_after_post_content', 'blossom_spa_comment', 30 );
add_action( 'blossom_spa_after_page_content', 'blossom_spa_comment' );

if( ! function_exists( 'blossom_spa_content_end' ) ) :
/**
 * Content End
*/
function blossom_spa_content_end(){ 
    $home_sections = blossom_spa_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>            
        </div><!-- .container -->        
    </div><!-- .error-holder/site-content -->
    <?php
    }
}
endif;
add_action( 'blossom_spa_before_footer', 'blossom_spa_content_end', 20 );

if( ! function_exists( 'blossom_spa_instagram' ) ) :
/**
 * Before Footer
*/
function blossom_spa_instagram(){
    if( blossom_spa_is_btif_activated() ){
        $ed_instagram = get_theme_mod( 'ed_instagram', false );
        if( $ed_instagram ){
            echo '<div class="instagram-section">';
            echo do_shortcode( '[blossomthemes_instagram_feed]' );
            echo '</div>';    
        }
    }
}
endif;
add_action( 'blossom_spa_before_footer_start', 'blossom_spa_instagram', 10 );

if( ! function_exists( 'blossom_spa_footer_start' ) ) :
/**
 * Footer Start
*/
function blossom_spa_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'blossom_spa_footer', 'blossom_spa_footer_start', 20 );

if( ! function_exists( 'blossom_spa_footer_top' ) ) :
/**
 * Footer Top
*/
function blossom_spa_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'blossom_spa_footer', 'blossom_spa_footer_top', 30 );

if( ! function_exists( 'blossom_spa_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function blossom_spa_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="copyright">           
            <?php
                blossom_spa_get_footer_copyright();

                esc_html_e( ' Blossom Spa | Developed By ', 'blossom-spa' );
                echo '<a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( ' Blossom Themes', 'blossom-spa' ) . '</a>.';
                
                printf( esc_html__( ' Powered by %s', 'blossom-spa' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-spa' ) ) .'" target="_blank">WordPress</a>. ' );
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <?php blossom_spa_social_links( true, false ); ?>
            <button aria-label="<?php esc_attr_e( 'go to top', 'blossom-spa' ); ?>" class="back-to-top">
                <i class="fas fa-chevron-up"></i>
            </button>
		</div>
	</div>
    <?php
}
endif;
add_action( 'blossom_spa_footer', 'blossom_spa_footer_bottom', 40 );

if( ! function_exists( 'blossom_spa_footer_end' ) ) :
/**
 * Footer End 
*/
function blossom_spa_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'blossom_spa_footer', 'blossom_spa_footer_end', 50 );

if( ! function_exists( 'blossom_spa_page_end' ) ) :
/**
 * Page End
*/
function blossom_spa_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'blossom_spa_after_footer', 'blossom_spa_page_end', 20 );