<?php
/**
 * Testimonial Section
 * 
 * @package Blossom_Spa
 */

$testimonial_title 	= get_theme_mod( 'testimonial_title', __( 'Here\'s What Our Customers Think', 'blossom-spa' ) );
$testimonial_content 	= get_theme_mod( 'testimonial_content', __( 'Our customers love us. We make sure that we make every customer happy. Showcase the feedback from your old customers to build trust with new customers using testimonials.', 'blossom-spa' ) );

if( is_active_sidebar( 'testimonial' ) ){ ?>
<section id="testimonial_section" class="testimonial-section">
	<div class="container">
		<?php if( !empty( $testimonial_title ) || !empty( $testimonial_content ) ) :
			if( !empty( $testimonial_title ) ) echo '<h2 class="section-title">' . esc_html( $testimonial_title ) . '</h2>';
			if( !empty( $testimonial_content ) ) echo '<div class="section-desc">' . wpautop( wp_kses_post( $testimonial_content ) ) . '</div>';
		endif; ?>
		<div class="grid owl-carousel">
    		<?php dynamic_sidebar( 'testimonial' ); ?>
    	</div>
    </div>
</section> <!-- .testimonial-section -->
<?php
}