<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 06/11/2017
 * Time: 09:34
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use Doctrine\DBAL\Connection;

class ProductCrudService implements ProductCrudInterface
{
    /**
     * @var  Connection
     */
    protected $dbConnection;

    public function setDbConnection($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getProductCrud($productID)
    {
        $dbProduct = $this->dbConnection->fetchAssoc(sprintf('SELECT * FROM products WHERE id=%u',$productID));
        $Product = new Product();
        $Product->setId($dbProduct['id']);
        $Product->setName($dbProduct['name']);
        $Product->setValue($dbProduct['value']);
        $Product->setDiscountedValue($dbProduct['discountedValue']);

        return $Product;
    }

    public function getAllProductsCrud()
    {
        $dbProducts = $this->dbConnection->fetchAll('SELECT * FROM products');
        $finishedProducts = array();

        foreach ($dbProducts as $dbProduct) {
            $Product = new Product();
            $Product->setId($dbProduct['id']);
            $Product->setName($dbProduct['name']);
            $Product->setValue($dbProduct['value']);
            $Product->setDiscountedValue($dbProduct['discountedValue']);
            array_push($finishedProducts, $Product);
        }
        return $finishedProducts;
    }

    public function createProductCrud(Product $product)
    {
        $this->dbConnection->exec(
            sprintf(
                'INSERT INTO products (id,name,value,discountedValue) 
                        VALUES(%u , \'%s\' , %f , %f)', $product->getId(),$product->getName(),$product->getValue(),$product->getDiscountedValue()
            )
        );
    }

    public function editProductCrud(Product $updatedProduct)
    {
        $this->dbConnection->exec(
            sprintf(
                'UPDATE products 
                        SET name=\'%s\', value=%f, discountedValue=%f 
                        WHERE id=%u',$updatedProduct->getName(),$updatedProduct->getValue(),$updatedProduct->getDiscountedValue(),$updatedProduct->getId()
            )
        );
    }

    public function deleteProductCrud(Product $product)
    {
        $this->dbConnection->exec(
            sprintf(
                'DELETE FROM products 
                        WHERE id=%u',$product->getId()
            )
        );
    }
}