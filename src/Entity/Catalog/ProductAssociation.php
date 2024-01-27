<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\ProductAssociation as BaseProductAssociation;

/**
 * @ORM\Table(name="VSCAT_ProductAssociations")
 * @ORM\Entity
 */
class ProductAssociation extends BaseProductAssociation
{
    
}
