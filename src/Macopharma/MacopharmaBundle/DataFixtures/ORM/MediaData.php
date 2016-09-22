<?php
namespace Macopharma\MacopharmaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Macopharma\MacopharmaBundle\Entity\Media;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Media
 *
 * @author jHeyvaert
 */
class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Medias = array(
            array(
                "name" => "vista-omega-3",
                "description" => "image vista-omega-3.jpg",
                "path" => "bundles/MacopharmaMacopharma/images/vista-omega-3.jpg",
            ),
            array(
                "name" => "Omega-3",
                "description" => "image omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/Omega-3.jpg",
            ),
            array(
                "name" => "Vitamine",
                "description" => "image vitamine",
                "path" => "bundles/MacopharmaMacopharma/images/vitamine.jpg",
            ),
            array(
                "name" => "Sport",
                "description" => "image sport",
                "path" => "bundles/MacopharmaMacopharma/images/sports.jpg",
            )
        );

        for($i=0; $i< sizeof($tab_Medias); $i++ ){
            $image = new Media();
            $image->setName($tab_Medias[$i]['name']);
            $image->setDescription($tab_Medias[$i]['description']);
            $image->setPath($tab_Medias[$i]['path']);

            $manager->persist($image);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
    
}
