<?php namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Vankosoft\ApplicationBundle\Component\Context\ApplicationContextInterface;
use Vankosoft\ApplicationBundle\Component\Status;

class AuthController extends AbstractController
{
    /** @var ApplicationContextInterface */
    private $applicationContext;
    
    public function __construct( ApplicationContextInterface $applicationContext )
    {
        $this->applicationContext   = $applicationContext;
    }
    
    public function login( AuthenticationUtils $authenticationUtils, Request $request ): Response
    {
        if ( 
            $this->getUser() && 
            (
                $this->getUser()->getApplications()->contains( $this->applicationContext->getApplication() ) ||
                $this->isGranted( 'ROLE_APPLICATION_ADMIN', $this->getUser() )
            )
        ) {
            return $this->redirectToRoute( 'swagger_ui' );
        }
        
        return new JsonResponse([
            'status'    => Status::STATUS_OK,
            'data'      => [
                'description'           => 'This should not called in API Application. If you are recieve this response may be should not permissions to access some route and you were redirected here.',
                'authenticationError'   => $authenticationUtils->getLastAuthenticationError(),
                'lastUsername'          => $authenticationUtils->getLastUsername(),
            ]
        ]);
    }
    
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception( 'Don\'t forget to activate logout in security.yaml' );
    }
}
