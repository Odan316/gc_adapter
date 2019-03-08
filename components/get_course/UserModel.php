<?php

namespace app\components\get_course;


class UserModel implements \JsonSerializable
{
    public $email;
    public $phone;
    public $firstName;
    public $lastName;
    public $city;
    public $country;
    public $groups = [];
    public $additionalFields = null;

    public $refreshIfExist = 0;

    private $_data = [
        "user" => [],
        "system" => [
            "refresh_if_exists" => 0,
            "partner_email" => "",
            "multiple_offers" => 0,
            "return_payment_link" => 0,
        ],
        "session" => [
            "utm_source" => "",
            "utm_medium" => "",
            "utm_content" => "",
            "utm_campaign" => "",
            "utm_group" => "",
            "gcpc" => "",
            "gcao" => "",
            "referer" => ""
        ]
    ];

    /**
     * @param string $category
     * @param string $paramName
     * @param mixed $paramValue
     */
    public function setParam(string $category, string $paramName, $paramValue)
    {
        $this->_data[$category][$paramName] = $paramValue;
    }

    public function setAdditionalField(string $fieldName, string $fieldValue)
    {
        if(is_null($this->additionalFields)){
            $this->additionalFields = new \stdClass();

        }
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $data = $this->_data;

        if(!empty($this->email)){
            $data["user"]["email"] = $this->email;
        }
        if(!empty($this->phone)){
            $data["user"]["phone"] = $this->phone;
        }
        if(!empty($this->firstName)){
            $data["user"]["first_name"] = $this->firstName;
        }
        if(!empty($this->lastName)){
            $data["user"]["last_name"] = $this->lastName;
        }
        if(!empty($this->city)){
            $data["user"]["city"] = $this->city;
        }
        if(!empty($this->country)){
            $data["user"]["country"] = $this->country;
        }
        if(!empty($this->groups)){
            $data["user"]["group_name"] = $this->groups;
        }

        if(!empty($this->additionalFields)){
            $data["user"]["addfields"] = $this->additionalFields;
        }

        $data["system"]["refresh_if_exists"] = (int)$this->refreshIfExist;

        return $data;
    }
}