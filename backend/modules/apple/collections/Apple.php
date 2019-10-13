<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.10.2019
 * Time: 4:53
 */
namespace backend\modules\apple\collections;

use \backend\modules\apple\models\db\Apple as DbApple;
use \backend\modules\apple\models\Apple as ModelApple;
use yii\base\Exception;

class Apple
{
    /**
     * @var ModelApple[]
     */
    protected $collection = [];

    public function __construct()
    {
        $DbApples = DbApple::find()->all();
        foreach($DbApples as $dbApple) {
            $this->collection[$dbApple->id] = new ModelApple($dbApple);
        }
    }

    /**
     * @param $id
     * @return ModelApple
     * @throws Exception
     */
    public function get($id)
    {
        if(!isset($this->collection[$id])) {
            throw new Exception("Элемент коллекции с ID '{$id}' не найден");
        }
        return $this->collection[$id];
    }

    /**
     * @return ModelApple[]
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * @param $color
     */
    public function create($color)
    {
        $modelApple = new ModelApple(null, $color);
        $id = $modelApple->getDbModel()->id;
        $this->collection[$id] = $modelApple;
    }
}