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

class UnderTree extends AbstractState
{
    /**
     * @throws Exception
     */
    public function fallToGround()
    {
        throw new Exception('Уронить нельзя, яблоко на земле');
    }

    public function eat($percent)
    {
        //@todo намутить логику
        $this->context->getDbModel()->size_percent -= $percent;
        $this->context->getDbModel()->save();

        $underTreeState = new UnderTree($this->context);
        $this->context->changeState($underTreeState);
    }

    /**
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove()
    {
        if($this->context->getDbModel()->size_percent > 0){
            throw new Exception('Удалить нельзя, яблоко не съедено');
        }
        //@todo проверить как эта шляпа работает
        if($this->context->getDbModel()->delete()) {
            unset($this->context);
        }
    }
}