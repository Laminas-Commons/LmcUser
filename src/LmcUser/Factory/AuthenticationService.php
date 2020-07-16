<?php

namespace LmcUser\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AuthenticationService implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new \Laminas\Authentication\AuthenticationService(
            $container->get('LmcUser\Authentication\Storage\Db'),
            $container->get('LmcUser\Authentication\Adapter\AdapterChain')
        );
    }
}
