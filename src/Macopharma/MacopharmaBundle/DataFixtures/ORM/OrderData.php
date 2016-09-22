<?php

namespace Macopharma\MacopharmaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Macopharma\MacopharmaBundle\Entity\Order;
use Macopharma\MacopharmaBundle\Entity\Product;
/**
 * Description of Order
 *
 * @author jHeyvaert
 */
class OrderData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager){

        $tab_orders = array(
            array(
                "User" => $manager->getRepository('MacopharmaUserBundle:User')->findOneBy(array('username' => 'benjamin')),
                "valider" => 1,
                "date" => new \DateTime(),
                "reference" => 1,
                "product" => array(
                    $manager->getRepository('MacopharmaMacopharmaBundle:Product')->findOneBy(array('name' => 'salade')),
                    $manager->getRepository('MacopharmaMacopharmaBundle:Product')->findOneBy(array('name' => 'tomate')),
                    $manager->getRepository('MacopharmaMacopharmaBundle:Product')->findOneBy(array('name' => 'pomme'))
                )
            )
        );

        for($i=0; $i< sizeof($tab_orders); $i++ ){
            $order = new Order();
            $order->setUser($tab_orders[$i]['User']);
            $order->setValider($tab_orders[$i]['valider']);
            $order->setDate($tab_orders[$i]['date']);
            $order->setReference($tab_orders[$i]['reference']);

            $Products_tab = $tab_orders[$i]['product'];
            for ($j = 0; $j < sizeof($tab_orders); $j++) {
                $order->setProducts($Products_tab[$j]);
            }

            $manager->persist($order);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
    
}
