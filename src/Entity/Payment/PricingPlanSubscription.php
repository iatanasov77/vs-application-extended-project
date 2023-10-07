<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\PricingPlanSubscription as BasePricingPlanSubscription;

/**
 * @ORM\Table(name="VSPAY_PricingPlanSubscriptions")
 * @ORM\Entity
 */
class PricingPlanSubscription extends BasePricingPlanSubscription
{
    
}