<?php namespace App\Component\Websocket;

use Symfony\Component\Serializer\SerializerInterface;
use App\Component\Websocket\Client\WebsocketServerClient;
use App\Component\Websocket\Client\WebsocketZmqClient;
use App\Component\Websocket\Client\WebsocketThruwayClient;
use App\Component\Websocket\Client\WebsocketRatchetConnectionClient;

final class WebsocketClientFactory
{
    /** @var SerializerInterface */
    private $serializer;
    
    /** @var string */
    private $websocketChatUrl;
    
    /** @var string */
    private $websocketPublisherUrl;
    
    /** @var string */
    private $zmqServerUrl;
    
    public function __construct(
        SerializerInterface $serializer,
        string $websocketChatUrl,
        string $websocketPublisherUrl,
        string $zmqServerUrl
    ) {
        $this->serializer               = $serializer;
        $this->websocketChatUrl         = $websocketChatUrl;
        $this->websocketPublisherUrl    = $websocketPublisherUrl;
        $this->zmqServerUrl             = $zmqServerUrl;
    }
    
    /**
     * Using: Textalk/websocket-php
     *        https://github.com/Textalk/websocket-php
     */
    public function createServerChatClient()
    {
        return new WebsocketServerClient( $this->websocketChatUrl, $this->serializer );
    }
    
    /**
     * Using: ZMQSocket
     *        https://www.php.net/manual/en/class.zmqsocket.php
     */
    public function createZmqClient()
    {
        return new WebsocketZmqClient( $this->zmqServerUrl, $this->serializer );
    }
    
    /**
     * Using: Thruway\Connection
     *        https://github.com/voryx/Thruway.git
     */
    public function createThruwayClient()
    {
        return new WebsocketThruwayClient( $this->websocketPublisherUrl, $this->serializer );
    }
}