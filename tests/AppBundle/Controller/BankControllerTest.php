<?php

namespace Tests\AppBundle\Controller;
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Message;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BankControllerTest extends WebTestCase
{
    /**
     * @group bb
     */
    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'bank/index');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @group bb
     */
    public function testRegisterAction()
    {

        $postData = [
            'username' => 'C8763_' . mt_rand(0,9),
            'password' => '0000'
                ];
        $paramArray = [];
        $uploadFileArray = [];
        $contentTypeArray = ['CONTENT_TYPE' => 'application/json'];

        $client = static::createClient();
        $crawler = $client->request(
                'POST',
                'bank/register',
                $paramArray,
                $uploadFileArray,
                $contentTypeArray,
                json_encode($postData));
              //   $postData
              //  );
        // dump($postData);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getcontent();
        $responseCheck = json_decode($content, true);
//        dump($content);
//        $this->assertEquals($postData['username'], $responseCheck["username"]);
    }
}
