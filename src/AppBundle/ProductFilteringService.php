<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 22/11/2017
 * Time: 12:35
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use Monolog\Logger;

class ProductFilteringService
{
    /**
     * @var int
     */
    protected $comparingValue;

    /**
     * @var int
     */
    protected $numberOfLetters;

    /**
     * @var string
     */
    protected $letterToCheck;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * ProductFilteringService constructor.
     * @param int $comparingValue
     * @param int $numberOfLetters
     * @param string $letterToCheck
     * @param Logger $logger
     */
    public function __construct($comparingValue, $numberOfLetters, $letterToCheck, $logger)
    {
        $this->comparingValue = $comparingValue;
        $this->letterToCheck = $letterToCheck;
        $this->numberOfLetters = $numberOfLetters;
        $this->logger = $logger;
    }

    /**
     * @var Product $product
     * @return bool
     */
    public function checkSmallerThanComparingValue(Product $product)
    {
        if ($product->getValue() > $this->comparingValue) {
            $this->logger->info(
                sprintf(
                    'The product with the ID(%u) has its value(%f) lower than what was asked: %f',
                    $product->getId(),
                    $product->getValue(),
                    $this->comparingValue
                )
            );

            return true;
        }

        return false;
    }

    /**
     * @var Product $product
     * @return bool
     */
    public function checkCharacterExistsInName(Product $product)
    {
        if (strpos($product->getName(), $this->letterToCheck) == true) {
            $this->logger->info(
                sprintf(
                    'The product with the ID(%u) has in its name(\'%s\') the letter(s): \'%s\'',
                    $product->getId(),
                    $product->getName(),
                    $this->letterToCheck
                )
            );

            return true;
        }

        return false;
    }

    /**
     * @var Product $product
     * @return bool
     */
    public function checkLengthOfName(Product $product)
    {
        if (strlen($product->getName()) > $this->numberOfLetters) {
            $this->logger->info(
                sprintf(
                    'The product with the ID(%u) has in its name(\'%s\') more than: %u letters',
                    $product->getId(),
                    $product->getName(),
                    $this->numberOfLetters
                )
            );

            return true;
        }

        return false;
    }
}