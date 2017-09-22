<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Db;


use Book\Model\Entity\BookEntity;
use Book\Model\Storage\BookStorageInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class BookTableGateway extends TableGateway implements BookStorageInterface
{
    /**
     * BookTableGateway constructor.
     * @param AdapterInterface $adapter
     * @param ResultSetInterface $resultSet
     */
    public function __construct(AdapterInterface $adapter, ResultSetInterface $resultSet)
    {
        parent::__construct('blog_post', $adapter, null, $resultSet);
    }


    public function fetchBookList()
    {
        $select = $this->getSql()->select();

        $collection = [];

        /** @var BookEntity $entity */
        foreach ($this->selectWith($select) as $entity) {
            $collection[$entity->getId()] = $entity;
        }

        return $collection;
    }

    public function fetchBookById($id)
    {
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);

        return $this->selectWith($select)->current();
    }

    public function insertBook(BookEntity $entity)
    {
        $insertData = $entity->getArrayCopy();

        $insert = $this->getSql()->insert();
        $insert->values($insertData);

        return $this->insertWith($insert) > 0;
    }

    public function updateBook(BookEntity $entity)
    {
        $updateData = $entity->getArrayCopy();

        $update = $this->getSql()->update();
        $update->set($updateData);
        $update->where->equalTo('id', $entity->getId());

        return $this->updateWith($update) > 0;
    }

    public function deleteBook(BookEntity $entity)
    {
        $delete = $this->getSql()->delete();
        $delete->where->equalTo('id', $entity->getId());

        return $this->deleteWith($delete) > 0;
    }
}