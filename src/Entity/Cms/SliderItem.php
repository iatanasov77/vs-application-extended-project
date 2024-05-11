<?php namespace App\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vankosoft\CmsBundle\Model\SliderItem as BaseSliderItem;

/**
 * @Gedmo\TranslationEntity(class="App\Entity\Application\Translation")
 * @ORM\Entity
 * @ORM\Table(name="VSCMS_SlidersItems")
 */
class SliderItem extends BaseSliderItem
{
}