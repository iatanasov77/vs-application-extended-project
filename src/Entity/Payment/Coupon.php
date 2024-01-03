<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\Coupon as BaseCoupon;

/**
 * @ORM\Table(name="VSPAY_Coupons")
 * @ORM\Entity
 */
class Coupon extends BaseCoupon
{
    
}