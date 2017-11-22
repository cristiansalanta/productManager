<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 31/10/2017
 * Time: 09:30
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Registry;

class PromotionManagerService
{
    private $promotionAmmount;

    public function __construct($promotionAmmount)
    {
        $this->promotionAmmount = $promotionAmmount;
    }

    public function applyPromotion($productValue)
    {
        return $productValue - $productValue*$this->promotionAmmount/100;
    }
}