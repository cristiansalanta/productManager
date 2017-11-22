<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 15/11/2017
 * Time: 16:47
 */

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Location
{
    /**
     * @var string
     * @SerializedName("country")
     * @Type("string")
     */
    private $country;

    /**
     * @var double
     * @Type("double")
     * @SerializedName("lat")
     */
    private $lat;

    /**
     * @var double
     * @Type("double")
     * @SerializedName("location_id")
     */
    private $location_id;

    /**
     * @var string
     * @SerializedName("display_name")
     * @Type("string")
     */
    private $display_name;

    /**
     * @var string
     * @SerializedName("state")
     * @Type("string")
     */
    private $state;

    /**
     * @var string
     * @SerializedName("city")
     * @Type("string")
     */
    private $city;

    /**
     * @var string
     * @SerializedName("airport_code")
     * @Type("string")
     */
    private $airport_code;

    /**
     * @var double
     * @SerializedName("long")
     * @Type("double")
     */
    private $long;

    /**
     * @var string
     * @SerializedName("time_zone")
     * @Type("string")
     */
    private $time_zone;

    /**
     * @var string
     * @SerializedName("title")
     * @Type("string")
     */
    private $title;

    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */
    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */
    /** ~~~~~~~~~~~~~~~~~~~~~~FUNCTIONS~~~~~~~~~~~~~~~~~~~~~ */

    /**
     * Set country
     * @param string $country
     * @return Location
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set lat
     * @param double $lat
     * @return Location
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * Get lat
     * @return double
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set location_id
     * @param double $location_id
     * @return Location
     */
    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
        return $this;
    }

    /**
     * Get location_id
     * @return double
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Set display_name
     * @param string $display_name
     * @return Location
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;

        return $this;
    }

    /**
     * Get display_name
     * @return string
     */
    public function getDisplayName()
    {
        return $this->country;
    }

    /**
     * Set state
     * @param string $state
     * @return Location
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     * @param string $city
     * @return Location
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set airport_code
     * @param string $airport_code
     * @return Location
     */
    public function setAirportCode($airport_code)
    {
        $this->airport_code = $airport_code;

        return $this;
    }

    /**
     * Get airport_code
     * @return string
     */
    public function getAirportCode()
    {
        return $this->airport_code;
    }

    /**
     * Set long
     * @param double $long
     * @return Location
     */
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long
     * @return double
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set time_zone
     * @param string $time_zone
     * @return Location
     */
    public function setTimeZone($time_zone)
    {
        $this->time_zone = $time_zone;

        return $this;
    }

    /**
     * Get time_zone
     * @return string
     */
    public function getTimeZone()
    {
        return $this->time_zone;
    }

    /**
     * Set title
     * @param string $title
     * @return Location
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}