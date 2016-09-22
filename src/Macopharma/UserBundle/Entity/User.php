<?php
// src/AppBundle/Entity/User.php

namespace Macopharma\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=125)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=125)
     */
    protected $firstname;

    /**
     * @ORM\Column(name="telephone", type="string", length=30)
     */
    protected $telephone;

    /**
     * @ORM\OneToMany(targetEntity="Macopharma\MacopharmaBundle\Entity\Order", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="Macopharma\UserBundle\Entity\AddressUser", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     * */
    private $adresse;


    public function __construct()
    {
        parent::__construct();
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresse = new \Doctrine\Common\Collections\ArrayCollection();
    }





    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Add order
     *
     * @param \Macopharma\MacopharmaBundle\Entity\Order $order
     *
     * @return User
     */
    public function addOrder(\Macopharma\MacopharmaBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Macopharma\MacopharmaBundle\Entity\Order $order
     */
    public function removeOrder(\Macopharma\MacopharmaBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add adresse
     *
     * @param \Macopharma\UserBundle\Entity\AddressUser $adresse
     *
     * @return User
     */
    public function addAdresse(\Macopharma\UserBundle\Entity\AddressUser $adresse)
    {
        $this->adresse[] = $adresse;

        return $this;
    }

    /**
     * Remove adresse
     *
     * @param \Macopharma\UserBundle\Entity\AddressUser $adresse
     */
    public function removeAdresse(\Macopharma\UserBundle\Entity\AddressUser $adresse)
    {
        $this->adresse->removeElement($adresse);
    }

    /**
     * Get adresse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
