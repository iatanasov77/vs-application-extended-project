<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\PricingPlanSubscription as BasePricingPlanSubscription;

/**
 * @ORM\Table(name="VSCAT_PricingPlanSubscriptions")
 * @ORM\Entity
 */
class PricingPlanSubscription extends BasePricingPlanSubscription
{
    
}