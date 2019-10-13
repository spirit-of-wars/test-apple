<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 8:23
 */

namespace  backend\modules\apple\models\states\apple;

use \backend\modules\apple\models\Apple;
use \backend\modules\apple\models\db\Apple as DbModel;
class StateSwitcher
{
    /**
     * @var AbstractState
     */
    protected $state;

    /**
     * @var Apple
     */
    protected $context;


    /**
     * StateSwitcher constructor.
     * @param Apple $context
     */
    public function __construct(Apple $context)
    {
        $this->context = $context;
        $status = $this->context->getDbModel()->status;
        $fallDate = $this->context->getDbModel()->fall_date;

        switch(true) {
            case(!$status):
                $this->state = new OnTree($this);
                break;
            case($fallDate && time() - $fallDate > Rotten::ROTTEN_TIME):
                $this->state = new Rotten($this);
                break;
            case($status === DbModel::STATUS_UNDER_TREE):
                $this->state = new UnderTree($this);
                break;
            default:
                $this->state = new OnTree($this);
        }
    }

    /**
     * @param AbstractState $state
     */
    public function changeState($state)
    {
        $this->state = $state;
    }

    /**
     * @return AbstractState
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return Apple
     */
    public function getContext()
    {
        return $this->context;
    }
}