<?php
namespace LeBonCoinBundle\Controller;

use LeBonCoinBundle\Entity\Adverts;
use LeBonCoinBundle\Entity\Images;
use LeBonCoinBundle\Form\AdvertsForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller
{
    public function editAction(Request $request)
    {
        $advert = new Adverts();
        $form = $this->createForm(AdvertsForm::class, $advert, array("action" => $this->generateUrl('leboncoin_edit_advert')));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach($advert->getImages() as $key => $image) {
                $img = new Images();
                $img->setFile($image);
                $img->setAdverts($advert);
                $img->upload();
                $advert->addImage($img);
                if (!preg_match('/^[0-9]*$/', $key)) {
                    unset($advert->getImages()[$key]);
                }
                $em->persist($img);
            }
            $em->persist($advert);
            $em->flush();
            return $this->redirectToRoute('leboncoin_index');
        }
        return $this->render('LeBonCoinBundle:Advert:edit.html.twig', array(
            "form" => $form->createView(),
        ));
    }
    
    public function showAction($id = null)
    {
        if($id) {
            $advert = $this->getDoctrine()->getRepository('LeBonCoinBundle:Adverts')->findOneById($id);
            $day = $advert->getDate()->format('d/m/Y');
            $time = $advert->getDate()->format('H:i');
        }
        else
            return $this->redirectToRoute('leboncoin_index');
        return $this->render('LeBonCoinBundle:Advert:show.html.twig', array(
            "advert" => $advert,
            "day" => $day,
            "time" => $time,
        ));
    }

}
