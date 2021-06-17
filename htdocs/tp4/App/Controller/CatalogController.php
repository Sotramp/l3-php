<?php


namespace App\Controller;


class CatalogController extends AbstractController
{

    public function view()
    {
        $list_product = ['test' => 'content 1', 'deux' => 'content 2'];
        echo $this->render('catalog/view.phtml', ['products' => $list_product]);
        //echo 'test';
    }

    /*public function viewProduct()
    {
        echo 'Page produit';
    }*/
}