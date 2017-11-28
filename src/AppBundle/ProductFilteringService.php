<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 22/11/2017
 * Time: 12:35
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductFilterIntEvent;
use AppBundle\Entity\ProductFilterStringEvent;
use Monolog\Logger;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

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
     * @var TraceableEventDispatcher
     */
    protected $dispatcher;

    /**
     * @param TraceableEventDispatcher $dispatcher
     * @return TraceableEventDispatcher
     */
    public function setDispatcher(TraceableEventDispatcher $dispatcher)
    {
        return $this->dispatcher = $dispatcher;
    }

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

            return true;
        }
        $filterEvent = new ProductFilterIntEvent();
        $filterEvent->setProduct($product);
        $filterEvent->setFilterInt($this->comparingValue);
        $this->dispatcher->dispatch('checkSmallerThan', $filterEvent);

        return false;
    }

    /**
     * @var Product $product
     * @return bool
     */
    public function checkCharacterExistsInName(Product $product)
    {
        if (strpos($product->getName(), $this->letterToCheck) == true) {

            return true;
        }
        $filterEvent = new ProductFilterStringEvent();
        $filterEvent->setProduct($product);
        $filterEvent->setFilterString($this->letterToCheck);
        $this->dispatcher->dispatch('checkCharacterExistsInName', $filterEvent);

        return false;
    }

    /**
     * @var Product $product
     * @return bool
     */
    public function checkLengthOfName(Product $product)
    {
        if (strlen($product->getName()) > $this->numberOfLetters) {

            return true;
        }
        $filterEvent = new ProductFilterIntEvent();
        $filterEvent->setProduct($product);
        $filterEvent->setFilterInt($this->numberOfLetters);
        $this->dispatcher->dispatch('checkLenghtOfName', $filterEvent);

        return false;

    }
}