/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.cmzr-site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.cmzr-site-description' ).text( to );
		} );
	} );

	//Hide/show header in branding
	wp.customize( 'smew_branding_description', function( value ) {
		value.bind( function( to ) {
			if (to) $( '.cmzr-site-header' ).show();
			else $( '.cmzr-site-header' ).hide();
		} );
	} );

	//Hide/show description in header/site-branding
	wp.customize( 'smew_branding_description', function( value ) {
		value.bind( function( to ) {
			if (to) $( '.cmzr-site-description' ).show();
			else $( '.cmzr-site-description' ).hide();
		} );
	} );

	//Hide/show minilogo in header/site-branding
	wp.customize( 'smew_branding_minilogo', function( value ) {
		value.bind( function( to ) {
			if (to) $( '.cmzr-site-minilogo' ).show();
			else $( '.cmzr-site-minilogo' ).hide();
		} );
	} );

	//Brand color
	wp.customize( 'smew_colors_brand', function( value ) {
		value.bind( function( to ) {
			//To do : remove old bg-... class and replace with bg-to
			//$( '.cmzr-navigation-menu' )....
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
