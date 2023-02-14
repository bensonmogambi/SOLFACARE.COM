<?php
/**
 * Blossom Spa Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Blossom_Spa
 */

function blossom_spa_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'blossom-spa' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'blossom-spa' ),
        ),
        'service' => array(
            'name'        => __( 'Service Section', 'blossom-spa' ),
            'id'          => 'service', 
            'description' => __( 'Add "Text" and "Blossom: Icon Text" widget for service section.', 'blossom-spa' ),
        ),
        'about' => array(
            'name'        => __( 'About Section', 'blossom-spa' ),
            'id'          => 'about', 
            'description' => __( 'Add "Blossom: Featured Page Widget" for about section.', 'blossom-spa' ),
        ),
        'service-two' => array(
            'name'        => __( 'Service Two Section', 'blossom-spa' ),
            'id'          => 'service-two', 
            'description' => __( 'Add "Image" and "Blossom: Icon Text" widget for service section.', 'blossom-spa' ),
        ),
        'cta-two' => array(
            'name'        => __( 'Call To Action Section', 'blossom-spa' ),
            'id'          => 'cta-two', 
            'description' => __( 'Add "Blossom: Call To Action" widget for Call to Action section.', 'blossom-spa' ),
        ),
        'team' => array(
            'name'        => __( 'Team Section', 'blossom-spa' ),
            'id'          => 'team', 
            'description' => __( 'Add "Blossom: Team Member" widget for team section.', 'blossom-spa' ),
        ),
        'testimonial' => array(
            'name'        => __( 'Testimonial Section', 'blossom-spa' ),
            'id'          => 'testimonial', 
            'description' => __( 'Add "Blossom: Testimonial" widget for testimonial section.', 'blossom-spa' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'blossom-spa' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'blossom-spa' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'blossom-spa' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'blossom-spa' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'blossom-spa' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'blossom-spa' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'blossom-spa' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'blossom-spa' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }

}
add_action( 'widgets_init', 'blossom_spa_widgets_init' );