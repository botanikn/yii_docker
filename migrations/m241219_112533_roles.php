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
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241219_112533_roles cannot be reverted.\n";

        return false;
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
