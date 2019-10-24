(function($){ "use strict";
$(document).ready( function() {

	// Trigger search
	$( '.header-search-form--ajax' ).each( function() {

		var $form = $(this),
			$input = $form.find( '.header-search-form__input' ),
			$filter = $form.find( '.header-search-form__filter' ),
			searchQuery = '',
			postType,
			postTypeArr = [];

		// Post type filter
		$filter.find( '.header-search-form__filter-checkbox:checked' ).each( function() {
			postTypeArr.push( $(this).val() );
		});
		postType = postTypeArr.length < 1 ? 'any' : postTypeArr.join();
		postTypeArr = [];

		// Change, keyup & paste events
		$input.on( 'change keyup paste', function(e) {

			var newSearchQuery = $(this).val();
			if ( ( newSearchQuery !== searchQuery ) && ! ( 38 === e.which || 40 === e.which || 13 === e.which ) ) {
				searchQuery = newSearchQuery.trim();
				getResults( $form, postType, searchQuery );
			}

		});

		// Focus event
		$input.on( 'focus', function(e) {

			var newSearchQuery = $(this).val();

			// Show already existing but hidden search results
			if ( ( newSearchQuery === searchQuery ) && $form.find( '.header-search-form__results' ).length > 0 ) {
				$form.find( '.header-search-form__results' ).slideDown( 300 );
			}

			// If there are no results, send request
			else {
				searchQuery = newSearchQuery.trim();
				getResults( $form, postType, searchQuery );
			}

		});

		// Change post type filter
		$filter.find( '.header-search-form__filter-checkbox' ).on( 'change', function() {

			$filter.find( 'input:checked' ).each( function() {
				postTypeArr.push( $(this).val() );
			});
			postType = postTypeArr.length < 1 ? 'any' : postTypeArr.join();
			postTypeArr = [];

			getResults( $form, postType, searchQuery );

		});

		// Keyboard navigation
		$input.on( 'keydown', function(e) {

			var $searchResults = $form.find( '.header-search-form__results' ),
				$active = $searchResults.find( '.header-search-form__results-item--active' );

			// Arrow down
			if ( 40 === e.which ) {

				if ( $active.length < 1 || $active.filter( ':last-child' ).length ) {
					$active.removeClass( 'header-search-form__results-item--active' );
					$searchResults.find( '.header-search-form__results-item:first-child' ).addClass( 'header-search-form__results-item--active' );
				}
				else {
					$active.removeClass( 'header-search-form__results-item--active' );
					$active.next().addClass( 'header-search-form__results-item--active' );
				}

				e.preventDefault();
                e.stopPropagation();

			}

			// Arrow up
			if ( 38 === e.which ) {

				if ( $active.length < 1 || $active.filter( ':first-child' ).length ) {
					$active.removeClass( 'header-search-form__results-item--active' );
					$searchResults.find( '.header-search-form__results-item:last-child' ).addClass( 'header-search-form__results-item--active' );
				}
				else {
					$active.removeClass( 'header-search-form__results-item--active' );
					$active.prev().addClass( 'header-search-form__results-item--active' );
				}

				e.preventDefault();
                e.stopPropagation();

			}

			// Enter
			if ( 13 === e.which ) {

				if ( $active.length ) {
					window.location.href = $active.find( 'a' ).attr( 'href' );
					e.preventDefault();
                	e.stopPropagation();
				}

			}

		});

	});

	// Get search results
	var ajaxRequest = null;
	function getResults( $form, postType, searchQuery ) {

		searchQuery = searchQuery.trim();

		// Check minimum search query length
		if ( searchQuery.length > 1 ) {

			// Delay before sending request
			clearTimeout( $form.data( 'ajax-search-timer' ) );
			$form.data( 'ajax-search-timer', setTimeout( function() {

				$form.addClass( 'header-search-form--loading' );
				$form.find( '.header-search-form__spinner' ).fadeIn( 150 );

		        // Ajax request
		        if ( null !== ajaxRequest ) { ajaxRequest.abort(); }
		        ajaxRequest = jQuery.ajax({
		            type: 'post',
		            url: lsvr_lore_ajax_search_var.url,
		            data: 'action=lsvr-lore-ajax-search&nonce=' + lsvr_lore_ajax_search_var.nonce + '&post_type=' + postType + '&search_query=' + searchQuery,
		            success: function( response ) {

		            	if ( '' !== response ) {

							var responseJson = false;

		            		// Parse JSON
		            		try {
								responseJson = JSON.parse( response );
							}

							// Invalid response
							catch(e) {
								console.log( 'Ajax Search Response: INVALID JSON' );
							}

							// Show results
							if ( responseJson ) {
								showResults( $form, responseJson );
							}

		            	} else {
		            		console.log( 'Ajax Search Response: BLANK' );
		            	}

						$form.removeClass( 'header-search-form--loading' );
						$form.find( '.header-search-form__spinner' ).fadeOut( 150 );

		            },
		            error: function() {
		            	$form.removeClass( 'header-search-form--loading' );
		            	$form.find( '.header-search-form__spinner' ).fadeOut( 150 );
						console.log( 'Ajax Search Response: ERROR' );
		            }
		        });

	        }, 500 ));

		}

	}

	// Show search results
	function showResults( $form, json ) {
		if ( json.hasOwnProperty( 'status' ) ) {

			var status = json.status,
				$input = $form.find( '.header-search-form__input' ),
				output = '';

			// If has results
			if ( 'ok' === status && json.hasOwnProperty( 'results' ) ) {

				$.each( json.results, function() {

					if ( this.hasOwnProperty( 'post_title' ) && this.hasOwnProperty( 'permalink' ) &&
						this.hasOwnProperty( 'post_type' ) ) {

						output += '<li class="header-search-form__results-item header-search-form__results-item--' + this.post_type + '">';
						output += '<i class="header-search-form__results-item-icon c-post-type-icon c-post-type-icon--' + this.post_type + '"></i>';
						output += '<a href="' + this.permalink + '" class="header-search-form__results-item-link">' + this.post_title + '</a>';

							// Likes
							if ( json.hasOwnProperty( 'rating_type' ) && 'likes' === json.rating_type && this.hasOwnProperty( 'post_type' )
								&& this.hasOwnProperty( 'rating_likes_abb' ) ) {

								output += '<span class="header-search-form__results-item-rating c-post-rating">';
								output += '<span class="c-post-rating__likes">' + this.rating_likes_abb + '</span>';
								output += '</span>';

							}

							// Dislikes
							else if ( json.hasOwnProperty( 'rating_type' ) && 'both' === json.rating_type
								&& this.hasOwnProperty( 'rating_likes_abb' ) && this.hasOwnProperty( 'rating_dislikes_abb' ) ) {

								output += '<span class="header-search-form__results-item-rating c-post-rating">';
								output += '<span class="c-post-rating__likes">' + this.rating_likes_abb + '</span>';
								output += '<span class="c-post-rating__dislikes">' + this.rating_dislikes_abb + '</span>';
								output += '</span>';

							}

							// Sum
							else if ( json.hasOwnProperty( 'rating_type' ) && 'sum' === json.rating_type
								&& this.hasOwnProperty( 'rating_sum_abb' ) && this.hasOwnProperty( 'rating_sum' ) ) {

								output += '<span class="header-search-form__results-item-rating c-post-rating">';

								if ( parseInt( this.rating_sum ) >= 0 ) {

									output += '<span class="c-post-rating__sum c-post-rating__sum--positive">' + this.rating_sum_abb + '</span>';

								} else {

									output += '<span class="c-post-rating__sum c-post-rating__sum--negative">' + this.rating_sum_abb + '</span>';

								}

								output += '</span>';

							}

						output += '</li>';

					}

				});
				output = '<ul class="header-search-form__results-list">' + output + '</ul>';

				// More link
				if ( json.hasOwnProperty( 'more_label' ) && json.hasOwnProperty( 'more_link' ) ) {
					output += '<p class="header-search-form__results-more">';
					output += '<a href="' + json.more_link + '" class="header-search-form__results-more-link">' + json.more_label + '</a></p>';
				}

			}

			// No results
			else if ( 'noresults' === status ) {
				var message = json.hasOwnProperty( 'message' ) ? json.message : '';
				if ( '' !== message ) {
					output = '<p class="header-search-form__results-message">' + message + '</p>';
				}
			}

			// Display results
			if ( '' !== output ) {

				if ( $form.find( '.header-search-form__results' ).length > 0 ) {
					$form.find( '.header-search-form__results' ).first().html( output );
				} else {
					$form.find( '.header-search-form__panel-inner' ).append( '<div class="header-search-form__results">' + output + '</div>' );
				}
				if ( $form.find( '.header-search-form__results' ).is( ':hidden' ) ) {
					$form.find( '.header-search-form__results' ).slideDown( 300 );
				}

			}

		}
	}

});
})(jQuery);