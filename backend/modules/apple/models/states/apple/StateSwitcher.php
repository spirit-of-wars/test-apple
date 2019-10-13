<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 8:23
 */

namespace  backend\modules\apple\models\states\apple;

use \backend\modules\apple\models\Apple;
class StateSwitcher
{
    /**
     * @var AbstractState
     */
    protected $state;
    protected $context;


    public function __construct(Apple $context)
    {
        $this->context = $context;
        $this->state = new OnTree($this);
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

    public function getContext()
    {
        return $this->context;
    }
}