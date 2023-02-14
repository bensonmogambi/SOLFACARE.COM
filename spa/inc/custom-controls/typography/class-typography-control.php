<?php
/**
 * Blossom Spa Customizer Typography Control
 *
 * @package Blossom_Spa
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Blossom_Spa_Typography_Control' ) ) {
    
    class Blossom_Spa_Typography_Control extends WP_Customize_Control{
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'blossom_spa_il8n_strings', array(
    			'on'                 => esc_attr__( 'ON', 'blossom-spa' ),
    			'off'                => esc_attr__( 'OFF', 'blossom-spa' ),
    			'all'                => esc_attr__( 'All', 'blossom-spa' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'blossom-spa' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'blossom-spa' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'blossom-spa' ),
    			'greek'              => esc_attr__( 'Greek', 'blossom-spa' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'blossom-spa' ),
    			'khmer'              => esc_attr__( 'Khmer', 'blossom-spa' ),
    			'latin'              => esc_attr__( 'Latin', 'blossom-spa' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'blossom-spa' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'blossom-spa' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'blossom-spa' ),
    			'arabic'             => esc_attr__( 'Arabic', 'blossom-spa' ),
    			'bengali'            => esc_attr__( 'Bengali', 'blossom-spa' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'blossom-spa' ),
    			'tamil'              => esc_attr__( 'Tamil', 'blossom-spa' ),
    			'telugu'             => esc_attr__( 'Telugu', 'blossom-spa' ),
    			'thai'               => esc_attr__( 'Thai', 'blossom-spa' ),
    			'serif'              => _x( 'Serif', 'font style', 'blossom-spa' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'blossom-spa' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'blossom-spa' ),
    			'font-family'        => esc_attr__( 'Font Family', 'blossom-spa' ),
    			'font-size'          => esc_attr__( 'Font Size', 'blossom-spa' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'blossom-spa' ),
    			'line-height'        => esc_attr__( 'Line Height', 'blossom-spa' ),
    			'font-style'         => esc_attr__( 'Font Style', 'blossom-spa' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'blossom-spa' ),
    			'text-align'         => esc_attr__( 'Text Align', 'blossom-spa' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'blossom-spa' ),
    			'none'               => esc_attr__( 'None', 'blossom-spa' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'blossom-spa' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'blossom-spa' ),
    			'top'                => esc_attr__( 'Top', 'blossom-spa' ),
    			'bottom'             => esc_attr__( 'Bottom', 'blossom-spa' ),
    			'left'               => esc_attr__( 'Left', 'blossom-spa' ),
    			'right'              => esc_attr__( 'Right', 'blossom-spa' ),
    			'center'             => esc_attr__( 'Center', 'blossom-spa' ),
    			'justify'            => esc_attr__( 'Justify', 'blossom-spa' ),
    			'color'              => esc_attr__( 'Color', 'blossom-spa' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'blossom-spa' ),
    			'variant'            => esc_attr__( 'Variant', 'blossom-spa' ),
    			'style'              => esc_attr__( 'Style', 'blossom-spa' ),
    			'size'               => esc_attr__( 'Size', 'blossom-spa' ),
    			'height'             => esc_attr__( 'Height', 'blossom-spa' ),
    			'spacing'            => esc_attr__( 'Spacing', 'blossom-spa' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'blossom-spa' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'blossom-spa' ),
    			'light'              => esc_attr__( 'Light 200', 'blossom-spa' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'blossom-spa' ),
    			'book'               => esc_attr__( 'Book 300', 'blossom-spa' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'blossom-spa' ),
    			'regular'            => esc_attr__( 'Normal 400', 'blossom-spa' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'blossom-spa' ),
    			'medium'             => esc_attr__( 'Medium 500', 'blossom-spa' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'blossom-spa' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'blossom-spa' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'blossom-spa' ),
    			'bold'               => esc_attr__( 'Bold 700', 'blossom-spa' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'blossom-spa' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'blossom-spa' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'blossom-spa' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'blossom-spa' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'blossom-spa' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'blossom-spa' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'blossom-spa-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		wp_enqueue_script( 'blossom-spa-selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    		wp_enqueue_script( 'blossom-spa-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array( 'jquery', 'blossom-spa-selectize' ), false, true );
    
    		$google_fonts   = Blossom_Spa_Fonts::get_google_fonts();
    		$standard_fonts = Blossom_Spa_Fonts::get_standard_fonts();
    		$all_variants   = Blossom_Spa_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'blossom-spa-typography', 'all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template(){ ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="blossom-spa-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant blossom-spa-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="blossom-spa-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}   

        protected function render_content(){
        } 
    }
}