<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\ProductCategory as ProductCategoryBase;

/**
 * @ORM\Table(name="VSCAT_ProductCategories")
 * @ORM\Entity
 */
class ProductCategory extends ProductCategoryBase
{
    
}
