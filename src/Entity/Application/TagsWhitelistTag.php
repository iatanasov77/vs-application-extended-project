<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\TagsWhitelistTag as BaseTagsWhitelistTag;

/**
 * @ORM\Table(name="VSAPP_TagsWhitelistTags")
 * @ORM\Entity
 */
class TagsWhitelistTag extends BaseTagsWhitelistTag
{
}
