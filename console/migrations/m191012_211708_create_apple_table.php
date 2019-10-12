<?php

use yii\db\Migration;
use \backend\modules\apple\models\Apple;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m191012_211708_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(255)->notNull(),
            'size_percent' => $this->integer(3)->defaultValue(Apple::BASE_PERCENT_SIZE)->notNull(),
            'state' => $this->integer(3)->defaultValue(Apple::STATUS_ON_TREE)->notNull(),
            'fall_date' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
