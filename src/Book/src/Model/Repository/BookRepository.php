<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Model\Repository;


use Book\Model\Entity\BookEntity;
use Book\Model\Storage\BookStorageInterface;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var BookStorageInterface
     */
    private $bookStorage;

    /**
     * BookRepository constructor.
     * @param BookStorageInterface $bookStorage
     */
    public function __construct(BookStorageInterface $bookStorage)
    {
        $this->bookStorage = $bookStorage;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAllBooks()
    {
        return $this->bookStorage->fetchBookList();
    }

    /**
     * @param int $id
     * @return BookEntity|null
     */
    public function fetchSingleBook($id)
    {
        return $this->bookStorage->fetchBookById($id);
    }

    /**
     * @param BookEntity $entity
     * @return bool
     */
    public function saveBook(BookEntity $entity)
    {
        if (!$entity->getId()) {
            return $this->bookStorage->insertBook($entity);
        }

        return $this->bookStorage->updateBook($entity);
    }

    /**
     * @param BookEntity $entity
     * @return bool
     */
    public function deleteBook(BookEntity $entity)
    {
        return $this->bookStorage->deleteBook($entity);
    }

}