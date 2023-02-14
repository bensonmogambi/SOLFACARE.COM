jQuery(document).ready(function($){
    /* Move Front page widgets to front-page panel */
    wp.customize.section( 'sidebar-widgets-service' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-service' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-about' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '25' );
    wp.customize.section( 'sidebar-widgets-service-two' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-service-two' ).priority( '40' );
    wp.customize.section( 'sidebar-widgets-cta-two' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-cta-two' ).priority( '80' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).priority( '90' );    
    wp.customize.section( 'sidebar-widgets-team' ).priority( '100' );
    wp.customize.section( 'sidebar-widgets-team' ).panel( 'frontpage_settings' );

    //Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        Blossom_Spa_scrollToSection( section_id );
    });  
    
    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( blossom_spa_cdata.home );
            }
        });
    });

    $( 'input[name=blossom-spa-flush-local-fonts-button]' ).on( 'click', function( e ) {
        var data = {
            wp_customize: 'on',
            action: 'blossom_spa_flush_fonts_folder',
            nonce: blossom_spa_cdata.flushFonts
        };  
        $( 'input[name=blossom-spa-flush-local-fonts-button]' ).attr('disabled', 'disabled');

        $.post( ajaxurl, data, function ( response ) {
            if ( response && response.success ) {
                $( 'input[name=blossom-spa-flush-local-fonts-button]' ).val( 'Successfully Flushed' );
            } else {
                $( 'input[name=blossom-spa-flush-local-fonts-button]' ).val( 'Failed, Reload Page and Try Again' );
            }
        });
    });
});

function Blossom_Spa_scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-service':
        preview_section_id = "service_section";
        break;

        case 'accordion-section-sidebar-widgets-about':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-sidebar-widgets-service-two':
        preview_section_id = "service_section_two";
        break;

        case 'accordion-section-sidebar-widgets-cta-two':
        preview_section_id = "cta_section_two";
        break;

        case 'accordion-section-sidebar-widgets-team':
        preview_section_id = "team_section";
        break;

        case 'accordion-section-blog_section':
        preview_section_id = "blog_section";
        break;

        case 'accordion-section-sidebar-widgets-testimonial':
        preview_section_id = "testimonial_section";
        break;       
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

    // Extends our custom "example-1" section.
    api.sectionConstructor['blossom-spa-pro-section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );