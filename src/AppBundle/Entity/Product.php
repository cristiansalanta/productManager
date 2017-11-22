<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Product
 */
class Product
{
    /**
     * @var int
     * @Serializer\Type("double")
     * @Serializer\SerializedName("id")
     */
    private $id;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("value")
     */
    private $value;

    /**
     * @var float
     * @Serializer\Type("float")
     * @Serializer\SerializedName("discountedValue")
     */
    private $discountedValue;

    /**
     * Set id
     * @param integer $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     * @return double
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     * @param float $value
     * @return Product
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set discountedValue
     * @param float $discountedValue
     * @return Product
     */
    public function setDiscountedValue($discountedValue)
    {
        $this->discountedValue = $discountedValue;

        return $this;
    }

    /**
     * Get discountedValue
     * @return float
     */
    public function getDiscountedValue()
    {
        return $this->discountedValue;
    }

}
