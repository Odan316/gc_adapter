<?php

namespace app\controllers;

use app\components\get_course\UserModel;
use app\components\just_click\UserModelAdapter;
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
     */
    public function actionPutUser()
    {
        if (Yii::$app->request->get('token') !== Yii::$app->params['timeWebToken']) {
            throw new ForbiddenHttpException('Your token is absent or invalid');
        }

        try {
            $data = Yii::$app->request->post();
            //VarDumper::dump($data);

            $jcUser = new UserModelAdapter($data);
            $user = new UserModel();

            $user = $jcUser->unloadToModel($user);
            $user->setRefresh();

            $result = $user->jsonSerialize();

            //->apiCall($action = 'add');

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}