<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Spa
 */
    /**
     * Doctype Hook
     * 
     * @hooked blossom_spa_doctype
    */
    do_action( 'blossom_spa_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked blossom_spa_head
    */
    do_action( 'blossom_spa_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php

    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked blossom_spa_page_start - 20 
    */
    do_action( 'blossom_spa_before_header' );
    
    /**
     * Header
     *
     * @hooked blossom_spa_responsive_nav - 10 
     * @hooked blossom_spa_header - 20     
    */
    do_action( 'blossom_spa_header' );
    
    /**
     * Content
     * 
     * @hooked blossom_spa_content_start
    */
    do_action( 'blossom_spa_content' );