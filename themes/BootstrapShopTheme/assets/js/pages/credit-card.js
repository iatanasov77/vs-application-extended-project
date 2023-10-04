//require( '@@/js/Stripe/paymentForm.js' );
//import { StripeCard } from '@@/js/Stripe/StripeJsV3.js';
import { SubmitCreditCardForm, SubmitPaymentForm } from '@@/js/Stripe/StripeJsV2.js';

$( function()
{
    //StripeCard();
    
    $( '#credit_card_form' ).on( 'submit', function( e )
    {
        SubmitCreditCardForm( e );
    });
    
    $( '#payment-form' ).on( 'submit', function( e )
    {
        SubmitPaymentForm( e );
    });
});