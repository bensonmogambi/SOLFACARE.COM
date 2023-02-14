<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Spa
 */
    
    /**
     * After Content
     * 
     * @hooked blossom_spa_content_end - 20
    */
    do_action( 'blossom_spa_before_footer' );
    
    /**
     * Before footer
     * 
     * @hooked blossom_spa_instagram - 10
    */
    do_action( 'blossom_spa_before_footer_start' );

    /**
     * Footer
     * 
     * @hooked blossom_spa_footer_start  - 20
     * @hooked blossom_spa_footer_top    - 30
     * @hooked blossom_spa_footer_bottom - 40
     * @hooked blossom_spa_footer_end    - 50
    */
    do_action( 'blossom_spa_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_spa_page_end    - 20
    */
    do_action( 'blossom_spa_after_footer' );

    wp_footer(); ?>

</body>
</html>
