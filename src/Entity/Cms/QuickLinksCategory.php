<?php namespace App\Entity\Cms;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\CmsBundle\Model\QuickLinksCategory as BaseQuickLinksCategory;

#[ORM\Entity]
#[ORM\Table(name: "VSCMS_QuickLinksCategories")]
class QuickLinksCategory extends BaseQuickLinksCategory
{
}
