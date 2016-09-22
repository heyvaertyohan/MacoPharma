<?php

namespace Macopharma\UserBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Macopharma\UserBundle\Entity\User;
use Macopharma\UserBundle\Entity\AddressUser;

/**
 * Description of AddressUserData
 *
 * @author jHeyvaert
 */
class AddressUserData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager){

        $tab_AdressUser = array(
            array(
                "user" => $manager->getRepository('MacopharmaUserBundle:User')->findOneBy(array('username' => 'benjamin')),
                "telephone" => "0600000000",
                "adresse" => "rue albertina rubosca",
                "cp" => "76600",
                "pays" => "France",
                "ville" => "Le Havre",
                "complement" => "face à l'église",
            )

        );

        for($i=0; $i< sizeof($tab_AdressUser); $i++ ){
            $adresse = new AddressUser();
            $adresse->setUser($tab_AdressUser[$i]['user']);
            $adresse->setRue($tab_AdressUser[$i]['adresse']);
            $adresse->setCp($tab_AdressUser[$i]['cp']);
            $adresse->setPays($tab_AdressUser[$i]['pays']);
            $adresse->setVille($tab_AdressUser[$i]['ville']);
            $adresse->setComplement($tab_AdressUser[$i]['complement']);
            $manager->persist($adresse);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
    
}
