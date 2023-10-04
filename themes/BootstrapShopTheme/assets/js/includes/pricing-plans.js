const bootstrap = require( 'bootstrap' );

import Velocity from 'velocity-animate';
import 'velocity-animate/velocity.ui';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// bin/test-vankosoft-application-extended fos:js-routing:dump --format=json --target=public/shared_assets/js/fos_js_routes_application.json
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var routes  = require( '../../../../../public/shared_assets/js/fos_js_routes_application.json' );
import { VsPath } from '@/js/includes/fos_js_routes.js';

export function ChoosePlan( planFormUrl )
{
    $.ajax({
        type: "GET",
        url: planFormUrl,
        success: function( response )
        {
            $( '#selectPricingPlanForm' ).html( response );
            
            /** Bootstrap 5 Modal Toggle */
            const myModal = new bootstrap.Modal( '#plan-modal', {
                keyboard: false
            });
            myModal.show( $( '#plan-modal' ).get( 0 ) );
        },
        error: function()
        {
            alert( "SYSTEM ERROR!!!" );
        }
    });
}

function GetCreditCardForm( url )
{
    /** Bootstrap 5 Modal Toggle */
    const myModal = new bootstrap.Modal( '#plan-modal', {
        keyboard: false
    });
    myModal.hide( $( '#plan-modal' ).get( 0 ) );
    
    $.ajax({
        type: "GET",
        url: url,
        success: function( response )
        {
            $( '.modal-title' ).text( 'Enter Your Card Details' );
            $( '.modal-body' ).attr( 'style', '' );
            $( '.modal-body' ).addClass( 'credit-card' );
            $( '#selectPricingPlanForm' ).addClass( 'credit-card' );
                        
            $( '#selectPricingPlanForm' ).html( response );
            
            myModal.show( $( '#plan-modal' ).get( 0 ) );
        },
        error: function()
        {
            alert( "SYSTEM ERROR!!!" );
        }
    });
}

$( function()
{
    $( ".modal" ).each( function( l ) {
        $( this ).on( "show.bs.modal", function( l ) {
            var o   = $( this ).attr( "data-easein" );
            
            "shake" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) : 
            "pulse" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) :
            "tada" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) :
            "flash" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) :
            "bounce" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) :
            "swing" == o ? $( ".modal-dialog" ).velocity( "callout." + o ) :
            $( ".modal-dialog" ).velocity( "transition." + o )
        });
    });
    
    $( '#selectPricingPlanForm' ).on( 'click', '#SelectPricingPlanSubmit', function ( e ) {
        e.preventDefault();
        e.stopPropagation();
        
        var formData    = new FormData( document.getElementById( 'PricingPlanForm' ) );
        $.ajax({
            type: "POST",
            url: VsPath( 'vs_payment_handle_pricing_plan_form', {}, routes ),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function( response )
            {
                //alert( response.data.paymentPrepareUrl );
                //alert( response.data.gatewayFactory );
                switch ( response.data.gatewayFactory ) {
                    case 'stripe_checkout':
                    case 'stripe_js':
                        GetCreditCardForm( VsPath( response.data.paymentPrepareUrl, {}, routes ) );
                        
                        break;
                    default:
                        document.location   = VsPath( response.data.paymentPrepareUrl, {}, routes );
                }
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
            }
        });
    });
});
