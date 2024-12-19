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
