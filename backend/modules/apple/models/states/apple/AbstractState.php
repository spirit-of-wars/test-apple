<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 6:01
 */

namespace  backend\modules\apple\models\states\apple;

use \backend\modules\apple\models\Apple;

abstract class AbstractState
{
    /**
     * @var StateSwitcher
     */
    protected $stateSwitcher;

    /**
     * AbstractState constructor.
     * @param StateSwitcher $stateSwitcher
     */
    public function __construct(StateSwitcher $stateSwitcher)
    {
        $this->stateSwitcher = $stateSwitcher;
    }

    abstract public function fallToGround();
    abstract public function eat($percent);
    abstract public function remove();

    public function getContext()
    {
        return $this->stateSwitcher->getContext();
    }

    public function getStateSwitcher()
    {
        return $this->stateSwitcher;
    }
}