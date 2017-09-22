<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Model\Storage;

use Book\Model\Entity\BookEntity;

interface BookStorageInterface
{
    /**
     * @return BookEntity[]
     */
    public function fetchBookList();

    /**
     * @param $id
     * @return BookEntity|null
     */
    public function fetchBookById($id);

    /**
     * @param BookEntity $album
     * @return bool
     */
    public function insertAlbum(BookEntity $album);

    /**
     * @param BookEntity $album
     * @return bool
     */
    public function updateAlbum(BookEntity $album);

    /**
     * @param BookEntity $album
     * @return bool
     */
    public function deleteAlbum(BookEntity $album);
}