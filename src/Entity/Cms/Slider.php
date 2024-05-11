<?php namespace App\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vankosoft\CmsBundle\Model\Slider as BaseSlider;

/**
 * @Gedmo\TranslationEntity(class="App\Entity\Application\Translation")
 * @ORM\Entity
 * @ORM\Table(name="VSCMS_Sliders")
 */
class Slider extends BaseSlider
{
}