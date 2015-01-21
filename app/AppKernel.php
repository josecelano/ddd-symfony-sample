<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Matthias\Common\App\Infrastructure\AsynchronousBusBundle\AsynchronousBusCommandBusBundle(),
            new Matthias\Common\App\Infrastructure\AsynchronousBusBundle\AsynchronousBusEventBusBundle(),
            new Matthias\Common\App\Infrastructure\CommonBundle\MatthiasCommonAppInfrastructureCommonBundle(),
            new Matthias\User\App\Infrastructure\UserBundle\MatthiasUserAppInfrastructureUserBundle(),
            new Matthias\User\Domain\Infrastructure\UserBundle\MatthiasUserDomainInfrastructureUserBundle(),
            new Matthias\User\Presentation\Infrastructure\WebBundle\MatthiasUserPresentationInfrastructureWebBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusEventBusBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}