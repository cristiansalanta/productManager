<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 16/11/2017
 * Time: 09:22
 */

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Market
{
    /**
     * @var string
     * @SerializedName("valid_to")
     * @Type("string")
     */
    private $valid_to;

    /**
     * @var array
     * @SerializedName("flight_days")
     * @Type("array")
     */
    private $flight_days;

    /**
     * @var string
     * @SerializedName("valid_from")
     * @Type("string")
     */
    private $valid_from;

    /**
     * @var string
     * @SerializedName("name")
     * @Type("string")
     */
    private $name;

    /**
     * @var string
     * @SerializedName("description")
     * @Type("string")
     */
    private $description;

    /**
     * @var string
     * @SerializedName("uri")
     * @Type("string")
     */
    private $uri;

    /**
     * @var Location
     * @SerializedName("to")
     * @Type("AppBundle\Entity\Location")
     */
    private $to;

    /**
     * @var Location
     * @SerializedName("from")
     * @Type("AppBundle\Entity\Location")
     */
    private $from;

    /**
     * @var string
     * @SerializedName("type")
     * @Type("string")
     */
    private $type;

    /**
     * @var integer
     * @SerializedName("id")
     * @Type("integer")
     */
    private $id;

    /**
     * @var integer
     * @SerializedName("redwebid")
     * @Type("integer")
     */
    private $reswebid;


    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */
    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */
    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */

    /**
     * Set valid_to
     * @param string $valid_to
     * @return Market
     */
    public function setValidTo($valid_to)
    {
        $this->valid_to = $valid_to;
        return $this;
    }

    /**
     * Get valid_to
     * @return string
     */
    public function getValidTo()
    {
        return $this->valid_to;
    }

    /**
     * Set flight_days
     * @param array $flight_days
     * @return Market
     */
    public function setFlightDays($flight_days)
    {
        $this->flight_days= $flight_days;
        return $this;
    }

    /**
     * Get flight_days
     * @return array
     */
    public function getFlightDays()
    {
        return $this->flight_days;
    }

    /**
     * Set valid_from
     * @param string $valid_from
     * @return Market
     */
    public function setValidFrom($valid_from)
    {
        $this->valid_from = $valid_from;
        return $this;
    }

    /**
     * Get valid_from
     * @return string
     */
    public function getValidFrom()
    {
        return $this->valid_from;
    }

    /**
     * Set name
     * @param string $name
     * @return Market
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
     * Set description
     * @param string $description
     * @return Market
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set uri
     * @param string $uri
     * @return Market
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set type
     * @param string $type
     * @return Market
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set id
     * @param integer $id
     * @return Market
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reswebid
     * @param integer $id
     * @return Market
     */
    public function setReswebid($reswebid)
    {
        $this->reswebid = $reswebid;

        return $this;
    }

    /**
     * Get reswebid
     * @return integer
     */
    public function getReswebid()
    {
        return $this->reswebid;
    }

    /**
     * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ TO and FROM ~~~~~~~~~
     */

    /**
     * Set "to"
     * @param Location $to
     * @return Market
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Get to
     * @return Location
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set Location
     * @param Location $from
     * @return Market
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     * @return Location
     */
    public function getFrom()
    {
        return $this->from;
    }

//    public function __set($name, $value)
//    {
//        $this->guta= $value;
//        echo "Hello " . $name . " = " . $value;
//    }
//
//    public function __get($name)
//    {
//        echo "Hello " . $name ;
//    }

}