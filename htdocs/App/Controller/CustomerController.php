<?php

namespace App\Controller;

use App\Entity\Product;

class CustomerController extends AbstractController
{

    public function view()
    {
        $list_customer = [];

        $customerRepo = new \App\Entity\Repository\Customer();
        $list_customer = $customerRepo->findAll();

        $customerByID = $customerRepo->find(5);

        $customerByName = $customerRepo->findBy('firstname', 'Gauthier');

        echo $this->render('customers/view.phtml',
            [
                'customers' => $list_customer,
                'customerID' => $customerByID,
                'customerName' => $customerByName
            ]);
    }

}