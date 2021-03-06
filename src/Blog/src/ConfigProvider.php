<?php

namespace Blog;
use ContainerInteropDoctrine\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Zend\Expressive\Application;

/**
 * The configuration provider for the Blog module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine'     => $this->getDoctrine(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                DebugStack::class => DebugStack::class,
            ],
            'factories'  => [
                EntityManager::class => EntityManagerFactory::class,
            ],
            'delegators' => [
                Application::class => [
                    Factory\RoutesDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'blog'    => [__DIR__ . '/../templates/blog'],
            ],
        ];
    }

    public function getDoctrine()
    {
        return [
            'driver' => [
                'orm_default' => [
                    'drivers' => [
                        'Blog\Entity' => 'blog_entity',
                    ],
                ],
                'blog_entity' => [
                    'class' => SimplifiedYamlDriver::class,
                    'cache' => 'array',
                    'paths' => [
                        dirname(__DIR__) . '/config/doctrine' => 'Blog\Entity',
                    ],
                ],
            ],
        ];
    }
}
