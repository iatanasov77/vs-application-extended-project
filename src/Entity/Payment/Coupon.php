<?php namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\PaymentBundle\Model\Coupon as BaseCoupon;
use Vankosoft\CatalogBundle\Model\Interfaces\PricingPlanAwareInterface;
use Vankosoft\CatalogBundle\Model\Traits\PricingPlanAwareEntity;

/**
 * @ORM\Table(name="VSPAY_Coupons", options={"comment":"Coupons fields are Inspired by Stripe Coupon Fields"})
 * @ORM\Entity
 */
class Coupon extends BaseCoupon implements PricingPlanAwareInterface
{
    use PricingPlanAwareEntity;
}