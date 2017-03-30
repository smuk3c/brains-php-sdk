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
           $is_bounce=NULL,
           $fb_ids = array(),
           $phone_numbers = array(),
           $puschrew_ids = array(),
           $subscriptions = array();


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
        "is_bounce",
        "fb_ids",
        "phone_numbers",
        "puschrew_ids",
        "subscriptions"
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

    public function getByEmail(){
        if($this->getVal("email")==NULL)
            throw new InvalidArgumentException('Email not valid...');
        //$app->get('/user/:appId/:key/:val(/:country)', 'Brains\\Controller\\User::fetch');
        return $this->execute('GET' , $this->appId."/email/".$this->email);
    }

    public function getByFbId($fb_id){
        //$app->get('/user/:appId/:key/:val(/:country)', 'Brains\\Controller\\User::fetch');
        return $this->execute('GET' , $this->appId."/fb_id/".$fb_id);
    }

    public function getByPhoneNumber($phone_number){
        //$app->get('/user/:appId/:key/:val(/:country)', 'Brains\\Controller\\User::fetch');
        return $this->execute('GET' , $this->appId."/phone/".$phone_number."/".$this->getCountryCode());
    }

    public function getByPushcrewId($push_id){
        //$app->get('/user/:appId/:key/:val(/:country)', 'Brains\\Controller\\User::fetch');
        return $this->execute('GET' , $this->appId."/pushcrew_id/".$push_id);
    }

    public function setVal($key, $val){
        if(property_exists($this, $key))
            $this->{$key} = $val;
        return $this;
    }

    public function setFbId($fb_id, $is_subscribed=true, $app_id=NULL){
        $fbIdArray = array(
            "fb_id" => $fb_id,
            "is_subscribed" => $is_subscribed
        );

        if($app_id)
            $fbIdArray["app_id"] = $app_id;

        $this->fb_ids[] = $fbIdArray;
    }

    public function setPuschrewId($puschrew_id, $is_subscribed=true, $app_id=NULL){
        $puschrewIdArray = array(
            "puschrew_id" => $puschrew_id,
            "is_subscribed" => $is_subscribed
        );

        if($app_id)
            $puschrewIdArray["app_id"] = $app_id;

        $this->puschrew_ids[] = $puschrewIdArray;
    }

    public function getCountryCode(){
        switch($this->country){
            case "HR":
                return 385;
                break;
            default:
                return 386;
                break;
        }
    }

    public function setPhoneNumber($phone_number, $is_subscribed=true, $country_code=NULL){
        $country_code = $country_code === NULL
            ? $this->getCountryCode()
            : $country_code;

        $phoneNumberArray = array(
            "phone_number" => $phone_number,
            "is_subscribed" => $is_subscribed,
            "country_code" => $country_code
        );

        $this->phone_numbers[] = $phoneNumberArray;
    }

    public function setSubscription($is_subscribed=true, $ip=NULL, $subscribe_timestamp=NULL, $unsubscribe_timestamp=NULL, $app_id=NULL){
        $subscriptionArray = array(
            "is_subscribed" => $is_subscribed
        );

        if($app_id)
            $subscriptionArray["app_id"] = $app_id;

        if($ip)
            $subscriptionArray["ip"] = $ip;

        if($subscribe_timestamp)
            $subscriptionArray["subscribe_timestamp"] = $subscribe_timestamp;

        if($unsubscribe_timestamp)
            $subscriptionArray["unsubscribe_timestamp"] = $unsubscribe_timestamp;

        $this->subscriptions[] = $subscriptionArray;
    }

    public function getVal($key){
        return property_exists($this, $key)
            ? $this->{$key}
            : NULL;
    }

    public function toArray(){
        $userArray = array();
        foreach ($this->keys AS $key){
            if($this->getVal($key) != NULL || (is_array($this->getVal($key)) && COUNT($this->getVal($key))>0))
                $userArray[$key] = $this->getVal($key);
        }
        return $userArray;
    }


}