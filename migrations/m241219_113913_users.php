<?php

use yii\db\Migration;

/**
 * Class m241219_113913_users
 */
class m241219_113913_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string(50)->notNull()->unique(),
            'password' => $this->text()->notNull()->unique(),
            'firstName' => $this->string(50)->notNull(),
            'lastName' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull(),
            'phone' => $this->string(20),
            'roleID' => $this->integer()->notNull(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-users-roleID',
            'users',
            'roleID',
            'roles',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241219_113913_users cannot be reverted.\n";

        return false;
    }
    */
}
