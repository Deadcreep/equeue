<?php

use yii\db\Migration;

/**
 * Class m180329_191631_create_operator
 */
class m180329_191613_create_operator extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Operators',
            [
                'id' => $this->primaryKey(),
                'windowId' => $this->integer()->notNull(),
                'userId' => $this->integer()->notNull(),
                'beginWorkTime' => $this->dateTime(),
                'endWorkTime' => $this->dateTime()
            ]
        );

        $this->addForeignKey(
            'windowId',
            'Operators',
            'windowId',
            'Windows',
            'id'
        );
        
        $this->addForeignKey(
            'userId',
            'Operators',
            'userId',
            'Users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180329_191631_create_operator cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180329_191631_create_operator cannot be reverted.\n";

        return false;
    }
    */
}
