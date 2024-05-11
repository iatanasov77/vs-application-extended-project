<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\PricingPlan as BasePricingPlan;

/**
 * @ORM\Table(name="VSCAT_PricingPlans")
 * @ORM\Entity
 */
class PricingPlan extends BasePricingPlan
{
    
}
