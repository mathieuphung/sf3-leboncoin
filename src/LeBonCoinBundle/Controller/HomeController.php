<?php

namespace LeBonCoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('LeBonCoinBundle:Home:index.html.twig', array(
            // ...
        ));
    }

}
