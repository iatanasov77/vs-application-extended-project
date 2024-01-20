<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\WidgetGroup as BaseWidgetGroup;

/**
 * @ORM\Table(name="VSAPP_WidgetGroups")
 * @ORM\Entity
 */
class WidgetGroup extends BaseWidgetGroup
{
}
