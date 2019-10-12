<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 13.10.2019
 * Time: 6:22
 */

namespace  backend\modules\apple\models\states\apple;

use yii\base\Exception;

class Rotten extends AbstractState
{
    /**
     * @throws Exception
     */
    public function fallToGround()
    {
        throw new Exception('Уронить нельзя, яблоко гнилое');
    }

    /**
     * @param $percent
     * @throws Exception
     */
    public function eat($percent)
    {
        throw new Exception('Съесть нельзя, яблоко гнилое');
    }

    /**
     * @throws Exception
     */
    public function remove()
    {
        throw new Exception('Удалить нельзя, яблоко гнилое');
    }
}