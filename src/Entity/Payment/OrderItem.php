<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\OrderItem as OrderItemBase;
use Vankosoft\CatalogBundle\Model\Interfaces\PayableObjectAwareInterface;
use Vankosoft\CatalogBundle\Model\Traits\PayableObjectAwareEntity;

/**
 * @ORM\Table(name="VSPAY_OrderItem")
 * @ORM\Entity
 */
class OrderItem extends OrderItemBase implements PayableObjectAwareInterface
{
    use PayableObjectAwareEntity;
}
