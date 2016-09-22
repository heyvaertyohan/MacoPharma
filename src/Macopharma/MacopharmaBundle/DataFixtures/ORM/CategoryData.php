<?php

namespace Macopharma\MacopharmaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Macopharma\MacopharmaBundle\Entity\Category;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Category
 *
 * @author jHeyvaert
 */
class CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Categorys = array(
            array(
                "name" => "Omega-3",
                "description" => "Omega-3",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Omega-3')),
            )/*,
            array(
                "name" => "Vitamine",
                "description" => "Vitamine",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Vitamine')),
            ),
            array(
                "name" => "Sport",
                "description" => "Sport",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Sport')),
            ),
            array(
                "name" => "Nutritherapie",
                "description" => "Nutritherapie",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Nutritherapie')),
            ),
            array(
                "name" => "Bien-etre",
                "description" => "Bien-etre",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Bien-etre')),
            )*//*,
            array(
                "name" => "Vitamine",
                "description" => "Vitamine",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Vitamine')),
            ),
            array(
                "name" => "Sport",
                "description" => "Sport",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Sport')),
            ),
            array(
                "name" => "Nutritherapie",
                "description" => "Nutritherapie",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Nutritherapie')),
            ),
            array(
                "name" => "Bien-etre",
                "description" => "Bien-etre",
                "media" => $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'Bien-etre')),
            )*/
        );

        for($i=0; $i< sizeof($tab_Categorys); $i++ ){
            $Category = new Category();
            $Category->SetName($tab_Categorys[$i]['name']);
            $Category->setDescription($tab_Categorys[$i]['description']);
            $Category->setMedia($tab_Categorys[$i]['media']);

            $manager->persist($Category);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
    
}
