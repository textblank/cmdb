<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

/**
 * 登录和退出
 */
class LoginController extends Controller
{
    public function actions(){
        /*return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'foreColor' => 0xa94442,
                'transparent' => true,
            ]
        ];*/
    }

    //public $layout = false;

    public function actionIndex()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('/login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
