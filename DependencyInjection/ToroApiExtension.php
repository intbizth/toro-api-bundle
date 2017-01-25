<?php

namespace Toro\Bundle\ApiBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Toro\Bundle\ApiBundle\Controller\TokenController;

class ToroApiExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration($config, $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $this->registerResources('sylius', $config['driver'], $config['resources'], $container);

        $loader->load('services.xml');

        $container->setDefinition('fos_oauth_server.controller.token', new Definition(TokenController::class, [
            new Reference('fos_oauth_server.server'),
            new Reference('fos_rest.decoder_provider'),
        ]));
    }

    /**
     * {@inheritdoc}
     *
     * @throws ServiceNotFoundException
     */
    public function prepend(ContainerBuilder $container)
    {
        if (!$container->hasExtension('fos_oauth_server')) {
            throw new ServiceNotFoundException('FOSOAuthServerBundle must be registered in kernel.');
        }

        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));
        $resourcesConfig = $config['resources'];

        $container->prependExtensionConfig('fos_oauth_server', [
            'db_driver' => 'orm',
            'client_class' => $resourcesConfig['api_client']['classes']['model'],
            'access_token_class' => $resourcesConfig['api_access_token']['classes']['model'],
            'refresh_token_class' => $resourcesConfig['api_refresh_token']['classes']['model'],
            'auth_code_class' => $resourcesConfig['api_auth_code']['classes']['model'],

            'service' => [
                'user_provider' => 'sylius.admin_user_provider.email_or_name_based',
                'client_manager' => 'sylius.oauth_server.client_manager',
            ],
        ]);
    }
}
