<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 6:08
 */

namespace  backend\modules\apple\models\states\apple;

use backend\modules\apple\models\db\Apple;
use yii\base\Exception;

class OnTree extends AbstractState
{
    public function fallToGround()
    {
        $this->context->getDbModel()->status = Apple::STATUS_UNDER_TREE;
        $this->context->getDbModel()->save();

        $underTreeState = new UnderTree($this->context);
        $this->context->changeState($underTreeState);
    }

    /**
     * @param $percent
     * @throws Exception
     */
    public function eat($percent)
    {
        throw new Exception('Съесть нельзя, яблоко на дереве');
    }

    /**
     * @throws Exception
     */
    public function remove()
    {
        throw new Exception('Удалить нельзя, яблоко на дереве');
    }
}