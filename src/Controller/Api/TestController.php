<?php namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use Vankosoft\ApplicationBundle\Component\Status;

class TestController extends AbstractController
{
    /** @var ManagerRegistry */
    private $doctrine;
    
    public function __construct( ManagerRegistry $doctrine )
    {
        $this->doctrine = $doctrine;
    }
    
    public function index( Request $request ): JsonResponse
    {
        /*
        $tablatures = $this->doctrine->getRepository( Tablature::class )->findAll();
        
        $response   = [];
        foreach( $tablatures as $tab ) {
            $response[] = $this->getTablatureJson( $tab );
        }
        */
        $response   = [
            'status'    => Status::STATUS_OK,
            'data'      => [
                'test_property' => 'Test Property',
            ]
        ];
        return new JsonResponse( $response );
    }
}
