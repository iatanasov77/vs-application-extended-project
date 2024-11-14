<?php namespace App\Controller\Application;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class TestMercureController extends AbstractController
{
    public function index(): Response
    {
        return $this->render( 'Pages/MercureTest/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    
    public function publish( HubInterface $hub ): JsonResponse
    {
        $update = new Update(
            '/test',
            json_encode( ['update' => 'New update received at ' . date( "h:i:sa" )] )
        );
        
        $hub->publish( $update );
        
        return $this->json( ['message' => 'Update published'] );
    }
}
