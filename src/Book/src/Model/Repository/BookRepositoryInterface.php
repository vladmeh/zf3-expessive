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

interface BookRepositoryInterface
{
    /**
     * @return BookEntity[]
     */
    public function fetchAllBooks();

    /**
     * @param int $id
     * @return BookEntity|null
     */
    public function fetchSingleBook($id);

    /**
     * @param BookEntity $entity
     * @return bool
     */
    public function saveBook(BookEntity $entity);

    /**
     * @param BookEntity $entity
     * @return bool
     */
    public function deleteBook(BookEntity $entity);
}