<?php

use yii\db\Schema;
use console\migrations\Migration;

class m170523_000352_categori extends Migration
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
            '{{%categori}}',
            [
                'id' => $this->primaryKey(10),
                'name' => $this->char(30)->notNull(),
            ], $this->tableOptions
        );



    }

    public function safeDown()
    {
        $this->dropTable('{{%categori}}');
    }
}
