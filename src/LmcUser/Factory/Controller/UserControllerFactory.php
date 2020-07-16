<?php

namespace LmcUser\Factory\Controller;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Controller\RedirectCallback;
use LmcUser\Controller\UserController;

class UserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var RedirectCallback $redirectCallback */
        $redirectCallback = $container->get('lmcuser_redirect_callback');

        /* @var UserController $controller */
        $controller = new UserController($redirectCallback);
        $controller->setServiceLocator($container);

        $controller->setChangeEmailForm($container->get('lmcuser_change_email_form'));
        $controller->setOptions($container->get('lmcuser_module_options'));
        $controller->setChangePasswordForm($container->get('lmcuser_change_password_form'));
        $controller->setLoginForm($container->get('lmcuser_login_form'));
        $controller->setRegisterForm($container->get('lmcuser_register_form'));
        $controller->setUserService($container->get('lmcuser_user_service'));

        return $controller;
    }
}
