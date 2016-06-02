<?php

namespace LeBonCoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
        $search = $request->request->get('search');
        $em = $this->getDoctrine()->getManager();
        $adverts = $this->getDoctrine()->getRepository('LeBonCoinBundle:Adverts')->getFilteredAdverts($search);
        return $this->render('LeBonCoinBundle:Search:index.html.twig', array(
            "adverts" => $adverts
        ));
    }

}
