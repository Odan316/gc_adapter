<?php

namespace app\controllers;

use app\components\get_course\GetCourseSender;
use app\components\get_course\UserModel;
use app\components\just_click\UserModelAdapter;
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
     * @throws \Exception
     */
    public function actionPutUser()
    {
        if (Yii::$app->request->get('token') !== Yii::$app->params['timeWebToken']) {
            throw new ForbiddenHttpException('Your token is absent or invalid');
        }

        $data = Yii::$app->request->post();
        Yii::info("Incoming data:\r\n".VarDumper::dumpAsString($data), 'get-course');
        //VarDumper::dump($data);

        $jcUser = new UserModelAdapter($data);
        $user = new UserModel();
        $sender = new GetCourseSender();
        $sender->accessToken = Yii::$app->params['GC-Token'];
        $sender->accountUrl = Yii::$app->params['GC-AccountUrl'];

        $user = $jcUser->unloadToModel($user);
        $user->setRefresh();

        //$result = $user->jsonSerialize();
        $result = $sender->send('add', $user->jsonSerialize());

        return $result;
    }
}