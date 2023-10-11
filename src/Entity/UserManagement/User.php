<?php namespace App\Entity\UserManagement;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vankosoft\UsersBundle\Model\User as BaseUser;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscribedUserInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Traits\SubscribedUserTrait;
use Vankosoft\PaymentBundle\Model\Interfaces\UserPaymentAwareInterface;
use Vankosoft\PaymentBundle\Model\Traits\UserPaymentAwareTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="VSUM_Users")
 */
class User extends BaseUser implements SubscribedUserInterface, UserPaymentAwareInterface
{
    use SubscribedUserTrait;
    use UserPaymentAwareTrait;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->subscriptions            = new ArrayCollection();
        
        $this->paymentDetails           = [];
        $this->orders                   = new ArrayCollection();
        $this->pricingPlanSubscriptions = new ArrayCollection();
    }
    /**
     * {@inheritDoc}
     */
    public function getRoles(): array
    {
        /* Use RolesArray ( OLD WAY )*/
        //return $this->getRolesFromArray();
        
        /* Use RolesCollection */
        return $this->getRolesFromCollection();
    }
}
