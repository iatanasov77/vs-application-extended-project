<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\ProductFile as BaseProductFile;

/**
 * @ORM\Table(name="VSCAT_ProductFiles")
 * @ORM\Entity
 */
class ProductFile extends BaseProductFile
{
    
}
