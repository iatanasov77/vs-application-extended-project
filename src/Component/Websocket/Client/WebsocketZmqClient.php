<?php namespace App\Component\Websocket\Client;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Thruway\ClientSession;
use Thruway\Peer\Client;
use Thruway\Transport\PawlTransportProvider;

/**
 * WebsocketClient Based on AMPHP
 * ==============================
 * Reference: https://amphp.org/amp
 * Manual:  https://stackoverflow.com/questions/64292868/how-to-send-a-message-to-specific-websocket-clients-with-symfony-ratchet
 *          https://stackoverflow.com/questions/60780643/get-websocket-pings-from-an-open-stream-connection-using-amp-websocket
 */
final class WebsocketZmqClient extends AbstractWebsocketClient
{
    public function send( object $msg ): void
    {
        $context = new \ZMQContext();
        $socket = $context->getSocket( \ZMQ::SOCKET_PUSH, 'my publisher' );
        $socket->connect( $this->websocketUrl );
        
        // , [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]
        $json   = $this->serializer->serialize( $msg, JsonEncoder::FORMAT );
        $socket->send( $json );
    }
    
    public function receive(): string
    {
        return '';
    }
    
    public function subscribe( string $realm, string $topic, \Closure $callback ): void
    {   
//         $client = new Client( $realm );
//         $client->addTransportProvider( new PawlTransportProvider( $this->websocketUrl ) );
        
//         $client->on('open', function ( ClientSession $session ) use ( $topic ) {
            
//             // 1) subscribe to a topic
//             $onevent = function ($args) {
//                 echo "Event {$args[0]}\n";
//             };
//             $session->subscribe( $topic, $onevent );
            
//             // 2) publish an event
//             $session->publish( $topic, ['Hello, world from PHP!!!'], [], ["acknowledge" => true] )->then(
//                 function () {
//                     echo "Publish Acknowledged!\n";
//                 },
//                 function ( $error ) {
//                     // publish failed
//                     echo "Publish Error {$error}\n";
//                 }
//             );
//         });
        
//         $client->start( false );
    }
}
