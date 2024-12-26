<?php

use yii\db\Migration;

/**
 * Class m241223_142628_cartitems
 */
class m241223_142628_cartitems extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cartitems', [
            'id' => $this->primaryKey(),
            'userID' => $this->integer()->notNull(),
            'goodID' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-cartitems-userID',
            'cartitems',
            'userID',
            'users',
            'id'
        );
        $this->addForeignKey(
            'fk-cartitems-goodID',
            'cartitems',
            'goodID',
            'goodscatalog',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cartitems');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241223_142628_cartitems cannot be reverted.\n";

        return false;
    }
    */
}
