<?php

namespace app\controllers;

use Exception;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Class JustClickController
 * @package controllers
 */
class JustClickController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'put-user' => ['post'],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    /**
     * @throws ForbiddenHttpException
     *
     * Формат приъодящих данных
     * array (
     * 'name' => имя контакта
     * 'email' => мейл контакта
     * 'phone' => телефон контакта
     * 'city' => город контакта
     * 'id_group' => номер группы контактов
     * 'ip' => ip подписчика
     * 'status' => статус (2 - подписка, 1- активация подписки)
     * 'utm' => array (
     * 'medium' => утм-параметр канал
     * 'source' => утм-параметр источник
     * 'campaign' => утм-параметр кампания
     * 'content' => утм-параметр объявление
     * 'term' => утм-параметр ключ
     * )
     * )
     */
    public function actionPutUser()
    {
        if (Yii::$app->request->get('token') !== Yii::$app->params['timeWebToken']) {
            throw new ForbiddenHttpException('Your token is absent or invalid');
        }

        //VarDumper::dump(Yii::$app->request->post());


        $data = Yii::$app->request->post();

        VarDumper::dump($data);
        $user = new \GetCourse\User();

        //$user::setAccountName('account_name');

        //try {
            if (!empty($data['email'])) {
                $user->setEmail($data['email']);
            }
            if (!empty($data['name'])) {
                $user->setFirstName($data['name']);
            }
            if (!empty($data['phone'])) {
                $user->setPhone($data['phone']);
            }
            if (!empty($data['city'])) {
                $user->setCity($data['city']);
            }

            /*$user
                ->setGroup('шахматисты')
                ->setGroup('дилетанты')
                ->setOverwrite();*/

            $result = $user->toArray();

            VarDumper::dump($result);
            //->apiCall($action = 'add');
        /*} catch (Exception $e) {
            echo $e->getMessage();
        }*/
    }
}