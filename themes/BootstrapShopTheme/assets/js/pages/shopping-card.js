//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// bin/test-vankosoft-application-extended fos:js-routing:dump --format=json --target=public/shared_assets/js/fos_js_routes_application.json
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var routes  = require( '../../../../../public/shared_assets/js/fos_js_routes_application.json' );
import { VsPath } from '@@/js/includes/fos_js_routes.js';

$( function()
{
    $( '.CartItemQty' ).on( 'change', function( e )
    {
       //alert( $( this ).val() );
       let newQty           = $( this ).val();
       let singlePrice      = $( this ).attr( 'data-singlePrice' );
       let oldItemTotal     = $( this ).closest( 'td' ).siblings( ".ItemTotal" ).children( ".ItemTotalValue" ).text();
       let newItemTotal     = newQty * singlePrice;
       let oldGrandTotal    = $( '#GrandTotalValue' ).text();
       let newGrandTotal    = parseInt( oldGrandTotal ) + ( newItemTotal - oldItemTotal );
       
       //alert( newGrandTotal );
       $( this ).closest( 'td' ).siblings( ".ItemTotal" ).children( ".ItemTotalValue" ).text( newItemTotal );
       $( '#GrandTotalValue' ).text( newGrandTotal )
    });
    
    $( '.CartItemQtyMinus' ).on( 'click', function( e )
    {
       let qty  = $( this ).siblings( ".CartItemQty" ).val();
       $( this ).siblings( ".CartItemQty" ).val( --qty );
       $( this ).siblings( ".CartItemQty" ).trigger( 'change' );
    });
    
    $( '.CartItemQtyPlus' ).on( 'click', function( e )
    {
       let qty  = $( this ).siblings( ".CartItemQty" ).val();
       $( this ).siblings( ".CartItemQty" ).val( ++qty );
       $( this ).siblings( ".CartItemQty" ).trigger( 'change' );
    });
    
    $( '.RemoveCartItem' ).on( 'click', function( e )
    {
        $.ajax({
            type: "GET",
            url: VsPath( 'vs_payment_remove_from_card', {'itemId': $( this ).attr( 'data-itemId' ) }, routes ),
            success: function( response )
            {
                document.location   = document.location;
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
            }
        });
    });
    
    $( '#btnUpdateCart' ).on( 'click', function( e )
    {
        e.preventDefault();
        e.stopPropagation();
        
        var cartItems   = [];
        $( '.CartItemQty' ).each( function()
        {
            cartItems[$( this ).attr( 'data-itemId' )] = $( this ).val();
        });
        
        var jsonCartItems   = JSON.stringify( cartItems );
        var formData    = new FormData();
        formData.append( "CartItems", jsonCartItems );
        
        $.ajax({
            type: "POST",
            url: VsPath( 'vs_payment_update_card', {}, routes ),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function( response )
            {
                document.location   = document.location;
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
            }
        });
    });
});