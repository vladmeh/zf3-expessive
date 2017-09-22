<?php

namespace Book;

use Zend\Expressive\Application;

/**
 * The configuration provider for the Book module
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
            'templates' => $this->getTemplates(),
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
            ],
            'factories' => [
                Model\Repository\BookRepositoryInterface::class => Factory\BookRepositoryFactory::class,
                Model\Storage\BookStorageInterface::class => Factory\BookTableGatewayFactory::class
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
                'book' => [__DIR__ . '/../templates/book'],
            ],
        ];
    }
}
