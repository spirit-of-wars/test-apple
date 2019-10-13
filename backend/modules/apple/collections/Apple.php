<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.10.2019
 * Time: 4:53
 */

use \backend\modules\apple\models\db\Apple as DbApple;
use \backend\modules\apple\models\Apple as ModelApple;
class Apple
{
    protected $collection = [];

    public function __construct()
    {
        $DbApples = DbApple::findAll([]);
        foreach($DbApples as $dbApple) {
            $this->collection[$dbApple->id] = new ModelApple($dbApple);
        }
    }

    public function get($id)
    {
        return isset($this->collection[$id]) ? $this->collection[$id] : null;
    }

    public function getAll()
    {
        return $this->collection;
    }

    public function create($color)
    {
        $modelApple = new ModelApple(null, $color);
        $id = $modelApple->getDbModel()->id;
        $this->collection[$id] = $modelApple;
    }
}