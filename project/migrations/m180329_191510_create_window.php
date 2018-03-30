<?php

use yii\db\Migration;

/**
 * Class m180329_191549_create_window
 */
class m180329_191510_create_window extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Windows',
            [
                'id' => $this->primaryKey(),
                'number' => $this->string()->notNull()
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180329_191549_create_window cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180329_191549_create_window cannot be reverted.\n";

        return false;
    }
    */
}
