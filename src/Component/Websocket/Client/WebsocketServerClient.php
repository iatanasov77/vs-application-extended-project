<?php namespace App\Component\Websocket\Client;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;

/**
 * WebsocketClient Based on AMPHP
 * ==============================
 * Reference: https://amphp.org/amp
 * Manual:  https://stackoverflow.com/questions/64292868/how-to-send-a-message-to-specific-websocket-clients-with-symfony-ratchet
 *          https://stackoverflow.com/questions/60780643/get-websocket-pings-from-an-open-stream-connection-using-amp-websocket
 */
final class WebsocketServerClient extends AbstractWebsocketClient
{
    public function send( object $msg ): void
    {
        // Here Use: Ratchet\Client\WebSocket
        $client = new \WebSocket\Client( $this->websocketUrl );
        
        // , [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]
        $json   = $this->serializer->serialize( $msg, JsonEncoder::FORMAT );
        $client->text( $json );
        //$client->text( "Hello WebSocket.org!" );
        //echo $client->receive();
        
        $client->close();
    }
    
    public function receive(): string
    {
        return '';
    }
    
    public function subscribe( string $realm, string $topic, \Closure $callback ): void
    {
        
    }
}
