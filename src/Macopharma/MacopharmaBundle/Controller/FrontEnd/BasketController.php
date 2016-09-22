<?php

namespace Macopharma\MacopharmaBundle\Controller\FrontEnd;

use Macopharma\UserBundle\MacopharmaUserBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Macopharma\MacopharmaBundle\Form\SearchType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Macopharma\MacopharmaBundle\Entity\Product;
use Macopharma\UserBundle\Entity;
use Macopharma\UserBundle\Form;

class BasketController extends Controller
{
    public function menuAction()
    {
        $session = $this->getRequest()->getSession();
        if (!$session->has('basket'))
            $articles = 0;
        else
            $articles = count($session->get('basket'));

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Basket:menu.html.twig', array('articles' => $articles));
    }

    public function listAction()
    {
        $session = $this->getRequest()->getSession();
        if (!$session->has('basket')) $session->set('basket', array());

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('MacopharmaMacopharmaBundle:Product')->findArray(array_keys($session->get('basket')));

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Basket:list.html.twig', array('products_list' => $products,
            'basket' => $session->get('basket')));
    }

    public function deleteAction(Product $product)
    {
        $session = $this->getRequest()->getSession();
        $basket = $session->get('basket');

        if(array_key_exists($product->getId(), $basket)){
            unset($basket[$product->getId()]);
            $session->set('basket', $basket);
            $this->get('session')->getFlashBag('success', "l'article a bien été supprimé" );
        }

        return $this->redirect($this->generateUrl('basket'));
    }

    public function addAction(Product $product)
    {
        $session = $this->getRequest()->getSession();

        if (!$session->has('basket')) $session->set('basket',array());
        $basket = $session->get('basket');

        if (array_key_exists($product->getId(), $basket)) {
            if ($this->getRequest()->query->get('qte') != null) {
                $basket[$product->getId()] = $this->getRequest()->query->get('qte');
            }
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($this->getRequest()->query->get('qte') != null)
                $basket[$product->getId()] = $this->getRequest()->query->get('qte');
            else
                $basket[$product->getId()] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('basket',$basket);

        return $this->redirect($this->generateUrl('basket'));
    }

    public function validationAction()
    {
        if ($this->get('request')->getMethod() == 'POST')
            $this->setLivraisonOnSession();

        $em = $this->getDoctrine()->getManager();
        $prepareOrder = $this->forward('MacopharmaBundle:Order:prepareOrder');
        $order = $em->getRepository('MacopharmaMacopharmaBundle:Order')->find($prepareOrder->getContent());

        dump($prepareOrder);
        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Basket:validation.html.twig', array('order' => $order));
    }

    public function setLivraisonOnSession()
    {
        $session = $this->getRequest()->getSession();

        if (!$session->has('adresse')) $session->set('adresse',array());
        $adresse = $session->get('adresse');

        if ($this->getRequest()->request->get('livraison') != null && $this->getRequest()->request->get('facturation') != null)
        {
            $adresse['livraison'] = $this->getRequest()->request->get('livraison');
            $adresse['facturation'] = $this->getRequest()->request->get('facturation');
        } else {
            return $this->redirect($this->generateUrl('basket_validation'));
        }

        $session->set('adresse',$adresse);
        return $this->redirect($this->generateUrl('basket_validation'));
    }

    public function deliveryAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $entity = new Entity\AddressUser();
        $form = $this->createForm(new Form\UsersAdressesType(), $entity);

        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setUser($user);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('basket_delivery'));
            }
        }

        return $this->render('MacopharmaMacopharmaBundle:FrontEnd/Basket:livraison.html.twig', array('User' => $user,
            'form' => $form->createView()));
    }

    public function deleteAdressAction(Entity\AddressUser $AddressUser){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MacopharmaUserBundle:AddressUser')->find($AddressUser->getId());

        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUser() || !$entity)
            return $this->redirect ($this->generateUrl ('basket_delivery'));

        $em->remove($entity);
        $em->flush();

        return $this->redirect ($this->generateUrl ('basket_delivery'));
    }

}
