<?php

use yii\db\Migration;
use \common\models\User;
/**
 * Class m191013_211252_add_admin_user_record
 */
class m191013_211252_add_admin_user_record extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {

        $user = new User();
        $user->username = 'admin';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword('admin');
        if(!$user->save()) {
            return false;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191013_211252_add_admin_user_record cannot be reverted.\n";

        return false;
    }

}
