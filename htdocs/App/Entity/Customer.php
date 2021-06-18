<?php

namespace App\Entity;

class Customer implements EntityInterface
{

    private $firstName;
    private $lastName;
    private $address;


    public function __construct($firstName, $lastName, $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $price
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed
     */
    public function setName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}
