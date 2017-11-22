<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 06/11/2017
 * Time: 13:00
 */

use AppBundle\StringProcessingService;

class StringProcessingServiceTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    /**
     * @var StringProcessingService
     */
    private $sps;

    public function setUp()
    {
        parent::setUp();

        $prefix_X = 404;
        $sufix_A = 1337;
        $this->sps = new StringProcessingService($prefix_X, $sufix_A);
    }

    /**
     * pentru fiecare test cate o functie
     */
    public function testFalseHasX()
    {
        /**
         *  FALSE contine 'x'
         */
        $testString = 'salam de victoria';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('salam de victoria', $resultedString);
    }

    public function testTrueHasX()
    {
        /**
         *  TRUE contine 'x'
         */
        $testString = 'salam de victoria x';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('404salam de victoria x', $resultedString);
    }
    public function testFalseHasAon5()
    {
        /**
         *  FALSE contine 'a' pe pozitia 5
         */
        $testString = 'salam de victoria';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('salam de victoria', $resultedString);
    }
    public function testTrueHasAon5()
    {
        /**
         *  TRUE contine 'a' pe pozitia 5
         */
        $testString = 'salaam de victoria';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('salaam de victoria1337', $resultedString);
    }
    public function testFalseHasLastCharb()
    {
        /**
         *  FALSE contine ultima liter 'b'
         */
        $testString = 'salam de victoria';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('salam de victoria', $resultedString);
    }
    public function testTrueHasLastCharb()
    {
        /**
         *  TRUE contine ultima litera 'b'
         */
        $testString = 'salam de victoriab';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('SALAM DE VICTORIAB', $resultedString);
    }

    public function testFalseHasLetterC3Times()
    {
        /**
         *  FALSE contine de exact 3 ori litera 'c'
         */
        $testString = 'salam de victoria c';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('salam de victoria c', $resultedString);
    }

    public function testTrueHasLetterC3Times()
    {
        /**
         *  TRUE contine de exact 3 ori litera 'c'
         */
        $testString = 'salam de victoria cc';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('calam de victoria cc', $resultedString);
    }
    public function testEverything()
    {
        /**
         *  Test cu toate elementele
         */
        $testString = 'fileala de mangleala x ccc';
        $resultedString = $this->sps->processString($testString);
        $this->assertEquals('404cileala de mangleala x ccc1337', $resultedString);
    }
}
