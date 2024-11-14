<?php namespace App\Component\Websocket\Server;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

/**
 * Manual:  https://stackoverflow.com/questions/64292868/how-to-send-a-message-to-specific-websocket-clients-with-symfony-ratchet
 *          https://stackoverflow.com/questions/30953610/how-to-send-messages-to-particular-users-ratchet-php-websocket
 */
class WebsocketMessagePublisher implements WampServerInterface
{
    /** @var \SplObjectStorage */
    protected $clients;
    
    /** @var array */
    protected $names;
    
    /** @var string */
    protected $logFile;
    
    /**
     * A lookup of all the topics clients have subscribed to
     */
    protected $subscribedTopics = [];
    
    public function __construct()
    {
        //$this->clients  = new \SplObjectStorage;
        $this->clients  = [];
        $this->names    = [];
        $this->logFile  = '/var/log/websocket/game-patform-publisher.log';
    }
    
    public function onSubscribe( ConnectionInterface $conn, $topic )
    {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }
    
    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onMessageEntry( $entry )
    {
        $entryData = \json_decode( $entry, true );
        
        // The following line is for debugging purposes only
        $this->log( "Incoming message: " . $entry . PHP_EOL );
        
        // If the lookup topic object isn't set there is no one to publish to
        if ( ! \array_key_exists( $entryData['topic'], $this->subscribedTopics ) ) {
            return;
        }
        
        $topic = $this->subscribedTopics[$entryData['topic']];
        
        // re-send the data to all the clients subscribed to that category
        $topic->broadcast( $entryData );
    }
    
    public function onUnSubscribe( ConnectionInterface $conn, $topic )
    {
        $this->log( "Subscribing to topic: " . $topic . PHP_EOL );
    }
    
    public function onOpen( ConnectionInterface $conn )
    {
        $this->log( " \n" );
        $this->log( "New connection ({$conn->resourceId})" . date( 'Y/m/d h:i:sa' ) );
        $this->log( " \n" );
    }
    
    public function onClose( ConnectionInterface $conn )
    {
        $this->log( "Connection {$conn->resourceId} has disconnected\n" );
    }
    
    public function onCall( ConnectionInterface $conn, $id, $topic, array $params )
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError( $id, $topic, 'You are not allowed to make calls' )->close();
    }
    
    public function onPublish( ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible )
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    
    public function onError( ConnectionInterface $conn, \Exception $e )
    {
        $this->log( "An error has occurred: {$e->getMessage()}\n" );
    }
    
    private function log( $logData ): void
    {
        \file_put_contents( $this->logFile, $logData, FILE_APPEND | LOCK_EX );
    }
}
