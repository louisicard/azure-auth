<?php

namespace LouisSicard\AzureAuth\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AzureAuthExtension extends Extension
{
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
    $loader->load('services.yml');

    $definition = $container->getDefinition('azure_auth.test_service');
    $definition->replaceArgument(1, $config['auth_url']);

  }

}