<?php

use yii\db\Migration;

/**
 * Class m241219_120920_orders
 */
class m241219_120920_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->execute("CREATE TYPE status AS ENUM('received', 'assembling', 'delivering', 'awaiting in pick-up point')");

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'status' => $this->string()->notNull()->defaultValue('received'),
            't_price' => $this->integer()->notNull(),
            'customerID' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-orders-customerID',
            'orders',
            'customerID',
            'users',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_120920_orders cannot be reverted.\n";

        return false;
    }
    */
}
