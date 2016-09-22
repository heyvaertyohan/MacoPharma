<?php
namespace Macopharma\MacopharmaBundle\DataFixtures;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Macopharma\MacopharmaBundle\Entity\Product;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Product
 *
 * @author jHeyvaert
 */
class ProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $Products_tab = array(
            array(
                "name" => "Vista Oméga 3 Capsules 100",
                "description" => "Contribue à retrouver, naturellement, un équilibre favorable en acides gras essentiels.",
                "disponible" => true,
                "plage" => "",
                "prix" => "31.41",
                "tva" =>
                    $manager->getRepository('MacopharmaMacopharmaBundle:Tva')->findOneBy(array('name' => 'TVA 21%')),
                "media" =>
                    $manager->getRepository('MacopharmaMacopharmaBundle:Media')->findOneBy(array('name' => 'vista-omega-3')),
                "Category" => $manager->getRepository('MacopharmaMacopharmaBundle:Category')->findOneBy(array('name' => 'Omega-3')
                )
             )
        );

        for($i=0; $i< sizeof($Products_tab); $i++ ){
            $product = new Product();
            $product->setName($Products_tab[$i]['name']);
            $product->setDescription($Products_tab[$i]['description']);
            $product->setDisponible($Products_tab[$i]['disponible']);
            $product->setPlage($Products_tab[$i]['plage']);
            $product->setPrix($Products_tab[$i]['prix']);
            $product->setTva($Products_tab[$i]['tva']);
            $product->setMedia($Products_tab[$i]['media']);
            $product->setCategory($Products_tab[$i]['Category']);

            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
    
}
