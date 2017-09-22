<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Factory;


use Book\Model\Repository\BookRepository;
use Book\Model\Storage\BookStorageInterface;
use Psr\Container\ContainerInterface;

class BookRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new BookRepository(
            $container->get(BookStorageInterface::class)
        );
    }

}