<?php

namespace App\Entity\Repository;

use App\Entity\EntityInterface;

interface RepositoryInterface
{

    /**
     * @return EntityInterface[]
     */
    public function findAll();

    /**
     * @param $id
     * @return EntityInterface
     */
    public function find($id);

    /**
     * @param $column
     * @param $value
     * @return EntityInterface
     */
    public function findBy($column, $value);

}