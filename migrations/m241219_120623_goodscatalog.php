<?php

use yii\db\Migration;

/**
 * Class m241219_120623_goodscatalog
 */
class m241219_120623_goodscatalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('goodscatalog', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'categoryID' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-goodscatalog-categoryID',
            'goodscatalog',
            'categoryID',
            'categories',
            'id'
        );
        $this->addForeignKey(
            'fk-user-updated_by',
            'goodscatalog',
            'updated_by',
            'users',
            'id'
        );
        $this->insert('goodscatalog', [
            'name' => 'ball',
            'description' => 'for football',
            'price' => 20,
            'categoryID' => 1,
            'createTime' => date('Y-m-d H:i:s', time()),
            'updateTime' => date('Y-m-d H:i:s', time())
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goodscatalog');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_120623_goodscatalog cannot be reverted.\n";

        return false;
    }
    */
}
