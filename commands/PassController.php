<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PassController extends Controller
{
    public $username = 'admin';
    public $password = 'adminPass';

    public function options($actionID)
    {
        $options = [
            'set' => ['password']
        ];

        return $options[$actionID];
    }

    /**
     * This command sets password to user
     *
     * @return int Exit code
     * @throws \yii\base\Exception
     */
    public function actionSet()
    {
        $user = User::findByUsername($this->username);

        if (!empty($user)) {
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);
        }

        echo "Password successfully set \n";

        return ExitCode::OK;
    }
}
