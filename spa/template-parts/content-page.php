<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Spa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php   
        /**
         * Entry Content
         * 
         * @hooked blossom_spa_entry_content - 15
         * @hooked blossom_spa_entry_footer  - 20
        */
        do_action( 'blossom_spa_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
