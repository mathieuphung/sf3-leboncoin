<?php
namespace LeBonCoinBundle\Controller;

use LeBonCoinBundle\Entity\Adverts;
use LeBonCoinBundle\Entity\Images;
use LeBonCoinBundle\Form\AdvertsForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller
{
    public function EditAction($id = null, Request $request)
    {
        if ($id)
            $advert = $this->getDoctrine()->getRepository('LeBonCoinBundle:Adverts')->findOneById($id);
        else
            $advert = new Adverts();
        $form = $this->createForm(AdvertsForm::class, $advert, array("action" => $this->generateUrl('leboncoin_edit')));
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
        }
        return $this->render('LeBonCoinBundle:Advert:edit.html.twig', array(
            "form" => $form->createView(),
        ));
    }

}
