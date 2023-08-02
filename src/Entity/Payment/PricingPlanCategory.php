<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\PricingPlanCategory as BasePricingPlanCategory;

/**
 * @ORM\Table(name="VSPAY_PricingPlanCategories")
 * @ORM\Entity
 */
class PricingPlanCategory extends BasePricingPlanCategory
{
    
}
