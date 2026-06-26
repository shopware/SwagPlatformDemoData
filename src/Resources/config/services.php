<?php declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Doctrine\DBAL\Connection;
use Psr\Clock\ClockInterface;
use Shopware\Core\Content\Media\File\FileSaver;
use Shopware\Core\Framework\Api\Controller\SyncController;
use Swag\PlatformDemoData\DataProvider\CategoryProvider;
use Swag\PlatformDemoData\DataProvider\CmsPageProvider;
use Swag\PlatformDemoData\DataProvider\CustomerProvider;
use Swag\PlatformDemoData\DataProvider\MediaProvider;
use Swag\PlatformDemoData\DataProvider\ProductProvider;
use Swag\PlatformDemoData\DataProvider\PropertyProvider;
use Swag\PlatformDemoData\DataProvider\RuleProvider;
use Swag\PlatformDemoData\DataProvider\ShippingMethodProvider;
use Swag\PlatformDemoData\DemoDataService;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(DemoDataService::class)
        ->public()
        ->args([
            service(SyncController::class),
            tagged_iterator('swag.demo_data.data_provider'),
            service('request_stack'),
        ]);

    $services->set(MediaProvider::class)
        ->args([
            service(Connection::class),
            service(FileSaver::class),
        ])
        ->tag('swag.demo_data.data_provider', ['priority' => 1100]);

    $services->set(CmsPageProvider::class)
        ->args([service(Connection::class)])
        ->tag('swag.demo_data.data_provider', ['priority' => 1000]);

    $services->set(CategoryProvider::class)
        ->args([
            service('category.repository'),
            service(Connection::class),
        ])
        ->tag('swag.demo_data.data_provider', ['priority' => 900]);

    $services->set(CustomerProvider::class)
        ->args([
            service(Connection::class),
            service('category.repository'),
        ])
        ->tag('swag.demo_data.data_provider', ['priority' => 800]);

    $services->set(RuleProvider::class)
        ->args([service(Connection::class)])
        ->tag('swag.demo_data.data_provider', ['priority' => 700]);

    $services->set(PropertyProvider::class)
        ->args([service(Connection::class)])
        ->tag('swag.demo_data.data_provider', ['priority' => 500]);

    $services->set(ProductProvider::class)
        ->args([
            service(Connection::class),
            service(ClockInterface::class),
        ])
        ->tag('swag.demo_data.data_provider', ['priority' => 400]);

    $services->set(ShippingMethodProvider::class)
        ->args([service(Connection::class)])
        ->tag('swag.demo_data.data_provider', ['priority' => 200]);
};
