/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

// (function ($) {
//   // Site title and description.
//   wp.customize("blogname", function (value) {
//     value.bind(function (to) {
//       $(".site-title a").text(to);
//     });
//   });
//   wp.customize("blogdescription", function (value) {
//     value.bind(function (to) {
//       $(".site-description").text(to);
//     });
//   });

//   // Header text color.
//   wp.customize("header_textcolor", function (value) {
//     value.bind(function (to) {
//       if ("blank" === to) {
//         $(".site-title, .site-description").css({
//           clip: "rect(1px, 1px, 1px, 1px)",
//           position: "absolute",
//         });
//       } else {
//         $(".site-title, .site-description").css({
//           clip: "auto",
//           position: "relative",
//         });
//         $(".site-title a, .site-description").css({
//           color: to,
//         });
//       }
//     });
//   });
// })(jQuery);



jQuery( function($){
	// on upload button click
	$( 'body' ).on( 'click', '.rudr-upload', function( event ){
		event.preventDefault(); // prevent default link click and page refresh
		console.log($(this));
		const button = $(this)
		const imageId = button.next().next().val();
		
		const customUploader = wp.media({
			title: 'Insert image', // modal window title
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false
		}).on( 'select', function() { // it also has "open" and "close" events
			const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			button.removeClass( 'button' ).html( '<img width="50" height="50" src="' + attachment.url + '">'); // add image instead of "Upload Image"
			button.next().show(); // show "Remove image" link
			button.next().next().val( attachment.id ); // Populate the hidden field with image ID
		})
		
		//already selected images
		customUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}
			
		})

		customUploader.open()
	
	});
	// on remove button click
	$( 'body' ).on( 'click', '.rudr-remove', function( event ){
		event.preventDefault();
		const button = $(this);
		button.next().val( '' ); // emptying the hidden field
		button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
	});
});

jQuery( function( $ ){

	let numberOfTags = 0;
	let newNumberOfTags = 0;

	// when there are some terms are already created
	if( ! $( '#the-list' ).children( 'tr' ).first().hasClass( 'no-items' ) ) {
		numberOfTags = $( '#the-list' ).children( 'tr' ).length;
	}

	// after a term has been added via AJAX	
	$(document).ajaxComplete( function( event, xhr, settings ){

		newNumberOfTags = $( '#the-list' ).children('tr').length;
		if( parseInt( newNumberOfTags ) > parseInt( numberOfTags ) ) {
			// refresh the actual number of tags variable
			numberOfTags = newNumberOfTags;
	
			// empty custom fields right here
			$( '.rudr-remove' ).each( function(){
				// empty hidden field
				$(this).next().val('');
				// hide remove image button
				$(this).hide().prev().addClass( 'button' ).text( 'Upload image' );
			});
		}
	});
});