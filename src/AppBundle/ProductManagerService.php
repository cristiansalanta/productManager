<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 27/10/2017
 * Time: 14:59
 */

namespace AppBundle;

use AppBundle\Entity\Product;
use AppBundle\Entity\FilteredProducts;
use AppBundle\Entity\CountedFilteredProducts;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

class ProductManagerService
{
    /**
     * @var PromotionManagerService
     */
    protected $promotionManager;

    /**
     * @var  ProductCrudService
     */
    protected $productCrud;

    /**
     * @var  ProductMongoCrudService
     */
    protected $productMongoCrud;

    /**
     * @var ProductFilteringService
     */
    protected $productFiltering;

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
     * @param ProductCrudService $productCrud
     * @return ProductCrudService
     */
    public function setProductCrud(ProductCrudService $productCrud)
    {
        return $this->productCrud = $productCrud;
    }

    /**
     * @param ProductMongoCrudService $productMongoCrud
     * @return ProductMongoCrudService
     */
    public function setProductMongoCrud(ProductMongoCrudService $productMongoCrud)
    {
        return $this->productMongoCrud = $productMongoCrud;
    }

    /**
     * @param $promotionManager
     */
    public function setPromotionManager($promotionManager)
    {
        $this->promotionManager = $promotionManager;
    }

    /**
     * @param $productFiltering
     */
    public function setProductFiltering($productFiltering)
    {
        $this->productFiltering = $productFiltering;
    }

    // Inside this service, through ProductCrudService we use the "getProductCrud" function
    // this is done by using the enabled variable declared above "productCrud"
    // The function below returns one object from the database, identified by the ID

    /**
     * @return Product
     */
    public function getProductDB($productID)
    {
        return $this->productMongoCrud->getProductCrud($productID);
    }

    /**
     * @return array
     */
    public function getAllProductsDB()
    {
        return $this->productMongoCrud->getAllProductsCrud();
    }

    /**
     * @param Product $product
     */
    public function createProductDB(Product $product)
    {
        $this->productMongoCrud->createProductCrud($product);
    }

    /**
     * @param Product $updatedProduct
     */
    public function editProductDB(Product $updatedProduct)
    {
        $this->productMongoCrud->editProductCrud($updatedProduct);
    }

    /**
     * @param Product $product
     */
    public function deleteProductDB(Product $product)
    {
        $this->productMongoCrud->deleteProductCrud($product);
    }

    /**
     * @param Product $entity
     */
    public function applyPromotion(Product $entity)
    {
        $entity->setValue($this->promotionManager->applyPromotion($entity->getValue()));
    }

    /**
     * @param Product $a
     * @param Product $b
     * @return int
     */
    public function cmp(Product $a, Product $b)
    {
        if (floatval($a->getValue()) < floatval($b->getValue())) {
            return -1;
        } elseif (floatval($a->getValue()) > floatval($b->getValue())) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @return Product[]
     */
    public function getAllProductsSorted()
    {
        $products = $this->productCrud->getAllProductsCrud();
        usort($products, array($this, "cmp"));

        return $products;
    }

    /**
     * @return FilteredProducts
     */
    public function getAllProductsFiltered()
    {
        $allProducts = $this->getAllProductsDB();
        $allProductsAllFilters = array();
        $allProductsFilter1 = array();
        $allProductsFilter2 = array();
        $allProductsFilter3 = array();

        /**
         * @var Product $product
         */
        foreach ($allProducts as $key => $product) {
            $statementSuccess = 1;

            //  Filtru 1: Obiectele care NU au valoarea mai MARE decat "comparingValue" TODO fix all other comments
            if ($this->productFiltering->checkSmallerThanComparingValue($product)) {
                array_push($allProductsFilter1, $product);
            } else {
                $statementSuccess = 0;
            }

            // Filtru 2: Obiectele care NU contin literele "A" sau "a"
            if ($this->productFiltering->checkCharacterExistsInName($product)) {
                array_push($allProductsFilter2, $product);
            } else {
                $statementSuccess = 0;
            }

            // Filtru 3: Numele produsului trebuie sa aiba un numar mai mare de litere
            if ($this->productFiltering->checkLengthOfName($product)) {
                array_push($allProductsFilter3, $product);
            } else {
                $statementSuccess = 0;
            }

            // Sa treaca de toate filtrele:
            if ($statementSuccess == 1) {
                array_push($allProductsAllFilters, $product);
            }
        }

        // Obiectele care NU o trecut de filtrele respective
        $allProductsFilter1 = array_values($allProductsFilter1);
        $allProductsFilter2 = array_values($allProductsFilter2);
        $allProductsFilter3 = array_values($allProductsFilter3);

        // Obiectele ramase dupa ce au trecut prin toate filtrele
        $allProductsAllFilters = array_values($allProductsAllFilters);

        $cfpAllProductsFilter1 = new CountedFilteredProducts();
        $cfpAllProductsFilter1->setFilteredProducts($allProductsFilter1);
        $cfpAllProductsFilter1->setCount(count($allProductsFilter1));

        $cfpAllProductsFilter2 = new CountedFilteredProducts();
        $cfpAllProductsFilter2->setFilteredProducts($allProductsFilter2);
        $cfpAllProductsFilter2->setCount(count($allProductsFilter2));

        $cfpAllProductsFilter3 = new CountedFilteredProducts();
        $cfpAllProductsFilter3->setFilteredProducts($allProductsFilter3);
        $cfpAllProductsFilter3->setCount(count($allProductsFilter3));

        $cfpAllProductsAllFilters = new CountedFilteredProducts();
        $cfpAllProductsAllFilters->setFilteredProducts($allProductsAllFilters);
        $cfpAllProductsAllFilters->setCount(count($allProductsAllFilters));

        $allFilteredProductsArrays = new FilteredProducts();
        $allFilteredProductsArrays->setProductsFailFilter1($cfpAllProductsFilter1);
        $allFilteredProductsArrays->setProductsFailFilter2($cfpAllProductsFilter2);
        $allFilteredProductsArrays->setProductsFailFilter3($cfpAllProductsFilter3);
        $allFilteredProductsArrays->setProductsSuccessAllFilters($cfpAllProductsAllFilters);

        return $allFilteredProductsArrays;
    }
}
