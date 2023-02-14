<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blossom_Spa
 */    
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <?php 
    		while ( have_posts() ) : the_post();

    			get_template_part( 'template-parts/content', get_post_type() );

    		endwhile; // End of the loop.
    		?>
        </main><!-- #main -->        

        <?php
            /**
             * @hooked blossom_spa_author               - 15
             * @hooked blossom_spa_navigation           - 20
             * @hooked blossom_spa_related_posts        - 25 
             * @hooked blossom_spa_comment              - 30
            */
            do_action( 'blossom_spa_after_post_content' );
        ?>
    </div><!-- #primary -->
<?php
get_sidebar();
get_footer();
