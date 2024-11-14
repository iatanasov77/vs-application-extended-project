<?php namespace App\Component\Websocket\Server;

use Thruway\Peer\Client;
use React\ZMQ\Context;
use React\EventLoop\LoopInterface;

/**
 * MANUAL:  http://socketo.me/docs/hello-world
 *          https://github.com/voryx/Thruway/issues/96
 */
final class WebsocketZmqPusher extends Client
{
    /** @var string */
    private $tcpUrl;
    
    public function __construct( string $realm, LoopInterface $loop, string $tcpUrl )
    {
        parent::__construct( $realm, $loop );
        
        $this->tcpUrl   = $tcpUrl;
    }
    
    public function onSessionStart( $session, $transport )
    {
        //die( 'EHO' );
        $context = new Context( $this->getLoop() );
        $pull    = $context->getSocket( \ZMQ::SOCKET_PULL );
        $pull->bind( $this->tcpUrl );
        $pull->on( 'message', [$this, 'onBlogEntry'] ); 
    }
    
    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onBlogEntry( $entry )
    {
        $entryData = \json_decode( $entry, true );
        
        if ( ! isset( $entryData['topic'] ) ) {
            return;
        }
        
        $this->getSession()->publish( $entryData['topic'], [$entryData] );
    }
}
