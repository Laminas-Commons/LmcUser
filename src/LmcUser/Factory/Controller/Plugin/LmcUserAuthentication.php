<?php

namespace LmcUser\Factory\Controller\Plugin;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Controller;

class LmcUserAuthentication implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('lmcuser_auth_service');
        $authAdapter = $container->get('LmcUser\Authentication\Adapter\AdapterChain');

        $controllerPlugin = new Controller\Plugin\LmcUserAuthentication;
        $controllerPlugin->setAuthService($authService);
        $controllerPlugin->setAuthAdapter($authAdapter);

        return $controllerPlugin;
    }
}
