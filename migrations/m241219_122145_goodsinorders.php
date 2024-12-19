<?php

use yii\db\Migration;

/**
 * Class m241219_122145_goodsinorders
 */
class m241219_122145_goodsinorders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('goodsinorders', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull()->unique(),
            'orderID' => $this->integer()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-goodsinorders-orderID',
            'goodsinorders',
            'orderID',
            'orders',
            'id'
        );
        $this->addForeignKey(
            'fk-goodsinorders-catalogID',
            'goodsinorders',
            'categoryID',
            'categories',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goodsinorders');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_122145_goodsinorders cannot be reverted.\n";

        return false;
    }
    */
}
