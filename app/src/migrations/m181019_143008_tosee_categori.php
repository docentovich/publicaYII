<?php

use yii\db\Schema;
use yii\db\Migration;

class m181019_143008_tosee_categori extends Migration
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
            '{{%tosee_categori}}',
            [
                'id'=> $this->primaryKey(10),
                'name'=> $this->char(30)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%tosee_categori}}');
    }
}