<?php namespace App\Component\Websocket\Client;

use Thruway\Connection;
use Thruway\ClientSession;

/**
 * https://stackoverflow.com/a/26152659/12693473
 */
final class WebsocketThruwayClient extends AbstractWebsocketClient
{
    public function send( object $msg ): void
    {
        $connection = new Connection([
            "realm"   => 'realm1',
            "url"     => $this->websocketUrl, //You can use this demo server or replace it with your router's IP
        ]);
        
        $connection->on('open', function ( ClientSession $session ) use ( $connection, $msg ) {
            $topic  = $msg->topic;
            $data   = $msg;
            
            //publish an event
            $session->publish( $topic, ['Hello, world from PHP!!!'], ['data' => $data], ["acknowledge" => true] )->then(
                function () use ( $connection ) {
                    $connection->close(); //You must close the connection or this will hang
                    echo "Publish Acknowledged!\n";
                },
                function ( $error ) {
                    // publish failed
                    echo "Publish Error {$error}\n";
                }
            );
        });
            
        $connection->open();
    }
    
    public function receive(): string
    {
        return '';
    }
    
    public function subscribe( string $realm, string $topic, \Closure $callback ): void
    {
        
    }
}