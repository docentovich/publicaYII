<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022603_user_group extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%user_group}}',
            [
                'id'=> $this->primaryKey(10),
                'name'=> $this->char(30)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%user_group}}');
    }
}
