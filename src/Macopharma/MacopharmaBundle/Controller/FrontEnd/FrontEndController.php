<?php

namespace WellnessCoreBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WellnessCoreBundle\Entity\Image;

class FrontEndController extends Controller
{
    private $listImagesSlider;

    protected function getListImageSlider(){
        return $this->listImagesSlider;
    }

    protected function initFrontEnd(){

        $rep_img = $this->getDoctrine()->getManager()->getRepository('WellnessCoreBundle:Image');
        $this->listCategoryWithLogo = $rep_img->getListImages(5, Image::TYPE_LOGO_SERVICE, null);

        $this->listImagesSlider = $rep_img->findBy(array('type' => 'mainSlider'));
        $this->listProvidersWithLogo = $rep_img->getListImages(4, Image::TYPE_LOGO_PROVIDER, null);

        if ($this->listImagesSlider == null) {
            throw $this->createNotFoundException("Pas d'image trouvée !");
        }

        if ($this->listCategoryWithLogo == null) {
            throw $this->createNotFoundException("Pas de Category trouvée !");
        }

        if ($this->listProvidersWithLogo == null) {
            throw $this->createNotFoundException("Pas d'image prestataire trouvée !");
        }
    }

    public function aboutAction()
    {
        return $this->render('WellnessCoreBundle:FrontEnd:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('WellnessCoreBundle:FrontEnd:contact.html.twig');
    }

    public function redirectAction()
    {
        $prefLang = $this->getRequest()->getPreferredLanguage(array("fr", "en"));
        return $this->redirect($this->generateUrl("public_homepage", array("_locale" => $prefLang ? $prefLang : "en")));
    }

    public function translationAction()
    {
        return $this->render('WellnessCoreBundle:FrontEnd:translation.html.twig');
    }
}
