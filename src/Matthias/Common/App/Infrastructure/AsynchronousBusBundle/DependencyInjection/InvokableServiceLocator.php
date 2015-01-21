<?php

namespace Matthias\Common\App\Infrastructure\AsynchronousBusBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

class InvokableServiceLocator
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke($serviceId)
    {
        return $this->container->get($serviceId);
    }
}
