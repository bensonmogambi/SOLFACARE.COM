<?php
/**
 * Blossom Spa Standalone Functions.
 *
 * @package Blossom_Spa
 */

if ( ! function_exists( 'blossom_spa_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function blossom_spa_posted_on() {
    $ed_post_date   = get_theme_mod( 'ed_post_date', false );
    if( $ed_post_date ) return false;

	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) && !( is_front_page() && ! is_home() ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time></time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    $posted_on = sprintf( '%1$s', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
	
	echo '<span class="posted-on"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><defs><style>.clk{fill:none;}.clkb{fill:#ccc6c8;}</style></defs><g transform="translate(7 18)"><g transform="translate(-7 -18)"><path class="clk" d="M0,0H36V36H0Z"/></g><g transform="translate(-2 -13)"><path class="clkb" d="M15.5,2A13.5,13.5,0,1,0,29,15.5,13.54,13.54,0,0,0,15.5,2Zm0,24.3A10.8,10.8,0,1,1,26.3,15.5,10.814,10.814,0,0,1,15.5,26.3Z" transform="translate(-2 -2)"/><path class="clkb" d="M13.025,7H11v8.1l7.02,4.32,1.08-1.755L13.025,14.02Z" transform="translate(1.15 -0.25)"/></g></g>
        </svg>' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'blossom_spa_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function blossom_spa_posted_by() {
    $ed_post_author   = get_theme_mod( 'ed_post_author', false );
    if( $ed_post_author ) return false;

    global $post;
    $author_name    = ( is_single() ) ? get_the_author_meta( 'display_name', $post->post_author ) : get_the_author();
    $author_url     = ( is_single() ) ? get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) : get_author_posts_url( get_the_author_meta( 'ID' ) );
	$byline         = sprintf( '%s',
		'<span class="author" itemprop="name"><a class="url fn n" href="' . esc_url( $author_url ) . '" itemprop="url">' . esc_html( $author_name ) . '</a></span>' 
    );
    if( is_home() || is_archive() || is_search() ) echo '<div class="author-like-wrap">';
    
    echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19"><defs><style>.auta{fill:none;}.auta,.autb{stroke:rgba(0,0,0,0);}.autb{fill:#ccc6c8;}</style></defs><g transform="translate(0.5 0.5)"><path class="auta" d="M0,0H18V18H0Z"></path><g transform="translate(1.5 1.5)"><path class="autb" d="M9.5,2A7.5,7.5,0,1,0,17,9.5,7.5,7.5,0,0,0,9.5,2ZM5.8,14.21c.322-.675,2.287-1.335,3.7-1.335s3.382.66,3.7,1.335a5.944,5.944,0,0,1-7.395,0Zm8.468-1.088c-1.073-1.3-3.675-1.747-4.77-1.747s-3.7.443-4.77,1.747a6,6,0,1,1,9.54,0Z" transform="translate(-2 -2)"></path><path class="autb" d="M11.125,6A2.625,2.625,0,1,0,13.75,8.625,2.618,2.618,0,0,0,11.125,6Zm0,3.75A1.125,1.125,0,1,1,12.25,8.625,1.123,1.123,0,0,1,11.125,9.75Z" transform="translate(-3.625 -3)"></path></g></g></svg>' . $byline . '</span>';
    
    if( is_home() || is_archive() || is_search() ) echo '</div>';
    
}
endif;

if( ! function_exists( 'blossom_spa_comment_count' ) ) :
/**
 * Comment Count
*/
function blossom_spa_comment_count(){
    $ed_comments    = get_theme_mod( 'ed_comments', false );
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) && !$ed_comments ) {
        
        echo '<span class="comment-box"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.943 15.465"><defs><style>.co{fill:none;stroke:#ccc6c8;stroke-width:1.3px;}</style></defs><path class="co" d="M15.425,11.636H12.584v2.03L9.2,11.636H1.218A1.213,1.213,0,0,1,0,10.419v-9.2A1.213,1.213,0,0,1,1.218,0H15.425a1.213,1.213,0,0,1,1.218,1.218v9.2A1.213,1.213,0,0,1,15.425,11.636Z" transform="translate(0.65 0.65)"></path></svg>';
		
        comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'No Comment<span class="screen-reader-text"> on %s</span>', 'blossom-spa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'blossom_spa_category' ) ) :
/**
 * Prints categories
 */
function blossom_spa_category(){
    $ed_cat_single  = get_theme_mod( 'ed_category', false );

    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() && !$ed_cat_single ) {
        $categories_list = get_the_category_list( ' ' );
        if ( $categories_list ) {
            echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
        }
    }elseif( 'blossom-portfolio' === get_post_type() ) {
        $term_list = get_the_term_list( get_the_ID(), 'blossom_portfolio_categories' );
        if( $term_list ) echo '<span class="category">' . $term_list . '</span>';
    }
}
endif;

if ( ! function_exists( 'blossom_spa_tag' ) ) :
/**
 * Prints tags
 */
function blossom_spa_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="cat-tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'blossom-spa' ) . '</span>', '<h5>', '</h5>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'blossom_spa_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function blossom_spa_get_posts_list( $status ){
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 3;
        $title                  = __( 'Recommended Articles', 'blossom-spa' );
        $class                  = ' recent-posts';
        $image_size             = 'blossom-spa-related';
        break;
        
        case 'related':
        $args['posts_per_page'] = 3;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'Recommended Articles', 'blossom-spa' ) );
        $class                  = ' related-posts';
        $image_size             = 'blossom-spa-related';
        $cats                   = get_the_category( $post->ID );        
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }
        break;        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="additional-post<?php echo esc_attr( $class ); ?>">
    		<?php 
            if( $title ) echo '<h3 class="post-title"><span>' . esc_html( $title ) . '</span></h3>'; ?>
            <div class="article-wrap">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <article class="post">
        				<figure class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                    }else{ 
                                        blossom_spa_get_fallback_svg( $image_size );
                                    }
                                ?>
                            </a>
                        </figure>
        				<header class="entry-header">
                            <div class="entry-meta">
                                <?php blossom_spa_posted_on(); ?>
                            </div>
        					<?php
                                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            ?>                        
        				</header>
        			</article>
    			<?php }?>
            </div>    		
    	</div>
        <?php
    }
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'blossom_spa_site_branding' ) ) :
/**
 * Site Branding
*/
function blossom_spa_site_branding(){  
    $site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );
    if( has_custom_logo() || $site_title || $site_description || $header_text ) :
        if( has_custom_logo() && ( $site_title || $site_description ) && $header_text ) {
            $branding_class = ' has-logo-text';
        }else{
            $branding_class = '';
        } ?>
        <div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="http://schema.org/Organization">
            <?php 
            if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                the_custom_logo();
            } 
            if( $site_title || $site_description ) :
                if( $branding_class ) echo '<div class="site-title-wrap">';
                if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                }else{ ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php }
                
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description" itemprop="description"><?php echo $description; ?></p>
                <?php
                }
                if( $branding_class ) echo '</div>';
            endif;

            ?>
        </div>    
    <?php
    endif;
}
endif;

if( ! function_exists( 'blossom_spa_header_contact' ) ) :
/**
 * Site Branding
*/
function blossom_spa_header_contact( $echo = true, $layout = true ){ 
    
    $phone_label = get_theme_mod( 'phone_label', __( 'Phone', 'blossom-spa' ) );
    $phone       = get_theme_mod( 'phone', '+123-456-7890' );
    $email_label = get_theme_mod( 'email_label', __( 'Email', 'blossom-spa' ) );
    $email       = get_theme_mod( 'email', 'mail@domain.com' );
    $opening_hours_label = get_theme_mod( 'opening_hours_label', __( 'Opening Hours', 'blossom-spa' ) );
    $opening_hours       = get_theme_mod( 'opening_hours', 'Mon - Fri: 7AM - 7PM' );
    
    if( $echo && ( !empty( $phone_label ) || !empty( $phone ) || !empty( $email_label ) || !empty( $email ) || !empty( $opening_hours_label ) || !empty( $opening_hours ) ) ) : ?>
        <div class="header-contact"> 
            <?php if( !empty( $phone_label ) || !empty( $phone ) ) : ?>
                <div class="contact-block">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><defs><style>.pha{fill:none;}.phb{fill:#ccc6c8;}</style></defs><path class="pha" d="M0,0H36V36H0Z"/><g transform="translate(4.5 4.5)"><path class="phb" d="M8.31,6a18.469,18.469,0,0,0,.675,3.885l-1.8,1.8A22.238,22.238,0,0,1,6.045,6H8.31M23.1,24.03a19.129,19.129,0,0,0,3.9.675V26.94a23.14,23.14,0,0,1-5.7-1.125l1.8-1.785M9.75,3H4.5A1.5,1.5,0,0,0,3,4.5,25.5,25.5,0,0,0,28.5,30,1.5,1.5,0,0,0,30,28.5V23.265a1.5,1.5,0,0,0-1.5-1.5,17.11,17.11,0,0,1-5.355-.855,1.259,1.259,0,0,0-.465-.075,1.537,1.537,0,0,0-1.065.435l-3.3,3.3A22.723,22.723,0,0,1,8.43,14.685l3.3-3.3a1.505,1.505,0,0,0,.375-1.53A17.041,17.041,0,0,1,11.25,4.5,1.5,1.5,0,0,0,9.75,3Z" transform="translate(-3 -3)"/></g></svg>
                    <?php if( $phone_label && $layout ) echo '<span class="title hphone-label">' . esc_html( $phone_label ) . '</span>';
                    if( !empty( $phone ) ) echo '<p class="content hphone"><a href="tel:' . preg_replace( '/[^\d+]/', '', $phone ) . '">' . esc_html( $phone ) . '</a></p>'; ?>
                </div>
            <?php endif; ?>

            <?php if( !empty( $email_label ) || !empty( $email ) ) : ?>
                <div class="contact-block">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><defs><style>.ema{fill:none;}.emb{fill:#ccc6c8;}</style></defs><path class="ema" d="M0,0H36V36H0Z"/><g transform="translate(3 2.925)"><path class="emb" d="M17,1.95a15,15,0,0,0,0,30h7.5v-3H17a12.154,12.154,0,0,1-12-12,12.154,12.154,0,0,1,12-12,12.154,12.154,0,0,1,12,12V19.1a2.425,2.425,0,0,1-2.25,2.355,2.425,2.425,0,0,1-2.25-2.355V16.95a7.5,7.5,0,1,0-2.19,5.3,5.555,5.555,0,0,0,4.44,2.2A5.269,5.269,0,0,0,32,19.1V16.95A15.005,15.005,0,0,0,17,1.95Zm0,19.5a4.5,4.5,0,1,1,4.5-4.5A4.494,4.494,0,0,1,17,21.45Z" transform="translate(-2 -1.95)"/></g></svg>
                    <?php if( $email_label && $layout ) echo '<span class="title hemail-label">' . esc_html( $email_label ) . '</span>';
                    if( !empty( $email ) ) echo '<p class="content hemail"><a href="mailto:' . sanitize_email( $email ) . '">' . sanitize_email( $email ) . '</a></p>'; ?>
                </div>
            <?php endif; ?>
            
            <?php if( !empty( $opening_hours_label ) || !empty( $opening_hours ) ) : ?>
                <div class="contact-block">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><defs><style>.clk{fill:none;}.clkb{fill:#ccc6c8;}</style></defs><g transform="translate(7 18)"><g transform="translate(-7 -18)"><path class="clk" d="M0,0H36V36H0Z"/></g><g transform="translate(-2 -13)"><path class="clkb" d="M15.5,2A13.5,13.5,0,1,0,29,15.5,13.54,13.54,0,0,0,15.5,2Zm0,24.3A10.8,10.8,0,1,1,26.3,15.5,10.814,10.814,0,0,1,15.5,26.3Z" transform="translate(-2 -2)"/><path class="clkb" d="M13.025,7H11v8.1l7.02,4.32,1.08-1.755L13.025,14.02Z" transform="translate(1.15 -0.25)"/></g></g></svg>
                    <?php if( $opening_hours_label && $layout ) echo '<span class="title hopening-label">' . esc_html( $opening_hours_label ) . '</span>';
                    if( !empty( $opening_hours ) ) echo '<p class="content hopening">' . esc_html( $opening_hours ) . '</p>'; ?>
                </div>
            <?php endif; ?>
    	</div><!-- .header-contact -->    
    <?php
    elseif ( !empty( $phone_label ) || !empty( $phone ) || !empty( $email_label ) || !empty( $email ) || !empty( $opening_hours_label ) || !empty( $opening_hours ) ) :
        return true;
    else :
        return false;
    endif;
}
endif;

if( ! function_exists( 'blossom_spa_social_links' ) ) :
/**
 * Social Links 
*/
function blossom_spa_social_links( $echo = true, $show_on = true ){ 

    $social_links = get_theme_mod( 'social_links' );
    $ed_social    = get_theme_mod( 'ed_social_links', true );
    $show         = ( $show_on ) ? 'header' : 'footer'; 
    
    if( $ed_social && $social_links && $echo ){ ?>
    <div class="<?php echo esc_attr( $show ); ?>-social">
        <ul class="social-list">
        	<?php 
            foreach( $social_links as $link ){
        	   if( $link['link'] ){ ?>
                <li>
                    <a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow noopener">
                        <i class="<?php echo esc_attr( $link['font'] ); ?>"></i>
                    </a>
                </li>    	   
                <?php
                } 
            } 
            ?>
    	</ul>
    </div>
    <?php    
    }elseif( $ed_social && $social_links ){
        return true;
    }else{
        return false;
    }
    ?>
    <?php                                
}
endif;

if( ! function_exists( 'blossom_spa_header_search' ) ) :
/**
 * Header Search
*/
function blossom_spa_header_search( $echo = true ) { 
    $header_search = get_theme_mod( 'ed_header_search', true );
    if( $echo && $header_search ) : ?>
        <div class="header-search-wrap">
            <button aria-label="<?php esc_attr_e( 'search form open', 'blossom-spa' ); ?>" class="header-search" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><defs><style>.sea{fill:#fff;}</style></defs><path class="sea" d="M16,14.591,12.679,11.27a6.89,6.89,0,0,0,1.409-4.226A7,7,0,0,0,7.044,0,7,7,0,0,0,0,7.044a7,7,0,0,0,7.044,7.044,6.89,6.89,0,0,0,4.226-1.409L14.591,16ZM2.013,7.044A4.983,4.983,0,0,1,7.044,2.013a4.983,4.983,0,0,1,5.031,5.031,4.983,4.983,0,0,1-5.031,5.031A4.983,4.983,0,0,1,2.013,7.044Z"/></svg>
            </button>
            <?php blossom_spa_search_form_wrap(); ?>
        </div>
    <?php 
    elseif( $header_search ) :
        return true;
    else :
        return false;
    endif;
}
endif;

if( ! function_exists( 'blossom_spa_form_section' ) ) :
/**
 * Form Icon
*/
function blossom_spa_form_section(){ ?>
    <div class="form-section">
		<span id="btn-search" class="fas fa-search"></span>
	</div>
    <?php
}
endif;

if( ! function_exists( 'blossom_spa_search_form_wrap' ) ) :
/**
 * Responsive Navigation
*/
function blossom_spa_search_form_wrap(){ 
    $header_search = get_theme_mod( 'ed_header_search', true ); 
    if( $header_search ) : ?>
        <div class="search-form-wrap search-modal cover-modal" data-modal-target-string=".search-modal">
            <div class="search-form-inner">
                <?php get_search_form(); ?>
                <button aria-label="<?php esc_attr_e( 'search form close', 'blossom-spa' ); ?>" class="close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false"></button>
            </div>
        </div>
    <?php
    endif;
}
endif;

if( ! function_exists( 'blossom_spa_primary_nagivation' ) ) :
/**
 * Primary Navigation.
*/
function blossom_spa_primary_nagivation(){ ?>
	<nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <button class="toggle-btn" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
        </button>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'blossom_spa_primary_menu_fallback',
            ) );
        ?>
	</nav><!-- #site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'blossom_spa_responsive_primary_nagivation' ) ) :
/**
 * Primary Navigation.
*/
function blossom_spa_responsive_primary_nagivation(){ ?>
    <nav id="res-navigation" class="main-navigation" role="navigation">
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'blossom-spa' ); ?>">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu main-menu-modal',
                        'fallback_cb'    => 'blossom_spa_primary_menu_fallback',
                    ) );
                ?>
            </div>
        </div>
    </nav><!-- #site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'blossom_spa_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function blossom_spa_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'blossom-spa' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'blossom_spa_secondary_navigation' ) ) :
/**
 * Secondary Navigation
*/
function blossom_spa_secondary_navigation(){ ?>
    <div id="secondary-toggle-button">
        <span></span><?php esc_html_e( 'Menu', 'blossom-spa' ); ?>
    </div>
	<nav class="secondary-nav">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'secondary',
				'menu_id'        => 'secondary-menu',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'blossom_spa_secondary_menu_fallback',
			) );
		?>
	</nav>
    <?php
}
endif;

if( ! function_exists( 'blossom_spa_secondary_menu_fallback' ) ) :
/**
 * Fallback for secondary menu
*/
function blossom_spa_secondary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="secondary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'blossom-spa' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'blossom_spa_breadcrumb' ) ) :
/**
 * Breadcrumbs
*/
function blossom_spa_breadcrumb() {
    global $post;
    $post_page  = get_option('page_for_posts'); //The ID of the page that displays posts.
    $show_front = get_option('show_on_front'); //What to show on the front page
    $home       = get_theme_mod('home_text', __('Home', 'blossom-spa')); // text for the 'Home' link
    $delimiter  = '<span class="separator"><i class="fa fa-angle-right"></i></span>';
    $before     = '<span class="current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb

    if( get_theme_mod( 'ed_breadcrumb', true ) ){
            
        $depth = 1;
        echo '<div class="breadcrumb-wrapper"><div class="container" >
                <div id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList"> 
                    <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html( $home ) . '</span></a>
                        <meta itemprop="position" content="'. absint( $depth ).'" />
                        <span class="separator">' .  $delimiter  . '</span>
                    </span>';
        if( is_home() ){
            $depth = 2;
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> '. $after;
            
        }elseif( is_category() ){
            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );

            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                        $depth ++;
                    }
                }
            }
            echo $before . ' <a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> ' . $after;
        
        }elseif( blossom_spa_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
        
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            
            if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }

            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $ancestor ) ) . '"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                        $depth++;
                    }
                }
            }           
            echo $before .'<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">'. esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            
        }elseif( blossom_spa_is_woocommerce_activated() && is_shop() ){ //Shop Archive page

            $depth = 2;
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                return;
            }
            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }
            echo $before .'<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">'. esc_html( $_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 

        }elseif( is_tax( 'blossom_portfolio_categories' ) ){
            $depth = 2;
            $queried_object = get_queried_object();
            $taxonomy = 'blossom_portfolio_categories';
            $ancestors = get_ancestors( $queried_object->term_id, $taxonomy );
            if( !empty( $ancestors ) ){
            $termz = get_term( $ancestors[0], $taxonomy );
            $ancestors_title = !empty( $termz->name ) ? esc_html( $termz->name ) : ''; 
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $termz->term_id ) ) . '"><span itemprop="name">' . $ancestors_title . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
                $depth++ ;
            }
            
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( $queried_object->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        }elseif( is_tag() ){
            
            $queried_object = get_queried_object();
            $depth = 2;

            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_author() ){
            
            $depth = 2;
            global $author;

            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_search() ){
            
            $depth = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before .'<a itemprop="item" href="'. esc_url( $request_uri ) .'"><span itemprop="name">'. esc_html__( 'Search Results for "', 'blossom-spa' ) . esc_html( get_search_query() ) . esc_html__( '"', 'blossom-spa' ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_day() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'blossom-spa' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'blossom-spa' ) ), get_the_time( __( 'm', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'blossom-spa' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'blossom-spa' ) ), get_the_time( __( 'm', 'blossom-spa' ) ), get_the_time( __( 'd', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'd', 'blossom-spa' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_month() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'blossom-spa' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'blossom-spa' ) ), get_the_time( __( 'm', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'F', 'blossom-spa' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_year() ){
            
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-spa' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'blossom-spa' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;

        }elseif( is_single() && !is_attachment() ){
            
            if( blossom_spa_is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                    $depth++;
                }
            
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                    $depth ++;
                }
                
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }elseif( get_post_type() != 'post' ){
                
                $depth = 2;
                $post_type = get_post_type_object( get_post_type() );
                
                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   printf( '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><meta itemprop="position" content="%3$s" />', esc_url( get_post_type_archive_link( get_post_type() ) ), $label, $depth );
                   echo '<meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                   $depth ++;    
                }

                if( get_post_type() =='blossom-portfolio' ){
                    // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   $portfolio_link = blossom_spa_get_page_template_url( 'templates/blossom-portfolio.php' );
                   echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.esc_url( $portfolio_link) .'" itemprop="item"><span itemprop="name">'.esc_html($label).'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                   $depth ++;    
                }

                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                $depth            = 2;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';  
                    $depth++;
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object )
                    {
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term = $key;
                            $potential_parent = $object->term_id;
                        }
                    }
                    
                    $cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                            $depth ++;
                        }
                    }
                }

                 echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;     
                
            }
        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'blossom-spa'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( post_type_archive_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }

        }elseif( is_attachment() ){
            
            $depth = 2;
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            echo  $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
           $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;

        }elseif( is_page() && $post->post_parent ){
            
            global $post;
            $depth = 2;
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $current_page = get_post( $parent_id );
                $breadcrumbs[] = $current_page->ID;
                $parent_id  = $current_page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . $delimiter . '</span> ';
                $depth++;
            }

            echo ' <span class="separator">' .  $delimiter . '</span> ' . $before .'<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'blossom-spa' ) . $after;
        }
        
        if( get_query_var('paged') ) echo __( ' (Page', 'blossom-spa' ) . ' ' . get_query_var('paged') . __( ')', 'blossom-spa' );
        
        echo '</div></div></div><!-- .breadcrumb-wrapper -->';
        
    }  
}
endif;

if( ! function_exists( 'blossom_spa_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function blossom_spa_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); 
                printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s <span class="says">says:</span></b>', 'blossom-spa' ), get_comment_author_link() ); ?>
            </div><!-- .comment-author vcard -->
            <div class="comment-metadata commentmetadata">
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'blossom-spa' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'blossom-spa' ); ?></em>
                <br />
            <?php endif; ?>
        </footer>
        <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>        
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        
	<?php if ( 'div' != $args['style'] ) : ?>
    </article><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'blossom_spa_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function blossom_spa_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_blossom_spa_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_blossom_spa_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_page_template( 'templates/blossom-portfolio.php' ) ) {
                $return = $class ? 'full-width' : false;
            }elseif( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
    }elseif( blossom_spa_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }elseif( 'blossom-portfolio' === get_post_type() ){ //For Portfolio Post Type
        $return = $class ? 'full-width' : false; //Fullwidth
    }elseif( is_404() ){
        $return = $class ? 'full-width' : false;
    }else{
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';    
            }                         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }    
    
    return $return; 
}
endif;

if( ! function_exists( 'blossom_spa_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function blossom_spa_get_home_sections(){
    $ed_banner     = get_theme_mod( 'ed_banner_section', 'static_banner' );
    $disable_all_section = get_theme_mod( 'disable_all_section', false );
    $sections = array( 
        'service'     => array( 'sidebar' => 'service' ),
        'about'       => array( 'sidebar' => 'about' ),
        'service_two' => array( 'sidebar' => 'service-two' ),
        'cta_two'     => array( 'sidebar' => 'cta-two' ),
        'testimonial' => array( 'sidebar' => 'testimonial' ),
        'team'        => array( 'sidebar' => 'team' ),
        'blog'        => array( 'section' => 'blog' ) 
    );
    
    $enabled_section = array();
    
    if( $ed_banner == 'static_banner' ) array_push( $enabled_section, 'banner' );

    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $k );
        }else{
            if( get_theme_mod( 'ed_' . $v['section'] . '_section', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }

    if( $disable_all_section ) {
        $enabled_section = array();
    } 
    
    return apply_filters( 'blossom_spa_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'blossom_spa_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function blossom_spa_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

/**
 * Is Blossom Theme Toolkit active or not
*/
function blossom_spa_is_bttk_activated(){
    return class_exists( 'Blossomthemes_Toolkit' ) ? true : false;
}

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function blossom_spa_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is BlossomThemes Social Feed active or not
*/
function blossom_spa_is_btif_activated(){
    return class_exists( 'Blossomthemes_Instagram_Feed' ) ? true : false;
}
/**
 * Query WooCommerce activation
 */
function blossom_spa_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Query Jetpack activation
*/
function blossom_spa_is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}

if ( ! function_exists( 'blossom_spa_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function blossom_spa_post_thumbnail() {
    global $wp_query;
    $image_size  = 'thumbnail';
    $sidebar     = blossom_spa_sidebar();
    
    if( is_front_page() && is_home() ){
        echo '<a href="' . esc_url( get_permalink() ) . '">';
        $image_size = blossom_spa_blog_layout_image_size();
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            blossom_spa_get_fallback_svg( $image_size );
        }        
        echo '</a>';
    }elseif( is_home() ){        
        echo '<a href="' . esc_url( get_permalink() ) . '">';
        $image_size = blossom_spa_blog_layout_image_size();
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            blossom_spa_get_fallback_svg( $image_size );    
        }        
        echo '</a>';
    }elseif( is_archive() || is_search() ){
        echo '<a href="' . esc_url( get_permalink() ) . '">';
        $image_size = blossom_spa_blog_layout_image_size();
        if( has_post_thumbnail() ){
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            blossom_spa_get_fallback_svg( $image_size );
        }
        echo '</a>';
    }
}
endif;

if ( ! function_exists( 'blossom_spa_singular_post_thumbnail' ) ) :
/**
 * Blog Layout Image Size
*/
function blossom_spa_singular_post_thumbnail() {
    $return = '';
    $ed_featured = get_theme_mod( 'ed_featured_image', true );    

    if( is_singular() ){
        $image_size = 'blossom-spa-single';
        if( is_single() ){
            if( $ed_featured ) $return .= get_the_post_thumbnail_url( '', $image_size );
        }elseif( is_page_template( 'templates/blossom-portfolio.php' ) ){
            $background_image = esc_url( get_template_directory_uri() .'/images/header-bg.jpg' );
            if( has_post_thumbnail() ) :
                $return .= get_the_post_thumbnail_url( '', $image_size );
            else:
                $return .= $background_image;
            endif;
        }else{
            $return .= get_the_post_thumbnail_url( '', $image_size );
        }
    }

    return $return;
}
endif;

if ( ! function_exists( 'blossom_spa_blog_layout_image_size' ) ) :
/**
 * Blog Layout Image Size
*/
function blossom_spa_blog_layout_image_size() {
    $sidebar      = blossom_spa_sidebar();
    $blog_layout  = get_theme_mod( 'blog_page_layout', 'list-layout' );
    
    if( $blog_layout == 'list-layout') { 
        $image_size = 'blossom-spa-blog-list';
    }elseif( $blog_layout == 'classic-layout' ) {
        $image_size = ( $sidebar ) ? 'blossom-spa-blog-classic' : 'blossom-spa-blog-classic-full';
    }elseif( $blog_layout == 'grid-layout' ){ 
        $image_size = 'blossom-spa-blog-classic';
    }else{
        $image_size = 'blossom-spa-blog-list';
    }

    return $image_size;
}
endif;

if( ! function_exists( 'blossom_spa_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function blossom_spa_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'blossom_spa_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function blossom_spa_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = blossom_spa_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#f2f2f2;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         */
        do_action( 'wp_body_open' );
    }
endif;

if( ! function_exists( 'blossom_spa_get_page_template_url' ) ) :
/**
 * Returns page template url if not found returns home page url
*/
function blossom_spa_get_page_template_url( $page_template ){
    $args = array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => $page_template,
        'post_type'  => 'page',
        'fields'     => 'ids',
    );
    
    $posts_array = get_posts( $args );
    
    $url = ( $posts_array ) ? get_permalink( $posts_array[0] ) : get_permalink( get_option( 'page_on_front' ) );
    return $url;    
}
endif;