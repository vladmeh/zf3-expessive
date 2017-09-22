<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Factory;


use Book\Db\BookTableGateway;
use Book\Model\Entity\BookEntity;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ArraySerializable;

class BookTableGatewayFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $resultSetPrototype = new HydratingResultSet(
            new ArraySerializable(),
            new BookEntity()
        );

        return new BookTableGateway(
            $container->get(AdapterInterface::class),
            $resultSetPrototype
        );
    }

}