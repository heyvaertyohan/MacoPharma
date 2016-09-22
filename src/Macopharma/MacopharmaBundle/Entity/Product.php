<?php

namespace Macopharma\MacopharmaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Macopharma\MacopharmaBundle\Entity\Tva;

/**
 * Product
 *
 * @ORM\Table("product")
 * @ORM\Entity(repositoryClass="Macopharma\MacopharmaBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var type String
     * @Gedmo\Slug(fields={"id","name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Macopharma\MacopharmaBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="Macopharma\MacopharmaBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;

    /**
     * @var string
     *
     * @ORM\Column(name="plage", type="string", length=255)
     */
    private $plage;


    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @ORM\ManytoOne(targetEntity="Tva", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Product
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set plage
     *
     * @param string $plage
     *
     * @return Product
     */
    public function setPlage($plage)
    {
        $this->plage = $plage;

        return $this;
    }

    /**
     * Get plage
     *
     * @return string
     */
    public function getPlage()
    {
        return $this->plage;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Product
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set media
     *
     * @param \Macopharma\MacopharmaBundle\Entity\Media $media
     *
     * @return Product
     */
    public function setMedia(\Macopharma\MacopharmaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Macopharma\MacopharmaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Category = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set Category
     *
     * @param \Macopharma\MacopharmaBundle\Entity\Category $Category
     *
     * @return Product
     */
    public function setCategory(\Macopharma\MacopharmaBundle\Entity\Category $Category)
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * Get Category
     *
     * @return \Macopharma\MacopharmaBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * Set tva
     *
     * @param \Macopharma/MacopharmaBundle\Entity\Tva $tva
     *
     * @return Product
     */
    public function setTva(Tva $tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return \Macopharma/MacopharmaBundle\Entity\Tva
     */
    public function getTva()
    {
        return $this->tva;
    }
}
