<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\WidgetsRegistry as BaseWidgetsRegistry;

/**
 * @ORM\Table(name="VSAPP_WidgetsRegistry")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class WidgetsRegistry extends BaseWidgetsRegistry
{
}
