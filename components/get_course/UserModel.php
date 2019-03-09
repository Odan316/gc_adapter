<?php

namespace app\components\get_course;


class UserModel implements \JsonSerializable
{
    private $_data = [
        'user' => [],
        'system' => [
            'refresh_if_exists' => 0,
            'partner_email' => '',
            'multiple_offers' => 0,
            'return_payment_link' => 0,
        ],
        'session' => [
            'utm_source' => '',
            'utm_medium' => '',
            'utm_content' => '',
            'utm_campaign' => '',
            'utm_group' => '',
            'gcpc' => '',
            'gcao' => '',
            'referer' => ''
        ]
    ];


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

        return $data;
    }

    /**
     * @param string $category
     * @param string $paramName
     * @param mixed $paramValue
     *
     * @return UserModel
     */
    public function setParam(string $category, string $paramName, $paramValue)
    {
        $this->_data[$category][$paramName] = $paramValue;

        return $this;
    }

    /**
     * @param string $category
     * @param string $paramName
     * @param $paramValue
     *
     * @return UserModel
     */
    private function setNonEmptyParam(string $category, string $paramName, $paramValue)
    {
        if(!empty($paramValue)){
            return $this->setParam($category, $paramName, $paramValue);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param string $fieldValue
     *
     * @return UserModel
     */
    public function setAdditionalField(string $fieldName, string $fieldValue)
    {
        // TODO: Realize
        return $this;
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setEmail(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'email', $value);
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setFirstName(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'first_name', $value);
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setLastName(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'last_name', $value);
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setPhone(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'phone', $value);
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setCity(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'city', $value);
    }

    /**
     * @param string $value
     *
     * @return UserModel
     */
    public function setCountry(string $value = '')
    {
        return $this->setNonEmptyParam('user', 'country', $value);
    }

    /**
     * @param int $value
     * @return UserModel
     */
    public function setRefresh(int $value = 1)
    {
        return $this->setParam('system', 'refresh_if_exists', (int) $value);
    }
}