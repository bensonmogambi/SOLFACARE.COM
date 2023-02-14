<?php
/**
 * Blog Section
 * 
 * @package Blossom_Spa
 */

$ed_blog          = get_theme_mod( 'ed_blog_section', true );
$section_title    = get_theme_mod( 'blog_section_title', __( 'Read Our Recent Articles', 'blossom-spa' ) );
$description  = get_theme_mod( 'blog_section_content', __( 'Show your customers that you know what you are doing by writing helpful articles related to your business. You can display your recent blog posts here. To modify this section, go to Appearance > Customize > Front Page Settings > Blog Section.', 'blossom-spa' ) );
$readmore = get_theme_mod( 'blog_readmore', __( 'READ MORE', 'blossom-spa' ) );
$blog     = get_option( 'page_for_posts' );
$label    = get_theme_mod( 'blog_view_all', __( 'VIEW MORE', 'blossom-spa' ) );

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

if( $ed_blog && ( $section_title || $description || $qry->have_posts() ) ){ ?>

<section id="blog_section" class="recent-post-section">
	<div class="container">
        
        <?php if( $section_title || $description ){  
            if( $section_title ) echo '<h2 class="section-title">' . esc_html( $section_title ) . '</h2>';
            if( $description ) echo '<div class="section-desc">' . wp_kses_post( wpautop( $description ) ) . '</div>'; 
        } ?>
        
        <?php if( $qry->have_posts() ){ ?>
            <div class="grid">
    			<?php 
                while( $qry->have_posts() ){
                    $qry->the_post(); ?>
                    <article class="post">
        				<figure class="post-thumbnail">
                            <?php blossom_spa_category(); ?>
                            <a href="<?php the_permalink(); ?>">
                            <?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( 'blossom-spa-service', array( 'itemprop' => 'image' ) );
                                }else{ 
                                    blossom_spa_get_fallback_svg( 'blossom-spa-service' );
                                }                            
                            ?>                        
                            </a>
                        </figure>
        				<div class="content-wrap">
        					<header class="entry-header">
        						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-meta">
                                    <?php 
                                        blossom_spa_posted_on();
                                        blossom_spa_comment_count(); 
                                    ?>
                                </div>
                            </header>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>                          
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo esc_html( $readmore ); ?></a>
                            </footer>
                        </div>
        			</article>			
        			<?php 
                }
                ?>
    		</div>
    		
            <?php if( $blog && $label ){ ?>
                <div class="btn-wrap">
        			<a href="<?php the_permalink( $blog ); ?>" class="btn-readmore"><?php echo esc_html( $label ); ?></a>
        		</div>
            <?php } ?>
        
        <?php }
        wp_reset_postdata(); ?>
	</div>
</section>
<?php 
}