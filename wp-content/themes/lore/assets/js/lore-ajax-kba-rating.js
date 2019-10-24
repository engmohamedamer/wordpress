(function($){ "use strict";
$(document).ready( function() {

	$( '.post-rating' ).each( function() {

		var $this = $(this),
			postId = $this.data( 'post-id' ),
			ratingType = $this.hasClass( 'post-rating--type-sum' ) ? 'sum' : 'both',
			$likeBtn = $this.find( '.post-rating__button--like' ),
			$dislikeBtn = $this.find( '.post-rating__button--dislike' ),
			$sumLabel = $this.find( '.post-rating__sum' );

		// Rate post
		function ratePost( rating ) {
			if ( ! $this.hasClass( 'post-rating--loading' ) ) {

				$this.addClass( 'post-rating--loading' );
				$this.find( '.c-alert-message' ).slideUp( 150, function() {
					$(this).remove();
				});

		        // Ajax query
		        jQuery.ajax({
		            type: 'post',
		            url: lsvr_lore_ajax_kba_rating_var.url,
		            data: 'action=lsvr-lore-ajax-kba-rating&nonce=' + lsvr_lore_ajax_kba_rating_var.nonce + '&post_id=' + postId + '&rating_type=' + rating,
		            success: function( response ) {
		            	if ( response !== '' ) {

			            	response = JSON.parse( response );

			            	// Sum rating type
			            	if ( 'sum' === ratingType && response.hasOwnProperty( 'sum_abb' ) ) {

			            		$sumLabel.text( response.sum_abb );

			            	}

			            	// Both and likes only rating type
			            	else {

				            	if ( response.hasOwnProperty( 'likes_abb' ) ) {
				            		$likeBtn.text( response.likes_abb );
				            	}
				            	if ( response.hasOwnProperty( 'likes_btn_title' ) ) {
				            		$likeBtn.attr( 'title', response.likes_btn_title );
				            	}
				            	if ( response.hasOwnProperty( 'dislikes_abb' ) ) {
				            		$dislikeBtn.text( response.dislikes_abb );
				            	}
				            	if ( response.hasOwnProperty( 'dislikes_btn_title' ) ) {
				            		$dislikeBtn.attr( 'title', response.dislikes_btn_title );
				            	}

			            	}

		            		// If rating was saved to DB
			            	if ( 'rating_saved' === response.status ) {
			            		$this.prepend( '<p class="c-alert-message c-alert-message--success" style="display:none">' + response.message_success + '</p>' );
			            	}

			            	// If already rated
			            	else if ( 'already_rated' === response.status ) {
			            		$this.prepend( '<p class="c-alert-message" style="display:none">' + response.message_already_rated + '</p>' );
			            	}

			            	// Error
			            	else {
			            		$this.prepend( '<p class="c-alert-message" style="display:none">' + response.message_error + '</p>' );
			            	}

			            	// Display message
		            		$this.find( '.c-alert-message' ).slideDown( 150, function() {
		            			setTimeout( function() {
		            				$this.find( '.c-alert-message' ).slideUp( 150, function() {
		            					$(this).remove();
		            				} );
		            			}, 5000 );
		            		});

			            	$this.removeClass( 'post-rating--loading' );

	            		}
		            }
		        });

			}
		}

		// Like
		$likeBtn.on( 'click', function(){
			ratePost( 'like' );
		});

		// Dislike
		$dislikeBtn.on( 'click', function(){
			ratePost( 'dislike' );
		});

	});

});
})(jQuery);