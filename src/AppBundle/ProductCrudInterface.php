<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 03/11/2017
 * Time: 13:32
 */

namespace AppBundle;
use AppBundle\Entity\Product;

interface ProductCrudInterface
{
    public function getProductCrud($productID);

    public function getAllProductsCrud();

    public function editProductCrud(Product $updatedProduct);

    public function deleteProductCrud(Product $updatedProduct);

    public function createProductCrud(Product $product);

}