<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 6:08
 */

namespace  backend\modules\apple\models\states\apple;

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

    /**
     * @param $percent integer
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eat($percent)
    {
        if($this->checkRotten()) {
            $this->changeStateToRotten();
            $this->getStateSwitcher()->getState()->eat($percent);
            return;
        }
        $this->eatBehavior($percent);
    }

    /**
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove()
    {
        if($this->checkRotten()) {
            $this->changeStateToRotten();
            $this->getStateSwitcher()->getState()->remove();
        }
        if($this->getContext()->getDbModel()->size_percent > 0){
            throw new Exception('Удалить нельзя, яблоко не съедено');
        }
        //@todo проверить как эта шляпа работает
        if($this->getContext()->getDbModel()->delete()) {
            return;
        }
    }

    protected function checkRotten()
    {
        if($this->getContext()->getDbModel()->fall_date > 12600) {
            return true;
        }
        return false;
    }

    protected function changeStateToRotten()
    {
        $rottenState = new Rotten($this->getStateSwitcher());
        $this->getStateSwitcher()->changeState($rottenState);
    }


    /**
     * @param int $percent
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    protected function eatBehavior($percent = 0)
    {
        $percent = abs($percent);
        $dbModel = $this->getContext()->getDbModel();
        if($dbModel->size_percent < $percent) {
            throw new Exception('Нельзя откусить больше чем осталось');
        }
        $dbModel->size_percent -= $percent;
        if($dbModel->size_percent > 0) {
            $dbModel->save();
        } else {
            $this->remove();
        }

    }
}