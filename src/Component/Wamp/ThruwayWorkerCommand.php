<?php namespace App\Component\Wamp;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Vankosoft\ThruwayBundle\Command\ThruwayWorkerCommand as BaseThruwayWorkerCommand;
use Vankosoft\ThruwayBundle\WampKernelInterface;
use Vankosoft\ThruwayBundle\Annotation\Worker as WorkerAnnotation;
use Thruway\Peer\ClientInterface;
use Thruway\Transport\PawlTransportProvider;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Container\ContainerInterface;
use React\Socket\ConnectorInterface;
use App\Component\Websocket\Server\WebsocketZmqPusher;

#[AsCommand(
    name: 'vsapp:game_service:start',
    description: 'Start Thruway WAMP worker',
    hidden: false
)]
final class ThruwayWorkerCommand extends BaseThruwayWorkerCommand
{
    public function __construct(
        ContainerInterface $container,
        ManagerRegistry $doctrine,
        ValidatorInterface $validator,
        WampKernelInterface $wampKernel,
        ConnectorInterface $connector
    ) {
        parent::__construct( $container, $doctrine, $validator, $wampKernel, $connector );
    }
    
    protected function getClient( ?WorkerAnnotation $workerAnnotation = null ): ClientInterface
    {
        $config = $this->getParameter( 'voryx_thruway' );
        $loop   = $this->get( 'voryx.thruway.loop' );
        
        if ( $workerAnnotation ) {
            $realm = $workerAnnotation->getRealm() ?: $config['realm'];
            $url   = $workerAnnotation->getUrl() ?: $config['url'];
        } else {
            $realm = $config['realm'];
            $url   = $config['url'];
        }
        
        $tcpUrl     = 'tcp://127.0.0.1:5555';
        $transport  = new PawlTransportProvider( $tcpUrl );
        $client     = new WebsocketZmqPusher( $realm, $loop, $tcpUrl );
        
        $client->addTransportProvider( $transport );
        
        return $client;
    }
}
