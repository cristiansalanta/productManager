<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 21/11/2017
 * Time: 16:30
 */

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class FilteredProducts
{
    /**
     * @var array
     * @SerializedName("products_that_did_not_pass_filter1")
     * @Type("AppBundle\Entity\CountedFilteredProducts")
     */
    protected $productsFailFilter1;

    /**
     * @var array
     * @SerializedName("products_that_did_not_pass_filter2")
     * @Type("AppBundle\Entity\CountedFilteredProducts")
     */
    protected $productsFailFilter2;

    /**
     * @var array
     * @SerializedName("products_that_did_not_pass_filter3")
     * @Type("AppBundle\Entity\CountedFilteredProducts")
     */
    protected $productsFailFilter3;

    /**
     * @var array
     * @SerializedName("products_that_passed_all_filters")
     * @Type("AppBundle\Entity\CountedFilteredProducts")
     */
    protected $productsSuccessAllFilters;


    /**
     * Set $productsFailFilter1
     * @param CountedFilteredProducts $productsFailFilter1
     * @return FilteredProducts
     */
    public function setProductsFailFilter1($productsFailFilter1)
    {
        $this->productsFailFilter1 = $productsFailFilter1;

        return $this;
    }

    /**
     * Get $productsFailFilter1
     * @return array<AppBundle\Entity\CountedFilteredProducts>
     */
    public function getProductsFailFilter1()
    {
        return $this->productsFailFilter1;
    }

    /**
     * Set $productsFailFilter2
     * @param CountedFilteredProducts $productsFailFilter2
     * @return FilteredProducts
     */
    public function setProductsFailFilter2($productsFailFilter2)
    {
        $this->productsFailFilter2 = $productsFailFilter2;

        return $this;
    }

    /**
     * Get $productsFailFilter2
     * @return array<AppBundle\Entity\CountedFilteredProducts>
     */
    public function getProductsFailFilter2()
    {
        return $this->productsFailFilter2;
    }

    /**
     * Set $productsFailFilter3
     * @param CountedFilteredProducts $productsFailFilter3
     * @return FilteredProducts
     */
    public function setProductsFailFilter3($productsFailFilter3)
    {
        $this->productsFailFilter3 = $productsFailFilter3;

        return $this;
    }

    /**
     * Get $productsFailFilter3
     * @return array<AppBundle\Entity\CountedFilteredProducts>
     */
    public function getProductsFailFilter3()
    {
        return $this->productsFailFilter3;
    }

    /**
     * Set $productsSuccessAllFilters
     * @param CountedFilteredProducts $productsSuccessAllFilters
     * @return FilteredProducts
     */
    public function setProductsSuccessAllFilters($productsSuccessAllFilters)
    {
        $this->productsSuccessAllFilters = $productsSuccessAllFilters;

        return $this;
    }

    /**
     * Get $productsSuccessAllFilters
     * @return array<AppBundle\Entity\CountedFilteredProducts>
     */
    public function getProductsSuccessAllFilters()
    {
        return $this->productsSuccessAllFilters;
    }
}