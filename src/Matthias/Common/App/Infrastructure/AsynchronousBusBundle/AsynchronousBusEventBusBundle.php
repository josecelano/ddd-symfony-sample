<?php

namespace Matthias\Common\App\Infrastructure\AsynchronousBusBundle;

use Matthias\Common\App\Infrastructure\AsynchronousBusBundle\DependencyInjection\EventBusExtension;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\ConfigureMiddlewares;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\RegisterMessageRecorders;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\RegisterSubscribers;

use SimpleBus\SymfonyBridge\RequiresOtherBundles;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AsynchronousBusEventBusBundle extends Bundle
{
    use RequiresOtherBundles;

    private $configurationAlias;

    public function __construct($alias = 'asynchronous_event_bus')
    {
        $this->configurationAlias = $alias;
    }

    public function build(ContainerBuilder $container)
    {
        $this->checkRequirements(array('AsynchronousBusCommandBusBundle'), $container);

        $container->addCompilerPass(
            new ConfigureMiddlewares(
                'asynchronous_event_bus',
                'asynchronous_event_bus_middleware'
            )
        );

        $container->addCompilerPass(
            new RegisterMessageRecorders(
                'asynchronous_bus.asynchronous_event_bus.aggregates_recorded_messages',
                'asynchronous_event_recorder'
            )
        );

        $container->addCompilerPass(
            new RegisterSubscribers(
                'asynchronous_bus.asynchronous_event_bus.event_subscribers_collection',
                'asynchronous_event_subscriber',
                'subscribes_to'
            )
        );
    }

    public function getContainerExtension()
    {
        return new EventBusExtension($this->configurationAlias);
    }
}
