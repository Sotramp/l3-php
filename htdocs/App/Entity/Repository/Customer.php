<?php

namespace App\Entity\Repository;

use App\Entity\EntityInterface;

class Customer extends AbstractRepository implements RepositoryInterface
{

    /**
     * @return EntityInterface[]
     */
    public function findAll()
    {
        $customers = [];

        foreach ($this->getConnexion()->query('SELECT * from customers') as $row) {
            $customer = new \App\Entity\Customer($row['firstname'], $row['lastname'], $row['address']);
            array_push($customers, $customer);
        }

        return $customers;
    }

    /**
     * @param $id
     * @return EntityInterface
     */
    public function find($id)
    {
        $request = $this->getConnexion()->prepare("SELECT * FROM customers WHERE id = :id");
        $request->bindParam(':id', $id);
        $request->execute();
        $result = $request->fetch();

        if ($result != null) {
            return new \App\Entity\Customer($result['firstname'], $result['lastname'], $result['address']);
        }

        return null;
    }

    /**
     * @param $column
     * @param $value
     * @return EntityInterface[]
     */
    public function findBy($column, $value)
    {
        $sql = "SELECT * FROM customers WHERE {$column} LIKE '{$value}'";
        $request = $this->getConnexion()->prepare($sql);
        $request->execute();
        $result = $request->fetch();

        if ($result != null) {
            return new \App\Entity\Customer($result['firstname'], $result['lastname'], $result['address']);
        }

        return null;
    }

}