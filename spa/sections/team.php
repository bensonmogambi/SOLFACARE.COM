<?php
/**
 * Team Section
 * 
 * @package Blossom_Spa
 */
$team_title 	= get_theme_mod( 'team_title', __( 'Meet Our Experienced Team Members', 'blossom-spa' ) );
$team_content 	= get_theme_mod( 'team_content', __( 'Some of our team members have 10+ years of experience. You can introduce your team members to give a more human feeling to the company.', 'blossom-spa' ) );

if( is_active_sidebar( 'team' ) ){ ?>
<section id="team_section" class="team-section">
	<div class="container">
		<?php if( !empty( $team_title ) || !empty( $team_content ) ) :
			if( !empty( $team_title ) ) echo '<h2 class="section-title">' . esc_html( $team_title ) . '</h2>';
			if( !empty( $team_content ) ) echo '<div class="section-desc">' .  esc_html( $team_content ) . '</div>';
		endif; ?>
		<div class="grid owl-carousel">
	    	<?php dynamic_sidebar( 'team' ); ?>
	    </div>
	</div>
</section> <!-- .team-section -->
<?php
}