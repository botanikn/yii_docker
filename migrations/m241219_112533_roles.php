<?php

use yii\db\Migration;

/**
 * Class m241219_112533_roles
 */
class m241219_112533_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('roles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_112533_roles cannot be reverted.\n";

        return false;
    }
    */
}
