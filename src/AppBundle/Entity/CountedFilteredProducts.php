<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 21/11/2017
 * Time: 18:15
 */

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class CountedFilteredProducts
{
    /**
     * @var array
     * @SerializedName("product_array_after_filters")
     * @Type("array<AppBundle\Entity\Product>")
     */
    protected $filteredProducts;

    /**
     * @var integer
     * @SerializedName("count_of_products")
     * @Type("integer")
     */
    protected $count;

    /**
     * Set $filteredProducts
     * @param Product[] $filteredProducts
     * @return CountedFilteredProducts
     */
    public function setFilteredProducts($filteredProducts)
    {
        $this->filteredProducts = $filteredProducts;
        return $this;
    }

    /**
     * Get $filteredProducts
     * @return Product[]
     */
    public function getFilteredProducts()
    {
        return $this->filteredProducts;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return CountedFilteredProducts
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }




}