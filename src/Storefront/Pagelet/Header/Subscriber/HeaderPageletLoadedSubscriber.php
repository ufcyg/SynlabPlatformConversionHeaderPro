<?php declare(strict_types=1);

namespace Synlab\PlatformConversionHeaderPro\Storefront\Pagelet\Header\Subscriber;

use Shopware\Storefront\Pagelet\Header\HeaderPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Framework\Struct\ArrayEntity;

class HeaderPageletLoadedSubscriber implements EventSubscriberInterface
{
    /**
     * @var SystemConfigService
     * 
     * $backgroundColor = $this->systemConfigService->get('SynlabPlatformConversionHeaderPro.config.backgroundColor');
     * 
     */
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public static function getSubscribedEvents()
    {
        return [
            HeaderPageletLoadedEvent::class => 'onHeaderPageletLoaded'
        ];
    }

    public function onHeaderPageletLoaded(HeaderPageletLoadedEvent $event): void
    {
        $systemConfig = $this->systemConfigService->get('PlatformConversionHeaderPro.config');
        $page = $event->getPagelet();

        $page->addExtension('CHP', new ArrayEntity($systemConfig));

        /*echo '<pre>';
        print_r($systemConfig);
        die();*/
    }
}