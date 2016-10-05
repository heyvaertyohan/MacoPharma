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
                "name" => "Omega-3",
                "description" => "image omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/Omega-3.jpg",
            ),
            array(
                "name" => "vista-omega-3",
                "description" => "image vista omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/vista-omega-3.jpg",
            ),
            array(
                "name" => "pg-pharmagenerix-omega-3-pg-150-gelules",
                "description" => "image pg pharmagenerix omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/pg-pharmagenerix-omega-3-pg-150-gelules.jpg",
            ),
            array(
                "name" => "biover-omega-3-capsules-80",
                "description" => "mage biover omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/biover-omega-3-capsules-80.jpg",
            ),
            array(
                "name" => "pg-pharmagenerix-omega-3-50-gelules",
                "description" => "image pg pharmagenerix omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/pg-pharmagenerix-omega-3-50-gelules.jpg",
            ),
            array(
                "name" => "omega-3-vegetal-60-capsules",
                "description" => "image omega 3 vegetal",
                "path" => "bundles/MacopharmaMacopharma/images/omega-3-vegetal-60-capsules.jpg",
            ),
            array(
                "name" => "damhert-omega-3-capsules-30",
                "description" => "image damhert omega 3",
                "path" => "bundles/MacopharmaMacopharma/images/damhert-omega-3-capsules-30.jpg",
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
