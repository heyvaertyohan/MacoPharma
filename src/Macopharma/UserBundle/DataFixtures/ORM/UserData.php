<?php

namespace Macopharma\UserBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Macopharma\UserBundle\Entity\User;
/**
 * Description of Category
 *
 * @author jHeyvaert
 */
class UsersData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager){

        $tab_User = array(
            array(
                "username" => "yohan",
                "name" => "yohan",
                "firstname" => "yohan",
                "email" => "heyvaertyohan@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'yohan',
                "role" => array(
                    "ROLE_ADMIN"
                ),
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'user')),
            ),
            array(
                "username" => "benjamin",
                "name" => "benjamin",
                "firstname" => "benjamin",
                "email" => "benjamin@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "role" => array(
                    ""
                ),
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'user')),
            ),
            array(
                "username" => "mathilde",
                "name" => "mathilde",
                "firstname" => "mathilde",
                "email" => "mathilde@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'mathilde',
                "role" => array(
                    ""
                ),
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'user')),
            ),
            array(
                "username" => "pauline",
                "name" => "pauline",
                "firstname" => "pauline",
                "email" => "pauline@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "role" => array(
                    ""
                ),
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'user')),
            ),
            array(
                "username" => "dominique",
                "name" => "dominique",
                "firstname" => "dominique",
                "email" => "dominique@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "role" => array(
                    ""
                ),
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'user')),
            )
        );

        for($i=0; $i< sizeof($tab_User); $i++ ){
            $user = new User();
            $user->setUsername($tab_User[$i]['username']);
            $user->setName($tab_User[$i]['name']);
            $user->setfirstname($tab_User[$i]['firstname']);
            $user->setEmail($tab_User[$i]['email']);
            $user->setEnabled($tab_User[$i]['enabled']);
            $user->setTelephone($tab_User[$i]['telephone']);
            $user->setPassword($this->container->get('security.encoder_factory')->getEncoder($user)->encodePassword($tab_User[$i]['password'], $user->getSalt()));
            $user->setRoles($tab_User[$i]['role']);

            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
    
}
