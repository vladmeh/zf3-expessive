<?php

namespace Album;
use Zend\Expressive\Application;
use Illuminate\Database\Capsule\Manager;

/**
 * The configuration provider for the Album module
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
            ],
            'factories'  => [
                //Manager::class => Factory\CapsuleFactory::class,
            ],
            'delegators' => [
                Application::class => [
                    Factory\RoutesDelegator::class,
                    Factory\CapsuleFactory::class,
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
                'album' => [__DIR__ . '/../templates/album'],
            ],
        ];
    }
}
