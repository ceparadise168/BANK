<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Bank;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
 * @ORM\Entity 
 * @ORM\Table(name="Trade")
 */
class Trade
{
    /**
     * @var Bank
     * @ORM\ManyToOne(targetEntity="Bank", inversedBy="trades")
     * @ORM\JoinColumn(name="bank_id", referencedColumnName="id")
     */
    private $bank;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $behavior;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $tradingFrom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $tradingTo;

    /**
     * @ORM\Column(type="integer") 
     */
    private $cash;

    /**~
     * @var \DateTime~
     * @ORM\Column(type="datetime", nullable=true)~
     */
    private $tradedAt;

    public function __construct()
    {
        $this->tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
    }

    /**
     * Get Bank
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set Bank
     */
    public function setBank(Bank $bank)
    {

        //ini_set('error_reporting', E_STRICT);
        $this->bank = $bank;
        /*
           $encodersArray = [
           new XmlEncoder(),
           new JsonEncoder()
           ];
           $normalizersArray = [new objectNormalizer()];
           $encoders = $encodersArray;;
           $normalizers = $normalizersArray;
           $serializer = new Serializer($normalizers, $encoders);
           $json = $serializer->serialize($bank, 'json');

           $filename = "/home/eric_tu/eric_tu/get.txt";
           $file = fopen($filename, "w");
           fwrite($file, $json);
           fclose($file);
         */
        // 不顯示 warring
        // ini_set('error_reporting', E_STRICT);

        // $tihs->bank = $bank;
        // var_dump($bank);
        return $this;
    }

    /**
     * Get Trade Time
     */
    public function getTradedAt()
    {
        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
        // return $this->tradedAt->format('Y-m-d H:i:s');
        return $this->tradedAt = $tradedAt->format('Y-m-d H:i:s');
    }

    /**
     * Set Trade Time
     */
    public function setTradedAt(\DateTime $tradedAt)
    {
        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
        $this->tradedAt = $tradedAt;
        return $this;
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
     * Get Trading Beahavior
     * @return string
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set Trading Beahavior
     * @return Trade
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
        return $this;
    }

    /**
     * Get Trade From
     */
    public function getTradingFrom()
    {
        return $this->tradingFrom;
    }

    /**
     * Set Trade From
     */
    public function setTradingFrom($tradingFrom)
    {
        $this->tradingFrom = $tradingFrom;
        return $this;
    }

    /**
     * Get Trade To
     */
    public function getTradingTo()
    {
        return $this->tradingTo;
    }

    /**
     * Set Trade To
     */
    public function setTradingTo($tradingTo)
    {
        $this->tradingTo = $tradingTo;
        return $this;
    }

    /**
     * Get cash
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set cash
     */
    public function setCash($cash)
    {
        $this->cash = $cash;
        return $this;
    }
}
