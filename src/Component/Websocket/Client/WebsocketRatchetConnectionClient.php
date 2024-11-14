<?php namespace App\Component\Websocket\Client;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Ratchet\ConnectionInterface;

final class WebsocketRatchetConnectionClient extends AbstractWebsocketClient
{
    /** @var ConnectionInterface */
    private $connection;
    
    public function __construct( string $websocketUrl, SerializerInterface $serializer, ConnectionInterface $connection )
    {
        parent::__construct( $websocketUrl, $serializer );
        
        $this->connection   = $connection;
        $this->clientId     = $connection->resourceId;
    }
    
    public function send( object $msg ): void
    {
        // , [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]
        $json   = $this->serializer->serialize( $msg, JsonEncoder::FORMAT );
        $this->connection->send( $json );
    }
    
    public function receive(): string
    {
        return '';
    }
    
    public function close(): void
    {
        $this->connection->close();
    }
    
    public function subscribe( string $realm, string $topic, \Closure $callback ): void
    {
        
    }
}
