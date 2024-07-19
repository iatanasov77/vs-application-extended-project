<?php namespace App\Entity\UserManagement;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vankosoft\UsersBundle\Model\User as BaseUser;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscribedUserInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Traits\SubscribedUserEntity;
use Vankosoft\PaymentBundle\Model\Interfaces\UserPaymentAwareInterface;
use Vankosoft\PaymentBundle\Model\Traits\UserPaymentAwareEntity;
use Vankosoft\PaymentBundle\Model\Interfaces\CustomerInterface;
use Vankosoft\PaymentBundle\Model\Traits\CustomerEntity;

use Vankosoft\CatalogBundle\Model\Interfaces\UserSubscriptionAwareInterface;
use Vankosoft\CatalogBundle\Model\Traits\UserSubscriptionAwareEntity;

use Vankosoft\CatalogBundle\Model\Interfaces\ReviewerAwareInterface;
use Vankosoft\CatalogBundle\Model\Interfaces\ReviewerInterface;
use Vankosoft\CatalogBundle\Model\Reviewer;

#[ORM\Entity]
#[ORM\Table(name: "VSUM_Users")]
class User extends BaseUser implements
    SubscribedUserInterface,
    UserPaymentAwareInterface,
    CustomerInterface,
    UserSubscriptionAwareInterface,
    ReviewerAwareInterface
{
    use SubscribedUserEntity;
    use UserPaymentAwareEntity;
    use CustomerEntity;
    use UserSubscriptionAwareEntity;
    
    public function __construct()
    {
        $this->newsletterSubscriptions  = new ArrayCollection();
        $this->orders                   = new ArrayCollection();
        $this->pricingPlanSubscriptions = new ArrayCollection();
        
        parent::__construct();
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
    
    public function _toReviewer(): ReviewerInterface
    {
        return Reviewer::fromUser( $this );
    }
}
