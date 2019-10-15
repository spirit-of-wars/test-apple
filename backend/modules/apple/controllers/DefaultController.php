<?php

namespace backend\modules\apple\controllers;

use \backend\modules\apple\collections\Apple;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `Apple` module
 */
class DefaultController extends Controller
{

    const MAX_GENERATE_APPLES = 3;
    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {

        $appleCollection = new Apple();

        $stateMessages = [];
        $request = \Yii::$app->request;
        try {
            if($request->post('generator')) {
                $stateMessages[] = $this->generateApples($appleCollection);
            }

            if($request->post('fall') && $appleId = $request->post('appleID')) {
                $stateMessages[] = $this->appleFallToGround($appleCollection, $appleId);
            }

            if($request->post('eat') && $appleId = $request->post('appleID')) {
                $stateMessages[] = $this->appleEat($appleCollection, $appleId, 10);
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
        }

        return $this->render('apple', [
            'appleCollection' => $appleCollection,
            'errorMessage' => $errorMsg,
            'stateMessages' => $stateMessages
        ]);
    }

    /**
     * @param Apple $appleCollection
     * @return string
     */
    protected function generateApples(Apple $appleCollection)
    {
        $count = rand(1, self::MAX_GENERATE_APPLES);
        for($i = 0; $i < $count; $i++) {
            $appleCollection->create();
        }

        return "Яблоки успешно сгенерированы. Количество - {$count}";
    }

    /**
     * @param Apple $appleCollection
     * @param $appleId
     * @return string
     * @throws \yii\base\Exception
     */
    protected function appleFallToGround(Apple $appleCollection, $appleId)
    {
        $apple = $appleCollection->get($appleId);
        $apple->fallToGround();

        return "Яблоко с ID {$appleId} успешно упало на землю";
    }

    /**
     * @param Apple $appleCollection
     * @param $appleId
     * @param $percent
     * @return string
     * @throws Exception
     */
    protected function appleEat(Apple $appleCollection, $appleId, $percent)
    {
        $apple = $appleCollection->get($appleId);
        $apple->eat($percent);
        $message = "Яблоко с ID {$appleId} успешно откушено на {$percent}%. Осталось - {$apple->size_percent}%.";
        if($apple->size_percent === 0) {
            $appleCollection->remove($appleId);
            $message = "Яблоко с ID {$appleId} полностью съедено и удалено";
        }

        return $message;
    }
}
