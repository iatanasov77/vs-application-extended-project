<?php namespace App\Widgets;

use Vankosoft\ApplicationBundle\EventListener\Widgets\WidgetLoaderInterface;
use Vankosoft\ApplicationBundle\Component\Widget\Widget;
use Vankosoft\ApplicationBundle\Component\Widget\Builder\Item;
use Vankosoft\ApplicationBundle\EventListener\Event\WidgetEvent;

use Symfony\Component\HttpFoundation\RequestStack;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class SidebarCategoriesWidget implements WidgetLoaderInterface
{
    /** @var RequestStack */
    private $requestStack;
    
    /** @var RepositoryInterface */
    private $productCategoryRepository;
    
    public function __construct(
        RequestStack $requestStack,
        RepositoryInterface $productCategoryRepository
    ) {
        $this->requestStack                 = $requestStack;
        $this->productCategoryRepository    = $productCategoryRepository;
    }
    
    public function builder( WidgetEvent $event )
    {
        $request        = $this->requestStack->getMainRequest();
        $categorySlug   = $request->attributes->get( 'categorySlug' );
        
        /** @var Widget */
        $widgetContainer    = $event->getWidgetContainer();
        
        /** @var Item */
        $widgetItem = $widgetContainer->createWidgetItem( 'sidebar-categories' );
        if( $widgetItem ) {
            $widgetItem->setTemplate( 'Widgets/sidebar_categories.html.twig', [
                'categories'        => $this->productCategoryRepository->findBy( ['parent' => null] ),
                'currentCategory'   => $this->productCategoryRepository->findByTaxonCode( $categorySlug ),
            ]);
            
            // Add Widgets
            $widgetContainer->addWidget( $widgetItem );
        }
    }
}