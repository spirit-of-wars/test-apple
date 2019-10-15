<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 5:53
 */

namespace backend\modules\apple\models;

use \backend\modules\apple\models\db\Apple as DbAppleModel;
use backend\modules\apple\models\states\apple\StateSwitcher;

/**
 *
 * @property integer $id
 * @property string $color
 * @property integer $size_percent
 * @property integer $status
 * @property integer $fall_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class Apple
{

    /**
     * @var DbAppleModel
     */
    protected $dbModel;

    /**
     * @var StateSwitcher
     */
    protected $stateSwitcher;

    public function __construct(DbAppleModel $dbModel = null, $color = '')
    {

        $this->initDbModel($dbModel, $color);
        $this->stateSwitcher = new StateSwitcher($this);
    }

    protected function initDbModel(DbAppleModel $dbModel = null, $color = '')
    {
        if($dbModel) {
            $this->dbModel = $dbModel;
        } else {
            $this->dbModel = new DbAppleModel();
            $this->dbModel->color = $color ?: $this->dbModel->getRandColor();
            $this->dbModel->save();
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->dbModel->$name;
    }

    /**
     * @return DbAppleModel
     */
    public function getDbModel()
    {
        return $this->dbModel;
    }


    public function fallToGround()
    {
        $this->stateSwitcher->getState()->fallToGround();
    }

    /**
     * @param $percent
     * @throws \yii\base\Exception
     */
    public function eat($percent)
    {
        $this->stateSwitcher->getState()->eat($percent);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function remove()
    {
        $this->stateSwitcher->getState()->remove();
    }
}