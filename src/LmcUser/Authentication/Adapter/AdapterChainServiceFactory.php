<?php
namespace LmcUser\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use LmcUser\Authentication\Adapter\Exception\OptionsNotFoundException;
use LmcUser\Options\ModuleOptions;

class AdapterChainServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Laminas\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $chain = new AdapterChain();
        $chain->setEventManager($container->get('EventManager'));

        $options = $this->getOptions($container);

        //iterate and attach multiple adapters and events if offered
        foreach ($options->getAuthAdapters() as $priority => $adapterName) {
            $adapter = $container->get($adapterName);

            if (is_callable(array($adapter, 'authenticate'))) {
                $chain->getEventManager()->attach('authenticate', array($adapter, 'authenticate'), $priority);
            }

            if (is_callable(array($adapter, 'logout'))) {
                $chain->getEventManager()->attach('logout', array($adapter, 'logout'), $priority);
            }
        }

        return $chain;
    }

    /**
     * @var ModuleOptions
     */
    protected $options;


    /**
     * set options
     *
     * @param ModuleOptions $options
     * @return AdapterChainServiceFactory
     */
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @param ServiceLocatorInterface $serviceLocator (optional) Service Locator
     * @return ModuleOptions $options
     * @throws OptionsNotFoundException If options tried to retrieve without being set but no SL was provided
     */
    public function getOptions(ServiceLocatorInterface $serviceLocator = null)
    {
        if (!$this->options) {
            if (!$serviceLocator) {
                throw new OptionsNotFoundException(
                    'Options were tried to retrieve but not set ' .
                    'and no service locator was provided'
                );
            }

            $this->setOptions($serviceLocator->get('lmcuser_module_options'));
        }

        return $this->options;
    }
}
