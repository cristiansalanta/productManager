<?php

namespace AppBundle\Tests\Controller;

use AppBundle\ProductManagerService;
use AppBundle\PromotionManagerService;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\Product;


class ProductControllerTest extends WebTestCase
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * @var ProductManagerService
     */
    private $pms;

    /**
     * setUp ( START )
     */
    public function setUp()
    {
        parent::setUp();
        self::bootKernel();
        //$this->pms = new ProductManagerService();

        $this->conn = self::$kernel->getContainer()->get('database_connection');

        $this->conn->query(
            "CREATE TABLE IF NOT EXISTS products (
                                                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                                                    name VARCHAR(30) NOT NULL,
                                                    value FLOAT(50),
                                                    discountedValue FLOAT
                                                    )"
        );
        $this->conn->exec(
            sprintf(
                'INSERT INTO products (id,name,value,discountedValue)
                            VALUES(%u , \'%s\' , %f , %f)',
                100,
                'Jagpanther',
                6300,
                0
            )
        );
        $this->conn->exec(
            sprintf(
                'INSERT INTO products (id,name,value,discountedValue)
                            VALUES(%u , \'%s\' , %f , %f)',
                101,
                'Ratte',
                73250,
                0
            )
        );
        $this->conn->exec(
            sprintf(
                'INSERT INTO products (id,name,value,discountedValue)
                            VALUES(%u , \'%s\' , %f , %f)',
                102,
                'Maus',
                11235,
                0
            )
        );
        $this->conn->exec(
            sprintf(
                'INSERT INTO products (id,name,value,discountedValue)
                            VALUES(%u , \'%s\' , %f , %f)',
                103,
                'Waffentrager Auf E-100',
                7010,
                0
            )
        );
    }

    public function testGetProductFromDB()
    {
        $client = static::createClient();
        $client->request('GET', '/product/get/allproductsjson/100');
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        /**
         * Testing the elements of the returned product:
         */
        $this->assertEquals(100, $data['id']);
        $this->assertEquals('Jagpanther', $data['name']);
        $this->assertEquals(6300, $data['value']);
        $this->assertEquals(0, $data['discountedValue']);

    }

    public function testSingleProduct()
    {
        $pm = new PromotionManagerService(10);
        $pms = new ProductManagerService();
        $pms->setPromotionManager($pm);

        $mockCrudService = $this->getMockBuilder('AppBundle\ProductCrudService')
            ->disableOriginalConstructor()
            ->setMethods(array('getProductCrud'))
            ->getMock();

        $product1 = new Product();
        $product1->setId(200);
        $product1->setName('Joe Jegosul');
        $product1->setValue(1300);
        $product1->setDiscountedValue(0);

        $mockCrudService->expects($this->once())->method('getProductCrud')->will($this->returnValue($product1));

        $pms->setProductCrud($mockCrudService);
        $data = $pms->getProductDB(200);
        $this->assertEquals(200, $data->getId());
        $this->assertEquals('Joe Jegosul', $data->getName());
        $this->assertEquals(1300, $data->getValue());
        $this->assertEquals(0, $data->getDiscountedValue());
    }

    public function testGetAllProductsSorted()
    {
        $client = static::createClient();
        $client->request('GET', '/product/get/allproductssortedjson');
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertEquals(100, $data[0]['id']);
        $this->assertEquals(103, $data[1]['id']);
        $this->assertEquals(102, $data[2]['id']);
        $this->assertEquals(101, $data[3]['id']);
    }

    public function testUnitGetAllProductsSorted()
    {


        $pm = new PromotionManagerService(10);

        /**
         *  THE MOCKING:
         * Se creeaza un 'mock' pentru "ProductCrudService".
         * Metodele care se doreste a fi mock-uite sunt: "getAllProductsCrud"
         *
         * Se creeaza 4 obiecte care vor fi returnate de catre Mock
         * (in loc sa se conecteze la baza de date sa ia valorile, le trimite Mock-ul instant)
         *
         * "expects($this->once())" se asteapta ca functia sa se intample o singura data
         * "->method('getAllProductsCrud')" aici se specifica functia care urmeaza sa fie mockuita
         *
         * "->will" se refera la ce urmeaza sa faca
         *
         * "$this->returnValue($products)" va spune mockului sa returneze arrayul de produse la apelarea functiei respective
         */
        $mockCrudService = $this->getMockBuilder('AppBundle\ProductCrudService')
            ->disableOriginalConstructor()
            ->setMethods(array('getAllProductsCrud'))
            ->getMock();

        $product1 = new Product();
        $product1->setId(100);
        $product1->setValue(6300);

        $product2 = new Product();
        $product2->setId(101);
        $product2->setValue(73250);

        $product3 = new Product();
        $product3->setId(102);
        $product3->setValue(11235);

        $product4 = new Product();
        $product4->setId(103);
        $product4->setValue(7010);

        $products = array($product1, $product2, $product3, $product4);

        $mockCrudService->expects($this->once())->method('getAllProductsCrud')->will($this->returnValue($products));

        $pms = new ProductManagerService();
        $pms->setPromotionManager($pm);

        /**
         * sa se construiasca cu mock
         */
        $pms->setProductCrud($mockCrudService);

        $data = $pms->getAllProductsSorted();

        $this->assertEquals(100, $data[0]->getId());
        $this->assertEquals(103, $data[1]->getId());
        $this->assertEquals(102, $data[2]->getId());
        $this->assertEquals(101, $data[3]->getId());
    }

    /**
     * Teardown ( END )
     */
    public function tearDown()
    {
        $this->conn->exec('DROP TABLE IF EXISTS products');
        parent::tearDown();
    }
}