<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customers", name="customer")
     */
    public function view(CustomerRepository $customerRepository)
    {
        $listCustomers = $customerRepository->findAll();
        $customerID = $customerRepository->findOneBy(['id' => 2]);

        return $this->render('/customers/customer.html.twig',
            [
                'listCustomers'  => $listCustomers,
                'customerID'     => $customerID
            ]
        );
    }
}