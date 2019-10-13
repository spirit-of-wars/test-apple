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
    /**
     * @throws Exception
     */
    public function fallToGround()
    {
        $dbModel = $this->getContext()->getDbModel();
        $dbModel->status = Apple::STATUS_UNDER_TREE;
        if(!$dbModel->save()) {
            throw new Exception('Ошибка сохранения яблока');
        }

        $this->changeStateToUnderTree();
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

    protected function changeStateToUnderTree()
    {
        $underTreeState = new UnderTree($this->getStateSwitcher());
        $this->getStateSwitcher()->changeState($underTreeState);
    }
}