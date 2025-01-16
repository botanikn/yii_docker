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
            'password_reset_token' => $this->string(),
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
        $this->insert('users', [
            'login' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('1111111111'),
            'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'firstName' => 'Robert',
            'lastName' => 'Patinson',
            'email' => 'r_b@gmail.com',
            'phone' => '79235442367',
            'roleID' => 1,
            'createTime' => date('Y-m-d H:i:s', time()),
            'updateTime' => date('Y-m-d H:i:s', time())
        ]);
        $this->insert('users', [
            'login' => 'client',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('1111111111'),
            'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'firstName' => 'Steve',
            'lastName' => 'Bushemi',
            'email' => 's_b@gmail.com',
            'phone' => '14682604790',
            'roleID' => 2,
            'createTime' => date('Y-m-d H:i:s', time()),
            'updateTime' => date('Y-m-d H:i:s', time())
        ]);
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
