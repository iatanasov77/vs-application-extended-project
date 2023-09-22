<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\TagsWhitelistContext as BaseTagsWhitelistContext;

/**
 * @ORM\Table(name="VSAPP_TagsWhitelistContexts")
 * @ORM\Entity
 */
class TagsWhitelistContext extends BaseTagsWhitelistContext
{
}
