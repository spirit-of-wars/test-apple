<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 5:53
 */

namespace backend\modules\apple\models;

use \backend\modules\apple\models\db\Apple as DbAppleModel;
use backend\modules\apple\models\states\apple\AbstractState;
use backend\modules\apple\models\states\apple\OnTree;
use backend\modules\apple\models\states\apple\UnderTree;

class Apple
{

    /**
     * @var DbAppleModel
     */
    protected $dbModel;

    /**
     * @var AbstractState
     */
    protected $state;

    public function __construct()
    {
        $this->dbModel = new DbAppleModel();
        $this->state = new OnTree($this);
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

    public function changeState($state)
    {
        $this->state = $state;
    }

    public function fallToGround()
    {
        $this->state->fallToGround();
    }

    public function eat($percent)
    {
        $this->state->eat($percent);
    }

    public function remove()
    {
        $this->state->remove();
    }
}