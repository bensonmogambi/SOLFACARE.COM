<?php
/**
 * CTA Section
 * 
 * @package Blossom_Spa
 */
if( is_active_sidebar( 'cta-two' ) ){ ?>
<section id="cta_section_two" class="cta-section">
    <?php dynamic_sidebar( 'cta-two' ); ?>
</section> <!-- .bg-cta-section -->
<?php
}