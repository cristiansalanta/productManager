<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 09/11/2017
 * Time: 10:31
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use JMS\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Null;

class ProductMongoCrudService implements ProductCrudInterface
{
    /**
     * @var Serializer
     */
    protected $serializer;

    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createProductCrud(Product $product)
    {
        $serializedProduct = $this->serializer->serialize($product, 'json');
        $arrayedProduct = json_decode($serializedProduct, true);
        $arrayedProduct['_id'] = $arrayedProduct['id'];
        unset($arrayedProduct['id']);

        $mongoConnection = new \MongoClient();
        $mongoConnection->selectCollection('products','product')->insert($arrayedProduct);
    }

    public function getProductCrud($productID)
    {
        $mongoConnection = new \MongoClient();
        $fetchedProduct = $mongoConnection->selectCollection('products', 'product')->findOne(array('_id' => (int)$productID));

        $Product = new Product();
        $Product->setId($fetchedProduct['_id']);
        $Product->setName($fetchedProduct['name']);
        $Product->setValue($fetchedProduct['value']);
        $Product->setDiscountedValue($fetchedProduct['discountedValue']);

        return $Product;
    }

    public function getAllProductsCrud()
    {
        $mongoConnection = new \MongoClient();
        $finishedProducts = array();
        $dbProducts = $mongoConnection->selectCollection('products', 'product')->find();

        foreach ($dbProducts as $dbProduct) {
            $Product = new Product();
            $Product->setId($dbProduct['_id']);
            $Product->setName($dbProduct['name']);
            $Product->setValue($dbProduct['value']);
            $Product->setDiscountedValue($dbProduct['discountedValue']);
            array_push($finishedProducts, $Product);
        }
        return $finishedProducts;
    }

    public function editProductCrud(Product $newProduct)
    {
        $mongoConnection = new \MongoClient();

        $serializedProduct = $this->serializer->serialize($newProduct, 'json');
        $arrayedNewProduct = json_decode($serializedProduct, true);

        $initialProduct = $this->getProductCrud($newProduct->getId());
        $serializedInitialProduct = $this->serializer->serialize($initialProduct, 'json');
        $arrayedInitialProduct = json_decode($serializedInitialProduct, true);

        foreach ($arrayedNewProduct as $key => $value) {
            if($value != NULL)
                $arrayedInitialProduct[$key] = $value;
        }

//      $updatedProduct = new Product();
//      $updatedProduct->set($arrayedInitialProduct);
//      $updatedProduct = json_decode(json_encode($arrayedInitialProduct), FALSE);
//
//        $mongoConnection->selectCollection('products','product')->update(
//                array('_id' => (int)$arrayedInitialProduct['id']),
//                array('$set' => array(
//                                        "name" =>$arrayedInitialProduct['name'],
//                                        "value" =>$arrayedInitialProduct['value'],
//                                        "discountedValue" =>$arrayedInitialProduct['discountedValue']
//                )));

            $arrayedInitialProduct['_id'] = $arrayedInitialProduct['id'];
            unset($arrayedInitialProduct['id']);

            $mongoConnection->selectCollection('products','product')->update(
                array('_id' => (int)$arrayedInitialProduct['_id']),
                array('$set' => $arrayedInitialProduct));
    }

    public function  deleteProductCrud(Product $Product)
    {
        $mongoConnection = new \MongoClient();
        $mongoConnection->selectCollection('products','product')->remove(
            array('_id' => (int)$Product->getId()));
    }
}