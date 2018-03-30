<?php

use yii\db\Migration;

/**
 * Class m180329_191605_create_user
 */
class m180329_191611_create_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'surname' => $this->string(),
                'login' => $this->string(),
                'password' => $this->string(),
                'role' => $this->string()
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180329_191605_create_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180329_191605_create_user cannot be reverted.\n";

        return false;
    }
    */
}
