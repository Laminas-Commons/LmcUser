<?php

namespace LmcUser\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Application;
use Laminas\Router\RouteInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Controller\RedirectCallback;
use LmcUser\Options\ModuleOptions;

class RedirectCallbackFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var RouteInterface $router */
        $router = $container->get('Router');

        /* @var Application $application */
        $application = $container->get('Application');

        /* @var ModuleOptions $options */
        $options = $container->get('lmcuser_module_options');

        return new RedirectCallback($application, $router, $options);
    }
}
