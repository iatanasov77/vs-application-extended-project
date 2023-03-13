$( function()
{
	$( '#btnLogout' ).click( function() {
		$.get( $( this ).attr( 'data-url' ), function( data ) {
			location.reload();
		});
	});
});