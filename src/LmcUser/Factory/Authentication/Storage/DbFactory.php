<?php

namespace LmcUser\Factory\Authentication\Storage;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Authentication\Storage\Db;

class DbFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $db = new Db();
        $db->setServiceManager($container);

        return $db;
    }
}
