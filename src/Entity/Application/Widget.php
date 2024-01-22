<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\Widget as BaseWidget;

/**
 * @ORM\Table(name="VSAPP_Widgets")
 * @ORM\Entity
 */
class Widget extends BaseWidget
{
}
