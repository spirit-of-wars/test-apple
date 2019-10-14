<?php

namespace backend\modules\apple\controllers;

use \backend\modules\apple\collections\Apple;
use yii\web\Controller;

/**
 * Default controller for the `Apple` module
 */
class DefaultController extends Controller
{
    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $appleCollection = new Apple();
//        $appleCollection->create('brown');
//        $apple = $appleCollection->get(5);
//        $apple->eat(99);
        return $this->render('index');
    }
}
