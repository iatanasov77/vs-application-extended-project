<?php namespace App\Widgets;

use Vankosoft\ApplicationBundle\EventListener\Widgets\WidgetLoaderInterface;
use Vankosoft\ApplicationBundle\Component\Widget\Widget;
use Vankosoft\ApplicationBundle\Component\Widget\Builder\Item;
use Vankosoft\ApplicationBundle\EventListener\Event\WidgetEvent;

/**
 * https://stackoverflow.com/questions/70757723/symfony-5-event-listener-not-registered/73353168#73353168
 */
class Test2Widget implements WidgetLoaderInterface
{
    public function builder( WidgetEvent $event )
    {
        /** @var Widget */
        $widgetContainer    = $event->getWidgetContainer();
        
        /** @var Item */
        $widgetItem = $widgetContainer->createWidgetItem( 'test-widget-2' );
        if( $widgetItem ) {
            $widgetItem->setTemplate( 'Widgets/test_2.html.twig' );
            
            // Add Widgets
            $widgetContainer->addWidget( $widgetItem );
        }
    }
}