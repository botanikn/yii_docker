<?php

use yii\db\Migration;

/**
 * Class m241219_120411_categories
 */
class m241219_120411_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->text(),
            'updated_by' => $this->integer(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-user-updated_by',
            'categories',
            'updated_by',
            'users',
            'id'
        );

        $this->insert('categories', [
            'name' => 'sport',
            'description' => 'sport inventory and other',
            'createTime' => date('Y-m-d H:i:s', time()),
            'updateTime' => date('Y-m-d H:i:s', time())
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_120411_categories cannot be reverted.\n";

        return false;
    }
    */
}
