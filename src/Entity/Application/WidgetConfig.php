<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\WidgetConfig as BaseWidgetConfig;

/**
 * @ORM\Table(name="VSAPP_WidgetsConfigs")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class WidgetConfig extends BaseWidgetConfig
{
}
