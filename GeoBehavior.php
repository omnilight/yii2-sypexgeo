<?php

namespace omnilight\sypexgeo;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\web\Request;


/**
 * Class GeoBehavior is the behavior for {@see yii\web\Request} class that provides functions of detecting
 * request geo information based on it's IP address
 */
class GeoBehavior extends Behavior
{
    /**
     * @var string|array|SypexGeo If string, than the name of the application component,
     * if array - configuration for SypexGeo class
     */
    public $sypexGeo = 'sypexGeo';

    public function init()
    {
        parent::init();

        if (is_string($this->sypexGeo)) {
            $this->sypexGeo = \Yii::$app->get($this->sypexGeo);
        } elseif (is_array($this->sypexGeo)) {
            $this->sypexGeo = \Yii::createObject(array_merge([
                'class' => SypexGeo::className(),
            ], $this->sypexGeo));
        }
    }

    public function attach($owner)
    {
        if (!($owner instanceof Request))
            throw new InvalidConfigException('GeoBehavior can be only attached to the yii\web\Request and it\'s children');

        parent::attach($owner);
    }


    /**
     * @return array|bool false if city is not detected
     */
    public function getCity()
    {
        return $this->sypexGeo->getCity($this->getIP());
    }

    /**
     * @return array
     */
    public function getCountry()
    {
        return $this->sypexGeo->getCountry($this->getIP());
    }

    /**
     * @return integer
     */
    public function getCountryId()
    {
        return $this->sypexGeo->getCountryId($this->getIP());
    }

    /**
     * @return array
     */
    public function getCityFull()
    {
        return $this->sypexGeo->getCityFull($this->getIP());
    }

    /**
     * @return string
     */
    protected function getIP()
    {
        /** @var Request $owner */
        $owner = $this->owner;
        return $owner->getUserIP();
    }
} 