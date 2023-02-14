<?php
/**
 * Help Panel.
 *
 * @package Blossom_Spa
 */
?>
<!-- Updates panel -->
<div id="plugins-panel" class="panel-left visible">
	<h4><?php esc_html_e( 'Recommended Plugins', 'blossom-spa' ); ?></h4>

	<p><?php esc_html_e( 'Below is a list of recommended plugins to install that will help you get the most out of Blossom Spa. Although each plugin is optional, it is recommended that you at least install the BlossomThemes Toolkit, BlossomThemes Email Newsletter & BlossomThemes Instagram Feed to create a website similar to the Blossom Spa demo.', 'blossom-spa' ); ?></p>

	<hr/>

	<?php 
	$free_plugins = array(

		'blossomthemes-toolkit' => array(
			'slug'     	=> 'blossomthemes-toolkit',
			'filename' 	=> 'blossomthemes-toolkit.php',
		),

		'blossomthemes-email-newsletter' => array(
			'slug' 	 	=> 'blossomthemes-email-newsletter',
			'filename'  => 'blossomthemes-email-newsletter.php',
		),

		'blossomthemes-instagram-feed' => array(
			'slug' 		=> 'blossomthemes-instagram-feed',
			'filename' 	=> 'blossomthemes-instagram-feed.php',
		),

		'regenerate-thumbnails' => array(
			'slug' 		=> 'regenerate-thumbnails',
			'filename' 	=> 'regenerate-thumbnails.php',
		),

	);

	if( !empty( $free_plugins ) ) { ?>
		<h4 class="recomplug-title"><?php esc_html_e( 'Free Plugins', 'blossom-spa' ); ?></h4>
		<p><?php esc_html_e( 'These Free Plugins might be handy for you.', 'blossom-spa' ); ?></p>
		<div class="recomended-plugin-wrap">
			<?php
			foreach( $free_plugins as $plugin ) {
				$info 		= blossom_spa_call_plugin_api( $plugin['slug'] );
				$icon_url 	= blossom_spa_check_for_icon( $info->icons ); ?>
				<div class="recom-plugin-wrap">
					<div class="plugin-img-wrap">
						<img src="<?php echo esc_url( $icon_url ); ?>" />
						<div class="version-author-info">
							<span class="version"><?php printf( esc_html__( 'Version %s', 'blossom-spa' ), $info->version ); ?></span>
							<span class="seperator">|</span>
							<span class="author"><?php echo esc_html( strip_tags( $info->author) ); ?></span>
						</div>
					</div>
					<div class="plugin-title-install clearfix">
						<span class="title" title="<?php echo esc_attr( $info->name ); ?>">
							<?php echo esc_html( $info->name ); ?>	
						</span>
						<?php 
						echo '<div class="button-wrap">';
						echo Blossom_Spa_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'] );
						echo '</div>';
						?>
					</div>
				</div>
				<?php
			} ?>
		</div>
	<?php
	} ?>
</div><!-- .panel-left -->