
$( function()
{
    $( '.btnAddToCart' ).click( function( e ) {
        e.preventDefault();
        //alert( 'Add To Cart Clicked !!!' );
        
        $.ajax({
            type: "GET",
            url: $( this ).attr( 'href' ),
            success: function( response )
            {
                location.reload();
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
            }
        });
    });
});
