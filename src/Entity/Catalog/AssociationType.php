<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\AssociationType as BaseAssociationType;

/**
 * @ORM\Table(name="VSCAT_AssociationTypes")
 * @ORM\Entity
 */
class AssociationType extends BaseAssociationType
{
    
}
