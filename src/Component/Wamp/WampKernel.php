<?php namespace App\Component\Wamp;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Thruway\ClientSession;
use Thruway\Transport\TransportInterface;
use Vankosoft\ThruwayBundle\WampKernel as BaseWampKernel;
use Vankosoft\ThruwayBundle\ResourceMapper;
use Vankosoft\ThruwayBundle\Event\SessionEvent;

final class WampKernel extends BaseWampKernel
{
    public function __construct(
        ContainerInterface $container,
        Serializer $serializer = null,
        ResourceMapper $resourceMapper,
        EventDispatcherInterface $dispatcher,
        LoggerInterface $logger
    ) {
        parent::__construct( $container, $serializer, $resourceMapper, $dispatcher, $logger );
    }
    
    public function onOpen( ClientSession $session, TransportInterface $transport ): void
    {
        $this->session   = $session;
        $this->transport = $transport;
        $mappings        = $this->resourceMapper->getMappings( $this->processName );
        var_dump( $mappings ); die;
        
        $event = new SessionEvent( $session, $transport, $this->processName, $this->processInstance, $mappings );
        $this->dispatcher->dispatch( WampEvents::OPEN, $event );
        
        //Map RPC calls and subscriptions to their controllers
        $this->mapResources( $mappings );
        
        $session->publish( 'game', ['Hello, world from VankoSoft!!!'], [], ["acknowledge" => true] )->then(
            function () {
                echo "Publish Acknowledged!\n";
            },
            function ( $error ) {
                // publish failed
                echo "Publish Error {$error}\n";
            }
        );
    }
}
