<?php namespace App\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vankosoft\CmsBundle\Model\QuickLink as BaseQuickLink;

/**
 * @Gedmo\TranslationEntity(class="App\Entity\Application\Translation")
 * @ORM\Entity
 * @ORM\Table(name="VSCMS_QuickLinks")
 */
class QuickLink extends BaseQuickLink
{
}