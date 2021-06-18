<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    /**
     * @Route("/catalog/addproduct", name="addproduct")
     */
    public function view(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, ['label' => 'Nom du produit : '])
            ->add('price', NumberType::class, ['label' => 'Prix du produit : '])
            ->add('save', SubmitType::class, ['label' => 'Ajout du produit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('addproduct_success');
        }

        return $this->render('/catalog/addproduct.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/catalog/addproduct_success", name="addproduct_success")
     */
    public function addProductSuccess()
    {
        return $this->render('/catalog/addproduct_success.html.twig');
    }
}