<?php namespace App\Controller\Application;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Vankosoft\ApplicationBundle\Component\Status;
use App\Component\Websocket\WebsocketClientFactory;
use App\Component\Dto\chat\ChatMessageDto;

class TestWebSocketController extends AbstractController
{
    /** @var WebsocketClientFactory */
    private $wsClientFactory;
    
    public function __construct( WebsocketClientFactory $wsClientFactory )
    {
        $this->wsClientFactory  = $wsClientFactory;
    }
    
    public function client1( Request $request ): Response
    {
        //$signature  = $this->getUser() ? $this->getUser()->getApiVerifySiganature() : '';
        
        $clientSettings           = [
            'socketPublisherUrl'    => $this->getParameter( 'app_websocket_publisher_url' ),
            'socketChatUrl'         => $this->getParameter( 'app_websocket_chat_url' ),
            //'apiVerifySiganature'   => $signature,
        ];
        
        return $this->render( 'Pages/WebSocketTest/client_1.html.twig', [
            'clientSettings'    => $clientSettings,
        ]);
    }
    
    public function client2( Request $request ): Response
    {
        //$signature  = $this->getUser() ? $this->getUser()->getApiVerifySiganature() : '';
        
        $clientSettings           = [
            'socketPublisherUrl'    => $this->getParameter( 'app_websocket_publisher_url' ),
            'socketChatUrl'         => $this->getParameter( 'app_websocket_chat_url' ),
            //'apiVerifySiganature'   => $signature,
        ];
        
        return $this->render( 'Pages/WebSocketTest/client_2.html.twig', [
            'clientSettings'    => $clientSettings,
        ]);
    }
    
    public function publish( Request $request ): Response
    {
        $data       = \json_decode( $request->getContent(), true );
        $testObject = new \stdClass();
        
        $dataObject = new ChatMessageDto();
        $dataObject->type           = 'test';
        $dataObject->fromUser       = $data['user'];
        $dataObject->message        = $data['message'];
        $dataObject->utcDateTime    = strval( ( new \DateTime( 'now' ) )->getTimestamp() );
        
        $testObject->topic  = 'chat';
        $testObject->data   = $dataObject;
        
        $this->wsClientFactory->createZmqClient()->send( $testObject );
        //$this->wsClientFactory->createThruwayClient()->send( $testObject );
        
        return new JsonResponse([
            'status'    => Status::STATUS_OK,
        ]);
    }
}
