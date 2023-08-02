<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\PricingPlan as BasePricingPlan;

/**
 * @ORM\Table(name="VSPAY_PricingPlans")
 * @ORM\Entity
 */
class PricingPlan extends BasePricingPlan
{
    
}
