<?php

namespace app\controllers;

use app\models\forms\JcGroupsForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class JcSettingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $formModel = new JcGroupsForm();
        if($formModel->load(Yii::$app->request->post())){
            $formModel->save();
        }

        return $this->render('index', ['formModel' => $formModel]);
    }
}