<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\PricingPlanCategory as BasePricingPlanCategory;

/**
 * @ORM\Table(name="VSCAT_PricingPlanCategories")
 * @ORM\Entity
 */
class PricingPlanCategory extends BasePricingPlanCategory
{
    
}
