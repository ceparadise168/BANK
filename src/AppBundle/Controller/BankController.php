<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\PostType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \DateTime;
use AppBundle\Entity\Bank;
use AppBundle\Entity\Trade;
use AppBundle\Entity\Account;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BankController extends Controller
{
    /**
     * @Route("bank/index", name = "bankIndex")
     * @Method("POST")
     */
    public function indexAction(Request $request)
    {
        $content = $request->getContent();
        $requestData = json_decode($content, true);

        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($requestData, 'json');

        //        var_dump($json);
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("bank/register", name = "bankRegister")
     * @Method("POST")
     */
    public function registerAction(Request $request)
    {

        $content = $request->getContent();

        $requestData = json_decode($content, true);
        $registerUsername = $requestData['username'];
        $registerPassword = $requestData['password'];
   //     dump($registerUsername,$registerPassword);

        $bank = new Bank();
        $bank->setUsername($registerUsername);
        $bank->setPassword($registerPassword);

//         $bank->setUsername("eric");
//         $bank->setPassword("777");
        $bank->setMoney("0");
        $bank->setStatus("0");
        // dump($bank);

        $trade = new Trade();
        $trade->setBehavior("INIT");
        $trade->setTradingFrom("INIT");
        $trade->setTradingTo("INIT");
        $trade->setCash("0");
        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
        $trade->setTradedAt($tradedAt);
        $trade->setBank($bank);

        $em = $this->getDoctrine()->getManager();
         $em->persist($bank);
         $em->persist($trade);
         $em->flush();

       $idd =  $bank->getId();
//this is a test line
//this is a test line in dev 2 
       $jsonArray = [
           "id" => $idd,
           "username" =>  $registerUsername,
           "password" => $registerPassword
       ];

        $encodersArray = [
            new XmlEncoder(),
            new JsonEncoder()
        ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
//     $json = $serializer->serialize($requestData, 'json');
        $json = $serializer->serialize($jsonArray, 'json');


        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("bank/login", name = "bankLogin")
     * @Method("POST")
     */
    public function LoginAction(Request $request)
    {
/*
        $content = $request->getContent();
        $requestData = json_decode($content, true);
        $loginId = $requestData['id'];
        $loginUsername = $requestData['username'];
        $loginPassword = $requestData['password'];

        $em = $this->getDoctrine()->getManager();
        $banks = $em->getRepository('AppBundle:Bank');
        $bank = $banks->find($loginId);
*/
/*
        $qb = $banks->createQueryBuilder('b')
            // ->orderBy('m.updatedAt', 'DESC')
            ->where('b.money < :money')
            ->setParameter('money', '0');

        $query = $qb->getQuery();
        $result = $query->getResult();
        $target = $result[0];
*/
/*
       $target = $bank;

        $targetID = $target->getId();
        $targetUsername = $target->getUsername();
        $targetPassword = $target->getPassword();

        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($target, 'json');
*/
        $response = new Response();
//        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

//       return $response;

        /*
           $bank = $banks->find($username);
           $id = $bank->getId();
           $username = $bank->getUsername();
           $password = $bank->getPassword();
         */
/*
        if ($loginUsername==$targetUsername && $loginPassword==$targetPassword) {
//            $bank = $banks->find($targetID);
            $bank->setStatus("1");
            $em->persist($bank);
            $em->flush();
            $json = $serializer->serialize($bank, 'json');
            $response->setContent($json ." SUCCESS");
            return $response;
        } else {
            $response->setContent($json ." FALSE" . $loginUsername."||".$targetUsername."|".$loginPassword."||".$targetPassword);
            return $response;
*/
            $response->setContent("HI");
            return $response;
      //  }

    }

    /**
     * @Route("bank/logout", name = "bankLogout")
     * @Method("GET")
     */
    public function LogoutAction()
    {
        $logoutUsername = "eric";
        $logoutPassowrd = "777";


        $em = $this->getDoctrine()->getManager();
        $banks = $em->getRepository('AppBundle:Bank');

        $qb = $banks->createQueryBuilder('b')
            // ->orderBy('m.updatedAt', 'DESC')
            ->where('b.money < :money')
            ->setParameter('money', '0');
        $query = $qb->getQuery();
        $result = $query->getResult();
        $target = $result[0];
        $targetID = $target->getId();
        $targetUsername = $target->getUsername();
        $targetPassword = $target->getPassword();

        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($target, 'json');

        if ($logoutUsername==$targetUsername && $logoutPassowrd==$targetPassword) {
            $bank = $banks->find($targetID);
            $bank->setStatus("0");
            $em->persist($bank);
            $em->flush();
            return new Response("Logout success");
        } else {
            return new Response("Logout false" . $json . $targetId .$targetUsername .  $targetPassword);
        }
    }

    /**
     * @Route("bank/search", name = "bankSearch")
     * @Method("GET")
     */
    public function serachAction()
    {
        $id = 1;
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository('AppBundle:Trade');
        $trade = $trades->find($id);

        $bankId = $trade->getBank()->getUsername();

        return new Response($bankId);
        /*
           $trade = new Trade();
           $trade->setBehavior("T");
           $trade->setTradingFrom("A");
           $trade->setTradingTo("B");
           $trade->setCash("100");
           $trade->setTradedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));
        //$trade->setTradedAt();
        $em = $this->getDoctrine()->getManager();
        $em->persist($trade);
        $em->flush();
        return new Response("Search");
         */
    }

    /**
     * @Route("bank/menu", name = "bankMenu")
     * @Method("GET")
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository('AppBundle:Trade');
        $trade = $trades->findAll();
        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($trade, 'json');

        //  dump($trade);
        return new Response("Menu" . $json);
    }

    /**
     * @Route("bank/deposit", name = "bankDeposit")
     * @Method("GET")
     */
    public function depositActino()
    {
        $depositMoney = 1000;

        $uid = 75;
        $em = $this->getDoctrine()->getManager();
        $banks = $em->getRepository('AppBundle:Bank');
        $bank = $banks->find($uid);

        $money = $bank->getMoney();

        $resultCash = $money + $depositMoney;
        $bank->setMoney($resultCash);
        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));

        $trade = new Trade();
        $trade->setBehavior("Deposit");
        $trade->setTradingFrom("A");
        $trade->setTradingTo("A");
        $trade->setCash($resultCash);
        $trade->setTradedAt($tradedAt);

        $trade->setBank($bank);

        $em->persist($trade);
        $em->flush();

        return new Response("Deposit");
    }

    /**
     * @Route("bank/withdrawals", name = "bankWithdrawals")
     * @Method("GET")
     */
    public function withdrawalsActino()
    {
        $withdrawalsMoney = 200;

        $uid = 75;

        $em = $this->getDoctrine()->getManager();
        $banks = $em->getRepository('AppBundle:Bank');
        $bank = $banks->find($uid);

        $money = $bank->getMoney();

        $resultCash = $money - $withdrawalsMoney;
        $bank->setMoney($resultCash);

        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));

        $trade = new Trade();
        $trade->setBehavior("Withdrawals");
        $trade->setTradingFrom("A");
        $trade->setTradingTo("A");
        $trade->setCash($resultCash);
        $trade->setTradedAt($tradedAt);

        $trade->setBank($bank);
        $em->persist($trade);
        $em->flush();

        return new Response("Withdrawals");

    }

    /**
     * @Route("bank/transfer", name="bankTransfer")
     * @Method("GET")
     */
    public function transferAction()
    {
        $transMoney = 300;
        $transferID = 75;
        $receiverID = 2;

        $em = $this->getDoctrine()->getManager();
        $banks = $em->getRepository('AppBundle:Bank');

        $transferBank = $banks->find($transferID);
        $transferMoney = $transferBank->getMoney();

        $receiverBank = $banks->find($receiverID);
        $receiverMoney = $receiverBank->getMoney();

        $resultCashTrans = $transferMoney - $transMoney;
        $resultCashRecei = $receiverMoney + $transMoney;
        $tradedAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));

        $tradeT = new Trade();
        $tradeT->setBehavior("transfer");
        $tradeT->setTradingFrom($transferID);
        $tradeT->setTradingTo($receiverID);
        $tradeT->setCash($resultCashTrans);
        $tradeT->setTradedAt($tradedAt);
        $tradeT->setBank($transferBank);

        $tradeR = new Trade();
        $tradeR->setBehavior("receive");
        $tradeR->setTradingFrom($transferID);
        $tradeR->setTradingTo($receiverID);
        $tradeR->setCash($resultCashRecei);
        $tradeR->setTradedAt($tradedAt);
        // $tradeR->setBank($receiverBank);


        $transferBank->setMoney($resultCashTrans);
        $receiverBank->setMoney($resultCashRecei);

        $em->persist($tradeT);
        $em->persist($tradeR);
        $em->flush();

        //return now money 
        return new Response("trans");
    }

    /**
     * @Route("bank/log/deposit", name = "depositLog")
     * @Method("GET")
     */
    public function depositLogAction()
    {
        $em = $this->getDoctrine()->getManager();
        //        $banks = $em->getRepository('AppBundle:Bank');
        $trades = $em->getRepository('AppBundle:Trade');
        $logID = 75;

        //        $bank = $banks->find('75');

        $qb = $trades->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->where('t.tradingFrom = :tradingFrom')
            ->setParameter('tradingFrom', 'A')
            ->andwhere('t.behavior = :behavior')
            ->setParameter('behavior', 'Deposit');

        $query = $qb->getQuery();
        $result = $query->getResult();
        //       $target = $result[0];
        //        $log = $transferBank->find();

        //        $trades = $em->getRepository('AppBundle:Trade');
        //        $trade = $trades->findAll();
        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($result, 'json');

        //  dump($trade);
        return new Response("Menu" . $json);
    }

    /**
     * @Route("bank/log/withdrawals", name = "withdrawalsLog")
     * @Method("GET")
     */
    public function withdrawalsLogAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository('AppBundle:Trade');
        $logID = 75;

        $qb = $trades->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->where('t.tradingFrom = :tradingFrom')
            ->setParameter('tradingFrom', 'A')
            ->andwhere('t.behavior = :behavior')
            ->setParameter('behavior', 'Withdrawals');

        $query = $qb->getQuery();
        $result = $query->getResult();

        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($result, 'json');

        return new Response("Menu" . $json);
    }

    /**
     * @Route("bank/log/transfer", name = "transferLog")
     * @Method("GET")
     */
    public function transferLogAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository('AppBundle:Trade');
        $logID = 75;

        $qb = $trades->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->where('t.tradingFrom = :tradingFrom')
            ->setParameter('tradingFrom', '75')
            ->andwhere('t.behavior = :behavior')
            ->setParameter('behavior', 'Transfer');
        $query = $qb->getQuery();
        $result = $query->getResult();

        $encodersArray = [
            new XmlEncoder(),
            new JsonEncoder()
        ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($result, 'json');

        return new Response("Menu" . $json);
    }

    /**
     * @Route("bank/log/receive", name = "receiveLog")
     * @Method("GET")
     */
    public function receiveLogAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository('AppBundle:Trade');
        $logID = 75;

        $qb = $trades->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->where('t.tradingTo = :tradingTo')
            ->setParameter('tradingTo', '2')
            ->andwhere('t.behavior = :behavior')
            ->setParameter('behavior', 'Transfer');
        $query = $qb->getQuery();
        $result = $query->getResult();

        $encodersArray = [
            new XmlEncoder(),
                new JsonEncoder()
                    ];
        $normalizersArray = [new objectNormalizer()];
        $encoders = $encodersArray;;
        $normalizers = $normalizersArray;
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($result, 'json');

        return new Response("Menu" . $json);
    }
}
