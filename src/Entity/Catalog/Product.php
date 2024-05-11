<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\Product as BaseProduct;

/**
 * @ORM\Table(name="VSCAT_Products")
 * @ORM\Entity
 */
class Product extends BaseProduct
{
    
}
