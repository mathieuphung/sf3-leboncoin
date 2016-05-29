<?php

namespace LeBonCoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    public function EditAction($id = null)
    {
        return $this->render('LeBonCoinBundle:Advert:edit.html.twig', array(
            // ...
        ));
    }

}
