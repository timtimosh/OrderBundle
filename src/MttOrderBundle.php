<?php

namespace Mtt\OrderBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Mtt\OrderBundle\DependencyInjection\Compiler\DoctrineResolveTargetEntityPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class MttOrderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineResolveTargetEntityPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1000);
    }
}
