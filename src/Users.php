<?php
namespace Brains;

use InvalidArgumentException;

class Users extends Base\Rest {

    public $email=NULL,
           $first_name=NULL,
           $last_name=NULL,
           $birthday=NULL,
           $gender=NULL,
           $first_address=NULL,
           $second_address=NULL,
           $zip_code=NULL,
           $city=NULL,
           $province=NULL,
           $country=NULL,
           $zodiac_sign=NULL,
           $is_bounce=NULL;

    protected $keys = array(
        "email",
        "first_name",
        "last_name",
        "birthday",
        "gender",
        "first_address",
        "second_address",
        "zip_code",
        "city",
        "provience",
        "country",
        "zodiac_sign",
        "is_bounce"
    );

    public function __construct($apiKey, $appId){
        $this->name = 'user';
        parent::__construct($apiKey,$appId);
    }

    public function add($data=null){
        if($this->getVal("email")==NULL)
            throw new InvalidArgumentException('Email not valid...');

        return $this->execute('POST', $this->toArray());
    }

    public function setVal($key, $val){
        if(property_exists($this, $key))
            $this->{$key} = $val;
        return $this;
    }

    public function getVal($key){
        return property_exists($this, $key)
            ? $this->{$key}
            : NULL;
    }

    public function toArray(){
        $userArray = array();
        foreach ($this->keys AS $key){
            if($this->getVal($key) != NULL)
                $userArray[$key] = $this->getVal($key);
        }
        return $userArray;
    }


}