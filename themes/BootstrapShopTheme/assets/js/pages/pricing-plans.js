import { SubmitCreditCardForm, SubmitPaymentForm } from '@@@/js/Stripe/StripeJsV2.js';
import { SubmitPayumCreditCardForm } from '@@@/js/Payum/Payum.js';
import { ChoosePlan } from '@@@@/js/includes/pricing_plan.js';
import '../includes/pricing-plans.js';

$( function()
{
    $( '.btnChoosePlan' ).on( 'click', function()
    {
        ChoosePlan( $( this ).attr( 'data-url' ) );
    });
    
    $( '#selectPricingPlanForm' ).on( 'submit', '#credit_card_form', SubmitCreditCardForm );
    $( '#payment-form' ).on( 'submit', SubmitPaymentForm );
    
    $( '#selectPricingPlanForm' ).on( 'submit', '#payum_credit_card_form', SubmitPayumCreditCardForm );
});
