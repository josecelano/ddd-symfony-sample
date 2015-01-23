<?php

namespace Matthias\Common\App\Infrastructure\AsynchronousBusBundle;

use Matthias\Common\App\Infrastructure\AsynchronousBusBundle\DependencyInjection\DoctrineOrmBridgeExtension;
use SimpleBus\SymfonyBridge\RequiresOtherBundles;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DoctrineOrmBridgeBundle extends Bundle
{
    use RequiresOtherBundles;

    public function getContainerExtension()
    {
        return new DoctrineOrmBridgeExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $this->checkRequirements(array('AsynchronousBusCommandBusBundle', 'AsynchronousBusEventBusBundle'), $container);
    }
}
