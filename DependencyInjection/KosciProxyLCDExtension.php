<?php

namespace Kosci\Bundle\ProxyLCDBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class KosciProxyLCDExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('proxy_lcd_ip', $config['proxy_ip']);
        $container->setParameter('proxy_lcd_port', $config['proxy_port']);
        $container->setParameter('proxy_lcd.dump.enabled', $config['dump']['enabled']);
        $container->setParameter('proxy_lcd.dump.mode', $config['dump']['mode']);
        $container->setParameter('proxy_lcd.clear_on_request', $config['clear_on_request']);
        $container->setParameter('proxy_lcd.request_length', $config['request_length']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
