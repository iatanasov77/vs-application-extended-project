<?php namespace App\Entity\Catalog;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CatalogBundle\Model\ServiceAssociation as BaseServiceAssociation;

/* This Resource Should be Created when Use Content Services in Project.
 * 
 * @ORM\Table(name="VSCAT_ServiceAssociations")
 * @ORM\Entity
 */
class ServiceAssociation extends BaseServiceAssociation
{
    
}
