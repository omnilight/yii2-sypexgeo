<?php

namespace omnilight\sypexgeo;

use omnilight\sypexgeo\vendor\SxGeo;
use yii\base\Component;


/**
 * Class SypexGeo is the wrapper for the SxGeo class that provides ability to use it as
 * application component
 *
 * @property SxGeo $sxGeo Direct access to the SxGeo class
 */
class SypexGeo extends Component
{
    /**
     * @var SxGeo
     */
    protected $_sxGeo;
    /**
     * Path to to the database file for Sypex Geo
     * @var string
     */
    public $database;
    /**
     * Access mode to the Sypex database
     * @var int
     */
    public $accessMode = SxGeo::SXGEO_FILE;

    /**
     * @param string $ip
     * @return array|bool false if city is not detected
     */
    public function getCity($ip)
    {
        return $this->getSxGeo()->getCity($ip);
    }

    /**
     * @param $ip
     * @return array
     */
    public function getCountry($ip)
    {
        return $this->getSxGeo()->getCountry($ip);
    }

    /**
     * @param string $ip
     * @return integer
     */
    public function getCountryId($ip)
    {
        return $this->getSxGeo()->getCountryId($ip);
    }

    /**
     * @param string $ip
     * @return array
     */
    public function getCityFull($ip)
    {
        return $this->getSxGeo()->getCityFull($ip);
    }

    /**
     * @return SxGeo
     */
    public function getSxGeo()
    {
        if ($this->_sxGeo === null) {
            $this->_sxGeo = new SxGeo(\Yii::getAlias($this->database), $this->accessMode);
        }
        return $this->_sxGeo;
    }
} 