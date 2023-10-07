
/**
 * Using StripeJsV3 With NPM
 */
//import { StripeCard } from '@@/js/Stripe/StripeJsV3.js';

/**
 * Using StripeJsV2
 */
import { SubmitCreditCardForm, SubmitPaymentForm } from '@@/js/Stripe/StripeJsV2.js';
//import { SubmitCreditCardForm, SubmitPaymentForm } from '../includes/StripeJsV2.js';

$( function()
{
    /**
     * Using StripeJsV3 With NPM
     */
    //StripeCard();
    
    /**
     * Using StripeJsV2
     */
    $( '#credit_card_form' ).on( 'submit', SubmitCreditCardForm );
    $( '#payment-form' ).on( 'submit', SubmitPaymentForm );
});