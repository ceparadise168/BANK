<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use \DateTime;

/**
* @ORM\Entity
* @ORM\Table(name="Bank")
*/
class Bank
{
    /**
     * @ORM\OneToMany(targetEntity="Trade", mappedBy="bank")
     */
    private $trades;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=225)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $money;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;


    public function __construct()
    {
        $this->trades = new ArrayCollection();
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Username
     * @return Bank
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get Password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password
     * @return Bank
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get Money
     * @return integer
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Set Money
     * @return Bank
     */
    public function setMoney($money)
    {
        $this->money = $money;
        return $this;
    }
    /**
     * Get Status
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Status
     * @return Bank
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}

