<?php

namespace backend\modules\apple\controllers;

use backend\modules\apple\models\Apple;
use yii\web\Controller;

/**
 * Default controller for the `Apple` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        new Apple(null, 'brown');
        return $this->render('index');
    }
}
