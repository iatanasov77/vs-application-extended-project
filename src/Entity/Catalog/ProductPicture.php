<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\ProductPicture as BaseProductPicture;

/**
 * @ORM\Table(name="VSCAT_ProductPictures")
 * @ORM\Entity
 */
class ProductPicture extends BaseProductPicture
{
    
}
