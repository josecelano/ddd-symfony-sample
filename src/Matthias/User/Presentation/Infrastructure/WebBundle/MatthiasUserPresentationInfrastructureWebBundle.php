<?php

namespace Matthias\User\Presentation\Infrastructure\WebBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MatthiasUserPresentationInfrastructureWebBundle extends Bundle
{
    use RequiresOtherBundles;

    public function build(ContainerBuilder $container)
    {
        $this->checkRequirements(array('MatthiasUserPresentationInfrastructureWebBundle'), $container);
    }
}
