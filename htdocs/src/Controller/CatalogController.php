<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route("/catalog", name="catalog")
     */
    public function view(ProductRepository $productRepository)
    {
        $listProducts = $productRepository->findAll();
        $productByID = $productRepository->findOneBy(['id' => 2]);

        return $this->render('/catalog/catalog.html.twig',
            [
                'listProducts'  => $listProducts,
                'productID'     => $productByID
            ]
        );
    }
}