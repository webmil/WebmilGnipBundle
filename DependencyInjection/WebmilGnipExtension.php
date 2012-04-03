<?php

namespace Webmil\GnipBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * WebmilGnipBundle Extension
 */
class WebmilGnipExtension extends Extension
{

    /**
     * load configuration
     * 
     * @param array            $configs   configs
     * @param ContainerBuilder $container container
     * 
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('webmil_gnip', $config);
           
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config/')));
        $loader->load('services.xml');
    }
}