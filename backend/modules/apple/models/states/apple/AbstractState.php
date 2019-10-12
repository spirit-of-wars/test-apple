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
     * @var Apple
     */
    protected $context;

    /**
     * AbstractState constructor.
     * @param Apple $model
     */
    public function __construct(Apple $context)
    {
        $this->context = $context;
    }

    abstract public function fallToGround();
    abstract public function eat($percent);
    abstract public function remove();

}