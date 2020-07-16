<?php

namespace LmcUser\Factory\Options;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Options;

class ModuleOptions implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        return new Options\ModuleOptions(isset($config['lmcuser']) ? $config['lmcuser'] : array());
    }
}
