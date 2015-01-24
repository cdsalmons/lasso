(function( $ ) {

	$(document).ready(function(){

		/////////////
		// SAVE TITLE
		/////////////

		$(lasso_editor.titleClass).on('blur', function() {

			var target = $(this);

			var data = {
				action: 		'process_update_title',
				postid: 		lasso_editor.postid,
				title:          $.trim( target.text() ),
				nonce: 			lasso_editor.titleNonce
			}

			/////////////
			//	UPDATE THE TITLE
			/////////////
			$.post( lasso_editor.ajaxurl, data, function(response) {

				if ( true == response.success ) {

					var saveClass = 'lasso-title-saved';

					target.addClass(saveClass);

					setTimeout(function(){
						target.removeClass(saveClass);
					},500);
				}

			});

		});

	});

})( jQuery );