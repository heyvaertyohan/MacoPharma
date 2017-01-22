<?php

namespace Macopharma\MacopharmaBundle\Controller\FrontEnd;

use Macopharma\MacopharmaBundle\Entity\Product;
use Macopharma\MacopharmaBundle\Entity\Category;
use Macopharma\MacopharmaBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function listAction(Category $Category = null)
    {
        if($Category == null){

            $this->products_list = $this->getDoctrine()->getManager()->getRepository('MacopharmaMacopharmaBundle:Product')->findAll();

            if ($this->products_list == null) {
                throw $this->createNotFoundException("No products list find!!");
            }
        }
        else{
            $this->products_list = $this->getDoctrine()->getManager()->getRepository('MacopharmaMacopharmaBundle:Product')->byCategory($Category);
            if ($this->products_list == null) {
                throw $this->createNotFoundException("No products list find!");
            }
        }
        $this->session = $this->get('Session');
        $this->basket = $this->session->get('basket');

        if (!$this->session->has('basket'))
            $this->articles = 0;
        else
            $this->articles = count($this->session->get('basket'));

        $this->list_Categorys = $this->getDoctrine()->getManager()->getRepository('MacopharmaMacopharmaBundle:Category')->findAll();

        if ($this->list_Categorys == null) {
            throw $this->createNotFoundException("No categories list  find!!");
        }

        $form = $this->createForm(SearchType::class);

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Product:list.html.twig', array(
            'list_Categorys' => $this->list_Categorys,
            'products_list' => $this->products_list,
            'articles' => $this->articles,
            'form' => $form->createView(),
            'basket' => $this->basket
        ));
    }

    public function readAction(Product $product)
    {
        $session = $this->get('Session');
        $basket = $session->get('basket');

        $product = $this->getDoctrine()->getManager()->getRepository('MacopharmaMacopharmaBundle:Product')->find($product->getId());
        $list_Categorys = $this->getDoctrine()->getManager()->getRepository('MacopharmaMacopharmaBundle:Category')->findAll();

        $form = $this->createForm(new SearchType());

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Product:read.html.twig', array(
            'list_Categorys' => $list_Categorys,
            'product' => $product,
            'form' => $form->createView(),
            'basket' => $basket
        ));
    }

    public function rechercheAction()
    {
        $form = $this->createForm(new SearchType());

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bind($this->get('request'));
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('MacopharmaMacopharmaBundle:Product')->recherche($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Product:list.html.twig', array(
            'products_list' => $products,
            'form' => $form->createView()
        ));
    }

    public function redirectAction()
    {
        $prefLang = $this->getRequest()->getPreferredLanguage(array("fr", "en"));
        return $this->redirect($this->generateUrl("public_homepage", array("_locale" => $prefLang ? $prefLang : "en")));
    }


}
