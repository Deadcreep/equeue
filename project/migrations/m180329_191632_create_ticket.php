<?php

use yii\db\Migration;

/**
 * Class m180329_191532_create_ticket
 */
class m180329_191632_create_ticket extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Tickets',
        [
            'id' => $this->primaryKey(),
            'number' => $this->string()->notNull(),
            'creationDate' => $this->dateTime(),
            'completionDate' => $this->dateTime(),
            'receptionDate' => $this->dateTime(),
            'windowId' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-windowId',
            'Tickets',
            'windowId',
            'Windows',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180329_191532_create_ticket cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180329_191532_create_ticket cannot be reverted.\n";

        return false;
    }
    */
}
