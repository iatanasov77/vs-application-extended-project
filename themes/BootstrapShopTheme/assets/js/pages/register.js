$( function()
{
    $( 'label.required' ).append( " <sup>*</sup>" );
    
    $( '#registration_form_country' ).on( 'change', function( e ) {
        $.ajax({
            type: "GET",
            url: $( this ).attr( 'data-urlGetStates' ) + $( this ).val(),
            success: function( response )
            {
                //console.log( response );
                
                $( '#registration_form_state' ).html( '' );
                
                $( '#registration_form_state' ).append( $( '<option>', {
                        value: null,
                        text : "-- Select State --"
                    }));
                $.each( response, function ( i, item ) {
                    $( '#registration_form_state' ).append( $( '<option>', {
                        value: i,
                        text : item
                    }));
                });
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
            }
        });
    });
});