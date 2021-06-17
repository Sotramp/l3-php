<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function home()
    {
        echo $this->render('home.phtml', []);
    }

}