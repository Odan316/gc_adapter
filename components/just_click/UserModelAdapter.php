<?php
/**
 * Created by PhpStorm.
 * User: odan
 * Date: 09.03.19
 * Time: 11:29
 */

namespace app\components\just_click;

use app\components\get_course\UserModel;
use app\models\JcGroup;
use yii\helpers\VarDumper;

/**
 * Class UserModelAdapter
 * @package app\components\just_click
 *
 * Формат приъодящих данных
 * array (
 *      'name' => имя контакта
 *      'email' => мейл контакта
 *      'phone' => телефон контакта
 *      'city' => город контакта
 *      'id_group' => номер группы контактов
 *      'ip' => ip подписчика
 *      'status' => статус (2 - подписка, 1- активация подписки)
 *      'utm' => array (
 *          'medium' => утм-параметр канал
 *          'source' => утм-параметр источник
 *          'campaign' => утм-параметр кампания
 *          'content' => утм-параметр объявление
 *          'term' => утм-параметр ключ
 *      )
 * )
 */
class UserModelAdapter
{
    private $_data = [];

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * @param string $paramName
     * @param string $defaultValue
     *
     * @return mixed
     */
    private function getValue(string $paramName, string $defaultValue = '')
    {
        return isset($this->_data[$paramName]) ? $this->_data[$paramName] : $defaultValue;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getValue('email');
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->getValue('phone');
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->getValue('city', '');
    }
    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->getValue('id_group', '');
    }

    /**
     * @param UserModel $user
     * @return UserModel
     */
    public function unloadToModel(UserModel $user)
    {
        $user
            ->setEmail($this->getEmail())
            ->setFirstName($this->getName())
            ->setPhone($this->getPhone())
            ->setCity($this->getCity());

        $jcGroup = JcGroup::find()->andWhere(['jcId' => $this->getGroup()])->one();

        if(!empty($jcGroup)){
            foreach($jcGroup->gcGroups as $gcGroup){
                $user->setGroup($gcGroup->gcId);
            }
        }


        /*$user
            ->setGroup('шахматисты')
            ->setGroup('дилетанты')
            ->setOverwrite();*/

        return $user;
    }
}