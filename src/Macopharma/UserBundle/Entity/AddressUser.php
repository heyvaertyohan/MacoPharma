<?php

namespace Macopharma\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressUser
 *
 * @ORM\Table("useradresse")
 * @ORM\Entity
 */
class AddressUser
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
     * @ORM\ManyToOne(targetEntity="Macopharma\UserBundle\Entity\User", inversedBy="adresse")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;


    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=10)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=125)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=125)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255)
     */
    private $complement;


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
     * Set cp
     *
     * @param string $cp
     *
     * @return AddressUser
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return AddressUser
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return AddressUser
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return AddressUser
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set user
     *
     * @param \Macopharma\UserBundle\Entity\User $user
     *
     * @return AddressUser
     */
    public function setUser(\Macopharma\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User
     *
     * @return \Macopharma\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return AddressUser
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }
}
