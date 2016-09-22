<?php

namespace Macopharma\MacopharmaBundle\Controller\FrontEnd;

use Macopharma\UserBundle\MacopharmaUserBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Macopharma\MacopharmaBundle\Form\SearchType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Macopharma\MacopharmaBundle\Entity\Product;
use Macopharma\UserBundle\Entity;
use Macopharma\UserBundle\Form;

class OrderController extends Controller
{
    public function validationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('MacopharmaBundle:Orders')->find($id);

        if (!$order || $order->getValider() == 1)
            throw $this->createNotFoundException('The order does not exist!');

        $order->setValider(1);
        $order->setReference($this->container->get('setNewReference')->reference());
        $em->flush();

        $session = $this->getRequest()->getSession();
        $session->remove('adresse');
        $session->remove('basket');
        $session->remove('order');

        $this->get('session')->getFlashBag()->add('success','Your order is successfully validated');
        return $this->redirect($this->generateUrl('factures'));
    }

    public function prepareOrderAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('order'))
            $order = new Orders();
        else
            $order = $em->getRepository('MacopharmaBundle:Order')->find($session->get('order'));

        $order->setDate(new \DateTime());
        $order->setUser($this->container->get('security.context')->getToken()->getUser());
        $order->setValider(0);
        $order->setReference(0);
        $order->setOrder($this->facture());

        if (!$session->has('order')) {
            $em->persist($order);
            $session->set('order',$order);
        }

        $em->flush();

        return new Response($order->getId());
    }

}
